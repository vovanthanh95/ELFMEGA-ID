<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>{{config('custom.namegame')}}-{{config('custom.namewebsite')}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="icon" href="{{ asset('assets/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css2/style.css?t=1.00') }}">
    <link rel="stylesheet" href="{{ asset('assets/css2/custom.css?t=1.00') }}">
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/sweetalert.all.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.paginate.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                    <img style="width: 15%;margin-left:3rem;" src="{{ asset('assets/images2/logo-small.png?t=1.00') }}"
                                        class="hidden-lg hidden-md hidden-sm">
                                    <img style="width: 5%;" src="{{ asset('assets/images2/logo.png?t=1.00') }}" class="hidden-xs">
                                </a>
                                <div class="pull-right pt5 pb5">
                                    @if (Auth::guard('client')->check())
                                    <p class="info">
                                        <a href="{{route('logout')}}">{{__('message.logout')}}</a>
                                    </p>
                                    @endif
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
                        <div class="company_title">
                            <a href="{{route('account')}}" style="color:#ccc">{{config('custom.namegame')}}</a><br />Server Time <span id="localTime"></span>
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
    <script src="{{ asset('assets/js2/pagination.min.js') }}"></script>
    <script>
        var x = setInterval(function() {
            var now = new Date();
            document.getElementById("localTime").innerHTML = now.toLocaleDateString() + "-" + now.toTimeString();

        }, 1000);
    </script>

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
