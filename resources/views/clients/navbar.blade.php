<div class="col-sm-4 col-md-4 col-lg-3">
    <div class="nav-left">
        <a href="#" class="close hidden-lg hidden-md hidden-sm"><img
                src="{{ asset('assets/images2/close.png?t=1.00') }}"></a>
        <ul class="nav-left-list">
            <li class="">
                <a href="{{ route('account') }}">
                    <i class="fa-regular fa-user"></i>
                    <span>Thông tin tài khoản</span>
                </a>
            </li>

            <li class="">
                <a href="{{ route('gift-code') }}">
                    <i class="fa-solid fa-gift"></i>
                    <span>{{ __('message.giftcode') }}</span>
                </a>
            </li>

            <div id="accordion">
                <li class="card">
                    <div class="card-header">
                        <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa-solid fa-money-bill-trend-up"></i>
                            <span>{{ __('message.topup') }}</span>
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <a href="{{ route('top-up-vn') }}">
                                <i class="fa-regular fa-credit-card-front"></i>
                                <span>NẠP THẺ</span>
                            </a>

                            <a href="{{ route('top-up-mo-mo') }}">
                                <i class="fa-regular fa-credit-card-front"></i>
                                <span>MOMO</span>
                            </a>
                        </div>
                    </div>

                </li>
                <li class="card">
                    <li class="card">
                        <div class="card-header">
                            <a classs="topbt" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2" style="border-bottom: 1px solid;">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <span>{{ __('message.history') }}</span>
                            </a>
                        </div>
                        <div id="collapse2" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <a href="{{ route('history') }}">
                                    <span>LỊCH SỬ HOẠT ĐỘNG</span>
                                </a>

                                <a href="{{ route('top-up') }}">
                                    <span>{{ __('message.historypayment') }}</span>
                                </a>
                            </div>
                        </div>
                </li>
            </div>

            <li class="">
                <a href="{{ route('change-pass') }}">
                    <i class="fa-solid fa-key"></i>
                    <span>{{ __('message.changepass') }}</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('change-email') }}">
                    <i class="fa-regular fa-envelope"></i>
                    <span>{{ __('message.changeemail') }}</span>
                </a>
            </li>

            <li class="">
                <a href="{{ route('change-phone') }}">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                    <span>{{ __('message.changephone') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
