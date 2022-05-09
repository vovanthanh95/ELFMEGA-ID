@extends('clients.main')
@section('content')
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">changephon</div>
        </section>
        <div class="loginmodal-container">
            <div class="conten_login">
                <div class="bk-form-login">
                    <form action="/changephone" method="post" novalidate="novalidate">
                        <input name="_token" type="hidden" value="">

                        <div class="col-md-12">
                            <div class="row">
                                <input id="currentemail" required autofocus autocomplete="off" name="currentemail"
                                    type="text" value="">
                                <label for="currentemail" alt="currentemail" placeholder="currentemail"></label>
                                <h5>suggest:<i style="color:red">emailisnotregistered</i></h5>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="currentphone" required autofocus autocomplete="off" name="currentphone"
                                    type="text" value="">
                                <label for="currentphone" alt="currentphone" placeholder="currentphone"></label>
                                <h5>suggest: <i style="color:red">phoneisnotregistered</i></h5>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="newphone" required autofocus autocomplete="off" name="newphone" type="text"
                                    value="">
                                <label for="newphone" alt="newphone" placeholder="newphone"></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="row">
                                        <input type="submit" name="changepass"
                                            class="login loginmodal-submit pull-left col-md-12" value="changephone">
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
            <a href="{{ route('change-pass') }}" class="btn btn-warning ty-link c-point">changepass</a>
            <a href="{{ route('change-email') }}" class="btn btn-warning ty-link c-point">changeemail</a>
            <a href="{{ route('account') }}" class="btn btn-warning ty-link c-point">myaccount</a>
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
