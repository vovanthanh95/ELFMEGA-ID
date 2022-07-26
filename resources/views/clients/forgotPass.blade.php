@extends('clients.main-login-fogot')
@section('content')
    <section class="login-section">
        <div class="box-container" style="  box-shadow:0 0px 40px rgba(0, 0, 0, 0.17)">
            <div class="login-container">
                <div class="login-content">
                    <div class="login-header">
                        <img src="{{ asset('assets/img/icon_logo.png') }}" alt="" class="login-logo">
                    </div>
                    <div class="text">
                        <span>QUÊN MẬT KHẨU</span>
                    </div>
                    <div class="login-body forgot-pass">
                        <form action="{{ route('post-forgot-pass') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="row" style="margin-bottom: 20px;">
                                <input name="username" class="col-md-12 form-control input-forget" type="text" placeholder="Tên đăng nhập" value="{{ old('username') }}" style="height: 40px;">
                            </div>
                            <div class="row">
                                <input name="email" class="col-12 form-control input-forget" type="email" placeholder="Email khôi phục tài khoản" value="{{ old('email') }}" style="height: 40px;">
                            </div>
                            <div class="row">
                                <input class="col-sm-8 form-control input-forget" name="captcha" id="newPassword" type="text"
                                    placeholder="Mã captcha" value="{{ old('captcha') }}" style="height: 40px;">
                                    <p class="col-sm-4 img-forget" id="refreshCaptcha" style="margin-top: 8px;">
                                        {!! captcha_img() !!}
                                    </p>
                            </div>
                            <div class="row">
                                <p><i style="color: #5b545b;">*click vào captcha để thay đổi captcha<i></p>
                            </div>
                            <div class="row" style="margin-left: 40px;">
                                <button type="submit" class="btn-green core-btn">XÁC NHẬN</button>
                                <a href="{{ route('login') }}"><button type="button" class="btn-cancel core-btn">HỦY</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
		$(document).ready(function(){
            $('#refreshCaptcha').click(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: 'reloadCaptcha',
                    success: function(result){
                        $('#refreshCaptcha').html(result.captcha);
                    },
                });
            });
        });
	</script>
@endsection
