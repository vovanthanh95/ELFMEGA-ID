@extends('clients.main')
@section('content')
<div class="accountPage__layout">
    <div class="updatePasswordPage__layout">
        <div class="rowTitle">
            <span>ĐỔI MẬT KHẨU</span>
        </div>
        <form class="form-input" action="{{route('post-change-pass')}}" method="POST">
            @csrf
            <div class="input-row">
                <input class="form-control my-3" name="currentpassword" id="oldPassword" type="password" placeholder="Nhập mật khẩu hiện tại (từ 6 -32 ký tự)" value="" style="height: 40px;">
            </div>
            <div class="input-row">
                <input class="form-control my-3" name="newpassword" id="newPassword" type="password" placeholder="Nhập mật khẩu mới (từ 6 -32 ký tự)" value="" style="height: 40px;">
            </div>
            <div class="input-row">
                <input class="form-control my-3" name="confirmpassword" id="confirmPassword" type="password" placeholder="Nhập lại mật khẩu mới (từ 6 -32 ký tự)" value="" style="height: 40px;">
            </div>
            <div class="btn-confirm-row">
                <button class="btn-custom" type="submit">XÁC NHẬN</button>
                <a href="{{route('account')}}"><button class="btn-custom" type="button">HỦY</button></a>
            </div>
        </form>
    </div>
</div>
@endsection