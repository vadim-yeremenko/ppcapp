$(function() {

  'use strict';


  /*------------------------------------------
   Calling Functions
   ------------------------------------------*/

  $(document).ready(function () {
    statsChartBar();
    //showChartsBar();
    /*
 * Function filter for button
 * */
    // $(document).on('click', '.filter-start', function (e) {
    //
    // });

    $('.stats-chart_head').on('change', 'select, input', function() {
      console.log($(this));
      var form = $('#filter-stats-form');
      var action = form.attr('action');
      var data = {
        'dates': form.find('#filter-stats-date-range').val(),
        'campaign': form.find('#campaign').val()
      };
      ajax_filter_stats(data, action);
    });
    /*
    * Function filter campaign changing
    * */
    $('#campaign').on('change', function (e) {

      var form = $('#filter-stats-form');
      var action = form.attr('action');
      var data = {
        'dates': form.find('#filter-stats-date-range').val(),
        'campaign': form.find('#campaign').val()
      };
      ajax_filter_stats(data, action);
    });

    function ajax_filter_stats(data, action)
    {
      $.ajax({
        url: action,
        type: 'POST',
        data: data,
        success: function(data) {
          $('#chart-bar').html(data.html);
          statsChartBar();
        }
      });
    }
  });


  /*------------------------------------------
   Defining Functions
   ------------------------------------------*/

  function statsChartBar() {
    var chart_bar = $('.chart-bar');
    var wrap = $('.chart-bar_wrap');
    var item = $('.chart-bar-item');
    var chart_vert_labels = $('.chart-bar_vert');
    var clicks_array = [];
    var rows_array = [];
    var rows_array_final = [];
    wrap.each(function() {
      /* Sorting array with clicks*/
      item.each(function() {
        clicks_array.push($(this).data('clicks'));
      });
      /* Sorting array with clicks from min to max*/
      clicks_array.sort(function(a, b){
        return parseInt(a) - parseInt(b);
      });
      /* Rounding array with clicks for creating grid (x-axis)*/
      $.each(clicks_array, function (index, value) {
        rows_array.push(Math.round(value / 50) * 50);
      });
      /* Correct array with rounded values for creating lines with 50, like 100..150..200..250*/
      rows_array = unique(rows_array); // only unique values
      var total = rows_array.length;
      $.each(rows_array, function (index, value) {
        var next = rows_array[($.inArray(index, rows_array) + 1) % rows_array.length];
        if(index == 0){
          if(value > 150){
            rows_array_final.push(value - 150);
            rows_array_final.push(value - 100);
            rows_array_final.push(value - 50);
          }
          if(value == 150){
            rows_array_final.push(value - 150);
            rows_array_final.push(value - 100);
            rows_array_final.push(value - 50);
          }
          if(value == 100){
            rows_array_final.push(value - 100);
            rows_array_final.push(value - 50);
          }
          if(value == 50){
            rows_array_final.push(value - 50);
          }
          rows_array_final.push(value);
          if(next-value === 50) {
            rows_array_final.push(value);
          } else {
            rows_array_final.push(value + 50);
          }
        } else {
          if(next-value === 50) {
            rows_array_final.push(value + 50);
          } else {
            rows_array_final.push(value);
          }
        }
        if (index === total - 1) {
          rows_array_final.push(value + 50);
        }
      });
    });

    // Append horisontal lines
    var row_height = 32; // one row height is 32 px by design
    var line_coefficient = row_height / 50;
    var wrapper_height = rows_array_final.length * row_height; // full height for box
    chart_bar.css({'height': wrapper_height}); // add css height for box
    wrap.css({'height': wrapper_height}); // add css height for wrap
    // add numeric values on the left side
    chart_vert_labels.html('');
    $.each(rows_array_final, function (index, value) {
      chart_vert_labels.append('<span>' + value + '</span>')
    });
    // add horizontal lines
    $('.chart-bar-lines').html('');
    $.each(rows_array_final, function (index, value) {
      $('.chart-bar-lines').append('<span data-position="'+index+'" data-value="' + value + '" style="bottom:' + index * row_height + 'px"></span>');
    });

    // Bar displaying
    var items_count = wrap.find('.chart-bar-item').length;
    $('.chart-bar-item').css('opacity', '1');
    var items_count = wrap.find('.chart-bar-item').length;
    wrap.find('.chart-bar-item').each(function (index, value) {
      var item_click = $(this).data('clicks');
      var rounded_click = Math.round(item_click / 50)*50;
      var line = $('.chart-bar-lines').find('*[data-value="' + rounded_click + '"]');
      var line_bottom = line.data('position') * row_height;
      var additional_height = (item_click - rounded_click) * line_coefficient;
      $(this).find('.chart-bar-item_bar').css({'height': line_bottom+additional_height +'px'});
      $(this).find('.chart-bar-item_bar span').css({'opacity': '1'});
      $(this).find('.chart-bar-item_counter').css({'opacity': '1'});
      var new_height = line_bottom+additional_height;
      if(new_height < 70){
        $(this).find('.chart-bar-item_bar').addClass('item_bar_fix');
        $(this).find('.chart-bar-item_bar span').css({'bottom': new_height+30 + 'px'});
      } else {
        $(this).find('.chart-bar-item_bar').removeClass('item_bar_fix');
      }
      // additional line for join top of bars
      if(index != items_count-1){
        var bar_current_height = line_bottom+additional_height;

        var next_item_click = $(this).next().data('clicks');
        var next_rounded_click = Math.round(next_item_click / 50)*50;
        var next_line = $('.chart-bar-lines').find('*[data-value="' + next_rounded_click + '"]');
        var next_line_bottom = next_line.data('position') * row_height;
        var next_additional_height = (next_item_click - next_rounded_click) * line_coefficient;
        var next_height = next_line_bottom + next_additional_height;

        //var rectangle = 360 - 180 / Math.PI * Math.atan2(next_height, bar_current_height);
       // console.log(rectangle);
        //$(this).append('.join-line').css({'transform': 'rotate(' +rectangle+ 'deg)'});
      }
    });


  }

  /* Additional functions */


  function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
      if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
  }


  /* Old/legacy function for Chart.js*/
  function showChartsBar() {
    var ctx = document.getElementById("chart-bar").getContext('2d');
    var purple_orange_gradient = ctx.createLinearGradient(0, 0, 0, 600);
    purple_orange_gradient.addColorStop(0, '#00a7db');
    purple_orange_gradient.addColorStop(1, 'rgba(0, 167, 219, 0.4)');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["06/24", "06/25", "06/26", "06/27", "06/28", "06/29", "06/30"],
        datasets: [{
          data: [523, 423, 411, 499, 422, 399, 511],
          backgroundColor: purple_orange_gradient,
          hoverBackgroundColor: purple_orange_gradient,
          barPercentage: 0.5,
          barThickness: 6,
          maxBarThickness: 8,
          minBarLength: 2,
          gridLines: {
            offsetGridLines: true
          }
        }]
      },
      options: {
        responsive: true,
        hover: {
          animationDuration: 0
        },
        animation: {
          duration: 1,
          onComplete: function () {
            var chartInstance = this.chart,
              ctx = chartInstance.ctx;

            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';

            this.data.datasets.forEach(function (dataset, i) {
              var meta = chartInstance.controller.getDatasetMeta(i);
              meta.data.forEach(function (bar, index) {
                var data = dataset.data[index];
                ctx.fillText(data, bar._model.x, bar._model.y - 5);
              });
            });
          }
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: false
        },
        scales: {
          yAxes: [{
            display: true,
            gridLines: {
              display : true
            },
            ticks: {
              display: true,
              beginAtZero:true
            }
          }],
          xAxes: [{
            barThickness : 40,
            gridLines: {
              display : false
            },
            ticks: {
              beginAtZero: true
            }
          }]
        },
      }
    });
  }

});