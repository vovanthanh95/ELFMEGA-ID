@extends('clients.main2')
@section('content')
    @include('clients.userinfo')
    <div class="container">
        <div class="row">
            @include('clients.navbar')
            {{-- content --}}
            <div class="col-sm-8 col-md-8 col-lg-9 ">
                <div class="boxinfo">
                    <h3 class="title">{{ __('message.giftcode') }}</h3>
                    <div class="payment-body main_df_bt">
                            <form action="{{ route('post-gift-code') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <p for="v_email" class="col-sm-3 control-label">
                                            {{ __('message.giftcode') }}:</p>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="code" required autofocus autocomplete="off"
                                                name="code" type="text" value="{{ old('code') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <p for="v_email" class="col-sm-3 control-label">
                                            {{ __('message.characters') }}:</p>
                                        <div id="charList" class="col-sm-9">
                                            <select class="select-list form-control" name="rid" id="rid"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <p for="v_email" class="col-sm-3 control-label">
                                            {{ __('message.captcha') }}:</p>
                                        <div class="col-sm-5">
                                            <input id="captcha" class="form-control" required autocomplete="off"
                                                name="captcha" type="text" value="">
                                        </div>
                                        <div class="col-sm-4">
                                            <p id="refreshCaptcha">
                                                {!! captcha_img() !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row btsm">
                                    <div class="form-group">
                                        <input type="submit" name="giftcode" class="btn bt-click"
                                            value="{{ __('message.redeemgiftcode') }}">
                                    </div>
                                </div>
                            </form>
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
                    $(document).ready(function() {
                        loadRole();
                    });

                    function loadRole() {
                        $("#rid option").remove();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('ajax-show-role') }}",
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(result) {
                                if (result == null) {
                                    $("#charList").show();
                                    $("#rid").append("<option>{{ __('message.pleasechooseacharacter') }}</option>");
                                } else {
                                    $("#rid").append("<option>{{ __('message.pleasechooseacharacter') }}</option>");
                                    result.forEach(value => {
                                        $("#charList").show();
                                        $('#rid').append('<option value="' + value.playerId + '">' + value.name +
                                            '</option>');
                                    });
                                }
                            }
                        });
                    }
                </script>

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
            </div>
        </div>
        {{-- end content --}}
    </div>
    </div>
@endsection
