@extends('clients.main2')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-10 col-sm-12 col-lg-offset-1 col-md-offset-1">
                <div class="col-sm-6 col-md-6">
                    <div class="boxdangnhap">
                        <h3 class="title">{{__('message.login')}}</h3>
                        <form id="frmlogin" action="{{route('post-login')}}" method="POST">
                            @csrf
                            <div class="errors_alert">
                            </div>
                            <div class="form-group">
                                <label for="login_account">user</label>
                                <input type="text" class="form-control" id="login_account" name="username"
                                    placeholder="{{__('message.username')}}" value="{{old('username')}}">
                                <span class="icons-icon-user icon-img "></span>
                            </div>
                            <div class="form-group">
                                <label for="login_password">{{__('message.password')}}</label>
                                <input type="password" class="form-control" id="login_password" name="password"
                                    placeholder="{{__('message.password')}}">
                                <span class="icons-icon-password icon-img"></span>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="serverid" id="serverid">
                                    <option>{{__('message.selectserver')}}</option>
                                    @foreach (config('custom.zonelist') as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="textlogin">
                                <div class="checkbox text-left">
                                </div>
                                <p class="pull-right"><a href="{{route('forgot-pass')}}">*Quên mật khẩu?</a></p>
                            </div>
                            <button type="submit" class="btn bt-dangnhap">{{__('message.login')}}</button>
                        </form>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="blockhome">
                        <div class="blockhome-content">
                            Chỉ với một tài khoản sử dụng <br>được tất cả các sản phẩm của Galaxy Game
                        </div>
                        <a href="{{route('register')}}" class="dangky">đăng ký tài khoản</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
