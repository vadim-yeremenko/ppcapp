@include('partials.head')

<div class="dashboard-page left-sidebar">

    @include('partials.sidebar_admin')

    <main class="mainbar">
        <div class="content" id="content">

            @yield('content')

            @include('partials.footer')
        </div><!-- /.content -->
    </main><!--/.mainbar-->

</div><!-- /.dashboard-page -->

@include('partials.scripts')