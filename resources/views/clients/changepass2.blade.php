@extends('clients.main2')
@section('content')
    @include('clients.userinfo')
    <div class="container">
        <div class="row">
            @include('clients.navbar')
            {{-- content --}}

            <div class="col-sm-8 col-md-8 col-lg-9 ">
                <div class="boxinfo">
                    <h3 class="title">{{__('message.changepass')}}</h3>
                    <form name="frmChangePassword" id="frmChangePassword" action="{{route('post-change-pass')}}" method="POST">
                        @csrf
                        <div class="errors_alert">
                        </div>
                        <div class="form-group">
                            <label for="old_password" class="col-sm-3 control-label">{{__('message.currentpassword')}}:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="old_password" name="currentpassword"
                                    placeholder="{{__('message.currentpassword')}}">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-sm-3 control-label">{{__('message.newpassword')}}:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="new_password" name="newpassword"
                                    placeholder="{{__('message.newpassword')}}">
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
                                    name="confirmpassword" placeholder="Xác nhận mật khẩu mới">
                            </div>
                        </div>
                        <div class="box-submit">
                            <div class="row btsm">
                                <button type="submit" class="btn bt-click">{{__('message.changepass')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- end content --}}
        </div>
    </div>
@endsection
