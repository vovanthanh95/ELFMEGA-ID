@extends('clients.main')
@section('content')
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">{{__('message.changepass')}}</div>
        </section>
        <div class="loginmodal-container">
            <div class="conten_login">
                <div class="bk-form-login">
                    <form action="{{route('post-change-pass')}}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <input id="currentpassword" required autofocus autocomplete="off" name="currentpassword"
                                    type="password" value="">
                                <label for="currentpassword" alt="{{__('message.currentpassword')}}" placeholder="{{__('message.currentpassword')}}"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="newpassword" required autofocus autocomplete="off" name="newpassword"
                                    type="password" value="">
                                <label for="newpassword" alt="{{__('message.newpassword')}}" placeholder="{{__('message.newpassword')}}"></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="row">
                                        <input type="submit" name="changepass"
                                            class="login loginmodal-submit pull-left col-md-12" value="{{__('message.changepass')}}">
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
            <a href="{{ route('change-email') }}" class="btn btn-warning ty-link c-point">{{__('message.changeemail')}}</a>
            <a href="{{ route('change-phone') }}" class="btn btn-warning ty-link c-point">{{__('message.changephone')}}</a>
            <a href="{{ route('account') }}" class="btn btn-warning ty-link c-point">{{__('message.myaccount')}}</a>
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
