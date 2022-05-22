@extends('clients.main')
@section('content')
    <script src="{{ asset('assets/js/jquery.paginate.js') }}" type="text/javascript"></script>
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">{{ __('message.historypayment') }}</div>
        </section>
        <div class="other-function-container">
            <div class="other-function-content-data shadow">
                <div id="data"></div>
                <ul class="pagination" id="pagination"></ul>
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
                beforeSend: function() {
                    $("#loading").css('display', 'block');
                },
                complete: function() {
                    $("#loading").css('display', 'none');
                },
                success: function(data) {
                    console.log(data);
                    $("#data").html(data.table);
                    totalpage = data.totalpage;
                    totalitem = data.totalitem;
                    loadPage(totalpage, totalitem, page);
                }
            });
        }

        function loadPage(totalpage, totalitem, page) {
            $('#pagination').pagination({
                items: totalpage,
                itemOnPage: totalitem,
                currentPage: page,
                cssStyle: '',
                prevText: '<span aria-hidden="true">&laquo;</span>',
                nextText: '<span aria-hidden="true">&raquo;</span>',
                onInit: function() {
                    // fire first page loading
                },
                onPageClick: function(page, evt) {
                    // some code
                    inquire(page);
                }
            });
        }
    </script>
@endsection
