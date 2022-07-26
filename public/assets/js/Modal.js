const showConfirm = ({ htmlContent, confirmButtonText, cancelButtonText }) => {
  return new Promise((resolve) => {
    Swal.fire({
      html: htmlContent,
      showCancelButton: true,
      showCloseButton: true,
      confirmButtonText: confirmButtonText ? confirmButtonText : 'Xác nhận',
      cancelButtonText: cancelButtonText ? cancelButtonText : 'Hủy',
      customClass: {
        container: 'game-sweetalert',
        actions: 'popup-confirm-actions',
      },
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        resolve(true);
      } else if (result.dismiss === 'cancel') {
        resolve(false);
      } else {
        resolve(null);
      }
    });
    document.getElementsByClassName('swal2-close')[0].innerHTML = '';
  });
};

const showAlert = ({
  htmlContent,
  confirmButtonText,
  showCloseButton = true,
}) => {
  return new Promise((resolve) => {
    Swal.fire({
      html: htmlContent,
      showCancelButton: false,
      showCloseButton,
      allowOutsideClick: false,
      confirmButtonText: confirmButtonText ? confirmButtonText : 'Xác nhận',
      customClass: {
        container: 'game-sweetalert',
      },
    }).then((result) => {
      if (result.isConfirmed) {
        resolve(true);
      }
    });
    document.getElementsByClassName('swal2-close')[0].innerHTML = '';
  });
};

const showConfirmPassword = async () => {
  return new Promise((resolve) => {
    Swal.fire({
      html: `
      <input id="swal-input" class="form-control" type="password" placeholder="Nhập mật khẩu">`,
      focusConfirm: false,
      showCancelButton: true,
      showCloseButton: true,
      confirmButtonText: 'Xác nhận',
      cancelButtonText: 'Hủy',
      customClass: {
        actions: 'popup-confirm-actions',
        container: 'game-sweetalert',
      },
      allowOutsideClick: false,
      preConfirm: () => {
        resolve(document.getElementById('swal-input').value);
      },
    });
    document.getElementsByClassName('swal2-close')[0].innerHTML = '';
  });
};
