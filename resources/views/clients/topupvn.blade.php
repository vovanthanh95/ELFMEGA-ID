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
                        <form action="/topup-vn" method="post" novalidate="novalidate">
                            <input name="_token" type="hidden" value="">
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
                                    <select class="select-list" name="card_provider" id="card_provider">
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
                                    <select class="select-list" name="card_value" id="card_value"
                                        onchange="getXu(this.value)">
                                        <option value="0">Chọn mệnh giá?</option>
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
                                    document.getElementById("Xus1").innerHTML = ((value / 100) * valuepromotion).toString().replace(
                                        /\B(?=(\d{3})+(?!\d))/g, ",") + " Xu";
                                }
                            </script>
                            <div class="box-subtitle__text text-center">NHẬP THÔNG TIN THẺ</div>
                            <div class="col-md-12">
                                <div class="row">
                                    <input id="card_serial" required autocomplete="off" name="card_serial" type="text"
                                        value="">
                                    <label for="Seri" alt="Seri" placeholder="Seri"></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <input id="card_password" required autocomplete="off" name="card_password" type="text"
                                        value="">
                                    <label for="Mã thẻ" alt="Mã thẻ" placeholder="Mã thẻ"></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <input style="width:50%" id="captcha" required placeholder="captcha" autocomplete="off"
                                        name="captcha" type="text" value="">
                                    <a href="javascript:changeCaptcha2();" id="refreshCaptcha">
                                        {!! captcha_img() !!}
                                    </a>
                                    <label for="captcha" alt="captcha" placeholder="captcha"></label>
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                        <div class="row">
                                            <input type="submit" name="topup"
                                                class="login loginmodal-submit pull-left col-md-12" value="topup">
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


            <div class="other-function-content-data shadow">
                <div class="list-data">
                    <h3>historypayment</h3>
                </div>
                {{-- history --}}
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
    <script type="text/javascript">
        function format_curency(a) {
            a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        }

        function changeCaptcha() {
            var url = "url_api";
            var id = url + "/captcha/captcha-image.php?rand=" + Math.random() + "&w=150&h=50";
            $("#imgCapcha").attr("src", id);
        }

        function changeCaptcha2() {
            var url = "url_api";
            var id = url + "/captcha/captcha-image.php?rand=" + Math.random() + "&w=150&h=50";
            $("#imgCapcha2").attr("src", id);
        }
        $('#form-th').submit(function() {
            <?php
            $array_desc = str_split('ABCDEFGHIJ');
            if (empty($_SESSION['can_refill']) == true || (empty($_SESSION['can_refill']) and unserialize($_SESSION['can_refill']) == false)) {
                shuffle($array_desc);
                $_SESSION['can_refill'] = serialize($array_desc);
            } else {
                shuffle($array_desc);
                $_SESSION['can_refill'] = serialize($array_desc);
            }

            echo ' var temp = document.getElementById("epinCode").value; ';
            foreach ($array_desc as $digit => $char) {
                echo 'while(temp.indexOf(\'' . $digit . '\')!=-1) { temp = temp.replace(\'' . $digit . '\',\'' . $char . '\'); }';
            }
            echo '
                                    			document.getElementById("pin_sent").value = temp;
                                    		';
            ?>
        });
    </script>
@endsection
