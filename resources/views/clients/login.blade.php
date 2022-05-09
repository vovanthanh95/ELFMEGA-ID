@extends('clients.main')
@section('content')
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">login</div>
        </section>
        <div class="loginmodal-container">
            <div class="conten_login">
                <div class="bk-form-login">
                    <form action="login" method="post" novalidate="novalidate">
                        <input name="_token" type="hidden" value="">
                        <div class="col-md-12">
                            <div class="row">
                                <input id="login" required autofocus autocomplete="off" name="username" type="text"
                                    value="">
                                <label for="login" alt="username" placeholder="username'"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="password" required autocomplete="off" name="password" type="password" value="">
                                <label for="password" alt="password" placeholder="password"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <select class="select-list" name="serverid" id="serverid">
                                    <option>selectserver</option>
                                    <option value="server 1">value</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="row">
                                        <input type="submit" name="login"
                                            class="login loginmodal-submit pull-left col-md-12" value="login">
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
                    <p> Quên mật khẩu? Nhấn vào đây: <a href="{{ route('forgot-pass') }}"
                            style="text-decoration: underline;"><b>Đặt lại mật khẩu</b></a></p>
                    <p style="margin-left: -20px;"> Người mới? Nhấn vào đây: <a href="register"
                            style="text-decoration: underline;"><b>Tạo tài khoản mới</b></a></p>
                </div>
                <!-- <div class="pull-left col-md-6">
        <a href="register" style="text-decoration: underline;" class="login-register-link">register'</a>
       </div>
       <div class="pull-left">
        <span class="pull-left login-register">
        <i class="fa fa-refresh" aria-hidden="true"></i>
        <a href="forgotpass" style="text-decoration: underline;">recoveraccount</a></span>
       </div> -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
