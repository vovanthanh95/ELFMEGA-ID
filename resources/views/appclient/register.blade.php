<!DOCTYPE html>
<!-- saved from url=(0051)https://id.baoboithanky.com/Authenticate/SignInForm -->
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style id="stndz-style"></style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="{{ asset('assets/appclient/css.css') }}">
    <link rel="stylesheet prefetch" href="https://id.baoboithanky.com/Themes/v2/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/appclient/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/appclient/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/appclient/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images2/logo.png') }}">
    <script src="{{ asset('assets/appclient/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/appclient/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/appclient/bootstrap-dialog.js') }}"></script>
    <script src="{{ asset('assets/appclient/jquery.form.js') }}"></script>
    <script src="{{ asset('assets/appclient/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/appclient/main.js') }}"></script>
</head>

<body style="background-color: #ffffff" data-new-gr-c-s-check-loaded="14.1016.0" data-gr-ext-installed="">
    <div id="IsIosVule" style="display: none"> </div>
    <div style="padding: 15px;">
        <!-- Nav tabs -->
        <ul class="nav nav-pills" role="tablist" style="display: inline-block; margin-bottom: 15px">
            <li role="presentation"><a href="{{ route('app-login') }}">Đăng nhập</a></li>
        </ul>
        <ul class="nav nav-pills" role="tablist" style="display: inline-block; margin-bottom: 15px">
            <li role="presentation" class="appbtn"><a href="{{ route('app-register') }}">Đăng ký</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="sign-up">
                <form action="{{ route('post-app-register') }}" method="post">
                    @csrf
                    <div class="form-group margin">
                        <input id="username" autocomplete="off" name="username" type="text"
                            value="{{ old('username') }}" placeholder="Tài khoản" class="form-control">
                    </div>
                    <div class="form-group margin">
                        <input id="password" autocomplete="off" name="password" type="password" value=""
                            placeholder="Mật khẩu" class="form-control">
                    </div>
                    <div class="form-group margin">
                        <div class="custom-control">
                            <input style="width: 50%" id="captcha" placeholder="Captcha" autocomplete="off"
                                name="captcha" type="text" value="">
                            <div class="row">
                                <div style="display: contents;" id="refreshCaptcha">
                                    {!! captcha_img() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group margin">
                        <input type="submit" name="register" class="submit appbtn" value="Đăng ký">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#refreshCaptcha').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: 'reloadCaptcha',
                    success: function(result) {
                        $('#refreshCaptcha').html(result.captcha);
                    },
                });
            });
        });
    </script>
</body>
{{-- thông báo --}}
@if (session()->has('msg') && session()->has('type'))
    <script type="text/javascript">
        setTimeout(function() {
            swal({
                text: "{{ session('msg') }}",
                type: "{{ session('type') }}"
            });
        }, 500);
    </script>
@endif
{{-- thông báo validate() --}}
@if ($errors->any())
    <script type="text/javascript">
        setTimeout(function() {
            swal({
                text: "{{ $errors->all()[0] }}",
                type: "error",
            });
        }, 500);
    </script>
@endif

</html>
