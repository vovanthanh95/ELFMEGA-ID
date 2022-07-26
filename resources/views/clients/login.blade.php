@extends('clients.main-login-fogot')
@section('content')
    <section class="login-section">
        <div class="box-container" style="  box-shadow:0 0px 40px rgba(0, 0, 0, 0.17)">
            <div class="login-container">
                <div class="login-content">
                    <div class="login-header">
                        <img src="{{ asset('assets/img/icon_logo.png') }}" alt="" class="login-logo">
                    </div>
                    <form action="{{ route('post-login') }}" method="POST">
                        @csrf
                        <div class="login-body">
                            <div class="row input-mg" style="margin-bottom: 20px;">
                                <input name="username" class="col-md-12 form-control input-forget" type="text" placeholder="Tên đăng nhập" value="{{ old('username') }}" style="height: 40px;">
                            </div>
                            <div class="row input-mg">
                                <input name="password" class="col-12 form-control input-forget" type="password" placeholder="Mật khẩu" value="" style="height: 40px;">
                            </div>
                            <div class="login-forget">
                                <a id="forget-pass" href="{{ route('forgot-pass') }}">Quên mật
                                    khẩu?</a>
                            </div>
                            <div class="login-button">
                                <style>
                                    .btn-green {
                                        margin-right: 0px !important
                                    }
                                </style>
                                <button type="submit" class="btn-green core-btn">ĐĂNG NHẬP</button>
                            </div>
                        </div>
                    </form>
                    <div class="login-footer">
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
