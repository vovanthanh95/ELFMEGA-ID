@extends('clients.main')
@section('content')
    <div class="accountPage__layout">
        <div class="updatePasswordPage__layout">
            <div class="rowTitle">
                <span>NẠP ATM/BANKING</span>
            </div>
            <div class="banking">
                <div class="row info-momo center">
                    <div class="col-md-12 col-sm-12 col-12">
                        <img src="{{ asset('assets/img/icon-gift.svg') }}">
                        @if (isset($discount['timestart']) && isset($discount['timeend']))
                            <p>
                                Từ {{ $discount['timestart'] . ' ' }} đến {{ ' ' . $discount['timeend'] . ' ' }}Ưu đãi lên tới
                                <span style="color: rgb(5, 21, 245);">
                                    {{ $discount['ispromotion'] }}%
                                </span>
                                giá trị nạp khi nạp qua ATM/BANKING
                            </p>
                        @else
                            <p>
                                Tỷ lệ nạp lên tới
                                <span style="color: rgb(5, 21, 245);">
                                    {{ $discount['value'] }}%
                                </span>
                                giá trị nạp khi nạp qua ATM/BANKING
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-6">
                        Ngân Hàng:
                    </div>
                    <div class="col-md-5 col-sm-6 col-6">
                        {{ $atm['name'] }}
                    </div>
                    <div class="col-md-4 col-sm-12 col-12">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-6">
                        Chủ tài khoản:
                    </div>
                    <div class="col-md-5 col-sm-6 col-6">
                        {{ $atm['accountname'] }}
                    </div>
                    <div class="col-md-4 col-sm-12 col-12">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-12 col-12">
                        Số tài khoản:
                    </div>
                    <div class="col-md-5 col-sm-8 col-8">
                        <input value="{{ $atm['accountnumber'] }}" id="payment_amount1" class="form-control"
                            style="height: 40px;" readonly>
                    </div>
                    <div class="col-md-4 col-sm-4 col-4 banking-center">
                        <button class="btn-copy btn-custom btn-custom-mb" onclick="saochep()">
                            Sao Chép
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-12 col-12">
                        Nội dung:
                    </div>
                    <div class="col-md-5 col-sm-8 col-8">
                        <input value="NAP {{ $username }}" id="payment_amount" class="form-control"
                            style="height: 40px;" readonly>
                    </div>
                    <div class="col-md-4 col-sm-4 col-4 banking-center">
                        <button class="btn-copy btn-custom btn-custom-mb" onclick="saochep2()">
                            Sao Chép
                        </button>
                    </div>
                </div>

                <div class="row center">
                    <span>Hệ thống sẽ tự động cộng {{ config('custom.namemoney') }} vào
                        tài khoản cho bạn ngay sau khi nhận được tiền từ 30s-1p, trường hợp sau 5 phút bạn không nhận
                        được Xu vui lòng liên hệ
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
                text: "Đã Sao Chép: " + copyText.value,
                type: "success"
            });
        }

        function saochep2() {
            var copyText = document.getElementById("payment_amount");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            swal({
                text: "Đã Sao Chép: " + copyText.value,
                type: "success"
            });
        }
    </script>
@endsection
