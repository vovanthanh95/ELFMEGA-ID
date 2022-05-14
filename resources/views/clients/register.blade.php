@extends('clients.main')
@section('content')
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">{{ __('message.register') }}</div>
        </section>
        <div class="loginmodal-container">
            <div class="conten_login">
                <div class="bk-form-login">
                    <form action="{{route('post-register')}}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <input id="username" required autofocus autocomplete="off" name="username" type="text" value ="{{old('username')}}">
                                <label for="username" alt="{{ __('message.username') }}" placeholder="{{ __('message.username') }}"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="password" required autofocus autocomplete="off" name="password" type="password"
                                    value="">
                                <label for="password" alt="{{ __('message.password') }}" placeholder="{{ __('message.password') }}"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="email" required autofocus autocomplete="off" name="email" type="text" value ="{{old('email')}}">
                                <label for="email" alt="{{ __('message.email') }}" placeholder="{{ __('message.email') }}"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="phone" required autofocus autocomplete="off" name="phone" type="text" value="{{old('phone')}}">
                                <label for="phone" alt="{{ __('message.phone') }}" placeholder="{{ __('message.phone') }}"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input style="width:50%" id="captcha" required autofocus
                                    placeholder="{{ __('message.captcha') }}" autocomplete="off" name="captcha" type="text"
                                    value="">
                                <label id="refreshCaptcha">
                                    {!! captcha_img() !!}
                                </label>
                                <label for="captcha" alt="{{ __('message.captcha') }}" placeholder="{{ __('message.captcha') }}"></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="row">
                                        <input type="submit" name="register"
                                            class="login loginmodal-submit pull-left col-md-12"
                                            value="{{ __('message.register') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input name="return_url" type="hidden" value="">
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="login-help">
                <div style="text-align: center;margin-top: 20px;">
                    <p style="margin-left: -20px;">{{ __('message.doyouhaveaccount') }}<a href="{{ route('login') }}"
                            style="text-decoration: underline;"><b>{{ __('message.login') }}</b></a></p>
                    <p> Quên mật khẩu? Nhấn vào đây: <a href="{{ route('forgot-pass') }}"
                            style="text-decoration: underline;"><b>Đặt lại mật khẩu</b></a></p>
                </div>
            </div>
        </div>
        <style>
            .payment-body {
                display: flex;
                align-items: flex-start;
                justify-content: center;
            }

            .bk-loading {
                text-align: center;
                display: none;
            }

            .biometric-box {
                display: none;
            }

        </style>
    </div>

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

    @if ($errors->any())
       <script type="text/javascript">
        setTimeout(function() {
            swal("{{$errors->all()[0]}}");
        }, 500);
    </script>
    @endif
@endsection
