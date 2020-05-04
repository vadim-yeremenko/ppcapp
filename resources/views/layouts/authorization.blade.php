@include('partials.head')
<div class="wrapper">
    <div class="main auth-page">
        <header class="header">
            <div class="container-fluid d-flex">
                <a href="/" class="header-logo">
                    <span class="header-logo_title">CPC Logo</span>
                    <span class="header-logo_subtitle">Placeholder</span>
                </a>
                <div class="header-nav">
                    <ul>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                        <li><a href="{{route('about')}}">About</a></li>
                        @if (\Request::is('/'))
                            <li><a href="{{ route('register') }}" class="btn btn-blue btn-icon"><i class="icon-plus"></i><span>Sign Up</span></a></li>
                        @elseif(\Request::is('register'))
                            <li><a href="{{ route('login') }}" class="btn btn-blue btn-icon"><i class="icon-plus"></i><span>Sign In</span></a></li>
                        @else
                            <li><a href="{{ route('register') }}" class="btn btn-blue btn-icon"><i class="icon-plus"></i><span>Sign Up</span></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </header><!-- /.header -->

        <main class="content">
            <div class="container">
                @yield('content')
            </div><!--/.container-->
        </main><!-- /.content -->
    </div><!-- /.main -->
    <footer class="footer">
        <div class="container">
            <div class="footer_nav">
                <ul>
                    <li><a href="{{ route('faq') }}">FAQ/Help</a></li>
                    <li><a href="{{ route('sitemap') }}">Sitemap</a></li>
                    <li><a href="{{ route('security_page') }}">Security</a></li>
                    <li><a href="{{ route('terms-of-service') }}">Terms of condition</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </footer><!-- /.footer -->
</div><!-- /.wrapper -->
<div class="mobile-rotate"><div class="icon"><i class="mobile_rotate"></i><span>Please rotate your mobile device for proper experience.</span></div></div> <!-- Include JS -->
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="{{ URL::asset('js/main/Chart.min.js') }}"></script>
<script src="{{ URL::asset('js/main/jquery.formstyler.min.js') }}"></script>
<script src="{{ URL::asset('js/main/ion.rangeSlider.min.js') }}"></script>
<script src="{{ URL::asset('js/main/moment.min.js') }}"></script>
<script src="{{ URL::asset('js/main/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('js/main/charts.js') }}"></script>
<script src="{{ URL::asset('js/main/chart-includes.js') }}"></script>
<script src="{{ URL::asset('js/main/ajax-forms.js') }}"></script>
<script src="{{ URL::asset('js/main/main.js') }}"></script>
</body>
</html>