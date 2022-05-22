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
            <div class="box-title__text text-center">topup</div>
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
                    <a class="animated flipInY list_bank2__" href="{{route('top-up-vn')}}">
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
                    <a class="animated flipInY list_bank2__" href="{{route('top-up-mo-mo')}}">
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
                </div>
            </div>
            <br />
            <div class="loginmodal-container">
                <div class="conten_login">
                    <div class="bk-form-login" id="pay-2">
                        <form action="{{route('post-top-up-vn')}}" method="post" novalidate="novalidate">
                            @csrf
                            <input name="type" type="hidden" value="payVN">
                            <u><strong>Chú ý:</strong></u>
                            <ul>
                                <li>Tỉ lệ nạp 1:1 (100,000 VNĐ = 100,000 Xu)</li>
                                <li>Hệ thống duyệt thẻ tự động</li>
                                <li>
                                    <font color="#ff0000"><strong>Khai báo sai mệnh giá sẽ không nạp được và bị mất
                                            thẻ.</strong></font>
                                </li>
                            </ul>
                            <div class="box-subtitle__text text-center">CHỌN LOẠI THẺ NẠP</div>
                            <div class="col-md-12">
                                <div class="row">
                                    <select class="select-list" name="card_provider" id="card_provider" onchange="changeCardProvider(this)">
                                        <option value="">Chọn loại thẻ bạn cần nạp?</option>
                                        <option value="11">Thẻ Viettel</option>
                                        <option value="12">Thẻ Mobifone</option>
                                        <option value="13">Thẻ Vinaphone</option>
                                    </select>
                                </div>
                            </div>
                            <div class="box-subtitle__text text-center">CHỌN MỆNH GIÁ</div>
                            <div class="form-group text-center">
                                <button type="button" class="badge badge-pill badge-dark" id="selectedtype"></button>
                                <button type="button" class="btn btn-info">Xu Nhận: <span id="Xus1"
                                        style="margin-left: 10px;" class="badge badge-light">0</span> </button>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <select class="select-list" name="card_value" id="card_value" disabled="disabled" onchange="changeCardValue(this)"
                                        onchange="getXu(this.value)">
                                        <option value="">Chọn mệnh giá?</option>
                                        <option value="10000">10,000 VNĐ</option>
                                        <option value="20000">20,000 VNĐ</option>
                                        <option value="50000">50,000 VNĐ</option>
                                        <option value="100000">100,000 VNĐ</option>
                                        <option value="200000">200,000 VNĐ</option>
                                        <option value="300000">300,000 VNĐ</option>
                                        <option value="500000">500,000 VNĐ</option>
                                        <option value="1000000">1,000,000 VNĐ</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="promo" value="">
                            <script>
                                function getXu(value) {
                                    var valuepromotion = document.getElementById("promo").value;
                                    document.getElementById("Xus1").innerHTML = ((value / 100) * {{$getpromotion}}).toString().replace(
                                        /\B(?=(\d{3})+(?!\d))/g, ",") + " Xu";
                                }
                            </script>
                            <div class="box-subtitle__text text-center">NHẬP THÔNG TIN THẺ</div>
                            <div class="col-md-12">
                                <div class="row">
                                    <input id="card_serial" required autocomplete="off" name="card_serial" type="text" disabled
                                        value="{{old('card_serial')}}">
                                    <label for="Seri" alt="Seri" placeholder="Seri"></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <input id="card_password" required autocomplete="off" name="card_password" type="text" disabled
                                        value="{{old('card_password')}}">
                                    <label for="Mã thẻ" alt="Mã thẻ" placeholder="Mã thẻ"></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <input style="width:50%" id="captcha" required placeholder="{{__('message.captcha')}}" autocomplete="off" disabled
                                        name="captcha" type="text" value="">
                                        <label id="refreshCaptcha">
                                            {!! captcha_img() !!}
                                        </label>
                                    <label for="captcha" alt="{{__('message.captcha')}}" placeholder="{{__('message.captcha')}}"></label>
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                        <div class="row">
                                            <input type="submit" name="topup" id="submit" disabled
                                                class="login loginmodal-submit pull-left col-md-12 show-submit" value="{{__('message.topup')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <i id="noti-biometric" style="color: red"></i>
                            </center>
                            <input name="return_url" type="hidden" id="return_url" value="">
                        </form>
                    </div>
                </div>
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

            .show-submit{
                background-color: #eee;
            }

        </style>
    </div>
    <script type="text/javascript">
        function changeCardProvider(a) {
            if(a.value != ""){
                $('#card_value').prop('disabled', false);
            }else{
                $('#card_value').prop('disabled', true);
                $('#card_value').prop('selectedIndex',0);

                $('#card_password').prop('disabled', true);
                $('#card_password').val('');

                $('#card_serial').prop('disabled', true);
                $('#card_serial').val('');

                $('#captcha').prop('disabled', true);
                $('#captcha').val('');

                $('#submit').prop('disabled', true);
                $('#submit').addClass( "show-submit" );
            }
        }

        function changeCardValue(a) {
            if(a.value != ""){
                $('#card_serial').prop('disabled', false);
                $('#card_password').prop('disabled', false);
                $('#captcha').prop('disabled', false);
                $('#submit').prop('disabled', false);
                $('#submit').removeClass( "show-submit" );

            }else{
                $('#card_serial').prop('disabled', true);
                $('#card_password').prop('disabled', true);
                $('#captcha').prop('disabled', true);
                $('#submit').prop('disabled', true);

                $('#card_password').prop('disabled', true);
                $('#card_password').val('');

                $('#card_serial').prop('disabled', true);
                $('#card_serial').val('');

                $('#captcha').prop('disabled', true);
                $('#captcha').val('');

                $('#submit').addClass( "show-submit" );
            }
        }
    </script>

    {{-- reload captcha onclick --}}
    <script>
		$(document).ready(function(){
            $('#refreshCaptcha').click(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: 'reloadCaptcha',
                    success: function(result){
                        $('#refreshCaptcha').html(result.captcha);
                    },
                });
            });
        });
	</script>
@endsection
