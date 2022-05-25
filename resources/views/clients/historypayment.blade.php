@extends('clients.main2')
@section('content')
    @include('clients.userinfo')
    <div class="container">
        <div class="row">
            @include('clients.navbar')
            {{-- content --}}
            <div class="col-sm-8 col-md-8 col-lg-9 ">
                <div class="boxinfo">
                    <h3 class="title">{{__('message.historypayment')}}</h3>
                    <div class="other-function-content-data shadow">
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
            </div>
            {{-- end content --}}
        </div>
    </div>

@endsection
