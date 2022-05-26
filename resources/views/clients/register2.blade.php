@extends('clients.main2')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2">
                <div class="dangky-home">
                    <h3 class="title">Chào mừng bạn đến với <span class="textcolor textbold">GALAXY
                            GAME</span>
                    </h3>
                    <div class="dangky-home-box">
                        <h4 class="title"><span class="icons-icon-user2"></span> Đăng ký tài khoản</h4>
                        <div class="dangky-home-content">
                            <p class="text-note text-left">Những thông tin có đánh dấu <span class="text-note2">*</span>
                                là bắt buộc nhập.</p>
                            <form name="frmRegister" id="frmRegister" action="{{route('post-register')}}" method="POST">
                                @csrf
                                <div class="errors_alert">
                                </div>
                                <div class="form-group">
                                    <label for="reg_username">{{__('message.username')}}</label>
                                    <input type="text" class="form-control" id="reg_username" name="username"
                                        placeholder="{{__('message.username')}}" value="{{old('username')}}">

                                    <span class="text-note2 text-hoa">*</span>
                                    <p class="text-note text-right"><i>(Tên đăng nhập dài 6-32 ký tự thường và
                                            số)</i></p>
                                </div>
                                <div class="form-group">
                                    <label for="reg_password">{{__('message.password')}}</label>
                                    <input type="password" class="form-control" id="reg_password" name="password"
                                        placeholder="{{__('message.password')}}">

                                    <span class="text-note2 text-hoa">*</span>
                                    <p class="text-note text-right"><i>(Mật khẩu có chiều dài 6-32 ký tự)</i>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="reg_confirmpassword">{{__('message.email')}}</label>
                                    <input type="text" class="form-control" id="reg_confirmpassword"
                                        name="email" placeholder="{{__('message.email')}}" value="{{old('email')}}">

                                    <span class="text-note2 text-hoa">*</span>
                                </div>
                                <div class="form-group">
                                    <label for="reg_confirmpassword">{{__('message.phone')}}</label>
                                    <input type="text" class="form-control" id="reg_confirmpassword"
                                        name="phone" placeholder="{{__('message.phone')}}" value="{{old('phone')}}">

                                    <span class="text-note2 text-hoa">*</span>
                                </div>
                                <div class="form-group">
                                        <label for="reg_captcha">{{__('message.captcha')}}</label>
                                        <input type="text" class="form-control" id="reg_captcha" name="captcha"
                                            placeholder="{{__('message.captcha')}}">
                                        <span class="text-note2 text-hoa">*</span>
                                </div>
                                <div class="form-group">
                                    <div class="" id="refreshCaptcha">
                                            {!! captcha_img() !!}
                                    </div>
                                </div>
                                <div class="box-submit">
                                    <div class="row btsm">
                                        <button type="submit" class="btn bt-click">{{__('message.register')}}</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2">
                <p class="text-note text-center">Nếu bạn đã có tài khoản GA ID, về <a href="{{route('login')}}">Trang
                        chủ</a> để đăng nhập.</p>
            </div>
        </div>
    </div>
    {{-- reload captcha onclick --}}
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
