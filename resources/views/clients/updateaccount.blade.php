@extends('clients.main2')
@section('content')
    @include('clients.userinfo')
    <div class="container">
        <div class="row">
            @include('clients.navbar')
            {{-- content --}}

            <div class="col-sm-8 col-md-8 col-lg-9">
                <div class="boxinfo">
                    <h3 class="title">Cập nhật thông tin tài khoản</h3>
                    <form name="frmUpdateInfo" id="frmUpdateInfo" action="" method="POST">
                        @csrf
                        <div class="errors_alert">
                        </div>
                        <div class="form-group">
                            <label for="u_fullname" class="col-sm-3 control-label">{{ __('message.username') }}:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control " id="u_fullname" name="u_fullname"
                                    placeholder="{{ __('message.username') }}" value="@if (Auth::guard('client')->check()){{ $username }}@endif">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="u_phone" class="col-sm-3 control-label">{{ __('message.email') }}:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control " id="u_phone" name="u_phone"
                                    placeholder="{{ __('message.email') }}" value="{{ $email != null ? $email : '' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="u_cardid" class="col-sm-3 control-label">{{ __('message.phone') }}:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="u_cardid" name="u_cardid"
                                    placeholder="{{ __('message.phone') }}" value="{{ $phone != null ? $phone : '' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="u_address" class="col-sm-3 control-label">{{ __('message.createtime') }}:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control " id="u_address" name="u_address" disabled
                                    placeholder="" value="{{ $createtime }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="u_address" class="col-sm-3 control-label">{{ __('message.surplus') }}
                                ({{ config('custom.namemoney') }}):</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control " id="u_address" name="u_address" disabled
                                    placeholder="" value="{{ $money }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row btsm">
                                <button type="submit" class="btn bt-click">{{ __('message.update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            {{-- end content --}}
        </div>
    </div>
@endsection
