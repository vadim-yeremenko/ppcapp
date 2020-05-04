@include('partials.head')

<div class="dashboard-page left-sidebar">

    @include('partials.sidebar_dashboard')

    <main class="mainbar">
        <div class="content" id="content">

            @yield('content')

            @include('partials.footer')

        </div>
    </main>
</div><!-- /.dashboard-page -->

@include('partials.scripts')