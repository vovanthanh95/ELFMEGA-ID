<div class="col-sm-4 col-md-4 col-lg-3">
    <div class="nav-left">
        <a href="#" class="close hidden-lg hidden-md hidden-sm"><img
                src="{{ asset('assets/images2/close.png?t=1.00') }}"></a>
        <ul class="nav-left-list">
            <li class="active">
                <a href="{{route('account')}}">
                    <span class="icons-icon-user-sub icon"></span>
                    <span>Thông tin tài khoản</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('update-account')}}">
                    <span class="icons-icon-upload icon"></span>
                    <span>Cập nhật thông tin</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('top-up')}}">
                    <span class="icons-icon-password-sub icon"></span>
                    <span>{{__('message.topup')}}</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('change-pass')}}">
                    <span class="icons-icon-password-sub icon"></span>
                    <span>{{__('message.changepass')}}</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('change-email')}}">
                    <span class="icons-icon-email icon"></span>
                    <span>{{__('message.changeemail')}}</span>
                </a>
            </li>

            <li class="">
                <a href="{{route('change-phone')}}">
                    <span class="icons-icon-phone icon"></span>
                    <span>{{__('message.changephone')}}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
