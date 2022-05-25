@extends('clients.main2')
@section('content')
    @include('clients.userinfo')
    <div class="container">
        <div class="row">
            @include('clients.navbar')
            {{-- content --}}
            <div class="col-sm-8 col-md-8 col-lg-9 ">
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
            </div>
            {{-- end content --}}
        </div>
    </div>
@endsection
