@extends('clients.main')
@section('content')
    <div class="accountPage__layout">
        <div class="updatePasswordPage__layout">
            <ul class="nav nav-tabs custom-tabs d-flex w-100 py-10" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link show bt-active" id="bt-active" onclick="onChangeTab('history-active')" data-tab="my_noti">
                        LỊCH SỬ HOẠT ĐỘNG
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="bt-topup" onclick="onChangeTab('history-top-up')" data-tab="event_noti">
                        LỊCH SỬ NẠP
                    </a>
                </li>
            </ul>
            <div class="history-active dip-show" id="history-active">
                <div class="row">
                    <div class="row center shadow">
                        <div id="data" class="data-history"></div>
                        <ul class="pagination paginationjs paginationjs-small paginationjs-theme-yellow pagi" id="pagination">
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function() {


                            inquire(1);

                            function inquire(page) {
                                var hdBeginDate = "";
                                var hdEndDate = "";
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('ajax-history') }}",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "hdBeginDate": hdBeginDate,
                                        "hdEndDate": hdEndDate,
                                        "page": page,
                                    },
                                    cache: false,
                                    success: function(data) {
                                        $("#data").html(data.table);
                                        totalpage = data.totalpage;
                                        totalitem = data.totalitem;
                                        loadPage(totalpage, totalitem, page);
                                    }
                                });
                            }

                            function loadPage(totalpage, totalitem, page) {
                                $('#pagination').pagination({
                                    dataSource: function(done) {
                                        var result = [];
                                        for (var i = 1; i < totalitem; i++) {
                                            result.push(i);
                                        }
                                        done(result);
                                    },
                                    pageSize: 5,
                                    pageNumber: page,
                                    afterPageOnClick: function(event, pageNumber) {
                                        console.log(pageNumber);
                                        inquire(pageNumber);
                                    },
                                    afterNextOnClick: function(event, pageNumber) {
                                        console.log(pageNumber);
                                        inquire(pageNumber);
                                    },
                                    afterPreviousOnClick: function(event, pageNumber) {
                                        console.log(pageNumber);
                                        inquire(pageNumber);
                                    }
                                });
                            }

                        });
                    </script>
                </div>
            </div>

            <div class="history-topup dip-hide" id="history-top-up">
                <div class="row">
                    <div class="other-function-content-data shadow">
                        @if ($data->count() > 0)
                            @foreach ($data as $value)
                                @php
                                    $status = '';
                                @endphp
                                @if ($value['type'] == 'tmt')
                                    @if ($value['status'] == 1)
                                        @php
                                            $status = '<font color="#3079ed">' . __('message.success') . '</font>';
                                        @endphp
                                    @elseif ($value['status'] == 2)
                                        @php
                                            $status = '<font color="red">' . __('message.invalidcardcode') . '</font>';
                                        @endphp
                                    @elseif ($value['status'] == 3)

                                    @elseif ($value['status'] == 4)
                                        @php
                                            $status = '<font color="red">' . __('message.invalidcardcode') . '</font>';
                                        @endphp
                                    @elseif ($value['status'] == 5)

                                    @elseif ($value['status'] == 0)
                                        @php
                                            $status = '<font color="blue">' . __('message.waitingforprogressing') . '</font>';
                                        @endphp
                                    @else
                                        @php
                                            $status = '<font color="red">' . __('message.theserverisempty') . '</font>';
                                        @endphp
                                    @endif
                                @else
                                    @if ($value['status'] == 1)
                                        @php
                                            $status = '<font color="#f13d56">' . __('message.success') . '</font>';
                                        @endphp
                                    @elseif ($value['status'] == 2)
                                        @php
                                            $status = '<font color="red">' . __('message.invalidcardcode') . '</font>';
                                        @endphp
                                    @elseif ($value['status'] == 3)
                                        @php
                                            $status = '<font color="red">' . __('message.errorofloadingcardvalue') . '</font>';
                                        @endphp
                                    @elseif ($value['status'] == 4)
                                        @php
                                            $status = '<font color="red">' . __('message.theserverisundermaintenance') . '</font>';
                                        @endphp
                                    @elseif ($value['status'] == 5)
                                        @php
                                            $status = '<font color="red">' . __('message.cardused') . '</font>';
                                        @endphp
                                    @elseif ($value['status'] == 0)
                                        @php
                                            $status = '<font color="blue">' . __('message.waitingforprogressing') . '</font>';
                                        @endphp
                                    @else
                                        @php
                                            $status = '<font color="red">' . __('message.theserverisempty') . '</font>';
                                        @endphp
                                    @endif
                                @endif

                                @if ($value['type'] != 'MOMO')
                                    @php
                                        $stringType = '<p>PIN: <span class="blue">' . preg_replace("/^.+(?=(.{5}$))/", '********', $value['pin']) . '</span></p>';
                                    @endphp
                                @else
                                    @php
                                        $stringType = '';
                                    @endphp
                                @endif

                                <div class="list-data-content txn row data-history">
                                    <div class="col-6 order-left-content">
                                        <p><span class="blue">{{ $value['type'] }}</span></p>
                                        {!! $stringType !!}
                                        <p>{{ date('H:i d/m/y', strtotime($value['time'])) }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-right">
                                            {!! $status !!}
                                        </p>
                                        <p class="text-right ">{{ number_format($value['amount']) }}
                                            {{ config('custom.namemoney') }}</p>
                                    </div>
                                    {{-- <div class="clearfix"></div> --}}
                                </div>
                            @endforeach
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function onChangeTab(tab) {
            if (tab == "history-active") {
                $("#bt-topup").removeClass('bt-active');
                $("#bt-active").addClass('bt-active');
                var x = document.getElementById("history-active");
                var y = document.getElementById("history-top-up");
                x.style.display = "block";
                y.style.display = "none";
            }
            if (tab == "history-top-up") {
                $("#bt-topup").addClass('bt-active');
                $("#bt-active").removeClass('bt-active');
                var x = document.getElementById("history-active");
                var y = document.getElementById("history-top-up");
                x.style.display = "none";
                y.style.display = "block";
            }
        }
    </script>
@endsection
