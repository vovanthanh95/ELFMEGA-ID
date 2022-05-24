<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>GGames - Kết Nối Game Thủ</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="icon" href="https://id.ggames.vn/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css2/stylee.css') }}">
</head>

<body>
    <div class="c-wrapper">
        <header class="header">
            <nav class="navbar navbar-default t-navbar-default navbar-fixed-top c-header t-header" role="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1">
                            <div class="navbar-header">
                                <div class="WidthChange">
                                    <a class="navbar-brand icons-logo t-icons-logo" href="https://id.ggames.vn"
                                        title="Công ty Galaxy Game">
                                        <img src="https://id.ggames.vn/st/images/logo-small.png?t=1.00"
                                            class="hidden-lg hidden-md hidden-sm">
                                        <img src="https://id.ggames.vn/st/images/logo.png?t=1.00"
                                            class="hidden-xs">
                                    </a>
                                </div>
                                <div class="pull-right pt5 pb5">
                                    <div class="pull-change">
                                        <a href="https://pay.ggames.vn" class="t-icons-game" title="Pay">
                                            NẠP TIỀN
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2">
                        <div class="dangky-home">
                            <div class="dangky-home-box">
                                <h4 class="title">Quên thông tin tài khoản</h4>
                                <div class="dangky-home-content">
                                    <p class="text-note text-left">Vui lòng điền vào tên đăng nhập hoặc email</p>
                                    <form name="frmFGP" id="frmFGP" action="" method="POST"
                                        onsubmit="return smForgotPassword();">
                                        <div class="errors_alert">
                                        </div>
                                        <div class="form-group">
                                            <label for="fgp_account">username</label>
                                            <input type="text" class="form-control" id="fgp_account"
                                                name="fgp_account" placeholder="Tên đăng nhập / email" value="">
                                            <span class="icons-icon-user icon-img"></span>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="widthsmall">
                                                <label for="fgp_captcha">nhập mã</label>
                                                <input type="text" class="form-control cancelW" id="fgp_captcha"
                                                    name="fgp_captcha" placeholder="Nhập mã kiểm tra">
                                                <span class="text-note2 text-hoa">*</span>
                                            </div>
                                            <div class="pull-right capcha">
                                                <img id="imageCaptcha"
                                                    src="https://id.ggames.vn/captcha.png?_c=5ca2bac906efbeac3f0bc47170658b1d"
                                                    class="captcha">
                                                <a href="javascript:refreshCaptcha();">
                                                    <img src="https://id.ggames.vn/st/images/bt-reload.png?t=1.00">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="box-submit">
                                            <div class="pull-right">
                                                <button type="submit" class="btn bt-click">Xác nhận</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2">
                        <p class="text-note text-center">Về <a href="https://id.ggames.vn">Trang chủ</a> để đăng nhập.
                        </p>
                    </div>
                </div>
            </div>
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
    <script src="{{ asset('assets/js2/libs/jquery.1.12.4.mine7dc.js') }}"></script>
    <script src="{{ asset('assets/js2/libs/bootstrap.mine7dc.js') }}"></script>
    <script src="{{ asset('assets/js2/libs/owl.carousele7dc.js') }}"></script>
    <script src="{{ asset('assets/js2/libs/md5e7dc.js') }}"></script>
    <script src="{{ asset('assets/js2/commone7dc.js') }}"></script>
    <script src="{{ asset('assets/js2/authe7dc.js') }}"></script>
</body>

</html>
