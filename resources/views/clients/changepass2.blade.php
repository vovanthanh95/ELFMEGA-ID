@extends('clients.main2')
@section('content')
    @include('clients.userinfo')
    <div class="container">
        <div class="row">
            @include('clients.navbar')
            {{-- content --}}

            <div class="col-sm-8 col-md-8 col-lg-9 ">
                <div class="boxinfo">
                    <h3 class="title">Thay đổi mật khẩu</h3>
                    <form name="frmChangePassword" id="frmChangePassword" action="" method="POST"
                        onsubmit="return smChangePassword();">
                        <div class="errors_alert">
                        </div>
                        <div class="form-group">
                            <label for="old_password" class="col-sm-3 control-label">Mật khẩu hiện tại:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control " id="old_password" name="old_password"
                                    placeholder="Nhập mật khẩu hiện tại">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-sm-3 control-label">Mật khẩu mới:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control " id="new_password" name="new_password"
                                    placeholder="Nhập mật khẩu mới">
                            </div>
                            <div class="col-sm-8 col-md-offset-3">
                                <p class="text-note mb0"><i>(Mật khẩu có chiều dài 6-32 ký tự)</i></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_confirmpassword" class="col-sm-3 control-label">Xác nhận mật khẩu
                                mới:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control " id="new_confirmpassword"
                                    name="new_confirmpassword" placeholder="Xác nhận mật khẩu mới">
                            </div>
                        </div>
                        <div class="box-submit">
                            <div class="pull-left">
                                <button type="submit" class="btn bt-click">Thay đổi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- end content --}}
        </div>
    </div>
@endsection
