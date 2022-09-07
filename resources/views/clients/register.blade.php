@extends('clients.main-login-fogot')
@section('content')
    <section class="login-section">
        <div class="box-container" style="  box-shadow:0 0px 40px rgba(0, 0, 0, 0.17)">
            <div class="login-container">
                <div class="login-content">
                    <div class="login-header">
                        <img src="{{ asset('assets/img/icon_logo.png') }}" alt="" class="login-logo">
                    </div>
                    <form action="{{ route('post-register') }}" method="POST">
                        @csrf
                        <div class="login-body">
                            <div class="row input-mg input-custom" style="margin-bottom: 20px;">
                                <i class="fa-regular fa-user icon-input"></i>
                                <input name="username" class="col-md-12 form-control input-forget" type="text"
                                    placeholder="{{ trans('message.formusername') }}" value="{{ old('username') }}"
                                    style="height: 55px;">
                            </div>
                            <div class="row input-mg input-custom">
                                <i class="fa-solid fa-key icon-input"></i>
                                <input name="password" class="col-12 form-control input-forget" type="password"
                                    placeholder="{{ trans('message.formpassword') }}" value="" style="height: 55px;">
                            </div>
                            <div class="login-forget">
                                <a id="forget-pass" style="font-style: normal;" href="{{ route('forgot-pass') }}">
                                    {{ trans('message.formforgotpass') }}
                                </a>
                            </div>
                            <div class="login-button">
                                <style>
                                    .btn-green {
                                        margin-right: 0px !important
                                    }
                                </style>
                                <button type="submit"
                                    class="btn-green core-btn btn-login">{{ trans('message.btnregister') }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="login-footer">
                        <div class="lang">
                            <div data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="languageMenu">
                                @if (session('language') == "en")
                                {{ trans('message.Textlangen') }}
                                @else
                                {{ trans('message.Textlangvi') }}
                                @endif
                                
                                <img src="{{ asset('assets/master-images/ICO-V.png') }}" class="arrow">
                            </div>
                            <ul class="dropdown-menu" aria-labelledby="languageMenu" style="border-bottom:none">
                                <li>
                                    <a class="lang" href="{{ route('change-language', ['language' => 'vi']) }}"
                                        style="font-weight:normal; padding:8px 0 8px 10px; color: #5b545b">
                                        {{ trans('message.Textlangvi') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="lang" href="{{ route('change-language', ['language' => 'en']) }}"
                                        style="font-weight:normal; padding:8px 0 8px 10px; color: #5b545b">
                                        {{ trans('message.Textlangen') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
