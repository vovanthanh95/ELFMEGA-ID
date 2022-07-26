@extends('clients.main')
@section('content')
    <div class="accountPage__layout">
        <div class="updatePasswordPage__layout">
            <div class="rowTitle">
                <span>NẠP THẺ ĐIỆN THOẠI</span>
            </div>
            <div class="row">
                <div class="col-md-5 col-sm-12 col-12">
                    <table class="table-card">
                        <thead>
                            <tr class="tb-head">
                                <td width="60%" class="tb-head">Mệnh giá <span class="fontsml">(VNĐ)</span></td>
                                <td width="40%"class="tb-head">{{ config('custom.namemoney') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10,000</td>
                                <td id="10">105</td>
                            </tr>
                            <tr>
                                <td>20,000</td>
                                <td id="20">210</td>
                            </tr>
                            <tr>
                                <td>50,000</td>
                                <td id="50">525</td>
                            </tr>
                            <tr>
                                <td>100,000</td>
                                <td id="100">1,050</td>
                            </tr>
                            <tr>
                                <td>200,000</td>
                                <td id="200">2,100</td>
                            </tr>
                            <tr>
                                <td>300,000</td>
                                <td id="300">3,150</td>
                            </tr>
                            <tr>
                                <td>500,000</td>
                                <td id="500">5,250</td>
                            </tr>
                            <tr>
                                <td>1,000,000</td>
                                <td id="1000">10,500</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-7 col-sm-12 col-12">
                    <form class="form-input-card" action="{{ route('post-top-up-vn') }}" method="POST">
                        @csrf
                        <div class="input-row">
                            <div class="row">
                                <div class="col-4 card-item row" id="">
                                    <input class="col-3" type="radio" name="card_provider" value="mobifone" id="mobifone-input"
                                        checked="checked">
                                    <label class="col-9" for="mobifone-input"><img id="mobifone" class="icon-card"
                                            src="{{ asset('assets/img/mobifone.png') }}"> </label>
                                </div>

                                <div class="col-4 card-item row" id="">
                                    <input class="col-3" type="radio" name="card_provider" value="viettel" id="card_2">
                                    <label class="col-9" for="card_2"><img class="icon-card"
                                            src="{{ asset('assets/img/viettel-logo.png') }}"> </label>
                                </div>
                                <div class="col-4 card-item row" id="">
                                    <input class="col-3" type="radio" name="card_provider" value="vinaphone" id="card_3">
                                    <label class="col-9" for="card_3"><img class="icon-card"
                                            src="{{ asset('assets/img/Vinaphone_Logo.png') }}"></label>
                                </div>
                            </div>
                        </div>
                        <div class="input-row">
                            <select class="select-list form-control my-3 topup-selection" name="card_value" id="rid"
                                style="height: 40px;">
                                <option value="">Chọn mệnh giá</option>
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
                        <div class="input-row">
                            <input class="form-control my-3" name="card_serial" id="oldPassword" type="text"
                                placeholder="Seri thẻ" value="{{ old('card_serial') }}" style="height: 40px;">
                        </div>
                        <div class="input-row">
                            <input class="form-control my-3" name="card_password" id="newPassword" type="text"
                                placeholder="Mã thẻ" value="{{ old('card_password') }}" style="height: 40px;">
                        </div>
                        <div class="row input-row">
                            <input class="col-7 form-control cus-input" name="captcha" id="newPassword" type="text"
                                placeholder="Mã captcha" value="{{ old('captcha') }}" style="height: 40px;">
                            <div class="col-5 img-captcha">
                                <p id="refreshCaptcha">
                                    {!! captcha_img() !!}
                                </p>
                            </div>
                        </div>
                        <div class="row input-row topup-info">
                            <p><i style="color: #5b545b;">*click vào captcha để thay đổi captcha<i></p>
                        </div>
                        <div class="btn-confirm-row">
                            <button class="btn-custom" type="submit">XÁC NHẬN</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
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
        // load data table
        document.getElementById("10").innerHTML = ((10000 / 100) * {{ $getpromotion }}).toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ",");
        document.getElementById("20").innerHTML = ((20000 / 100) * {{ $getpromotion }}).toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ",");
        document.getElementById("50").innerHTML = ((50000 / 100) * {{ $getpromotion }}).toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ",");
        document.getElementById("100").innerHTML = ((100000 / 100) * {{ $getpromotion }}).toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ",");
        document.getElementById("200").innerHTML = ((200000 / 100) * {{ $getpromotion }}).toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ",");
        document.getElementById("300").innerHTML = ((300000 / 100) * {{ $getpromotion }}).toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ",");
        document.getElementById("500").innerHTML = ((500000 / 100) * {{ $getpromotion }}).toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ",");
        document.getElementById("1000").innerHTML = ((1000000 / 100) * {{ $getpromotion }}).toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ",");
    </script>
@endsection
