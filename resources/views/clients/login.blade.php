@extends('clients.main')
@section('content')
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">{{__('message.login')}}</div>
        </section>
        <div class="loginmodal-container">
            <div class="conten_login">
                <div class="bk-form-login">
                    <form action="{{ route('post-login') }}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <input id="login" required autofocus autocomplete="off" name="username" type="text"
                                    value="">
                                <label for="login" alt="{{__('message.username')}}" placeholder="{{__('message.username')}}"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <input id="password" required autocomplete="off" name="password" type="password" value="">
                                <label for="password" alt="{{__('message.password')}}" placeholder="{{__('message.password')}}"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <select class="select-list" name="serverid" id="serverid">
                                    <option>{{__('message.selectserver')}}</option>
                                    @foreach (config('custom.zonelist') as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="row">
                                        <input type="submit" name="login"
                                            class="login loginmodal-submit pull-left col-md-12" value="{{__('message.login')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="login-help">
                <div style="text-align: center;margin-top: 20px;">
                    <p> Quên mật khẩu? Nhấn vào đây: <a href="{{ route('forgot-pass') }}"
                            style="text-decoration: underline;"><b>Đặt lại mật khẩu</b></a></p>
                    <p style="margin-left: -20px;"> Người mới? Nhấn vào đây: <a href="register"
                            style="text-decoration: underline;"><b>Tạo tài khoản mới</b></a></p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    @if (session('msg'))
        <script type="text/javascript">
            setTimeout(function() {
                swal("{{ session('msg') }}");
            }, 500);
        </script>
    @endif

@endsection
