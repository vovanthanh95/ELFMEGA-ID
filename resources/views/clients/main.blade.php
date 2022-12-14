<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('message.title') }}</title>
    <link href="{{ asset('assets/img/icon_logo.png') }}" rel="shortcut icon">
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
    <style>
        .swal2-header::before {
            position: relative !important;
            height: 36px !important;
            width: 100%;
            background: transparent url('{{ asset('assets/master-images/312X36_BGXanh_koBo.png') }}') !important;
            content: '{{ trans('message.alerttitle') }}';
            color: #fff;
            text-align: center;
            padding-top: 4px;
            font-size: 25px;
            background-size: 100% !important;
        }
    </style>
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
                                            <img class="user-img2" src="{{ asset('assets/img/pokemon-user.png') }}"
                                                width="14px" alt="abc">
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
                                        <span class="item-menu-1">&nbsp;{{ trans('message.linkaccount') }}</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('change-pass') }}">
                                        <i class="fa-solid fa-key sub-icon"></i>
                                        <span class="item-menu-2">&nbsp;{{ trans('message.linkchangepass') }}</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('top-up-vn') }}">
                                        <img src="{{ asset('assets/img/icon-the-cao.png') }}" alt="abc">
                                        <span class="item-menu-3">&nbsp;{{ trans('message.linktopupcard') }}</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('top-up-banking') }}">
                                        <i class="fa-regular fa-credit-card sub-icon"></i>
                                        <span class="item-menu-4">&nbsp;{{ trans('message.linktopupbanking') }}</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('accumulat') }}">
                                        <i class="fa-solid fa-gift sub-icon"></i>
                                        <span class="item-menu-7">&nbsp;{{ trans('message.linkaccumulat') }}</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('history') }}">
                                        <i class="fa-solid fa-clock-rotate-left sub-icon"></i>
                                        <span class="item-menu-6">&nbsp;{{ trans('message.linkhistory') }}</span>
                                    </a>
                                </li>
                                <li class="dropdownNavigation">
                                    <a href="{{ route('logout') }}" class="cursor">
                                        <img src="{{ asset('assets/img/ico_dangxuat.png') }}" alt="abc">
                                        <span class="item-menu-7">&nbsp;{{ trans('message.linklogout') }}</span>
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
                                        <a class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            <div class="col-3">
                                                <img src="{{ asset('assets/img/ico_taikhoan.png') }}" alt="">
                                            </div>
                                            <div class="col-8 adiv">
                                                <span> {{ trans('message.linkaccount') }}
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse sub-menu"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul class="sub-menu-item">
                                                <li class="mid dis-border-bot">
                                                    <a class="row" href="{{ route('change-pass') }}">
                                                        <div class="col-3"><img
                                                                src="{{ asset('assets/img/ICO-PASS.png') }}"
                                                                alt=""></div>
                                                        <div class="col-8 adiv">
                                                            <span>{{ trans('message.linkchangepass') }}</span>
                                                        </div>
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
                                        <a class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse2"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            <div class="col-3">
                                                <img src="{{ asset('assets/img/VI-DIEN-TU.png') }}">
                                            </div>
                                            <div class="col-8 adiv">
                                                <span>{{ trans('message.linktopup') }} </span>
                                            </div>
                                        </a>
                                    </li>
                                    <div id="flush-collapse2" class="accordion-collapse collapse sub-menu"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul class="sub-menu-item">
                                                <li>
                                                    <a href="{{ route('top-up-vn') }}">
                                                        <div class="col-3">
                                                            <img class="col-3"
                                                                src="{{ asset('assets/img/icon-the-cao.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-8 adiv">
                                                            <span>{{ trans('message.linktopupcard') }}</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('top-up-banking') }}">
                                                        <div class="col-3">
                                                            <img src="{{ asset('assets/img/THE-NGAN-HANG-CHON.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-8 adiv">
                                                            <span>{{ trans('message.linktopupbanking') }}</span>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="">
                                    <li>
                                        <a class="alink" href="{{ route('accumulat') }}">
                                            <div class="col-3"><img
                                                    src="{{ asset('assets/img/ico_giftcode2.png') }}" alt="">
                                            </div>
                                            <div class="col-8 adiv"><span>
                                                    {{ trans('message.linkaccumulat') }} </span></div>
                                        </a>
                                    </li>
                                </div>
                            </div>
                            <div>
                                <div class="">
                                    <li>
                                        <a class="alink" href="{{ route('history') }}">
                                            <div class="col-3"><img src="{{ asset('assets/img/ico_lichsu.png') }}"
                                                    alt=""></div>
                                            <div class="col-8 adiv"><span>
                                                    {{ trans('message.linkhistory') }} </span>
                                            </div>
                                        </a>
                                    </li>
                                </div>
                            </div>
                            {{-- <li class="row">
                                <a class="row" href="{{ route('accumulat') }}">
                                    <img class="col-3" src="{{ asset('assets/img/ico_giftcode2.png') }}"
                                        alt="">
                                    <span class="col-9 sub-item-7">
                                        {{ trans('message.linkaccumulat') }}
                                    </span>
                                </a>
                            </li>
                            <li class="row">
                                <a class="row" href="{{ route('history') }}">
                                    <img class="col-3" src="{{ asset('assets/img/ico_lichsu.png') }}"
                                        alt="">
                                    <p class="col-9 sub-item-7">
                                        {{ trans('message.linkhistory') }}
                                    </p>
                                </a>
                            </li> --}}

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
                            <p>Copyright@2022 ElfMega</p>
                            <p>{{ trans('message.infofooter') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-6 reset-padding-left reset-padding-right" style="text-align: 'right'">
                    <p class="contact-info">
                        <a href="https://www.facebook.com/ElfMega" target="_blank">
                            Fanpage: <span class="footer-info"> ElfMega</span>
                            <img src="{{ asset('assets/img/FOOTER-ICO-FB.png') }}" class="footer-ico">
                        </a>
                    </p>
                    <p class="contact-info">
                        <a href="">
                            Email: <span class="footer-info">ElfMega.com@gmail.com</span>
                            <img src="{{ asset('assets/img/FOOTER-ICO-MAIL.png') }}" class="footer-ico">
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <footer class="is-mobile footer1">
        <div class="footer-container">
            {{-- <div class="row ">
                <div class="col-md-12 text-center">
                    <div>Copyright@2022 thanthudaichien.com</div>
                    <div>{{ trans('message.infofooter') }}</div>
                    <div>
                        Fanpage:
                        <a href="https://www.facebook.com/thanthudaichien" style="color: '#000'">
                            &nbsp;thanthudaichien
                        </a>
                        | Email: <span style="color: '#000'">thanthudaichien.com@gmail.com</span>
                    </div>
                </div>
            </div> --}}
        </div>
    </footer>
    <footer class="is-mobile2">
        <div class="footer-container">
            <div class="row footer2">
                <div class="col-2">
                    <a href="{{ route('home') }}"><i class="fa-solid fa-house-chimney"></i>
                        <p>{{ trans('message.linkhome') }}</p>
                    </a>
                </div>
                <div class="col-2">
                    <a href="{{ route('selection-top-up') }}"><i class="fa-solid fa-money-check-dollar"></i>
                        <p>{{ trans('message.linktopup') }}</p>
                    </a>
                </div>
                <div class="col-2">
                    <a href="{{ route('history') }}"><i class="fa-solid fa-clock-rotate-left"></i>
                        <p>{{ trans('message.linkhistory') }}</p>
                    </a>
                </div>
                <div class="col-2">
                    <a href="{{ route('accumulat') }}"><i class="fa-solid fa-gift"></i>
                        <p>{{ trans('message.linkaccumulat') }}</p>
                    </a>
                </div>
                <div class="col-2">
                    <a href="https://www.facebook.com/ElfMega"><i class="fa-solid fa-headset"></i>
                        <p>{{ trans('message.linksupport') }}</p>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/Account.js?version=400') }}"></script>
    <script src="{{ asset('assets/js/mdb.min.js') }}"></script>
    {{-- th??ng b??o --}}
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
    {{-- th??ng b??o validate() --}}
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
