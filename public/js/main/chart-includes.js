
$(function() {

  'use strict';


  /*------------------------------------------
   Calling Functions
   ------------------------------------------*/

  $(document).ready(function () {
    balanceGraph();
  });


  /*------------------------------------------
   Defining Functions
   ------------------------------------------*/

  function balanceGraph() {
    if ($('#balance-graph').length > 0) {
      var ctx = document.getElementById('balance-graph').getContext('2d');
      var values = $("#balance-graph").attr("data-labels");
      var values_array = values.split(',');
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
          datasets: [{
            data: values_array,
            borderWidth: 4,
            lineTension: 0.1,
            fill: false,
            borderColor: '#48ed33',
            pointRadius: 0,
          }]
        },
        options: {
          legend: {
            display: false
          },
          title: {
            display: false,
          },
          scales: {
            xAxes: [{
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                display: false
              },

            }],
            yAxes: [{
              ticks: {
                display: false
              },
              gridLines: {
                display: true,
                drawBorder: false,
              }
            }]
          }
        }
      });
    }
    if ($('#balance-graph_right').length > 0) {
      var ctx_right = document.getElementById('balance-graph_right').getContext('2d');
      var myChart_right = new Chart(ctx_right, {
        type: 'line',
        data: {
          labels: [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
          datasets: [{
            data: [130, 140, 140, 145, 140, 140, 145, 135],
            borderWidth: 4,
            lineTension: 0.1,
            fill: false,
            borderColor: '#48ed33',
            pointRadius: 0,
          }]
        },
        options: {
          legend: {
            display: false
          },
          title: {
            display: false,
          },
          scales: {
            xAxes: [{
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                display: false
              },

            }],
            yAxes: [{
              ticks: {
                display: false
              },
              gridLines: {
                display: true,
                drawBorder: false,
              }
            }]
          }
        }
      });
    }
    if ($('#balance-graph_left').length > 0) {
      var ctx_left = document.getElementById('balance-graph_left').getContext('2d');
      var myChart_left = new Chart(ctx_left, {
        type: 'line',
        data: {
          labels: [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
          datasets: [{
            data: $('#balance-graph_left').data('values'),
            borderWidth: 4,
            lineTension: 0.1,
            fill: false,
            borderColor: '#48ed33',
            pointRadius: 0,
          }]
        },
        options: {
          legend: {
            display: false
          },
          title: {
            display: false,
          },
          scales: {
            xAxes: [{
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                display: false
              },

            }],
            yAxes: [{
              ticks: {
                display: false
              },
              gridLines: {
                display: true,
                drawBorder: false,
              }
            }]
          }
        }
      });
    }
  }
});