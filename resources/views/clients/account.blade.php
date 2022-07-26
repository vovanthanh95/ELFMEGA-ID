@extends('clients.main')
@section('content')
<div class="accountPage__layout">
    <div class="linkedProfile__section rowTitle">
        <span>THÔNG TIN TÀI KHOẢN</span>
    </div>
    <div class="">
        <div class="profileInfo">
            <div class="row">
                <div class="col-md-4 col-4 label">Tài khoản:</div>
                <div class="col-md-8 col-8 value label username1">
                    {{ $username != null ? $username : '' }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-4 label">Email:</div>
                <div class="col-md-8 col-8 value label">
                    @if ($email != null)
                        {{$email}}
                    @else
                    <button class="btn-custom btn-capnhat"><a href="{{route('update-email')}}"> CẬP NHẬT EMAIL</a></button>
                    @endif
                </div>
                <div class="col-md-12 col-12 forgot"><i>*Email dùng để lấy lại mật khẩu trong trường hợp quên mật khẩu</i></div>
            </div>
            <div class="row">
                <div class="col-md-4 col-4 label">Số điện thoại:</div>
                <div class="col-md-8 col-8 value label">
                    @if ($phone != null)
                        {{$phone}}
                    @else
                    <button class="btn-custom btn-capnhat"><a href="{{route('update-phone')}}"> CẬP NHẬT SĐT</a></button>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-4 label">Thời gian đăng ký:</div>
                <div class="col-md-8 col-8 value label">
                    {{ $createtime }}
                </div>
            </div>
            <div class="row" style="border-bottom: 0px;">
                <div class="col-md-4 col-4 label">Số dư ({{config('custom.namemoney')}}):</div>
                <div class="col-md-8 col-8 value label">
                    {{ $money }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection