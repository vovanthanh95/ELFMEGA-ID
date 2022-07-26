@extends('clients.main')
@section('content')
    <div class="accountPage__layout">
        <div class="updatePasswordPage__layout">
            <div class="rowTitle">
                <span>CẬP NHẬT EMAIL</span>
            </div>
            <form class="form-input" action="{{ route('post-update-email') }}" method="POST">
                @csrf
                <div class="input-row">
                    <input class="form-control my-3" name="email" type="email"
                        placeholder="Nhập email mới" value="{{ old('email') }}" style="height: 40px;">
                </div>
                <div class="btn-confirm-row">
                    <button class="btn-custom" type="submit">XÁC NHẬN</button>
                </div>
            </form>
        </div>
    </div>
@endsection
