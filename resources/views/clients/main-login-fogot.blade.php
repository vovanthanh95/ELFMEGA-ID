<html lang="">

<head>
    <title>Cổng thanh toán Thần Thú Đại Chiến</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/bootstrap/js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick-theme.css') }}">
    <script type="text/javascript" src="{{ asset('assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.all.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/hoverAnimation/hover.css') }}">
    <link rel="SHORTCUT ICON" href="{{ asset('assets/img/pokeball.png') }}">
    <script src="{{ asset('assets/js/mobile-detect.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootbox/bootbox.min.js') }}"></script>
    <link href="{{ asset('assets/plugins/holdon/HoldOn.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/plugins/holdon/HoldOn.min.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="{{ asset('assets/js/main.js?v=106') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login.css?v=106') }}">
    <script src="{{ asset('assets/js/forget-password.js?v=106') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <link type="text/css" href="{{ asset('assets/css/font.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
</head>

<body style="">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forget-password.css?v=106') }}">
    <div id="blur" style="background-image: url({{ asset('assets/master-images/1920x1080.jpg') }});">
        <div style="background: rgba(0, 0, 0, 0);width: 100%; height:100%"></div>
    </div>
    @yield('content')
    <div id="captcha" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" style="font-size:16px" id="captcha-title"></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align:center">
                    <div id="recaptcha-container" style="max-width:100%"></div>
                </div>
            </div>
        </div>
    </div>
    <input id="lang" type="hidden" value="VN">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
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
</body>

</html>
