var _action_url = "/login";
var _action_login = "login";
var _action_check_login = "checkLogin";
var _login_type_account = "LOGIN_BY_ACCOUNT";
var _login_type_google = "LOGIN_BY_GOOGLE";
var _login_type_facebook = "LOGIN_BY_FACEBOOK";
var on_loading = 'Đang xử lý...';

var channel;
var utm_medium;
var utm_content;
var gameid;
var redirectUrl;
var lang;

$(document).ready(function () {
     initGlobalVariable();
    initMessage();
    $("#forget-pass").click(function () {
        window.location.href = '/forget_password?gameid=' + gameid +'&utm_medium='+utm_medium + '&utm_content='+utm_content+ '&channel='+channel+ '&redirectUrl=' + encodeURIComponent(redirectUrl);
    });
     $("#register").click(function () {
        window.location.href = '/register?gameid=' + gameid + '&utm_medium='+utm_medium + '&utm_content='+utm_content+ '&channel='+channel +'&redirectUrl=' + encodeURIComponent(redirectUrl);
    });

    $(".image-dropdown").click(function () {
        $("#username").trigger('focus');
    })

    $("#action-login-yg").click(function () {
        const username = $.trim($("#username").val());
        const password = $("#password").val();
        var valid = 0;
        if (username.length === 0) {
            valid++;
            $("#username").addClass("has-error");
        } else {
            $("#username").removeClass("has-error");
        }
        if (password.length === 0) {
            valid++;
            $("#password").addClass("has-error");
        } else {
            $("#password").removeClass("has-error");
        }

        if (valid > 0) {
            return;
        }
        const datas = {
            "action": _action_login,
            "username": username,
            "password": password,
            "loginType": _login_type_account,
            "redirectUrl": redirectUrl,
            "gameid": gameid,
            "utm_content": utm_content,
            "utm_medium": utm_medium,
            "channel":channel
        };
        openLoader();
        $.ajax({
            url: "/login_yg",
            data: datas,
            success: function (result) {
                if (result.status === 1) {
                    const user = JSON.parse(result.user);
                    
                    let message = '';
                    if (lang === 'VN') {
                        message = 'Đăng nhập thành công với tài khoản <span style="font-weight:bold"> ' + user.username + '</span>';
                    } else {
                        message = 'Login successfully with account <span style="font-weight:bold"> ' + user.username + '</span>';
                    }
                    Swal.fire({
                        title: "",
                        html: message,
                        type: "success",
                        showCancelButton: false,
                        closeOnConfirm: true,
                        showLoaderOnConfirm: true,
                        showCloseButton: true,
                        showConfirmButton: true
                    }).then(function () {
                        console.log();
                        window.location = "?redirectUrl=" + encodeURIComponent(redirectUrl) + "&utm_medium=" +utm_medium +"&utm_content=" +utm_content +"&channel="+channel +"&gameid=" +gameid;
                    });
                } else {
                    let message = '';
                    if (lang === 'VN') {
                        message = result.msg;
                    } else {
                        message = result.msgEng;
                    }
                    Swal.fire({
                        title: "",
                        text: message,
                        type: "error",
                        showCancelButton: false,
                        closeOnConfirm: true,
                        showLoaderOnConfirm: true,
                        showCloseButton: true,
                        showConfirmButton: true,
                    });
                }
                $(".swal2-close").html("");
            },
            error: function (result) {

            },
            complete: function (data) {
                closeLoader();
            }
        });
    });

    $("#password").keyup(function (event) {
        if (event.keyCode === 13) {
            $("#action-login-yg").click();
        }
    });

});

function initGlobalVariable(){
    channel = $("#channel").val() ? $("#channel").val() : "";
    utm_medium = $("#utm_medium").val() ? $("#utm_medium").val() : "";
    utm_content = $("#utm_content").val() ? $("#utm_content").val() : "";
    gameid = getUrlParameter("gameid") ? getUrlParameter("gameid") : 0;
    redirectUrl = $("#redirect_url").val() ? $("#redirect_url").val() : '';
    lang = $('#lang').val() ? $("#lang").val() : '';;
}

function initMessage() {
    
    if (lang !== 'VN') {
        on_loading = 'Proccessing data...';
    }
}

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var datas = {
        "open_id": profile.getId(),
        "open_name": profile.getName(),
        "open_avatar": profile.getImageUrl(),
        "open_email": profile.getEmail(),
        "channel": channel,
        "utm_medium": utm_medium,
        "utm_content": utm_content,
        "gameid": gameid,
        "redirectUrl": redirectUrl
    };
    openLoader();
    $.ajax({
        url: "/login_gg",
        data: datas,
        success: function (result) {
            if (result.status === 1) {
                const user = JSON.parse(result.user);
                let message = ''
                if (lang === 'VN') {
                    message = 'Đăng nhập thành công với tài khoản <span style="font-weight:bold"> ' + user.username + '</span>';
                } else {
                    message = 'Login successfully with account <span style="font-weight:bold"> ' + user.username + '</span>';
                }
                Swal.fire({
                    title: "",
                    html: message,
                    type: "success",
                    showCancelButton: false,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: true,
                    showCloseButton: true,
                }).then(function () {
                    window.location = "?redirectUrl=" + encodeURIComponent(redirectUrl) + "&utm_medium=" +utm_medium +"&utm_content=" +utm_content +"&channel="+channel +"&gameid=" +gameid;
                });
            } else {
                let message = ''
                if (lang === 'VN') {
                    message = result.msg;
                } else {
                    message = result.msgEng;
                }
                Swal.fire({
                    title: "",
                    text: message,
                    type: "error",
                    showCancelButton: false,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: true,
                    showCloseButton: true,
                });
            }
            $(".swal2-close").html("");
        },
        complete: function (data) {
            closeLoader();
        }
    });
}

function onLoadGoogleCallback() {
    gapi.load('auth2', function () {
        auth2 = gapi.auth2.init({
            client_id: '${google_client}',
            cookiepolicy: 'single_host_origin',
            scope: 'profile'
        });
        auth2.attachClickHandler(element, {},
            function (googleUser) {
                onSignIn(googleUser)
            }, function (error) {
                console.log('Sign-in error', error);
            }
        );
    });

    element = document.getElementById('googleSignIn');
}


$(".country").click(function (event) {
    event.preventDefault();
    var country = $(this).attr("id");
    var datas = {
        "action": "changeLanguage",
        "code": country
    };
    openLoader();
    $.ajax({
        url: "/home",
        data: datas,
        success: function (result) {
            if (result.result == true)
                location.reload(true);
        },
        error: function () {
            alert("Error");
        },
        complete: function (data) {
            closeLoader();
        }
    });
});
function loginFB() {
    FB.login(function (response) {
        if (response.authResponse) {
            var accessToken = response.authResponse.accessToken;
            FB.api('/me?fields=id,name,email,picture', function (response) {
                var email = "";
                var avatar = "";
                if (response.email)
                    email = response.email;
                if (response.id)
                    avatar = "https://graph.facebook.com/" + response.id + "/picture?type=square";
                var datas = {
                    "open_id": accessToken,
                    "open_name": response.name,
                    "open_avatar": avatar,
                    "open_email": email,
                    "channel": channel,
                    "utm_medium": utm_medium,
                    "utm_content": utm_content,
                    "gameid": gameid,
                    "redirectUrl": redirectUrl
                };
                openLoader();
                $.ajax({
                    url: "/login_fb",
                    data: datas,
                    success: function (result) {
                        if (result.status === 1) {
                            const user = JSON.parse(result.user);
                            let message = '';
                            if (lang === 'VN') {
                                message = 'Đăng nhập thành công với tài khoản <span style="font-weight:bold"> ' + user.username + '</span>';
                            } else {
                                message = 'Login successfully with account <span style="font-weight:bold"> ' + user.username + '</span>';
                            }
                            Swal.fire({
                                title: "",
                                html: message,
                                type: "success",
                                showCancelButton: false,
                                closeOnConfirm: true,
                                showLoaderOnConfirm: true,
                                showCloseButton: true,
                            }).then(function () {
                                window.location = "?redirectUrl=" + encodeURIComponent(redirectUrl) + "&utm_medium=" +utm_medium +"&utm_content=" +utm_content +"&channel="+channel+"&gameid=" +gameid;
                            });
                        } else {
                            
                            let message = '';
                            if (lang === 'VN') {
                                message = result.msg;
                            } else {
                                message = result.msgEng;
                            }
                            Swal.fire({
                                title: "",
                                text: message,
                                type: "error",
                                showCancelButton: false,
                                closeOnConfirm: true,
                                showLoaderOnConfirm: true,
                                showCloseButton: true
                            });
                        }
                        $(".swal2-close").html("");
                    },
                    error: function () { },
                    complete: function (data) {
                        closeLoader();
                    }
                });
            });
        }
    }, { scope: 'public_profile,email' });
}
function checkLoginState() {
    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
    });
}
function statusChangeCallback(response) {
    console.log(response);
}
window.fbAsyncInit = function () {
    const fb_id = $("#facebook_id").val();
    FB.init({
        appId: fb_id,
        cookie: true,
        xfbml: true,
        version: 'v8.0'
    });

    FB.AppEvents.logPageView();
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function openLoader() {
    var options = {
        theme: "sk-bounce",
        message: on_loading,
        backgroundColor: "#e9f0f6",
        textColor: "#5d6062"
    };
    HoldOn.open(options);
}

function closeLoader() {
    HoldOn.close();
}