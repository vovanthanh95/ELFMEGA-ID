@extends('clients.main')
@section('content')
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">register</div>
        </section>
        <div class="loginmodal-container">
            <div class="conten_login">
                <div class="bk-form-login">
                    <form action="register" method="post" novalidate="novalidate">
                        <input name="_token" type="hidden" value="">
                        <div class="col-md-12">
                            <div class="row">
                                <input id="username" required autofocus autocomplete="off" name="username" type="text">
                                <label for="username" alt="username" placeholder="username"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="password" required autofocus autocomplete="off" name="password" type="password"
                                    value="">
                                <label for="password" alt="password" placeholder="password"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="email" required autofocus autocomplete="off" name="email" type="text">
                                <label for="email" alt="email" placeholder="email"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="phone" required autofocus autocomplete="off" name="phone" type="text">
                                <label for="phone" alt="phone" placeholder="phone"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input style="width:50%" id="captcha" required autofocus placeholder="captcha"
                                    autocomplete="off" name="captcha" type="text" value="">
                                <a href="javascript:changeCaptcha();" id="refreshCaptcha">
                                    {!!captcha_img()!!}
                                </a>
                                <label for="captcha" alt="captcha" placeholder="captcha"></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="row">
                                        <input type="submit" name="register"
                                            class="login loginmodal-submit pull-left col-md-12" value="register">
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
                    <p style="margin-left: -20px;">doyouhaveaccount <a href="{{ route('login') }}"
                            style="text-decoration: underline;"><b>login</b></a></p>
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
@endsection
