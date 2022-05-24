<div class="user-xu">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <p class="pull-right">
                    {{ __('message.serverid') }}: <span class="textbold">
                        @if (Auth::guard('client')->check())
                            {{ session('servername') }}
                        @endif
                    </span>
                    | Tài khoản: <span class="textbold">
                        @if (Auth::guard('client')->check())
                            {{ $username }}
                        @endif
                    </span>
                    | Số {{ config('custom.namemoney') }}: <span class="textbold">
                        @if (Auth::guard('client')->check())
                            {{ $money }}
                        @endif
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
