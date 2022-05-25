@extends('clients.main2')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2">
                <div class="dangky-home">
                    <div class="dangky-home-box">
                        <h4 class="title">{{ __('message.forgotpass') }}</h4>
                        <div class="dangky-home-content">
                            <p class="text-note text-left">Vui lòng điền vào tên đăng nhập hoặc email</p>
                            <form name="frmFGP" id="frmFGP" action="{{ route('post-forgot-pass') }}" method="POST">
                                @csrf
                                <div class="errors_alert">
                                </div>
                                <div class="form-group">
                                    <label for="fgp_account">{{ __('message.username') }}</label>
                                    <input type="text" class="form-control" id="fgp_account" name="username"
                                        placeholder="{{ __('message.username') }}" value="{{ old('username') }}">
                                    <span class="icons-icon-user icon-img"></span>
                                </div>
                                <div class="form-group">
                                    <label for="fgp_account">{{ __('message.email') }}</label>
                                    <input type="text" class="form-control" id="fgp_account" name="email"
                                        placeholder="{{ __('message.email') }}" value="{{ old('email') }}">
                                    <span class="icons-icon-user icon-img"></span>
                                </div>
                                <div class="form-group">
                                    <label for="fgp_captcha">nhập mã</label>
                                    <input type="text" class="form-control cancelW" id="fgp_captcha" name="captcha"
                                        placeholder="{{ __('message.captcha') }}">
                                    <span class="text-note2 text-hoa">*</span>
                                </div>
                                <div class="form-group">
                                    <div class="" id="refreshCaptcha">
                                        {!! captcha_img() !!}
                                    </div>
                                </div>

                                <div class="box-submit">
                                    <div class="">
                                        <button type="submit" class="btn bt-click">{{ __('message.recoveraccount') }}</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2">
            <p class="text-note text-center">Về <a href="{{route('login')}}">Trang chủ</a> để đăng nhập.
            </p>
        </div>
    </div>
    </div>
    {{-- reload captcha --}}
    <script>
		$(document).ready(function(){
            $('#refreshCaptcha').click(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: 'reloadCaptcha',
                    success: function(result){
                        $('#refreshCaptcha').html(result.captcha);
                    },
                });
            });
        });
	</script>
@endsection
