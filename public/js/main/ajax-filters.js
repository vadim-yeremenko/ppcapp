$(document).ready(function() {



  $('#results-users').on('click', '.accept-user-btn', function(e) {
    e.preventDefault();
    var action = $(this).data('action');
    var id = $(this).data('user');
    var item = $(this);
    var data = {
      'action': 'accept',
      'id': id
    };
    $.ajax({
      url: action,
      type: 'POST',
      data: data,
      success: function(data) {
        item.parents('.table-row-requests').fadeOut('fast');
      }
    });
    return false;
  });

  $('#results-users').on('click', '.decline-user-btn', function(e) {
    var id = $(this).data('user');
    $('#decline-user-form').find('input[name="user"]').val(id);
    $.fancybox.open($('#decline-user-popup'));
  });

  $('.close-popup').on('click', function (e) {
    e.preventDefault();
    $.fancybox.close();
  });

  $('#decline-user-form').on('submit', function(e){
    e.preventDefault();
    var action = $(this).attr('action');
    var id = $(this).find('input[name="user"]').val();
    var message = $(this).find('#user_decline_message').val();
    var item = $(this);
    var data = {
      'action': 'decline',
      'id': id,
      'message': message
    };
    $.ajax({
      url: action,
      type: 'POST',
      data: data,
      success: function(data) {
        $('#results-users').find('.table-row-requests[data-user="'+data.id+'"]').fadeOut('fast');
        $.fancybox.close();
      }
    });
  });

  $('#filter-popup-campaign').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var action = $(this).attr('action');
    ajax_filter_campaigns(data, action);
  });

  $('#users-filter').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var action = $(this).attr('action');
    ajax_filter_users(data, action)
  });

  function ajax_filter_users(data, action) {
    $.ajax({
      url: action,
      type: 'POST',
      data: data,
      success: function(data) {
        console.log(data);
      }
    });
  }

  function ajax_filter_campaigns(data, action){
    $.ajax({
      url: action,
      type:'POST',
      data: data,
      beforeSend: function() {
        $('#filter-body').find('.filter-inner').fadeOut('fast').html();
      },
      success: function(data) {
        if(data.error){
          
        } else {
          $('#filter-body').find('.filter-inner').fadeIn('fast').html(data.html);
        }
      }
    });
  }

  $('*[data-usersajax]').on('click', function(e) {
    e.preventDefault();
    $('*[data-usersajax]').removeClass('active');
    $(this).addClass('active');
    var type = $(this).attr('data-usersajax');
    var action = $(this).attr('href');
    var data;
    if(type === 'active'){
      data = {'type': 'active'};
      ajax_users_type(action, data);
      $('.more-filters').show('fast');
    } else {
      data = {'type': 'nonactive'};
      ajax_users_type(action, data);
      $('.more-filters').hide('fast');
    }
  });

  function ajax_users_type(action, data){
    $.ajax({
      url: action,
      type:'POST',
      data: data,
      beforeSend: function() {
        $('#results-users').fadeOut('fast').html();
      },
      success: function(data) {
        if(data.error){

        } else {
          $('#results-users').fadeIn('fast').html(data.html);
        }
      }
    });
  }

  /*
  * =========================================
  *
  * ========= Pagination and filter =========
  *
  * =========================================
  * */


  $('body').on('click', '.filter-start', function(){
    $('.filter-form').trigger('submit');
    console.log('ok');
  });

  $('body').on('submit', '.filter-form', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var btn = $(this).find('.btn');
    var more_btn = $(this).data('action');
    var id = $(this).attr('id');
    var data = $(this).serialize() + '&action=' + $(this).data('action');
    $('*[data-filter="'+id+'"]').data('pagination', 2);
    var result = 'ajax-result';
    if(!!$(this).data('result'))
    {
      result = $(this).data('result');
    }
    pagination_ajax(url, result, data, btn, '', more_btn);
    $('body').find('.filters-popup.show').removeClass('show');
    $('body').find('.btn-filters.opened').removeClass('opened');
  });

  $('body').on('click', '*[data-pagination]', function(e) {
    e.preventDefault();
    var filter = $(this).data('filter'); // ID attr from form with filter
    var pagination = $(this).data('pagination'); // page
    var limit = $(this).data('limit');
    var url = $(this).attr('href');
    var action = $(this).data('action');
    var btn = $(this);
    var form_data = $('#'+filter).serialize();
    var result = 'ajax-result';
    if(!!$(this).data('result'))
    {
      result = $(this).data('result');
    }
    var data = form_data + '&pagination=' + pagination + '&action=' + action;
    pagination_ajax(url, result, data, btn, pagination);
  });

  function pagination_ajax(url, result = 'ajax-result', data, btn, pagination, more_btn) {
    $.ajax({
      url: url,
      type: 'POST',
      data: data,
      beforeSend: function () {
        //btn.addClass('on-loading');
        if($('#' + result).parents('.table').find('.ajax_loader').length > 0){
          $('#' + result).parents('.table').find('.ajax_loader').removeClass('hide');
        } else {
          $('#' + result).parents('.table').append('<div class="ajax_loader"></div>');
        }

      },
      success: function (data) {
        //btn.removeClass('on-loading');
        console.log(data);
        console.log(result);
        if (data.error) {

        } else {
          if(data.redirect){
            window.location.replace(data.redirect);
          }

          if(data.pagination_end){
            $('.table-footer-btn').addClass('fadeout');
          } else {
            $('.table-footer-btn').removeClass('fadeout');
          }
          btn.data('pagination', data.pagination);
          $('#' + result).fadeIn('fast').html(data.html);
          if(data.more_btn_url){
            $('body').find('#'+more_btn).attr('href', data.more_btn_url);
          }
        }
      },
      complete: function() {
        $('#' + result).parents('.table').find('.ajax_loader').addClass('hide');
      }
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