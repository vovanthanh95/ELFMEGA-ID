@extends('clients.main')
@section('content')
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">myaccount</div>
        </section>
        <br />
        <div class="loginmodal-container">
            <div class="conten_login">
                <div class="bk-form-login">
                    <form action="/account" method="post" novalidate="novalidate">
                        <input name="_token" type="hidden" value="">
                        <div class="col-md-12">
                            <div class="row">
                                email<br />
                                <input id="email" autocomplete="off" name="email" type="text" placeholder="email" value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                phone:<br />
                                <input id="phone" autocomplete="off" name="phone" type="text" placeholder="updatephone"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                createtime:<br />
                                <input id="createtime" required readonly autocomplete="off" name="createtime" type="text"
                                    value="">
                            </div>
                        </div>
                        createip:<br />
                        <div class="col-md-12">
                            <div class="row">
                                surplus:<br />
                                <input id="surplus" required readonly autocomplete="off" name="surplus" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="row">
                                        <input type="submit" name="account"
                                            class="login loginmodal-submit pull-left col-md-12" value="update">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input name="return_url" type="hidden" value="">
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="link-auth block">
            <a href="{{ route('change-pass') }}" class="btn btn-warning" style="width: 138px;">changepass</a>
            <a href="{{ route('change-email') }}" class="btn btn-warning" style="width: 138px;">changeemail</a>
            <a href="{{ route('change-phone') }}" class="btn btn-warning" style="width: 138px;">changephone</a>
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

            .link-auth {
                text-align: center;
                padding: 30px 0 0;
            }

            .link-auth a {
                display: inline-block;
            }

            .link-auth.block {
                padding-top: 0;
            }

            .link-auth.block a {
                margin: 3px 0;
                list-style-type: none;
            }

        </style>
    </div>
@endsection
