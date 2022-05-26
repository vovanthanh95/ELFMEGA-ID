@extends('clients.main2')
@section('content')
    @include('clients.userinfo')
    <div class="container">
        <div class="row">
            @include('clients.navbar')
            {{-- content --}}
            <div class="col-sm-8 col-md-8 col-lg-9 ">
                <div class="boxinfo">
                    <h3 class="title">{{ __('message.topup') }}</h3>
                <form action="{{ route('post-top-up-vn') }}" method="post" novalidate="novalidate" class="topup">
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
                    <div class="row">
                        <div class="form-group">
                            <p class="col-sm-3 control-label">CHỌN LOẠI THẺ NẠP:</p>
                            <div class="col-sm-6">
                                <select class="select-list form-control" name="card_provider" id="card_provider"
                                    onchange="changeCardProvider(this)">
                                    <option value="">Chọn loại thẻ bạn cần nạp?</option>
                                    <option value="11">Thẻ Viettel</option>
                                    <option value="12">Thẻ Mobifone</option>
                                    <option value="13">Thẻ Vinaphone</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <p class="col-sm-3 control-label">CHỌN MỆNH GIÁ:</p>
                            <div class="col-sm-6">
                                <select class="select-list form-control" name="card_value" id="card_value"
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
                    </div>
                    <div class="row xunhan">
                        <button type="button" class="badge badge-pill badge-dark" id="selectedtype"></button>
                        <button type="button" class="btn btn-info">Xu Nhận: <span id="Xus1" style="margin-left: 10px;"
                                class="badge badge-light">0</span> </button>
                        <input type="hidden" id="promo" value="">
                    </div>
                    <script>
                        function getXu(value) {
                            var valuepromotion = document.getElementById("promo").value;
                            document.getElementById("Xus1").innerHTML = ((value / 100) * {{ $getpromotion }}).toString().replace(
                                /\B(?=(\d{3})+(?!\d))/g, ",") + " Xu";
                        }
                    </script>

                    <div class="row">
                        <div class="form-group">
                            <p class="col-sm-3 control-label">NHẬP SERIAL THẺ:</p>
                            <div class="col-sm-6">
                                <input id="form-control" class="form-control" required autocomplete="off"
                                    name="card_serial" type="text" value="{{ old('card_serial') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <p class="col-sm-3 control-label">NHẬP MÃ THẺ:</p>
                            <div class="col-sm-6">
                                <input class="form-control" id="card_password" required autocomplete="off"
                                    name="card_password" type="text" value="{{ old('card_password') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <p class="col-sm-3 control-label">NHẬP MÃ CAPTCHA:</p>
                            <div class="col-sm-3">
                                <input class="form-control" id="card_password" required autocomplete="off"
                                    name="captcha" type="text" value="{{ old('captcha') }}">
                            </div>

                            <div class="col-sm-2 captcha-img">
                                <p id="refreshCaptcha">
                                    {!! captcha_img() !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row btsm">
                        <input type="submit" name="topup" id="submit"
                            class="btn bt-click"
                            value="{{ __('message.topup') }}">
                    </div>
                </form>
                </div>
            </div>
            {{-- end content --}}
        </div>
    </div>

    <script type="text/javascript">
        // function changeCardProvider(a) {
        //     if(a.value != ""){
        //         $('#card_value').prop('disabled', false);
        //     }else{
        //         $('#card_value').prop('disabled', true);
        //         $('#card_value').prop('selectedIndex',0);

        //         $('#card_password').prop('disabled', true);
        //         $('#card_password').val('');

        //         $('#card_serial').prop('disabled', true);
        //         $('#card_serial').val('');

        //         $('#captcha').prop('disabled', true);
        //         $('#captcha').val('');

        //         $('#submit').prop('disabled', true);
        //         $('#submit').addClass( "show-submit" );
        //     }
        // }

        // function changeCardValue(a) {
        //     if(a.value != ""){
        //         $('#card_serial').prop('disabled', false);
        //         $('#card_password').prop('disabled', false);
        //         $('#captcha').prop('disabled', false);
        //         $('#submit').prop('disabled', false);
        //         $('#submit').removeClass( "show-submit" );

        //     }else{
        //         $('#card_serial').prop('disabled', true);
        //         $('#card_password').prop('disabled', true);
        //         $('#captcha').prop('disabled', true);
        //         $('#submit').prop('disabled', true);

        //         $('#card_password').prop('disabled', true);
        //         $('#card_password').val('');

        //         $('#card_serial').prop('disabled', true);
        //         $('#card_serial').val('');

        //         $('#captcha').prop('disabled', true);
        //         $('#captcha').val('');

        //         $('#submit').addClass( "show-submit" );
        //     }
        // }
    </script>

    {{-- reload captcha onclick --}}
    <script>
        $(document).ready(function() {
            $('#refreshCaptcha').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: 'reloadCaptcha',
                    success: function(result) {
                        $('#refreshCaptcha').html(result.captcha);
                    },
                });
            });
        });
    </script>
@endsection
