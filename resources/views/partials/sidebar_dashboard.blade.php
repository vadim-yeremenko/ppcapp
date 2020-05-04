<aside class="sidebar">
    @include('partials.notifications')
    <div class="sidebar_wrapper">
        <div class="notifications-counter">
            <span class="icon"><i class="icon-bell-white"></i></span>
            <span class="count">0</span>
        </div><!--/.sidebar-notification-->
        <div class="sidebar-main">
            <a href="/" class="sidebar-logo header-logo">
                <span class="header-logo_title">CPC Logo</span>
                <span class="header-logo_subtitle">Placeholder</span>
            </a>
            <div class="sidebar-nav_mobile">
                <a href="#" class="mobile-nav-btn">
                    <span class="hamburger hamburger--slider">
                        <span class="hamburger-box"></span>
                        <span class="hamburger-inner"></span>
                    </span>
                </a>
            </div><div class="sidebar-nav">
                <ul>
                    <li class="{{ (request()->is('dashboard/add-campaign')) ? 'active' : '' }}"><a href="{{ route('add-campaign') }}">Create new ad</a></li>
                    <li class="{{ (request()->is('dashboard/campaigns')) ? 'active' : '' }}"><a href="{{ route('campaign') }}">Campaigns</a></li>
                    <li class="{{ (request()->is('dashboard/calendar')) ? 'active' : '' }}"><a href="{{ route('calendar') }}">Calendar</a></li>
                    <li class="{{ (request()->is('dashboard/balance')) ? 'active' : '' }}"><a href="{{ route('balance') }}">Balance</a></li>
                    <li class="{{ (request()->is('dashboard/account')) ? 'active' : '' }}"><a href="{{ route('account') }}">Account</a></li>
                </ul>
            </div>
        </div><!--/.sidebar-main-->
        <div class="sidebar-footer">
            <div class="user-meta">
                <div class="user-meta_avatar">

                    @if(empty(Auth::user()->avatar))
                        <img src="{{url('img/avatar-placeholder.png')}}" alt="{{ Auth::user()->name }}">
                    @else
                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                    @endif
                </div>
            </div>
            <div class="logout">
                <a href="{{ url('/logout') }}" class="logout_link">
                    <span>Log out</span>
                    <span class="icon">
                        <i class="icon-exit-dark"></i>
                    </span>
                </a>
            </div>
        </div><!--/.sidebar-footer-->
    </div><!--/.sidebar_wrapper-->
</aside><!--/.sidebar-->