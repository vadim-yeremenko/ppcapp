$(document).ready(function() {
  // $('*[data-pagination]').on('click', function(e) {
  //   e.preventDefault();
  //   var pagination = $(this).data('pagination');
  //   var limit = $(this).data('limit');
  //   var offset = $(this).data('offset');
  //   var action = $(this).attr('href');
  //   var step = $(this).data('step');
  //   var btn = $(this);
  //   var data = {
  //     'pagination': pagination,
  //     'offset': offset,
  //     'limit': limit
  //   };
  //   pagination_ajax(action, data, btn, limit, offset, step);
  // });
  //
  // function pagination_ajax(action, data, btn, limit, offset, step){
  //   $.ajax({
  //     url: action,
  //     type:'POST',
  //     data: data,
  //     beforeSend: function() {
  //       btn.addClass('on-loading');
  //     },
  //     success: function(data) {
  //       btn.removeClass('on-loading');
  //       if(data.error){
  //
  //       } else {
  //         console.log(data);
  //         btn.attr('data-limit', limit + step);
  //         btn.attr('data-offset', limit - step);
  //         $('#results-users').fadeIn('fast').html(data.html);
  //       }
  //     }
  //   });
  // }

  // function get_pagination(action, data, btn, limit, offset, step) {
  //   $.get(
  //     action,
  //     data,
  //     get_pagination_success
  //   );
  // }
  //
  // function get_pagination_success(data) {
  //   if(data.error){
  //     console.log('Get ajax error');
  //   } else {
  //     //btn.attr('data-limit', data.limit);
  //     console.log(data);
  //     $('#results-users').fadeIn('fast').html(data.html);
  //   }
  // }

});