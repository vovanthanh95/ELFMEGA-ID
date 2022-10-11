@extends('clients.main')
@section('content')
    @if ($momo != null && $zalopay != null && $discount != null)
        <div class="accountPage__layout">
            <div class="updatePasswordPage__layout">
                <div class="rowTitle">
                    <span>{{ trans('message.titletopupewallet') }}</span>
                </div>
                <div class="banking">
                    <div class="row info-momo center">
                        <div class="col-md-12 col-sm-12 col-12">
                            <img src="{{ asset('assets/img/icon-gift.svg') }}">
                            @if (isset($discount['timestart']) && isset($discount['timeend']))
                                <p>
                                    {{ trans('message.Textfrom') }} {{ $discount['timestart'] . ' ' }}
                                    {{ trans('message.Textto') }}
                                    {{ ' ' . $discount['timeend'] . ' ' }}{{ trans('message.Textoffers') }}
                                    <span style="color: rgb(5, 21, 245);">
                                        {{ $discount['ispromotion'] }}%
                                    </span>
                                    {{ trans('message.Texttopupvalue') }}{{ trans('message.Textewallet') }}
                                </p>
                            @else
                                <p>
                                    {{ trans('message.Textrateupto') }}
                                    <span style="color: rgb(5, 21, 245);">
                                        {{ $discount['value'] }}%
                                    </span>
                                    {{ trans('message.Texttopupvalue') . ' ' }}{{ trans('message.Textewallet') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row center icon-momo-zalo">
                        <div class="col-3 card-item row nopading" id="">
                            <input class="col-3" type="radio" name="card_provider" value="mobifone" id="mobifone-input"
                                checked="checked" onclick="chon('momo','{{ $username }}')">
                            <label class="col-9" for="mobifone-input"><img id="mobifone" class="icon-card-momo"
                                    src="{{ asset('assets/img/momo.jpg') }}"> </label>
                        </div>

                        <div class="col-3 card-item row nopading" id="">
                            {{-- <input class="col-3" type="radio" name="card_provider" value="viettel" id="card_2"
                                onclick="chon('zalopay','{{ $username }}')">
                            <label class="col-9" for="card_2"><img class="icon-card-momo"
                                    src="{{ asset('assets/img/zalopay.png') }}"> </label> --}}
                        </div>
                    </div>
                    
                     <div class="row">
                        <div class="col-md-3 col-sm-12 col-12" id="stk">
                        </div>
                        <div class="col-md-9 col-sm-12 col-12">

                            <li class="row">
                                <span class="col-3" style="color:#36b3df;">{{trans('message.Textnote')}}:</span>
                                <span class="col-9"> - {{trans('message.Textnolimitmoney')}}.</span>
                             </li>
                             <li class="row">
                                <span class="col-3" style="color:#36b3df;"></span>
                                <span class="col-9"> - {{trans('message.Textminimummoney')}} <span style="color:#36b3df;"> 50,000{{trans('message.money')}}</span></span>
                             </li>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-6">
                            {{ trans('message.Textaccountholder') }}:
                        </div>
                        <div class="col-md-5 col-sm-6 col-6" id="accountname">
                            {{ $momo['accountname'] }}
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-12" id="stk">
                            {{ trans('message.Textaccountnumbermomo') }}:
                        </div>
                        <div class="col-md-5 col-sm-8 col-8">
                            <input value="{{ $momo['accountnumber'] }}" id="payment_amount1" class="form-control"
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
                            <input value="{{ $username }}" id="payment_amount" class="form-control"
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
                            <a href="https://www.facebook.com/thanthudaichien">
                                <span style="color: rgb(5, 21, 245);text-decoration: none;">Fanpage
                                </span>
                            </a>
                        </span>
                    </div>
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

            function chon(data, username) {
                if (data == "momo") {
                    $("#accountname").html('{{ $momo['accountname'] }}');
                    $("#payment_amount1").val('{{ $momo['accountnumber'] }}');
                    $("#payment_amount").val(username);
                    $("#stk").html("{{ trans('message.Textaccountnumbermomo') }}");
                }
                if (data == "zalopay") {
                    $("#accountname").html('{{ $zalopay['accountname'] }}');
                    $("#payment_amount1").val('{{ $zalopay['accountnumber'] }}');
                    $("#payment_amount").val(username);
                    $("#stk").html("{{ trans('message.Textaccountnumberzalo') }}");
                }
            }
        </script>
    @endif
@endsection
