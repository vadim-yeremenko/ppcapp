$(function () {

  'use strict';

  /*
  * Here is all ajax functions for admin panel
  *
  * */

  $(document).ready(function () {
    ajax_tabs_call();
  });

  /*Functions*/

  // Function called when we click to button on admin's dashboard for switching products and users panel
  function ajax_tabs_call()
  {
    $('body').on('click', '.btn-ajax', function(e){
      e.preventDefault();

      var url = $(this).attr('data-url');
      var action = $(this).attr('data-ajax');
      var data = {action: action};
      var result = 'ajax_table_result';
      ajax_run(url, data, '', result);

    })
  }

  // mainly ajax funciton
  function ajax_run(url, data, btn, result) {

    $.ajax({
      url: url,
      type:'POST',
      data: data,
      success: function (data) {
        console.log(data);
        $('#ajax_table_result').html(data.html);
        $("select").styler();
        rangeSliderIncluding();
        //showFiltersPopup();
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

});