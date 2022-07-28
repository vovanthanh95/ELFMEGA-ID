@extends('clients.main')
@section('content')
<div class="accountPage__layout">
    <div class="updatePasswordPage__layout">
        <div class="rowTitle">
            <span>{{trans('message.titlechangepass')}}</span>
        </div>
        <form class="form-input" action="{{route('post-change-pass')}}" method="POST">
            @csrf
            <div class="input-row">
                <input class="form-control my-3" name="currentpassword" id="oldPassword" type="password" placeholder="{{trans('message.formcurrentpassword')}}" value="" style="height: 40px;">
            </div>
            <div class="input-row">
                <input class="form-control my-3" name="newpassword" id="newPassword" type="password" placeholder="{{trans('message.formnewpassword')}}" value="" style="height: 40px;">
            </div>
            <div class="input-row">
                <input class="form-control my-3" name="confirmpassword" id="confirmPassword" type="password" placeholder="{{trans('message.formrepeatnewpassword')}}" value="" style="height: 40px;">
            </div>
            <div class="btn-confirm-row">
                <button class="btn-custom" type="submit">{{trans('message.btnaccept')}}</button>
                <a href="{{route('account')}}"><button class="btn-custom" type="button">{{trans('message.btncancel')}}</button></a>
            </div>
        </form>
    </div>
</div>
@endsection