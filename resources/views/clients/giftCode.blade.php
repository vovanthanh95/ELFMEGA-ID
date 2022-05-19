@extends('clients.main')
@section('content')
    <div class="payment-body main_df_bt">
        <section class="bg_title">
            <div class="box-title__text text-center">{{ __('message.giftcode') }}</div>
        </section>
        <div class="other-function-container">
            <div class="loginmodal-container">
                <div class="conten_login">
                    <div class="bk-form-login">
                        <form action="{{ route('post-gift-code') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <input id="code" required autofocus autocomplete="off" name="code" type="text" value="{{old('code')}}">
                                    <label for="code" alt="{{ __('message.giftcode') }}"
                                        placeholder="{{ __('message.giftcode') }}"></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div id="charList">
                                        <select class="select-list" name="rid" id="rid"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <input style="width:50%" id="captcha" required
                                        placeholder="{{ __('message.captcha') }}" autocomplete="off" name="captcha"
                                        type="text" value="">
                                    <label id="refreshCaptcha">
                                        {!! captcha_img() !!}
                                    </label>
                                    <label for="captcha" alt="{{ __('message.captcha') }}"
                                        placeholder="{{ __('message.captcha') }}"></label>
                                </div>
                            </div>

                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                        <div class="row">
                                            <input type="submit" name="giftcode"
                                                class="login loginmodal-submit pull-left col-md-12"
                                                value="{{ __('message.redeemgiftcode') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input name="return_url" type="hidden" id="return_url" value="">
                        </form>
                    </div>
                </div>
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
                        $("#rid").append("<option>{{__('message.pleasechooseacharacter')}}</option>");
                    } else {
                        $("#rid").append("<option>{{__('message.pleasechooseacharacter')}}</option>");
                        result.forEach(value => {
                            $("#charList").show();
                            $('#rid').append('<option value="' + value.playerId + '">' + value.name + '</option>');
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
@endsection
