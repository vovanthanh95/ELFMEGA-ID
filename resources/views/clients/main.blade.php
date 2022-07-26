<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cổng thanh toán Thần Thú Đại Chiến</title>
    <link href="{{ asset('assets/img/pokeball.png') }}" rel="shortcut icon">
    <meta name="format-detection" content="telephone=no">
    
    <link href="{{ asset('assets/css/googlefonts.css?family=Open+Sans:wght@600;700;800&amp;display=swap') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.js') }}"></script>
    <link href="{{ asset('assets/libs/lity.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/libs/lity.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/Navbar.css?version=400') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/Banner.css?version=400') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/Footer.css?version=400') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/_variable.css?version=400') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/_global.css?version=400') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/_reset.css?version=400') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/_game.css?version=400') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/_accountLayout.css?version=400') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/_modal.css?version=400') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <script src="{{ asset('assets/js/sweetalert.all.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/mobile-detect.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/main2.js?version=400') }}"></script>
    <script src="{{ asset('assets/js/Modal.js?version=400') }}"></script>
    <script src="{{ asset('assets/js/ApiHelper.js?version=400') }}"></script>
    <script src="{{ asset('assets/js/paginate.js?version=400') }}"></script>
    <script src="{{ asset('assets/js/pagination.js?version=400') }}"></script>
    <script src="{{ asset('assets/js/utils.js?version=400') }}"></script>
    <script src="{{ asset('assets/js/loadingoverlay.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.standalone.min.css') }}">
    <link type="text/css" href="{{ asset('assets/css/AccountMenu.css?version=400') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/Account.css?version=400') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/AccountService.js?version=400') }}"></script>
    <link type="text/css" href="{{ asset('assets/css/font.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="game-navbar" style="">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex" style="justify-content: space-between;">
                    <div class="game-navbar__logo">
                        <a href="/">
                            <img src="{{ asset('assets/img/icon_logo.png') }}" alt=""
                                class="d-none d-md-block">
                            <img src="{{ asset('assets/img/icon_logo.png') }}" alt=""
                                class="d-block d-md-none">
                        </a>
                    </div>
                    <ul class="game-navbar-nav">
                        <li class="game-navbar__navlink dropdown" style="left:0;">
                            <a href="#" class="" role="button" id="dropdownMenuLinksS"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar-toggle">
                                    <img src="{{ asset('assets/img/ico_logged_in.png') }}" alt="">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuLink"
                                style="margin: 0px;">
                                <li class="accountInfo">
                                    <div class="accountInfo__left">
                                        <img src="{{ asset('assets/img/ico_logged_in.png') }}" alt="">
                                    </div>
                                    <div class="accountInfo__right">
                                        <p class="username2">
                                            <img class="user-img2" src="{{ asset('assets/img/pokemon-user.png') }}" width="14px"
                                                alt="abc">
                                            @if (Auth::guard('client')->check())
                                               <span> {{ $username }}</span>
                                            @endif
                                        </p>
                                        <p class="coin"><img src="{{ asset('assets/img/coins.png') }}" width="14px"
                                                alt="abc">
                                        <span>
                                            @if (Auth::guard('client')->check())
                                                {{ $money }}
                                            @endif
                                        </span>
                                        </p>
                                    </div>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('account') }}">
                                        <i class="fa-regular fa-user sub-icon"></i>
                                        <span>&nbsp;TÀI KHOẢN</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('change-pass') }}">
                                        <i class="fa-solid fa-key sub-icon"></i>
                                        <span>&nbsp;ĐỔI MẬT KHẨU</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('top-up-vn') }}">
                                        <img src="{{ asset('assets/img/icon-the-cao.png') }}" alt="abc">
                                        <span>&nbsp;NẠP THẺ CÀO</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('top-up-banking') }}">
                                        <i class="fa-regular fa-credit-card sub-icon"></i>
                                        <span>&nbsp;ATM/BANKING</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('top-up-mo-mo') }}">
                                        <img src="{{ asset('assets/img/MOBILE-MM.png') }}" alt="abc">
                                        <span>&nbsp;VÍ ĐIỆN TỬ</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('history') }}">
                                        <i class="fa-solid fa-clock-rotate-left sub-icon"></i>
                                        <span>&nbsp;LỊCH SỬ</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('logout') }}" class="cursor">
                                        <img src="{{ asset('assets/img/ico_dangxuat.png') }}" alt="abc">
                                        <span>&nbsp;ĐĂNG XUẤT</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="accountLayout">
        <div class="container d-flex">
            <div class="accountLayout__infoLeft">
                <div class="menuInfo">
                    <div class="menuInfo__headerInfo">
                        <div class="avatar">
                            <a href="{{ route('account') }}">
                                <img class="avata-image" src="{{ asset('assets/img/pokeball.png') }}"
                                    alt="">
                            </a>
                        </div>
                        <div class="userInfo">
                            <div class="userInfo_name">
                                <img src="{{ asset('assets/img/pokemon-user.png') }}"
                                        alt="{{ config('custom.namemoney') }}">
                                <p class="active username">
                                    @if (Auth::guard('client')->check())
                                        {{ $username }}
                                    @endif
                                </p><br>
                            </div>
                            <div class="row-coin">
                                <div class="userInfo_ycoin">
                                    <img src="{{ asset('assets/img/coins.png') }}"
                                        alt="{{ config('custom.namemoney') }}">
                                    @if (Auth::guard('client')->check())
                                       <p class="coin-number"> {{ $money }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="menuInfo__bodyInfo">
                        <ul>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <li class="accordion-header" id="flush-headingOne">
                                        <a class="accordion-button collapsed row" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            <img class="col-3" src="{{ asset('assets/img/ico_taikhoan.png') }}"
                                                alt="">
                                            <span class="col-9 menu-item tk"> TÀI KHOẢN </span>
                                        </a>
                                    </li>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse sub-menu"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul class="sub-menu-item">
                                                <li class="mid dis-border-bot">
                                                    <a class="row" href="{{ route('change-pass') }}">
                                                        <img class="col-3"
                                                            src="{{ asset('assets/img/ICO-PASS.png') }}"
                                                            alt="">
                                                        <span class="col-9 sub-item-1 mk">ĐỔI MẬT KHẨU</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <li class="accordion-header" id="flush-headingOne">
                                        <a class="accordion-button collapsed row" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse2"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            <img class="col-3" src="{{ asset('assets/img/VI-DIEN-TU.png') }}"
                                                alt=""> <span class="col-9 menu-item nt"> NẠP TIỀN </span>
                                        </a>
                                    </li>
                                    <div id="flush-collapse2" class="accordion-collapse collapse sub-menu"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul class="sub-menu-item">
                                                <li class="mid">
                                                    <a class="row" href="{{ route('top-up-vn') }}">
                                                        <img class="col-3"
                                                            src="{{ asset('assets/img/icon-the-cao.png') }}"
                                                            alt="">
                                                        <span class="col-9 sub-item-3">NẠP THẺ CÀO</span>
                                                    </a>
                                                </li>
                                                <li class="mid">
                                                    <a class="row" href="{{ route('top-up-banking') }}">
                                                        <img class="col-3"
                                                            src="{{ asset('assets/img/THE-NGAN-HANG-CHON.png') }}"
                                                            alt=""> <span
                                                            class="col-9 sub-item-4">ATM/BANKING</span>
                                                    </a>
                                                </li>
                                                <li class="end">
                                                    <a class="row" href="{{ route('top-up-mo-mo') }}">
                                                        <img class="col-3"
                                                            src="{{ asset('assets/img/MOBILE-MM.png') }}"
                                                            alt=""> <span class="col-9 sub-item-5">VÍ ĐIỆN
                                                            TỬ</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <li>
                                <a class="row" href="{{ route('history') }}">
                                    <img class="col-3" src="{{ asset('assets/img/ico_lichsu.png') }}"
                                        alt="">
                                    <span class="col-9 sub-item-7">
                                        LỊCH SỬ
                                    </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-12">
                </div>
            </div>
            <div class="accountLayout__infoRight">
                @yield('content')
            </div>
        </div>
    </div>
    <footer class="page-footer is-pc">
        <div class="container pc-view">
            <div class="row pd_list">
                <div class="col-md-6 col-6 reset-padding-left reset-padding-right ft1">
                    <div class="footer1 r-0">
                        <div class="p1" style="padding-top: '2px'">
                            <p>Copyright@2022 thanthudaichien.com</p>
                            <p>Chơi quá 180 phút một ngày sẽ ảnh hưởng xấu đến sức khỏe.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-6 reset-padding-left reset-padding-right" style="text-align: 'right'">
                    <p class="contact-info">
                        <a href="https://www.facebook.com/thanthudaichien" target="_blank">
                            Fanpage: <span class="footer-info">thanthudaichien</span>
                            <img src="{{ asset('assets/img/FOOTER-ICO-FB.png') }}" class="footer-ico">
                        </a>
                    </p>
                    <p class="contact-info">
                        <a href="">
                            Email: <span class="footer-info">thanthudaichien.com@gmail.com</span>
                            <img src="{{ asset('assets/img/FOOTER-ICO-MAIL.png') }}" class="footer-ico">
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <footer class="is-mobile">
        <div class="footer-container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div>Copyright@2022 thanthudaichien.com</div>
                    <div>Chơi quá 180 phút 1 ngày sẽ ảnh hưởng đến sức khỏe</div>
                    <div>
                        Fanpage:
                        <a href="https://www.facebook.com/thanthudaichien" style="color: '#000'">
                            &nbsp;thanthudaichien
                        </a>
                        | Email: <span style="color: '#000'">thanthudaichien.com@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/Account.js?version=400') }}"></script>

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
</body>

</html>
