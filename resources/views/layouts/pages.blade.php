@include('partials.head')

<div class="dashboard-page @if (Auth::check()) left-sidebar @else without-sidebar @endif">
    @if (Auth::check())
        @role('administrator')
            @include('partials.sidebar_admin')
        @else
            @include('partials.sidebar_dashboard')
        @endrole
    @endif


    <main class="mainbar">
        <div class="content">

            @yield('content')

            @include('partials.footer')
        </div><!-- /.content -->
    </main><!--/.mainbar-->

</div><!-- /.dashboard-page -->

@include('partials.scripts')