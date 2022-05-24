@extends('clients.main2')
@section('content')
    @include('clients.userinfo')
    <div class="container">
        <div class="row">
            @include('clients.navbar')
            {{-- content --}}

            <div class="col-sm-8 col-md-8 col-lg-9">
                <div class="boxinfo">
                    <h3 class="title">{{ __('message.accountinformation') }}</h3>
                    <a href="{{ route('update-account') }}" class="text02">{{ __('message.update') }}</a>
                    <form>
                        <div class="form-group">
                            <label for="username"
                                class="col-sm-3 control-label col-xs-5">{{ __('message.username') }}:</label>
                            <div class="col-sm-6 col-xs-7">
                                <p class="notbg ">
                                    @if (Auth::guard('client')->check())
                                        {{ $username }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="emaillogin"
                                class="col-sm-3 control-label col-xs-5">{{ __('message.email') }}:</label>
                            <div class="col-sm-6 col-xs-7">
                                <p class="notbg ">
                                    {{ $email != null ? $email : '' }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userphone"
                                class="col-sm-3 control-label col-xs-5">{{ __('message.phone') }}:</label>
                            <div class="col-sm-6 col-xs-7">
                                <p class="notbg ">{{ $phone != null ? $phone : '' }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="usercmnd"
                                class="col-sm-3 control-label col-xs-5">{{ __('message.createtime') }}:</label>
                            <div class="col-sm-6 col-xs-7">
                                <p class="notbg ">{{ $createtime }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="useradress" class="col-sm-3 control-label col-xs-5">{{ __('message.surplus') }}
                                ({{ config('custom.namemoney') }}):</label>
                            <div class="col-sm-6 col-xs-7">
                                <p class="notbg ">{{ $money }}</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- end content --}}
        </div>
    </div>
@endsection
