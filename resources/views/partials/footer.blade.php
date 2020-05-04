<div class="mainbar-footer">
    <div class="logout">
        <a href="#" class="logout_link">
            <span>Log out</span>
            <span class="icon">
                <i class="icon-exit-dark"></i>
            </span>
        </a>
    </div>
    <div class="footer_nav">
        <ul>
            @if (!Auth::check())
                <li><a href="{{ route('login') }}">Login</a></li>
            @endif
            <li><a href="{{ route('faq') }}">FAQ/Help</a></li>
            <li><a href="{{ route('sitemap') }}">Sitemap</a></li>
            <li><a href="{{ route('security_page') }}">Security</a></li>
            <li><a href="{{ route('terms-of-service') }}">Terms of condition</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </div>
</div><!-- /.mainbar-footer -->