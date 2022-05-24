jQuery(document).ready(function() {
    jQuery('.social_login_gg').click(function(){
        var oPopup;
        oPopup = window.open(jQuery(this).data('link'), '_blank', "height=500,width=500,left=400, top=100", "resizable=yes", "scrollbars=no", "toolbar=no", "status=no");
    });
    
    jQuery('.social_login_fb').click(function(){
        FB.init({
            appId: jQuery(this).data('appid'),
            cookie: true, // This is important, it's not enabled by default
            version: 'v2.5'
        });
        FB.login(function(response) {
            if (response.authResponse) {
                jQuery.ajax({
                    url: sIDLINK + '/social/ssofb',
                    type: 'POST',
                    data: {
                        accesstoken: response.authResponse.accessToken
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        if (data) {
                            if (data.e) {
                                alert(data.r);
                                window.location.href = window.location.href
                            } else {
                                window.location.href = window.location.href
                            }
                        } else {
                            alert("Có lỗi xảy ra. Vui lòng thử lại.");
                            window.location.href = window.location.href
                        }
                    },
                    cache: false,
                    error: function() {
                        alert("Có lỗi xảy ra. Vui lòng thử lại.");
                        window.location.href = window.location.href
                    },
                    dataType: 'json'
                });
            } else {
                window.location.href = window.location.href
            }
        }, {
            scope: 'email,public_profile'
        });
    });
});
var bFlagSubmit = false;

function smLogin(){
    if(bFlagSubmit){
        return false;
    }
    var oAccount = jQuery('input#login_account');
    var oPassword = jQuery('input#login_password');
    
    jQuery('div.errors_alert').html('');
    if(!oAccount.val()){
        var sElement = jQuery('<p class="text-error text-left">* Tài khoản không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    if(!oPassword.val()){
        var sElement = jQuery('<p class="text-error text-left">* Mật khẩu không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    if(jQuery('input#login_captcha').length){
        if(!jQuery('input#login_captcha').val()){
            var sElement = jQuery('<p class="text-error text-left">* Mã kiểm tra không hợp lệ</p>');
            jQuery('div.errors_alert').html(sElement);
            return false;
        }
    }
    
    var sPassMD5 = (oPassword.val())?md5(oPassword.val()):'';
    oPassword.val(sPassMD5);
    
    bFlagSubmit = true;
    
    return bFlagSubmit;
}

function smRegister(){
    if(bFlagSubmit){
        return false;
    }
    var oUserName = jQuery('input#reg_username');
    var oPassword = jQuery('input#reg_password');
    var oConfirmPassword = jQuery('input#reg_confirmpassword');
    
    jQuery('div.errors_alert').html('');
    if(!oUserName.val()){
        var sElement = jQuery('<p class="text-error text-left">* Tên đăng nhập không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    if(!oPassword.val()){
        var sElement = jQuery('<p class="text-error text-left">* Mật khẩu không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    if(oPassword.val() != oConfirmPassword.val()){
        var sElement = jQuery('<p class="text-error text-left">* Xác nhận mật khẩu không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    if(jQuery('input#reg_captcha').length){
        if(!jQuery('input#reg_captcha').val()){
            var sElement = jQuery('<p class="text-error text-left">* Mã kiểm tra không hợp lệ</p>');
            jQuery('div.errors_alert').html(sElement);
            return false;
        }
    }
    
    var sPassMD5 = (oPassword.val())?md5(oPassword.val()):'';
    oPassword.val(sPassMD5);
    
    var sConfirmPassMD5 = (oConfirmPassword.val())?md5(oConfirmPassword.val()):'';
    oConfirmPassword.val(sConfirmPassMD5);
    
    bFlagSubmit = true;
    
    return bFlagSubmit;
}

function smForgotPassword(){
    if(bFlagSubmit){
        return false;
    }
    var oAccount = jQuery('input#fgp_account');
    var oCaptcha = jQuery('input#fgp_captcha');
    
    jQuery('div.errors_alert').html('');
    if(!oAccount.val()){
        var sElement = jQuery('<p class="text-error text-left">* Tài khoản không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    if(!oCaptcha.val()){
        var sElement = jQuery('<p class="text-error text-left">* Mã kiểm tra không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    bFlagSubmit = true;
    
    return bFlagSubmit;
}

function smChangeForgotPass(){
    if(bFlagSubmit){
        return false;
    }
    var oPassword = jQuery('input#cfgp_password');
    var oConfirmPassword = jQuery('input#cfgp_confirmpassword');
    var oCaptcha = jQuery('input#cfgp_captcha');
    
    jQuery('div.errors_alert').html('');
    
    if(!oPassword.val()){
        var sElement = jQuery('<p class="text-error text-left">* Mật khẩu không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    if(oPassword.val() != oConfirmPassword.val()){
        var sElement = jQuery('<p class="text-error text-left">* Xác nhận mật khẩu không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    if(!oCaptcha.val()){
        var sElement = jQuery('<p class="text-error text-left">* Mã kiểm tra không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    var sPassMD5 = (oPassword.val())?md5(oPassword.val()):'';
    oPassword.val(sPassMD5);
    
    var sConfirmPassMD5 = (oConfirmPassword.val())?md5(oConfirmPassword.val()):'';
    oConfirmPassword.val(sConfirmPassMD5);
    
    bFlagSubmit = true;
    
    return bFlagSubmit;
}


