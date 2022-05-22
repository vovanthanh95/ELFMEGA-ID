@extends('clients.main')
@section('content')
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">{{ __('message.changephone') }}</div>
        </section>
        <div class="loginmodal-container">
            <div class="conten_login">
                <div class="bk-form-login">
                    <form action="{{ route('post-change-phone') }}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <h5>{{ __('message.suggest') }}:
                                    @if (Auth::guard('client')->check())
                                        {{ $email }}
                                    @else
                                        <i style="color:red">{{ __('message.emailisnotregistered') }}</i>
                                    @endif
                                </h5>
                                <input id="currentemail" required autofocus autocomplete="off" name="currentemail"
                                    type="text" value="{{ old('currentemail') }}">
                                <label for="currentemail" alt="{{ __('message.currentemail') }}"
                                    placeholder="{{ __('message.currentemail') }}"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <h5>{{ __('message.suggest') }}:
                                    @if (Auth::guard('client')->check())
                                        {{ $phone }}
                                    @else
                                        <i style="color:red">{{ __('message.phoneisnotregistered') }}</i>
                                    @endif
                                </h5>
                                <input id="currentphone" required autofocus autocomplete="off" name="currentphone"
                                    type="text" value="{{ old('currentphone') }}">
                                <label for="currentphone" alt="{{ __('message.currentphone') }}"
                                    placeholder="{{ __('message.currentphone') }}"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="newphone" required autofocus autocomplete="off" name="newphone" type="text"
                                    value="{{ old('newphone') }}">
                                <label for="newphone" alt="{{ __('message.newphone') }}"
                                    placeholder="{{ __('message.newphone') }}"></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="row">
                                        <input type="submit" name="changepass"
                                            class="login loginmodal-submit pull-left col-md-12"
                                            value="{{ __('message.changephone') }}">
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
            <a href="{{ route('change-pass') }}"
                class="btn btn-warning ty-link c-point">{{ __('message.changepass') }}</a>
            <a href="{{ route('change-email') }}"
                class="btn btn-warning ty-link c-point">{{ __('message.changeemail') }}</a>
            <a href="{{ route('account') }}" class="btn btn-warning ty-link c-point">{{ __('message.myaccount') }}</a>
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
