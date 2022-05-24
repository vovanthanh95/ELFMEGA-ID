jQuery(document).ready(function() {
  
});
var bFlagSubmit = false;

function smChangePassword(){
    if(bFlagSubmit){
        return false;
    }
    var oPassword = jQuery('input#old_password');
    var oNewPassword = jQuery('input#new_password');
    var oConfirmNewPassword = jQuery('input#new_confirmpassword');
    
    jQuery('div.errors_alert').html('');
    
    if(!oPassword.val()){
        var sElement = jQuery('<p class="text-error text-left">* Mật khẩu hiện tại không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    if(!oNewPassword.val()){
        var sElement = jQuery('<p class="text-error text-left">* Mật khẩu mới không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    if(oNewPassword.val() != oConfirmNewPassword.val()){
        var sElement = jQuery('<p class="text-error text-left">* Xác nhận mật khẩu mới không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    var sPassMD5 = (oPassword.val())?md5(oPassword.val()):'';
    oPassword.val(sPassMD5);
    
    var sNewPassMD5 = (oNewPassword.val())?md5(oNewPassword.val()):'';
    oNewPassword.val(sNewPassMD5);
    
    var sConfirmNewPassMD5 = (oConfirmNewPassword.val())?md5(oConfirmNewPassword.val()):'';
    oConfirmNewPassword.val(sConfirmNewPassMD5);
    
    bFlagSubmit = true;
    
    return bFlagSubmit;
}

function smUpdateInfo(){
    if(bFlagSubmit){
        return false;
    }
    
    var oFullName = jQuery('input#u_fullname');
    var oPhone = jQuery('input#u_phone');
    var oCardID = jQuery('input#u_cardid');
    var oAddress = jQuery('input#u_address');
    var oDayBorn = jQuery('select#u_born_day');
    var oMonthBorn = jQuery('select#u_born_month');
    var oYearBorn = jQuery('select#u_born_year');
    var oGender = jQuery('input[type=radio][name=u_gender]:checked');
    var oConfirmInfo = jQuery('input[type=checkbox][name=u_confirminfo]:checked');
    
    jQuery('div.errors_alert').html('');
    
    if(!oFullName.val()){
        var sElement = jQuery('<p class="text-error text-left">* Họ và tên không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    if(!oPhone.val()){
        var sElement = jQuery('<p class="text-error text-left">* Số điện thoại không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    if(!oCardID.val()){
        var sElement = jQuery('<p class="text-error text-left">* CMND/PassPort không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    if(!oAddress.val()){
        var sElement = jQuery('<p class="text-error text-left">* Địa chỉ không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    if(!oDayBorn.val()){
        var sElement = jQuery('<p class="text-error text-left">* Ngày sinh không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    if(!oMonthBorn.val()){
        var sElement = jQuery('<p class="text-error text-left">* Tháng sinh không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    if(!oYearBorn.val()){
        var sElement = jQuery('<p class="text-error text-left">* Năm sinh không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    if(!oGender.val() || oGender.val()=='underfined'){
        var sElement = jQuery('<p class="text-error text-left">* Giới tính không hợp lệ</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    if(!oConfirmInfo.val()){
        var sElement = jQuery('<p class="text-error text-left">* Vui lòng xác nhận thông tin đúng sự thật</p>');
        jQuery('div.errors_alert').html(sElement);
        return false;
    }
    
    bFlagSubmit = true;
    
    return bFlagSubmit;
}