$(document).ready(function () {
  $('#birthday')
    .datepicker({
      format: 'dd/mm/yyyy',
    })
    .on('changeDate', function () {
      $(this).datepicker('hide');
    });

  $('#time_cmnd')
    .datepicker({
      format: 'dd/mm/yyyy',
      todayHighlight: true,
    })
    .on('changeDate', function () {
      $(this).datepicker('hide');
    });
  // initFirebase();
});

// function initFirebase() {
//   // Your web app's Firebase configuration
//   var firebaseConfig = {
//     apiKey: 'AIzaSyCN_tZ4OYLL8zsq_S5EcwDXzba_7gY-ZC0',
//     authDomain: 'game-corp-3e79e.firebaseapp.com',
//     databaseURL: 'https://game-corp-3e79e.firebaseio.com',
//     projectId: 'game-corp-3e79e',
//     storageBucket: 'game-corp-3e79e.appspot.com',
//     messagingSenderId: '638390575257',
//     appId: '1:638390575257:web:3105c87301ae55240f9808',
//     measurementId: 'G-NMCSEHX9YL',
//   };
  // Initialize Firebase
  // firebase.initializeApp(firebaseConfig);
  // firebase.analytics();
  // Login phone
  // firebase.auth().languageCode = 'vn';
  // To apply the default browser preference instead of explicitly setting it.
  // window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
  //   'recaptcha-container',
  //   {
  //     size: 'normal',
  //   }
  // );
// }

const activePhone = (phoneNumber) => {
  var countryCode = '+84';
  var phoneFirebase = countryCode + phoneNumber;
  $('#captcha').modal('show');
  var appVerifier = window.recaptchaVerifier;
  firebase
    .auth()
    .signInWithPhoneNumber(phoneFirebase, appVerifier)
    .then(function (confirmationResult) {
      window.confirmationResult = confirmationResult;
      var code = prompt('Vui lòng nhập code', '');
      if (code) {
        confirmationResult
          .confirm(code)
          .then(async function (result) {
            const response = await sendActivePhone(result.user.uid);
            showAlert({
              htmlContent: response.message,
              confirmButtonText: 'Xác nhận',
            }).then((value) => {
              window.location.reload();
            });
            handleCloseModal();
          })
          .catch((err) => {
            if (err.code === 'auth/invalid-verification-code') {
              showAlert({
                htmlContent: 'Code xác thực không đúng',
                confirmButtonText: 'Xác nhận',
              });
            } else {
              showAlert({
                htmlContent: 'Đã có lỗi xảy ra. Vui lòng thử lại sau',
                confirmButtonText: 'Xác nhận',
              });
            }
          });
      } else {
        handleCloseModal();
      }
    });
};

const handleActiveEmail = async () => {
  const response = await sendActiveEmail();
  showAlert({ htmlContent: response.message, confirmButtonText: 'OK' });
};
const handleClickActivePhone = (phone) => {
  verifyReCaptchaCallBack(phone);
};

const verifyReCaptchaCallBack = (phone) => {
  var countryCode = '+84';
  var phoneFirebase = countryCode + phone;
  $('#captcha').modal('show');
  var appVerifier = window.recaptchaVerifier;
  firebase
    .auth()
    .signInWithPhoneNumber(phoneFirebase, appVerifier)
    .then(function (confirmationResult) {
      window.confirmationResult = confirmationResult;
      var code = prompt('Vui lòng nhập code', '');
      if (code) {
        confirmationResult
          .confirm(code)
          .then(async function (result) {
            const response = await sendActivePhone(result.user.uid);
            showAlert({
              htmlContent: response.message,
              confirmButtonText: 'Xác nhận',
            }).then((value) => {
              window.location.reload();
            });
            handleCloseModal();
          })
          .catch(handCaptchaError);
      } else {
        handleCloseModal();
      }
    })
    .catch(function (error) {});
};

const handleCloseModal = () => $('#captcha').modal('hide');

const handCaptchaError = (err) => {
  if (err.code === 'auth/invalid-verification-code') {
    showAlert({
      htmlContent: 'Code xác thực không đúng',
      confirmButtonText: 'Xác nhận',
    });
  } else {
    showAlert({
      htmlContent: 'Đã có lỗi xảy ra. Vui lòng thử lại sau',
      confirmButtonText: 'Xác nhận',
    });
  }
};
const handleConfirmUpdate = () => {
  let gender = getById('gender').val()
    ? parseInt(getById('gender').val(), 10)
    : 0;
  if (!gender) {
    var selectedGender = document.getElementsByName('inlineRadioOptions');
    for (i = 0; i < selectedGender.length; i++) {
      if (selectedGender[i].checked) {
        const checkedValue = $(selectedGender[i]).val();
        gender = parseInt(checkedValue, 10);
      }
    }
  }
  const data = {
    username: getById('username').val(),
    phone: getById('phone').val(),
    email: getById('email').val(),
    fullName: getById('fullName').val(),
    birthday: getById('birthday').val(),
    address: getById('address').val(),
    cmnd: getById('cmnd').val(),
    time_cmnd: getById('time_cmnd').val(),
    location_cmnd: getById('location_cmnd').val(),
    gender: gender ? gender : 0,
  };
  showConfirmPassword().then(async (confirmPassword) => {
    const body = {
      ...data,
      confirmPassword,
    };
    const response = await updateUserProfile(body);
    showAlert({
      htmlContent: response.message,
      confirmButtonText: 'Xác nhận',
    }).then((value) => {
      if (response.code === 200) {
        window.location.href = '/account';
      }
    });
  });
};

const linkFacebook = () => {
  const hashedPassword = $('#password').val();
  if (!hashedPassword) {
    showAlert({
      htmlContent:
        'Tài khoản chưa có mật khẩu. Vui lòng cập nhật mật khẩu trước',
    });
    return;
  }
  FB.login(
    function (response) {
      if (response.authResponse) {
        var accessToken = response.authResponse.accessToken;
        FB.api('/me?fields=id,name,email,picture', async function (response2) {
          if (response2.id) {
            const data = {
              open_id: accessToken,
              open_name: response2.name,
              open_avatar:
                'https://graph.facebook.com/' +
                response2.id +
                '/picture?type=square',
              open_email: response2.email ? response2.email : '',
            };
            const responseLinkProfile = await linkProfileFB(data);
            if (responseLinkProfile) {
              showAlert({
                htmlContent: responseLinkProfile.message,
                confirmButtonText: 'OK',
              }).then((value) => {
                if (responseLinkProfile.code === 200) {
                  window.location.reload();
                }
              });
            }
          }
        });
      }
    },
    { scope: 'public_profile,email' }
  );
};

const linkGoogle = async (response) => {
  const hashedPassword = $('#password').val();
  if (!hashedPassword) {
    showAlert({
      htmlContent:
        'Tài khoản chưa có mật khẩu. Vui lòng cập nhật mật khẩu trước',
    });
    return;
  }
  const profile = response.getBasicProfile();
  const data = {
    open_id: profile.getId(),
    open_name: profile.getName(),
    open_avatar: profile.getImageUrl(),
    open_email: profile.getEmail(),
  };
  const responseLinkProfile = await linkProfileGG(data);
  if (responseLinkProfile) {
    showAlert({
      htmlContent: responseLinkProfile.message,
      confirmButtonText: 'OK',
    }).then((value) => {
      if (responseLinkProfile.code === 200) {
        window.location.reload();
      }
    });
  }
};

const handleUpdatePassword = async () => {
  let requireOldPassword = false;
  const password = getById('password');
  const oldPassword = getById('oldPassword');
  const newPassword = getById('newPassword');
  const confirmPassword = getById('confirmPassword');
  const passwords = {
    confirmPassword: confirmPassword.val(),
    newPassword: newPassword.val(),
    oldPassword: oldPassword.val(),
  };
  if (password.val()) {
    requireOldPassword = true;
  }
  if (requireOldPassword && !passwords.oldPassword) {
    showAlert({ htmlContent: 'Vui lòng nhập mật khẩu cũ' });
    return;
  }

  if (!passwords.newPassword) {
    showAlert({ htmlContent: 'Vui lòng nhập mật khẩu mới' });
    return;
  }
  if (!passwords.confirmPassword) {
    showAlert({ htmlContent: 'Vui lòng nhập lại mật khẩu mới' });
    return;
  }
  if (passwords.confirmPassword !== passwords.newPassword) {
    showAlert({
      htmlContent: 'Xác nhận mật khẩu mới không trùng với mật khẩu mới',
    });
    return;
  }
  const response = await updatePassword(passwords);
  showAlert({ htmlContent: response.message }).then((result) => {
    if (result && response.code === 200) {
      window.location.href = '/account';
    }
  });
};
