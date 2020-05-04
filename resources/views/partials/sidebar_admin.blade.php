<aside class="sidebar">
    @include('partials.notifications')
    <div class="sidebar_wrapper">
        <div class="notifications-counter">
            <span class="icon"><i class="icon-bell-white"></i></span>
            <span class="count">0</span>
        </div><!--/.sidebar-notification-->
        <div class="sidebar-main">
            <a href="/admin" class="sidebar-logo header-logo">
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
                    <li class="{{ (request()->is('admin/users')) ? 'active' : '' }}"><a href="{{ route('admin-users') }}">Users</a></li>
                    <li class="{{ (request()->is('admin/products')) ? 'active' : '' }}"><a href="{{ route('admin-products') }}">Products</a></li>
                    <li class="{{ (request()->is('admin/balance')) ? 'active' : '' }}"><a href="{{ route('admin-balance') }}">Balance</a></li>
                    <li class="{{ (request()->is('admin/cpc-rates')) ? 'active' : '' }}"><a href="{{ route('admin-cpc') }}">CPC Rates</a></li>
                    <li class="{{ (request()->is('admin/feed')) ? 'active' : '' }}"><a href="{{ route('admin-feed') }}">Feed</a></li>
                    <li class="{{ (request()->is('admin/edit')) ? 'active' : '' }}"><a href="{{ route('edit_pages') }}">Edit content</a></li>
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