@extends('clients.main')
@section('content')
<div class="accountPage__layout">
    <div class="linkedProfile__section rowTitle">
        <span>{{trans('message.titleaccount')}}</span>
    </div>
    <div class="">
        <div class="profileInfo">
            <div class="row">
                <div class="col-md-4 col-4 label">{{trans('message.Textaccount')}}:</div>
                <div class="col-md-8 col-8 value label username1">
                    {{ $username != null ? $username : '' }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-4 label">{{trans('message.Textemail')}}:</div>
                <div class="col-md-8 col-8 value label">
                    @if ($email != null)
                        {{$email}}
                    @else
                    <button class="btn-custom btn-capnhat"><a href="{{route('update-email')}}"> {{trans('message.btnupdateemail')}}</a></button>
                    @endif
                </div>
                <div class="col-md-12 col-12 forgot"><i>{{trans('message.infoemail')}}</i></div>
            </div>
            <div class="row">
                <div class="col-md-4 col-4 label">{{trans('message.Textphone')}}:</div>
                <div class="col-md-8 col-8 value label">
                    @if ($phone != null)
                        {{$phone}}
                    @else
                    <button class="btn-custom btn-capnhat"><a href="{{route('update-phone')}}"> {{trans('message.btnupdatephone')}}</a></button>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-4 label">{{trans('message.Texttimeregister')}}:</div>
                <div class="col-md-8 col-8 value label">
                    {{ $createtime }}
                </div>
            </div>
            <div class="row" style="border-bottom: 0px;">
                <div class="col-md-4 col-4 label">{{trans('message.Textsurplus')}} ({{config('custom.namemoney')}}):</div>
                <div class="col-md-8 col-8 value label">
                    {{ $money }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection