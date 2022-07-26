@extends('clients.main')
@section('content')
    <div class="accountPage__layout">
        <div class="updatePasswordPage__layout">
            <div class="rowTitle">
                <span>ĐỔI SỐ ĐIỆN THOẠI</span>
            </div>
            <form class="form-input" action="{{ route('post-change-phone') }}" method="POST">
                @csrf
                <div class="input-row">
                    <input class="form-control my-3" name="currentphone" id="oldPassword" type="text"
                        placeholder="Nhập số điện thoại hiện tại" value="{{ old('currentphone') }}" style="height: 40px;">
                </div>
                <div class="input-row">
                    <input class="form-control my-3" name="newphone" id="newPassword" type="text"
                        placeholder="Nhập số điện thoại mới" value="{{ old('newphone') }}" style="height: 40px;">
                </div>
                <div class="btn-confirm-row">
                    <button class="btn-custom" type="submit">XÁC NHẬN</button>
                    <a href="{{ route('account') }}"><button class="btn-custom" type="button">HỦY</button></a>
                </div>
            </form>
        </div>
    </div>
@endsection
