@extends('clients.main')
@section('content')
    <div class="accountPage__layout">
        <div class="updatePasswordPage__layout">
            <div class="rowTitle">
                <span>{{ trans('message.titleaccumulat') }}</span>
            </div>
            @if ($data['isaccumulat'])
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="input-row info-accumulat">
                            <ul>
                                <li>- Tổng tích nạp hiện tại: <span class="text-hightlight"
                                        id="money">{{ number_format(Auth::guard('client')->user()->accumulat) }}</span>
                                    VNĐ</li>
                                <li>- Sự kiện tích nạp nhận giftcode diễn ra: từ <span
                                        class="text-hightlight">{{ $data['time_start'] }}</span> đến
                                    <span class="text-hightlight">{{ $data['time_end'] }}</span>
                                </li>
                                <li>- Điểm tích lũy nạp được cộng dồn theo thời gian sự kiện!</li>
                                <li>- Mỗi tài khoản sẽ nhận 1 mốc tích lũy 1 lần duy nhất trong thời gian sự kiện tích nạp
                                </li>
                                <li>- Sau khi hết thời gian sự kiện, hệ thống sẽ tự động reset điểm tích nạp!</li>
                                <li>- <span class="text-hightlight">Lưu ý:</span> Tích nạp sẽ không tính tiền khuyến mãi nạp
                                    thẻ</li>
                            </ul>
                        </div>
                        <div class="input-row">
                            <select class="select-list form-control my-3 topup-selection" name="card_value"
                                id="select-accumulat" style="height: 40px;">
                                <option value="">{{ trans('message.Textselectaccumulat') }}</option>
                                @foreach ($data['accumulat'] as $value)
                                    <option value="{{ $value['id'] }}">{{ number_format($value['money']) }}</option>
                                @endforeach>
                            </select>
                        </div>
                        <div class="row" style="margin-bottom: 20px" id="info-content">
                            <div class="gift-info"></div>
                            <table class="table-card" id="tb-award" style="display: none">
                                <thead>
                                    <tr class="tb-head">
                                        <td width="20%" class="tb-head">STT</span></td>
                                        <td width="40%"class="tb-head">Tên vật phẩm</td>
                                        <td width="40%"class="tb-head">Số lượng</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="btn-confirm-row">
                            <button class="btn-custom" id="btn-get-giftcode" type="submit"
                                style="display: none">{{ trans('message.btngetgiftcode') }}</button>
                        </div>
                    </div>

                </div>
            @else
                <div class="input-row end-time">
                    <ul>
                        <li>Sự kiện nạp tích lũy chưa diễn ra.</li>
                        <li>Vui lòng quay lại sau khi có sự kiện mới.</li>
                    </ul>
                </div>
            @endif

        </div>
    </div>

    <script>
        function saochep() {
            var copyText = document.getElementById("giftcode");
            var textArea = document.createElement("textarea");
            textArea.value = copyText.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy");
            textArea.remove();
            swal({
                text: "{{ trans('message.alerthascopy') }}: " + textArea.value,
                type: "success"
            });
        }

        $('#select-accumulat').on('change', function() {
            $.ajax({
                type: "POST",
                url: "{{ route('get-award-accumulat') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": $('#select-accumulat').val(),
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (typeof data['award'] === 'object') {
                        if (data['award'].length == 0) {
                            $('#tb-award').hide();
                            $('#btn-get-giftcode').hide();
                        } else {
                            $('#tb-award').show();
                            $('#btn-get-giftcode').show();
                            $('#info-content div').text("");
                            $('#tb-award tbody').empty();
                            for (var i = 0; i < data['award'].length; i++) {
                                $('#tb-award tbody').append("<tr><td>" + (i + 1) + "</td><td>" + data[
                                        'award'][i]
                                    ['name'] + "</td><td>" + data['award'][i]['num'] + "</td></tr>");
                            }
                        }
                    } else {
                        $('#tb-award').hide();
                        $('#btn-get-giftcode').hide();
                        $('#info-content div').text("");
                    }


                    if (typeof data['giftcode'] === 'undefined') {
                        $('#info-content div').html(data['msg']);
                        $('#btn-get-giftcode').show();
                    } else {
                        $('#btn-get-giftcode').hide();
                        $('#info-content div').html(
                            '<span>' +
                            'GiftCode của bạn là: <span class="text-hightlight" id="giftcode">' +
                            data["giftcode"] +
                            '</span></span>' +
                            '<button class="btn-copy btn-custom btn-custom-mb" onclick="saochep()">' +
                            '{{ trans('message.btncopy') }}' +
                            '</button>'
                        );
                    }

                    if (typeof data['status'] != 'undefined') {
                        $('#btn-get-giftcode').hide();
                    }

                },
            });
        });


        $('#btn-get-giftcode').on('click', function() {
            Swal.fire({
                text: "Bạn có muốn nhận giftcode gói này không!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'HỦY'
            }).then((result) => {
                if (result.value) {
                    console.log(result);
                    $('#btn-get-giftcode').hide();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('get-giftcode-accumulat') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": $('#select-accumulat').val(),
                        },
                        cache: false,
                        dataType: 'json',
                        success: function(data) {
                            if (data['giftcode'] != "") {
                                $('#info-content div').html(
                                    '<span>' +
                                    'GiftCode của bạn là: <span class="text-hightlight" id="giftcode">' +
                                    data["giftcode"] +
                                    '</span></span>' +
                                    '<button class="btn-copy btn-custom btn-custom-mb" onclick="saochep()">' +
                                    '{{ trans('message.btncopy') }}' +
                                    '</button>'
                                );
                            }
                        },
                    });
                }
            })
        });
    </script>
@endsection
