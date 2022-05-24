<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>GGames - Kết Nối Game Thủ</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="icon" href="{{ asset('assets/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css2/style.css?t=1.00') }}">
    <link rel="stylesheet" href="{{ asset('assets/css2/custom.css?t=1.00') }}">
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/sweetalert.all.js') }}" type="text/javascript"></script>
</head>

<body>
    <div class="c-wrapper">
        <header class="header">
            <nav class="navbar navbar-default t-navbar-default navbar-fixed-top c-header t-header" role="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 ">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle t-navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-ex1-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand icons-logo t-icons-logo" href="{{route('account')}}"
                                    title="Game">
                                    <img src="{{ asset('assets/images2/logo-small.png?t=1.00') }}"
                                        class="hidden-lg hidden-md hidden-sm">
                                    <img src="{{ asset('assets/images2/logo.png?t=1.00') }}" class="hidden-xs">
                                </a>
                                <div class="pull-right pt5 pb5">
                                    <p class="info">
                                        <a href="{{route('logout')}}">{{__('message.logout')}}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            @yield('content')
        </main>
        <footer class="footer c-footer t-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="pull-left text-left">
                            <p>Một sản phẩm của Thiên Hà Game </p>
                            <ul class="t-footer__link">
                                <li><a href="#">Giới thiệu</a></li>
                                <li><a href="https://ggames.vn/dieu-khoan-su-dung.html" target="_blank">Điều khoản sử
                                        dụng</a></li>
                                <li><a href="#">Q&amp;A</a></li>
                                <li><a href="#">Góp ý</a></li>
                            </ul>
                        </div>
                        <div class="pull-right">
                            <p class="text-right">Thông tin ICP<br>
                                CÔNG TY TNHH TRỰC TUYẾN THIÊN HÀ<br>
                                Địa chỉ: 497/12 Nguyễn Văn Khối, Phường 8, Quận Gò Vấp, TP. Hồ Chí Minh<br>
                                Điện thoại: 02862713680 - Email: <a
                                    href="mailto:hotro@ggames.vn">hotro@ggames.vn</a><br>
                                Số giấy G1: 255/GP-BTTTT - Ngày cấp: 24/06/2019 - Nơi cấp: Bộ Thông tin và Truyền
                                thông<br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Javascript -->

    <script src="{{ asset('assets/js2/libs/jquery.1.12.4.min.js?t=1.00') }}"></script>
    <script src="{{ asset('assets/js2/libs/bootstrap.min.js?t=1.00') }}"></script>
    <script src="{{ asset('assets/js2/libs/owl.carousel.js?t=1.00') }}"></script>
    <script src="{{ asset('assets/js2/common.js?t=1.00') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js2/libs/md5.js?t=1.00') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js2/account.js?t=1.00') }}"></script>

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
                text: "{{$errors->all()[0]}}",
                type: "error",
            });
        }, 500);
    </script>
    @endif

</body>

</html>
