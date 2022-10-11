@extends('clients.main')
@section('content')
<div class="accountPage__layout">
    <div class="linkedProfile__section rowTitle">
        <span>{{trans('message.titlselectiontopup')}}</span>
    </div>
    <div class="">
        <div class="profileInfo">
            <div class="row">
                <div class="col-md-12 col-12 value label btn-center">
                    <button class="btn-custom btn-capnhat"><a href="{{route('top-up-vn')}}"> {{trans('message.btntopupcard')}}</a></button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-12 value label btn-center">
                    <button class="btn-custom btn-capnhat"><a href="{{route('top-up-banking')}}"> {{trans('message.btnbanking')}}</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection