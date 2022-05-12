<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta id="viewport" name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="theme-color" content="#00b7f1">
    <link rel="icon" href="{{ asset('assets/images/3q-logo.png') }}">
    <!-- CSRF Token -->
    <title>abc</title>
    <meta content=", game online 2020, game mobile, game hot thailand, game android ios pc" name="keywords" />
    <meta content=", game online 2020, game mobile, game hot thailand, game android ios pc" name="description" />
    <!-- <link href="public/assets/css/roboto.css?v=<?php echo rand(); ?>" rel="stylesheet"> -->
    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/setting.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/reponsive.css') }}" rel="stylesheet">

    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/sweetalert.all.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/dist/js/jquery.flagstrap.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert.css') }}">
    <link href="{{ asset('assets/dist/css/flags.css') }}" rel="stylesheet">


    <style type="text/css">
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background: #000;
            opacity: 0.5;
            filter: alpha(opacity=50);
        }

        #loader {
            display: block;
            position: relative;
            left: 50%;
            top: 50%;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #3498db;
            -webkit-animation: spin 2s linear infinite;
            /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 2s linear infinite;
            /* Chrome, Firefox 16+, IE 10+, Opera */
            z-index: 1001;
        }

        #loader:before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #e74c3c;

            -webkit-animation: spin 3s linear infinite;
            /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 3s linear infinite;
            /* Chrome, Firefox 16+, IE 10+, Opera */
        }

        #loader:after {
            content: "";
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #f9c922;

            -webkit-animation: spin 1.5s linear infinite;
            /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 1.5s linear infinite;
            /* Chrome, Firefox 16+, IE 10+, Opera */
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(0deg);
                /* IE 9 */
                transform: rotate(0deg);
                /* Firefox 16+, IE 10+, Opera */
            }

            100% {
                -webkit-transform: rotate(360deg);
                /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(360deg);
                /* IE 9 */
                transform: rotate(360deg);
                /* Firefox 16+, IE 10+, Opera */
            }
        }

        @keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(0deg);
                /* IE 9 */
                transform: rotate(0deg);
                /* Firefox 16+, IE 10+, Opera */
            }

            100% {
                -webkit-transform: rotate(360deg);
                /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(360deg);
                /* IE 9 */
                transform: rotate(360deg);
                /* Firefox 16+, IE 10+, Opera */
            }
        }

        #loader-wrapper .loader-section {
            position: fixed;
            top: 0;
            width: 51%;
            height: 100%;
            background: #ffffff;
            z-index: 1000;
            -webkit-transform: translateX(0);
            /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: translateX(0);
            /* IE 9 */
            transform: translateX(0);
            /* Firefox 16+, IE 10+, Opera */
        }

        .loaded #loader {
            opacity: 0;
            -webkit-transition: all 0.3s ease-out;
            transition: all 0.3s ease-out;
        }

        .loaded #loader-wrapper {
            visibility: hidden;
        }

    </style>
    <script>
        $(document).ready(function() {

            setTimeout(function() {
                $('body').addClass('loaded');
            }, 100);

        });
    </script>
</head>

<body class="dislable_scorll _conten_">
    <div id="loader-wrapper">
        <div id="loader">

        </div>
        <!-- <div class="loader-section section-left"></div> -->
        <!-- <div class="loader-section section-right"></div> -->
    </div>
    <div class="container  m_body m_main_mb no-padding">
        <div class="header bg-white box-shadow">
            <div class="container">
                <div class="width-box main-box-header m-auto clearfix">
                    <div class="row f-left" style="display: flex; align-items: center;">
                        <div class="col-xs-3 f-left">
                            <a href=""><img style="margin: 0.5rem 0 0 0; width:95%;"
                                    src="{{ asset('assets/images/3q-logo.png') }}"></a>
                        </div>
                        <div class="col-xs-5" style="text-align: center;">
                            <span style="color: #ff753a;">
                                @if (Auth::guard('client')->check())
                                    {{ __('message.serverid') }}: {{ session('serverid')}}
                                @endif

                            </span>
                        </div>
                        <div class="col-xs-4" style="text-align: right;">
                            <div class="name-user f-tahomabold">
                                @if (Auth::guard('client')->check())
                                    {{ $username }}
                                @endif
                            </div>
                            <span style="color: #ff753a;font-size: 13px;"><b id="txtMoneyHave">
                                    @if (Auth::guard('client')->check())
                                        {{ $money }}
                                    @endif
                                </b>
                                @if (Auth::guard('client')->check())
                                    {{ config('custom.namemoney') }}
                                @endif

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container unauthorize" id="sidebar">
            <div class="sidebar-header unauthorize">
                <div class="sidebar-header-background">
                    <div class="pull-left">
                        <a href=""><img class="logodnm" src="{{ asset('assets/images/3q-logo.png') }}"
                                style="left: 50%;transform: translateX(-50%);"></a>
                    </div>
                </div>

                <div class="pull-left" id="close-menu-btn" style="padding: 0 15px;">
                    <i class="fa fa-times" style="color:#fff; font-size: 25px;"></i>
                </div>
                <!--div id="close-menu-btn">
                    <i class="fa fa-times" style="color:#fff; font-size: 25px;"></i>
                </div-->
                <div class="pull-right">
                    <!--a class="btn btn-light" style="top: 14px;position: relative;color: #fff;" href="#" onclick="document.location = 'js-oc:kunlunClose:null';return false"> <i class="fa fa-arrow-right" style="font-size: 15px;"></i></a-->
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <script type="text/javascript">
            var APILOADING = {};
            APILOADING.submitTarget = function(el, target) {
                var url = $(el).attr('action');
                var method = $(el).attr('method');
                var data = $(el).serialize();
                $(el).find(':submit').prop('disabled', true);
                $.post(url, data, function(json) {
                    if (json['status'] == 0) {
                        swal({
                            title: json['msg'],
                            type: "success"
                        }, function() {}).then((value) => {
                            if (json['url'] != "") {
                                window.location = json['url'];
                            }
                        });
                    } else if (json['status'] == 10) {
                        window.location = json['url'];
                    } else {
                        swal(json['msg']);
                    }
                    $(el).find(':submit').prop('disabled', false);
                }, 'json');

                return false;
            }

            function changeCaptcha() {
                $("#imgCapcha").attr("src", id);
            }

            function setNotification(str, url) {
                swal({
                    title: "Thông báo",
                    text: "",
                    type: "warning",
                    html: str,
                    confirmButtonText: 'Đi đến',
                    cancelButtonText: 'Hủy',
                    showCancelButton: true,
                }, function() {}).then((result) => {
                    if (result.value) {
                        if (url != "") {
                            window.location = url;
                        }
                    }
                });
            }
            <?php if (isset($_SESSION['username']) && $_SESSION['username']) { ?>
            reLoad();

            function reLoad() {
                $.post("ajax/ajax-reload.php", "", function(json) {
                    $("#txtMoneyHave").html(json['money']);
                    $("#txtPointHave").html(json['point']);
                }, 'json');
            }
            <?php } ?>
        </script>
        <div class="payment-container container no-padding">
            @yield('content')
        </div>

        <div class="nav-bottom bg-white">
            <div class="container">
                <div class="link-nav-bottom m-auto d-flex flex-center bg-white">
                    @if (!Auth::guard('client')->check())
                        <a href="http://3qbadao.mobi/" class="item-nav-bottom d-flex flex-center f-d-column ">
                            <i class="icon-nav-bottom d-flex flex-center fa fa-home"> </i>
                            <span class="txt-nav-bottom">{{ __('message.home') }}</span>
                        </a>
                        <a href="http://3qbadao.mobi/" class="item-nav-bottom d-flex flex-center f-d-column ">
                            <i class="icon-nav-bottom d-flex flex-center fa fa-download"> </i>
                            <span class="txt-nav-bottom">{{ __('message.downloadgame') }}</span>
                        </a>
                        <a href="https://www.facebook.com/badao3q"
                            class="item-nav-bottom d-flex flex-center f-d-column ">
                            <i class="icon-nav-bottom d-flex flex-center fa fa-facebook-f"> </i>
                            <span class="txt-nav-bottom">Fanpage</span>
                        </a>
                    @endif
                    @if (Auth::guard('client')->check())
                        <a href="{{ route('top-up') }}" class="item-nav-bottom d-flex flex-center f-d-column ">
                            <i class="icon-nav-bottom d-flex flex-center fa fa-credit-card"> </i>
                            <span class="txt-nav-bottom">{{ __('message.topup') }}</span>
                        </a>
                        <a href="{{ route('gift-code') }}" class="item-nav-bottom d-flex flex-center f-d-column ">
                            <i class="icon-nav-bottom d-flex flex-center fa fa-gift"> </i>
                            <span class="txt-nav-bottom">{{ __('message.giftcode') }}</span>
                        </a>
                        <a href="{{ route('history') }}" class="item-nav-bottom d-flex flex-center f-d-column ">
                            <i class="icon-nav-bottom d-flex flex-center fa fa-history"> </i>
                            <span class="txt-nav-bottom">{{ __('message.history') }}</span>
                        </a>
                        <a href="{{ route('account') }}" class="item-nav-bottom d-flex flex-center f-d-column ">
                            <i class="icon-nav-bottom d-flex flex-center fa fa-user"> </i>
                            <span class="txt-nav-bottom">{{ __('message.username') }}</span>
                        </a>
                        <a href="{{ route('logout') }}" class="item-nav-bottom d-flex flex-center f-d-column ">
                            <i class="icon-nav-bottom d-flex flex-center fa fa-sign-out"> </i>
                            <span class="txt-nav-bottom">{{ __('message.logout') }}</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="footer_wapper  container">
            <div class="company_title">
                <a href="#" style="color:#ccc">namewebsite</a><br />Server Time <span id="localTime"></span>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/sidebar.js') }}"></script>
    <!--script>
         $('#bk-login').submit(function() {
             $('.bk-form-login').css('display', 'none');
             $('.login-help').css('display', 'none');
             $('.bk-loading').css('display', 'block');
         });
      </script-->
    <script>
        var x = setInterval(function() {
            var now = new Date();
            document.getElementById("localTime").innerHTML = now.toLocaleDateString() + "-" + now.toTimeString();

        }, 1000);
        $('#advanced').flagStrap({
            buttonSize: "btn-lg",
            buttonType: "btn-primary",
            labelMargin: "20px",
            scrollable: false,
            scrollableHeight: "350px",
            onSelect: function(value, element) {
                $.post("ajax/ajax-language.php", "lang=" + value, function(json) {
                    window.location.reload();
                }, 'json');
            }
        });
        $('#advancedtop').flagStrap({
            buttonSize: "btn-lg",
            buttonType: "btn-primary",
            labelMargin: "20px",
            scrollable: false,
            scrollableHeight: "350px",
            onSelect: function(value, element) {
                $.post("ajax/ajax-language.php", "lang=" + value, function(json) {
                    window.location.reload();
                }, 'json');

            }
        });
    </script>

</body>

</html>
