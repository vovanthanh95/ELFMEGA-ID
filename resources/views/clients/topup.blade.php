@extends('clients.main')
@section('content')
    <style>
        .box-subtitle__text {
            font-weight: 900;
            color: #ff753a;
            font-size: 16px;
            text-transform: uppercase;
        }

    </style>
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">{{__('message.topup')}}</div>
        </section>
        <div class="other-function-container">
            <div class="">
                <style>
                    .list_bank2__ {
                        width: 48%;
                        float: left;
                    }

                </style>
                <div class="row">
                    <a class="animated flipInY list_bank2__" href="{{ route('top-up-vn') }}">
                        <div class="row tab_bank_atm " style="margin-left: 1px; margin-right: 1px;">
                            <div class="list_bank_atm" style="padding-bottom: 10px">
                                <div class="tile-stats" type="2" id="list_bank" bpm_id="15">
                                    <div class="im_bank">
                                        <img class="max_width"
                                            src="{{ asset('assets/images/card_types/card.png') }}">
                                    </div>
                                    <p class="text-center" style="color:#464646">Nạp Card</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a class="animated flipInY list_bank2__" href="{{ route('top-up-mo-mo') }}">
                        <div class="row tab_bank_atm " style="margin-left: 1px; margin-right: 0px;">
                            <div class="list_bank_atm" style="padding-bottom: 10px">
                                <div class="tile-stats" type="3" id="list_bank" bpm_id="60">
                                    <div class="im_bank">
                                        <img class="max_width"
                                            src="{{ asset('assets/images/card_types/bank.png') }}">
                                    </div>
                                    <p class="text-center" style="color:#464646">ATM, Momo, ZaloPay</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="box-subtitle__text text-center">VUI LÒNG CHỌN 1 TRONG 2 PHƯƠNG THỨC Ở TRÊN ĐỂ TIẾP TỤC</div>
                </div>
            </div>
            <br />
            <div class="other-function-content-data shadow">
                <div class="list-data">
                    <h3>{{__('message.historypayment')}}</h3>
                </div>
                @if ($data->count() > 0)
                    @foreach ($data as $value)
                        @php
                            $status = '';
                        @endphp
                        @if ($value['type'] == 'tmt')
                            @if ($value['status'] == 1)
                                @php
                                    $status = '<font color="#3079ed">'.__('message.success').'</font>';
                                @endphp
                            @elseif ($value['status'] == 2)
                                @php
                                    $status = '<font color="red">'.__('message.invalidcardcode').'</font>';
                                @endphp
                            @elseif ($value['status'] == 3)

                            @elseif ($value['status'] == 4)
                                @php
                                    $status = '<font color="red">'.__('message.invalidcardcode').'</font>';
                                @endphp
                            @elseif ($value['status'] == 5)
                            @elseif ($value['status'] == 0)
                                @php
                                    $status = '<font color="blue">'.__('message.waitingforprogressing').'</font>';
                                @endphp
                            @else
                                @php
                                    $status = '<font color="red">'.__('message.theserverisempty').'</font>';
                                @endphp
                            @endif
                        @else
                            @if ($value['status'] == 1)
                                @php
                                    $status = '<font color="#3079ed">'.__('message.success').'</font>';
                                @endphp
                            @elseif ($value['status'] == 2)
                                @php
                                    $status = '<font color="red">'.__('message.invalidcardcode').'</font>';
                                @endphp
                            @elseif ($value['status'] == 3)
                                @php
                                    $status = '<font color="red">'.__('message.errorofloadingcardvalue').'</font>';
                                @endphp
                            @elseif ($value['status'] == 4)
                                @php
                                    $status = '<font color="red">'.__('message.theserverisundermaintenance').'</font>';
                                @endphp
                            @elseif ($value['status'] == 5)
                                @php
                                    $status = '<font color="red">'.__('message.cardused').'</font>';
                                @endphp
                            @elseif ($value['status'] == 0)
                                @php
                                    $status = '<font color="blue">'.__('message.waitingforprogressing').'</font>';
                                @endphp
                            @else
                                @php
                                    $status = '<font color="red">'.__('message.theserverisempty').'</font>';
                                @endphp
                            @endif
                        @endif

                        @if ($value['type'] != 'MOMO')
                            @php
                                $stringType = '<p>PIN: <span class="blue">'.preg_replace("/^.+(?=(.{5}$))/", "********", $value['pin']).'</span></p>';
                            @endphp
                        @else
                            @php
                                $stringType = '';
                            @endphp
                        @endif

                        <div class="list-data-content txn">
                            <div class="col-xs-6 order-left-content">
                                <p><span class="blue">{{ $value['type'] }}</span></p>
                                {!! $stringType !!}
                                <p>{{ date('H:i d/m/y', strtotime($value['time'])) }}</p>
                            </div>
                            <div class="col-xs-6">
                                <p class="text-right">
                                    {!! $status !!}
                                </p>
                                <p class="text-right ">{{ number_format($value['amount']) }} {{config('custom.namemoney')}}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endforeach
                @endif
                <div class="clearfix"></div>
            </div>



        </div>
        <style>
            .payment-body {
                display: flex;
                align-items: flex-start;
                justify-content: center;
            }

            .bk-loading {
                text-align: center;
                display: none;
            }

            .biometric-box {
                display: none;
            }

        </style>
    </div>

@endsection
