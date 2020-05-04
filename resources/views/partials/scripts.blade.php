    <div class="mobile-rotate"><div class="icon"><i class="mobile_rotate"></i><span>Please rotate your mobile device for proper experience.</span></div></div> <!-- Include JS -->

    <!-- Scripts including -->
    <script src="{{ URL::asset('js/main/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/main/Chart.min.js') }}"></script>
    <script src="{{ URL::asset('js/main/jquery.formstyler.min.js') }}"></script>
    <script src="{{ URL::asset('js/main/jquery.fancybox.min.js') }}"></script>
    <script src="{{ URL::asset('js/main/jquery.mask.min.js') }}"></script>
    <script src="{{ URL::asset('js/main/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ URL::asset('js/main/moment.min.js') }}"></script>
    <script src="{{ URL::asset('js/main/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('js/main/charts.js') }}"></script>
    <script src="{{ URL::asset('js/main/chart-includes.js') }}"></script>
    <script src="{{ URL::asset('js/main/ajax-forms.js') }}"></script>
    <script src="{{ URL::asset('js/main/ajax-pagination.js') }}"></script>
    <script src="{{ URL::asset('js/main/ajax-filters.js') }}"></script>
    <script src="{{ URL::asset('js/main/jquery.daterangepicker.min.js') }}"></script>

    {{--    Here is condition for show only customers scripts or only for admin panel --}}
    @role('administrator')
    <script src="{{ URL::asset('js/main/ajax-admin.js') }}"></script>
    @else

    @endrole

    <!-- Include JS file. -->
    <script src="//cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>


    <script src="{{ URL::asset('js/main/main.js') }}"></script>
</body>
</html>