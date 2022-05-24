@extends('clients.main2')
@section('content')
    @include('clients.userinfo')
    <div class="container">
        <div class="row">
            @include('clients.navbar')
            {{-- content --}}

            <div class="col-sm-8 col-md-8 col-lg-9">
                <div class="boxinfo">
                    <h3 class="title">{{ __('message.changephone') }}</h3>
                    <form id="frmVerify" action="{{route('post-change-phone')}}" method="POST">
                        @csrf
                        <div class="errors_alert">
                        </div>
                        <div class="form-group">
                            <label for="v_email" class="col-sm-3 control-label">{{ __('message.currentemail') }}:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control " id="v_email" name="currentemail"
                                    placeholder="{{ __('message.currentemail') }}" value="{{old('currentemail')}}">
                            </div>
                            <div class="col-sm-8 col-md-offset-3">
                                <p class="text-error mb0"><i>{{ __('message.suggest') }}:
                                        @if (Auth::guard('client')->check())
                                            {{ $email }}
                                        @else
                                            <i style="color:red">{{ __('message.emailisnotregistered') }}</i>
                                        @endif
                                </i></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="v_confirmemail" class="col-sm-3 control-label">{{ __('message.currentphone') }}:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control " id="v_confirmemail" name="currentphone"
                                    placeholder="{{ __('message.currentphone') }}" value="{{old('currentphone')}}">
                            </div>
                            <div class="col-sm-8 col-md-offset-3">
                                <p class="text-error mb0"><i>{{ __('message.suggest') }}:
                                        @if (Auth::guard('client')->check())
                                            {{ $phone }}
                                        @else
                                            <i style="color:red">{{ __('message.phoneisnotregistered') }}</i>
                                        @endif
                                </i></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="v_confirmemail" class="col-sm-3 control-label">{{ __('message.newphone') }}:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control " id="v_confirmemail" name="newphone"
                                    placeholder="{{ __('message.newphone') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn bt-click">{{ __('message.changephone') }}</button>
                    </form>
                </div>
            </div>


            {{-- end content --}}
        </div>
    </div>
@endsection
