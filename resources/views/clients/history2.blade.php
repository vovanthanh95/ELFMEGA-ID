@extends('clients.main2')
@section('content')
    @include('clients.userinfo')
    <div class="container">
        <div class="row">
            @include('clients.navbar')
            {{-- content --}}
            <div class="col-sm-8 col-md-8 col-lg-9 ">
                <div class="row boxinfo center">
                    <h3 class="title">{{ __('message.history') }}</h3>
                            <div class="row col-sm-6 center">
                                <div id="data"></div>
                                <ul class="pagination paginationjs paginationjs-small paginationjs-theme-yellow" id="pagination"></ul>
                                <div class="clearfix"></div>
                            </div>
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
                                className: 'paginationjs-theme-blue paginationjs-small',
                                afterPageOnClick: function(event, pageNumber) {
                                    console.log(pageNumber);
                                    inquire(pageNumber);
                                },
                                afterNextOnClick:function(event, pageNumber){
                                    console.log(pageNumber);
                                    inquire(pageNumber);
                                }
                                // items: totalpage,
                                // itemOnPage: totalitem,
                                // currentPage: page,
                                // cssStyle: '',
                                // prevText: '<span aria-hidden="true">&laquo;</span>',
                                // nextText: '<span aria-hidden="true">&raquo;</span>',
                                // onInit: function() {
                                //     // fire first page loading
                                // },
                                // onPageClick: function(page, evt) {
                                //     // some code
                                //     inquire(page);
                                // }
                            });
                        }

                    });
                </script>
                {{-- end content --}}
            </div>
        </div>
    @endsection
