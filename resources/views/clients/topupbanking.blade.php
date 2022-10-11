@extends('clients.main')
@section('content')
    @if ($atm != null && $discount != null)
        <div class="accountPage__layout">
            <div class="updatePasswordPage__layout">
                <div class="rowTitle">
                    <span>{{ trans('message.titletopupbanking') }}</span>
                </div>
                <div class="banking">
                    @if (isset($discount['timestart']) && isset($discount['timeend']))
                        <div class="row info-momo center">
                            <div class="col-md-12 col-sm-12 col-12">
                                <img src="{{ asset('assets/img/icon-gift.svg') }}">

                                <p>
                                    {{ trans('message.Textfrom') }} {{ $discount['timestart'] . ' ' }}
                                    {{ trans('message.Textto') }}
                                    {{ ' ' . $discount['timeend'] . ' ' }}{{ trans('message.Textoffers') }}
                                    <span style="color: rgb(5, 21, 245);">
                                        {{ $discount['ispromotion'] }}%
                                    </span>
                                    {{ trans('message.Texttopupvalue') }} ATM/BANKING
                                </p>

                            </div>
                        </div>
                    @endif
                    {{-- <div class="row">
                        <div class="col-md-9 col-sm-12 col-12" style="display: flex">
                            <span style="color:#36b3df;"> {{ trans('message.Textnote') }}:</span>
                            <ul>
                                <li>
                                    <span> - {{ trans('message.Textnolimitmoney') }}.</span>
                                </li>
                                <li>
                                    <span> - {{ trans('message.Textminimummoney') }} <span style="color:#36b3df;">
                                            50,000{{ trans('message.money') }}</span></span>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                    <!-- Tabs navs -->
                    <ul class="nav nav-tabs nav-justified mb-3 nav-tabs-custom" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="ex3-tab-1" data-mdb-toggle="tab" href="#ex3-tabs-1"
                                role="tab" aria-controls="ex3-tabs-1" aria-selected="true">PHILIPPINES</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex3-tab-2" data-mdb-toggle="tab" href="#ex3-tabs-2" role="tab"
                                aria-controls="ex3-tabs-2" aria-selected="false">INDONESIA</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex3-tab-3" data-mdb-toggle="tab" href="#ex3-tabs-3" role="tab"
                                aria-controls="ex3-tabs-3" aria-selected="false">THAILAND</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex3-tab-4" data-mdb-toggle="tab" href="#ex3-tabs-4" role="tab"
                                aria-controls="ex3-tabs-4" aria-selected="false">OTHERS</a>
                        </li>
                    </ul>
                    <!-- Tabs navs -->

                    <!-- Tabs content -->
                    <div class="tab-content" id="ex2-content">
                        <div class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-5">
                                    {{ trans('message.rate') }}:
                                </div>
                                <div class="col-md-5 col-sm-6 col-7">
                                    500 GCASH = 100,000 Coin <span style="color:#36b3df;">({{trans('message.minimum')}} 500 GCASH)</span>
                                </div>
                                <div class="col-md-4 col-sm-12 col-12">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-5">
                                    {{ trans('message.Textbankname') }}:
                                </div>
                                <div class="col-md-5 col-sm-6 col-7">
                                    {{$atm[0]['name']}}
                                </div>
                                <div class="col-md-4 col-sm-12 col-12">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-5">
                                    {{ trans('message.Textaccountholder') }}:
                                </div>
                                <div class="col-md-5 col-sm-6 col-7">
                                    {{$atm[0]['accountname']}}
                                </div>
                                <div class="col-md-4 col-sm-12 col-12">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-12">
                                    {{ trans('message.Textaccountnumber') }}:
                                </div>
                                <div class="col-md-5 col-sm-8 col-8">
                                    <input value="{{$atm[0]['accountnumber']}}" id="payment_amount1" class="form-control"
                                        style="height: 40px;" readonly>
                                </div>
                                <div class="col-md-4 col-sm-4 col-4 banking-center">
                                    <button class="btn-copy btn-custom btn-custom-mb" onclick="saochep()">
                                        {{ trans('message.btncopy') }}
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-12">
                                    {{ trans('message.Textcontent') }}:
                                </div>
                                <div class="col-md-5 col-sm-8 col-8">
                                    <input value="ELFMEGA {{ $username }}" id="payment_amount" class="form-control"
                                        style="height: 40px;" readonly>
                                </div>
                                <div class="col-md-4 col-sm-4 col-4 banking-center">
                                    <button class="btn-copy btn-custom btn-custom-mb" onclick="saochep2()">
                                        {{ trans('message.btncopy') }}
                                    </button>
                                </div>
                            </div>

                            <div class="row center">
                                <span>{{ trans('message.infotopup', ['coin' => config('custom.namemoney')]) }}
                                    <a href="https://www.facebook.com/elfmega">
                                        <span style="color: rgb(5, 21, 245);text-decoration: none;">Fanpage
                                        </span>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-5">
                                    {{ trans('message.rate') }}:
                                </div>
                                <div class="col-md-5 col-sm-6 col-7">
                                    100,000 IDR = 75,000 Coin <span style="color:#36b3df;">({{trans('message.minimum')}} 100,000 IDR)</span>
                                </div>
                                <div class="col-md-4 col-sm-12 col-12">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-5">
                                    {{ trans('message.Textbankname') }}:
                                </div>
                                <div class="col-md-5 col-sm-6 col-7">
                                    {{$atm[1]['name']}}
                                </div>
                                <div class="col-md-4 col-sm-12 col-12">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-5">
                                    {{ trans('message.Textaccountholder') }}:
                                </div>
                                <div class="col-md-5 col-sm-6 col-7">
                                    {{$atm[1]['accountname']}}
                                </div>
                                <div class="col-md-4 col-sm-12 col-12">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-12">
                                    {{ trans('message.Textaccountnumber') }}:
                                </div>
                                <div class="col-md-5 col-sm-8 col-8">
                                    <input value="{{$atm[1]['accountnumber']}}" id="payment_amount3" class="form-control"
                                        style="height: 40px;" readonly>
                                </div>
                                <div class="col-md-4 col-sm-4 col-4 banking-center">
                                    <button class="btn-copy btn-custom btn-custom-mb" onclick="saochep3()">
                                        {{ trans('message.btncopy') }}
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-12">
                                    {{ trans('message.Textcontent') }}:
                                </div>
                                <div class="col-md-5 col-sm-8 col-8">
                                    <input value="ELFMEGA {{ $username }}" id="payment_amount4" class="form-control"
                                        style="height: 40px;" readonly>
                                </div>
                                <div class="col-md-4 col-sm-4 col-4 banking-center">
                                    <button class="btn-copy btn-custom btn-custom-mb" onclick="saochep4()">
                                        {{ trans('message.btncopy') }}
                                    </button>
                                </div>
                            </div>

                            <div class="row center">
                                <span>{{ trans('message.infotopup', ['coin' => config('custom.namemoney')]) }}
                                    <a href="https://www.facebook.com/elfmega">
                                        <span style="color: rgb(5, 21, 245);text-decoration: none;">Fanpage
                                        </span>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-5">
                                    {{ trans('message.rate') }}:
                                </div>
                                <div class="col-md-5 col-sm-6 col-7">
                                    500 BATH = 175.000 Coin <span style="color:#36b3df;">({{trans('message.minimum')}} 500 BATH)</span>
                                </div>
                                <div class="col-md-4 col-sm-12 col-12">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-5">
                                    {{ trans('message.Textbankname') }}:
                                </div>
                                <div class="col-md-5 col-sm-6 col-7">
                                    {{$atm[2]['name']}}
                                </div>
                                <div class="col-md-4 col-sm-12 col-12">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-5">
                                    {{ trans('message.Textaccountholder') }}:
                                </div>
                                <div class="col-md-5 col-sm-6 col-7">
                                    {{$atm[2]['accountname']}}
                                </div>
                                <div class="col-md-4 col-sm-12 col-12">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-12">
                                    {{ trans('message.Textaccountnumber') }}:
                                </div>
                                <div class="col-md-5 col-sm-8 col-8">
                                    <input value="{{$atm[2]['accountnumber']}}" id="payment_amount5" class="form-control"
                                        style="height: 40px;" readonly>
                                </div>
                                <div class="col-md-4 col-sm-4 col-4 banking-center">
                                    <button class="btn-copy btn-custom btn-custom-mb" onclick="saochep5()">
                                        {{ trans('message.btncopy') }}
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-12">
                                    {{ trans('message.Textcontent') }}:
                                </div>
                                <div class="col-md-5 col-sm-8 col-8">
                                    <input value="ELFMEGA {{ $username }}" id="payment_amount6" class="form-control"
                                        style="height: 40px;" readonly>
                                </div>
                                <div class="col-md-4 col-sm-4 col-4 banking-center">
                                    <button class="btn-copy btn-custom btn-custom-mb" onclick="saochep6()">
                                        {{ trans('message.btncopy') }}
                                    </button>
                                </div>
                            </div>

                            <div class="row center">
                                <span>{{ trans('message.infotopup', ['coin' => config('custom.namemoney')]) }}
                                    <a href="https://www.facebook.com/elfmega">
                                        <span style="color: rgb(5, 21, 245);text-decoration: none;">Fanpage
                                        </span>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ex3-tabs-4" role="tabpanel" aria-labelledby="ex3-tab-4">
                            <div class="row center">
                                   <span> {{ trans('message.rate') }}: 10$ Paypal = 100.000 Coin </span><span style="color:#36b3df;">({{trans('message.minimum')}} 10$)</span>
                            </div>
                            <div class="row center">
                                <span>{{ trans('message.supportfanpage') }}
                                    <a href="https://www.facebook.com/elfmega">
                                        <span style="color: rgb(5, 21, 245);text-decoration: none;">Fanpage
                                        </span>
                                    </a>
                                    {{ trans('message.support') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Tabs content -->
                </div>
            </div>
        </div>
        <script>
            function saochep() {
                var copyText = document.getElementById("payment_amount1");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                swal({
                    text: "{{ trans('message.alerthascopy') }}: " + copyText.value,
                    type: "success"
                });
            }

            function saochep2() {
                var copyText = document.getElementById("payment_amount");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                swal({
                    text: "{{ trans('message.alerthascopy') }}: " + copyText.value,
                    type: "success"
                });
            }

            function saochep3() {
                var copyText = document.getElementById("payment_amount3");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                swal({
                    text: "{{ trans('message.alerthascopy') }}: " + copyText.value,
                    type: "success"
                });
            }

            function saochep4() {
                var copyText = document.getElementById("payment_amount4");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                swal({
                    text: "{{ trans('message.alerthascopy') }}: " + copyText.value,
                    type: "success"
                });
            }

            function saochep5() {
                var copyText = document.getElementById("payment_amount5");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                swal({
                    text: "{{ trans('message.alerthascopy') }}: " + copyText.value,
                    type: "success"
                });
            }

            function saochep6() {
                var copyText = document.getElementById("payment_amount6");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                swal({
                    text: "{{ trans('message.alerthascopy') }}: " + copyText.value,
                    type: "success"
                });
            }
        </script>
    @endif
@endsection
