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
                                        <img class="max_width" src="{{asset('assets/images/card_types/card.png')}}">
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
                                        <img class="max_width" src="{{asset('assets/images/card_types/bank.png')}}">
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
