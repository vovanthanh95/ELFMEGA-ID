@extends('clients.main')
@section('content')
    <div class="accountPage__layout">
        <div class="updatePasswordPage__layout">
            <div class="rowTitle">
                <span>{{trans('message.titleupdatephone')}}</span>
            </div>
            <form class="form-input" action="{{ route('post-update-phone') }}" method="POST">
                @csrf
                <div class="input-row">
                    <input class="form-control my-3" name="phone" type="text"
                        placeholder="{{trans('message.formnewphone')}}" value="{{ old('phone') }}" style="height: 40px;">
                </div>
                <div class="btn-confirm-row">
                    <button class="btn-custom" type="submit">{{trans('message.btnaccept')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
