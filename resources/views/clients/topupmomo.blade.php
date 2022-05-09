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
                </div>
            </div>
            <br />
            <div class="loginmodal-container">
                <div class="conten_login">
                    <div class="box-subtitle__text text-center">TỈ LỆ NẠP</div>
                    <span>Chuyển Khoản Momo, MBbank, ZaloPay nhận: 120% giá trị số tiền nạp <br>
                        <font color="red">Ví dụ: Chuyển Khoản 100,000 VNĐ nhận 120,000 namemoney</font>
                    </span>
                    <div class="mb-3">
                        <div class="box-subtitle__text text-center">HÌNH THỨC CHUYỂN KHOẢN</div>
                        <p>
                            Chuyển khoản với nội dung dưới đây, cú pháp nạp không phân biệt hoa thường.
                        </p>
                    </div>

                    <div class="bg-sand-corner-light p-4 mb-4">
                        <div class="row no-gutters">
                            <div class="col-sm-12">
                                <p><strong><span style="font-size:15px;"><span style="color:#000000;"><span
                                                    style="font-size:15px;color:#ff753a;">❖ Cú pháp:
                                                </span></span></span><span class="font-weight-600">3Q
                                           username</span></strong></p>
                            </div>
                        </div>
                    </div>
                    <p>Tài khoản nhận nạp qua kênh chuyển khoản</p>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col" class="w-50">Kênh nạp</th>
                                <th scope="col"> Thông tin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ATM MBBank</td>

                                <td>
                                    <span class="text-success font-weight-600"><b>38666778899 - NGUYỄN ĐÌNH ĐÌNH</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Ví MOMO</td>
                                <td>
                                    <span class="text-success font-weight-600"><b>0978866517 - NGUYỄN ĐÌNH ĐÌNH</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Ví ZaloPay</td>
                                <td>
                                    <span class="text-success font-weight-600"><b>0978866517 - NGUYỄN ĐÌNH ĐÌNH</b></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <u><strong>Chú ý:</strong></u>
                    <ul>
                        <li><b>3Q</b> là tên cú pháp</li>
                        <li><b>username</b> là tên đăng nhập, vui lòng ghi đúng để tránh nạp nhầm tài
                            khoản</li>
                        <li>Hệ thống sẽ tự động cộng namemone vào tài khoản cho bạn ngay sau khi nhận
                            được tiền từ 30s-1p, trường hợp sau 5 phút bạn không nhận được namemoney vui
                            lòng liên hệ <a href="https://m.me/badao3q" style="font-size:15px;color:#0404B4;"
                                target="_blank">Fanpage</a></li>
                    </ul>
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
