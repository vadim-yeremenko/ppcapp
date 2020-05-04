$(function () {

  'use strict';


  /*------------------------------------------
   Calling Functions
   ------------------------------------------*/

  $(document).ready(function () {
    notificationsBar();
    formstylerIncluding();
    datePickerIncluding();
    rangeSliderIncluding();
    showFiltersPopup();
    hideCharts();
    maskInputDate();
    btnCharge();
    avatarInput();
    radioSubproduct();
    checkInputRequired();
    popupFancybox();
    messagePopup();
    scrollTo();
    mobileMenu();
    changeSubproduct();
    radioBidType();
    radioBidTypeChange();
    openFileWindow();
    openImageOnAfterChoose();
    date_picker_new();
  });


  /*------------------------------------------
   Defining Functions
   ------------------------------------------*/

  function mobileMenu() {
    $('.mobile-nav-btn').on('click', function (e) {
      e.preventDefault();
      $('.hamburger').toggleClass('is-active');
      $('.sidebar-nav').toggleClass('show');
    });
  }

  function messagePopup() {
    $('.close').on('click', function () {
      $('.alert-popup').slideUp('fast');
    })
  }

  function popupFancybox() {
    $('.close-popup').on('click', function (e) {
      e.preventDefault();
      $.fancybox.close();
    });
  }

  function radioSubproduct() {
    $('.subproducts-radio').on('click', function () {
      $(this).parents('.input-box_input').find('.subproducts-radio').removeClass('active');
      $(this).toggleClass('active');
    });
  }

  function radioBidType() {
    $('.bid-type-radio').on('click', function () {
      $(this).parents('.input-box_input').find('.bid-type-radio').removeClass('active');
      $(this).toggleClass('active');
    });
  }

  function radioBidTypeChange() {
    $('input[name="cpc_type"]').on('change', function (e) {
      if ($(this).val() == 'range') {
        $('#cpc_singular').slideUp('fast');
        $('#cpc_range').slideDown('fast');
      } else {
        $('#cpc_range').slideUp('fast');
        $('#cpc_singular').slideDown('fast');
      }
    });
  }

  function avatarInput() {
    $('.avatar-field').styler();
  }

  function btnCharge() {
    $('.btn-charge').on('click', function () {
      $('.btn-charge').removeClass('active');
      $('.charge-footer').hide('fast');
      $(this).toggleClass('active');
      if ($(this).val() == 'credit_card') {

        $('#charge-card').toggleClass('charge-show');
      } else {

        $('#charge-card').removeClass('charge-show');
      }
      if ($(this).val() == 'paypal') {

        $('#charge-paypal').toggleClass('charge-show');
      } else {

        $('#charge-paypal').removeClass('charge-show');
      }
      if ($(this).val() == 'wire_transfer') {

        $('#charge-wire').toggleClass('charge-show');
      } else {

        $('#charge-wire').removeClass('charge-show');
      }
    });
  }

  function maskInputDate() {
    if ($('.card-date').length > 0) {
      $('input.card-date').mask('00/00');
      $('input.card-cvv').mask('000');
      $('input.card-number').mask('0000 0000 0000 0000');
    }
    if ($('input.cpc-bid').length > 0) {
      $('input.cpc-bid').mask('0.00');
    }
    //$('.money-mask').mask("#.##0,00");
  }

  function hideCharts() {
    $('.chart-hide-btn').on('click', function (e) {
      e.preventDefault();
      $(this).parents('.stats-chart').toggleClass('hidden');
      if ($(this).parents('.stats-chart').hasClass('hidden')) {
        $(this).find('span').text('Show stats');
      } else {
        $(this).find('span').text('Hide stats');
      }
    });
  }

  function rangeSliderIncluding() {

    // Single
    $('.input-slider').each(function () {
      var min = $(this).data('min');
      var max = $(this).data('max');
      var prefix = $(this).data('prefix');
      var step = $(this).data('step');
      var current = $(this).data('current');
      var current_slider = $(this);
      $(this).ionRangeSlider({
        grid: false,
        min: min,
        max: max,
        from: current,
        step: step,
        prefix: prefix,
        onStart: function (data) {
          current_slider.parents('.input-box').find('.input-field').val(data.from);
        },
        onFinish: function (data) {
          current_slider.parents('.input-box').find('.input-field-required').removeClass('required-error').addClass('required-ok');
        }
      });
      $(this).on('change', function () {
        var $inp = $(this);
        var from = $inp.prop('value');
        $(this).parents('.input-box').find('.input-field').val(from);
        $(this).parents('.input-box').find('.input-field-required').removeClass('required-error').addClass('required-ok');
      });
    });
// Range
    $('.range-integer').each(function () {
      var min = $(this).data('min');
      var max = $(this).data('max');
      var current = $(this).data('current');
      var current_slider = $(this);
      var prefix = $(this).data('prefix');
      var step = $(this).data('step');
      $(this).ionRangeSlider({
        type: "double",
        grid: false,
        min: min,
        max: max,
        from: current,
        to: 800,
        step: step,
        prefix: prefix,
        onStart: function (data) {
          current_slider.parents('.input-box').find('.input-field').val(data.from);
        },
        onFinish: function (data) {
          current_slider.parents('.input-box').find('.input-field-required').removeClass('required-error').addClass('required-ok');
        }
      });
    });
    // Range
    $('.input-slider-range').each(function () {
      var min = $(this).data('min');
      var max = $(this).data('max');
      var current = $(this).data('current');
      var current_slider = $(this);
      $(this).ionRangeSlider({
        type: "double",
        grid: false,
        min: min,
        max: max,
        from: current,
        to: 10000,
        step: 0.01,
        prefix: '$',
        onStart: function (data) {
          current_slider.parents('.input-box').find('.input-field').val(data.from);
        },
        onFinish: function (data) {
          current_slider.parents('.input-box').find('.input-field-required').removeClass('required-error').addClass('required-ok');
        }
      });
    });
  }

  function datePickerIncluding() {
    var oneWeekAgo = new Date();
    oneWeekAgo.setDate(oneWeekAgo.getDate() - 6);
    var today = new Date();
    today.setDate(today.getDate());
    $('.datepicker').daterangepicker({
      startDate: oneWeekAgo,
      endDate: today,
      linkedCalendars: false,
      locale: {
        'format': 'MM/DD/YY',
        'applyLabel': 'Filter dates',
      },
      applyButtonClasses: 'btn-blue filter-start',
    });

    $('.datepicker-single').daterangepicker({
      linkedCalendars: false,
      singleDatePicker: true,
      locale: {
        'format': 'MM/DD/YY',
        'applyLabel': 'Filter dates',
      },
      applyButtonClasses: 'btn-blue',
    });

    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    $('.datepicker-choose').daterangepicker({
      linkedCalendars: false,
      singleDatePicker: true,
      minDate: new Date(),
      locale: {
        'format': 'MM/DD/YY',
        'applyLabel': 'Filter dates',
      },
      applyButtonClasses: 'btn-blue',
    });

    $('.datepicker-calendar').daterangepicker({
      parentEl: '.filter-calendar',
      linkedCalendars: false,
      autoApply: true,
      locale: {
        'format': 'MM/DD/YY',
        'applyLabel': 'Filter dates',
      },
      applyButtonClasses: 'btn-blue',
    });

    $('input.datepicker-calendar').focus();

    $('.datepicker-single').on('show.daterangepicker', function (ev, picker) {
      $(this).parents('.input-date-range').addClass('calendar-opened');
    });
    $('.datepicker').on('show.daterangepicker', function (ev, picker) {
      $(this).parents('.input-date-range').addClass('calendar-opened');
    });
    $('.datepicker-choose').on('show.daterangepicker', function (ev, picker) {
      $(this).parents('.input-date-range').addClass('calendar-opened');
    });

    $('.datepicker-single').on('hide.daterangepicker', function (ev, picker) {
      $(this).parents('.input-date-range').removeClass('calendar-opened');
    });
    $('.datepicker').on('hide.daterangepicker', function () {
      $(this).parents('.input-date-range').removeClass('calendar-opened');

    });
    $('.datepicker-choose').on('hide.daterangepicker', function () {
      $(this).parents('.input-date-range').removeClass('calendar-opened');
    });
  }

  function formstylerIncluding() {
    $('.select-styled').styler();
  }

  function notificationsBar() {
    var link = $('.notifications-counter');
    link.on('click', function () {
      $(this).toggleClass('hover');
      $('.notifications').toggleClass('opened');
      $('body').toggleClass('notifications-opened');
    });
  }

  function showFiltersPopup() {
    $('body').on('click', '.filter-popup-open', function (e) {
      e.preventDefault();
      if($(this).hasClass('opened')){
        $(this).removeClass('opened');
        $(this).parents('.more-filters').find('.filters-popup').removeClass('show');
        $('#content').css('min-height', 'auto');
      } else {
        $(this).addClass('opened');
        var height = $(this).parents('.more-filters').find('.filters-popup').height();
        var offset = $(this).parents('.more-filters').find('.filters-popup').offset();
        var offset_top = offset.top;
        $(this).parents('.more-filters').find('.filters-popup').addClass('show');
        $('#content').css('min-height', height + offset_top + 30);
      }
    });
  }

  function checkInputRequired() {
    $('.input-field-required').each(function () {
      $(this).find('input').on('change', function () {
        var rate = $(this).val();
        if (rate.length > 2) {
          $(this).parents('.input-field-required').addClass('required-ok');
        } else {
          $(this).parents('.input-field-required').removeClass('required-ok');
        }
      });
      $(this).find('textarea').on('change', function () {
        var rate = $(this).val();
        if (rate.length > 2) {
          $(this).parents('.input-field-required').addClass('required-ok');
        } else {
          $(this).parents('.input-field-required').removeClass('required-ok');
        }
      });
    });
  }

  function changeSubproduct() {
    $('input[name="is_sub"]').on('change', function (e) {
      if ($(this).val() == 'yes') {
        $('.input-box-sub').slideDown('fast');
      } else {
        $('.input-box-sub').slideUp('fast');
      }
    });
  }

  function scrollTo() {
    $('.scroll-to').on('click', function (e) {
      e.preventDefault();
    });
  }

  function openFileWindow() {
    $('.choose-img-btn').on('click', function(e) {
      e.preventDefault();
      $(this).parents('.input-box').find('.avatar-field').trigger('click');
    });
  }

  function openImageOnAfterChoose() {
    $(".avatar-field").change(function(e) {
      readURL(this);
    });
  }

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('.avatar-field-img').attr('src', e.target.result).fadeIn('fast');
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  function date_picker_new() {
    if($('.date-picker-calendar').length){
      var oneWeekAgo = new Date();
      oneWeekAgo.setDate(oneWeekAgo.getDate() - 6);
      var today = new Date();
      $('.date-picker-calendar').dateRangePicker({
        format: 'MM/DD/YY',
        alwaysOpen:true,
        singleMonth: true,
        container: '.filter-calendar',
        separator: ' - ',
      });
    }
  }

  $('.date-filter').on('change', function (e) {
    $('.date-picker-calendar').val($(this).val());
  });

  // $('.tabs').each(function(tab){
  //   var tabs_main = $(this);
  //   var height = tabs_main.find('.show').children('.tabs-content_wrapper').height();
  //   $('.tabs-content-wrap').css('height', height);
  //
  //   $('.tabs-switcher').on('click', 'a.btn-link', function(e){
  //     e.preventDefault();
  //     tabs_main.find('.tabs-content').removeClass('show');
  //     var item = $(this).attr('href');
  //     var height = tabs_main.find('*[data-content='+item+']').children('.tabs-content_wrapper').height();
  //     $('.tabs-content-wrap').css('height', height);
  //     tabs_main.find('*[data-content='+item+']').addClass('show');
  //   });
  // });

  /* FAQ editing / add more*/
  $(document).on('click', '.add-faq-item', function(e){
    e.preventDefault();
    var html = $('#input-box-faq-more').html();
    $('.input-box-faq-add').after(html);
  });
  /* Remove */
  $(document).on('click', '.faq-remove', function(e){
    e.preventDefault();
    $(this).parents('.input-box-faq').find('input[name="action"]').val('remove');
    $(this).parents('.input-box-faq').find('input[name="action"]').val('remove');
  });

  /* ======================
  * Editor
  * */

  $('.btn-avatar-upload').on('click', function(e){
    e.preventDefault();
    $(this).parents('.input-box_wrap').find('.avatar-field').trigger('click');
  });

  if($('#editor').length){
    ClassicEditor
      .create( document.querySelector( '#editor' ) )
      .catch( error => {
        console.error( error );
      } );
  }

  $('.campaign-start-date').on('change', function(){
    var value = $(this).val();
    var date = new Date(value);
    var j = new Array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    var m = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    var sub = 'th';
    switch (date.getDate()) {
      case 1:
        sub = 'st';
        break;
      case 2:
        sub = 'nd';
        break;
      case 3:
        sub = 'rd';
        break;
      default:
        sub = 'th';
        break;
    }

    $('#start_date').text(j[date.getDay() - 1] + ', '+ date.getDate() +  '\'' + sub + ' of ' + m[date.getMonth()] + ' ' +  date.getFullYear());

  });

  $(document).mouseup(function (e){
    var div = $(".notifications.opened");
    if (!div.is(e.target)
      && div.has(e.target).length === 0) {
      div.removeClass('opened');
      $('body').removeClass('notifications-opened');
      $('.notifications-counter').removeClass('hover');
    }
  });

  $(document).mouseup(function (e){
    var div = $(".more-filters");
    if (!div.is(e.target)
      && div.has(e.target).length === 0) {
      $('.filters-popup').removeClass('show');
      $('.filter-popup-open.opened').removeClass('opened');
    }
  });

  $('.filters-popup form').on('click', '.btn', function(e){
    $('.filters-popup.show').removeClass('show');
    $('.filter-popup-open.opened').removeClass('opened');
  });
});