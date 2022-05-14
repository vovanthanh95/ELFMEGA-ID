@extends('clients.main')
@section('content')
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">{{__('message.recoveraccount')}}</div>
        </section>
        <div class="loginmodal-container">
            <div class="conten_login">
                <div class="bk-form-login">
                    <form action="/forgotpass" method="post" novalidate="novalidate">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <input id="username" required autofocus autocomplete="off" name="username" type="text"
                                    value="">
                                <label for="username" alt="username" placeholder="username"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="email" required autofocus autocomplete="off" name="email" type="text" value="">
                                <label for="email" alt="email" placeholder="email"></label>
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
                                        <input type="submit" name="forgotpass"
                                            class="login loginmodal-submit pull-left col-md-12" value="recoveraccount">
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
                <div>
                    <? doyouhaveaccount ?>
                    <!-- <a href="register" class="login-register-link">register</a> -->
                    <a href="login" style="text-decoration: underline;">login</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
