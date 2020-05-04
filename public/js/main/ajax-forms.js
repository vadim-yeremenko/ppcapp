$(document).ready(function() {
  /*
  * X-CSRF-TOKEN
  * */
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.edit-account-btn').each(function(item) {
    $(this).on('click', function (e) {
      e.preventDefault();
      var form = $(this).parents('form');
      var value = $(this).parents('.input-box_wrap').find('.input-field').val();
      var field = $(this).parents('.input-box_wrap').find('.input-field').attr('name');
      var _token = $(this).parents('form').find('input[name="_token"]').val();
      data = {
        _token: _token,
        field: field,
        value: value
      };
      var action = $(this).parents('form').attr('action');
      ajaxAccountEditByField(data, action);
    });
  });

  $('.edit-avatar-btn').each(function(item) {
    $(this).on('click', function (e) {
      e.preventDefault();
      var form = $(this).parents('form');
      var form_data = new FormData(form[0]);
      form_data.append('field', 'avatar');
      //console.log(form_data);
      var action = $(this).parents('form').attr('action');
      if($('#avatar-image').val()){
        ajaxAccountEditAvatar(form_data, action);
      }
    });
  });

  /**
   *
   * Account edit with AJAX
   *
   * */

  function ajaxAccountEditByField(data, action){
    $('.btn-edit').addClass('loading');
    $.ajax({
      url: action,
      type: 'POST',
      data: data,
      success: function(data) {
        console.log(data);
        $('.btn-edit').removeClass('loading');
        if(data.errors) {
          var errors_array = data.errors;
          $.each(errors_array, function(key, value) {
            checkRequired(key, value);
          });
          scrollToMistake();
        } else {
          $('#content').html(data.html);
        }
      }
    });
  }

  $('body').on('click', '.btn-change-password', function(e) {
    e.preventDefault();
    var data = $('#account-password-form').serialize() + '&field=change_password';
    var action = $('#account-password-form').attr('action');
    $('.btn-edit').addClass('loading');

    $.ajax({
      url: action,
      type: 'POST',
      data: data,
      success: function(data) {
        console.log(data);
        $('.btn-edit').removeClass('loading');
        if(data.errors) {
          var errors_array = data.errors;
          $.each(errors_array, function(key, value) {
            checkRequired(key, value);
          });
          scrollToMistake();
        } else {
          $('#content').html(data.html);
        }
      }
    });
  });

  /**
   *
   * Account-avatar edit with AJAX
   *
   * */

  function ajaxAccountEditAvatar(data, action){
    $('.edit-avatar-btn').addClass('loading');
    $.ajax({
      url: action,
      type: 'POST',
      data: data,
      contentType: false,
      processData: false,
      success: function(data) {
        console.log(data);
        $('.edit-avatar-btn').removeClass('loading');
        if(data.errors) {

          var errors_array = data.errors;
          $.each(errors_array, function(key, value) {
            checkRequired(key, value);
          });
          scrollToMistake();
        } else {
          $('#content').html(data.html);
        }
      }
    });
  }

  $('#account-form').on('submit', function(e) {
    e.preventDefault();


  });

  /*
  *
  * Ajax function for adding new products
  * */
  $('.btn-add-product').click(function(e) {
    e.preventDefault();
    var form = $(this).parents('form');
    var action = form.attr('action');

    var mincpc = $(this).parents('form').find('[name="mincpc"]').val().substring(1).split('.').join("");
    var maxcpc = $(this).parents('form').find('[name="maxcpc"]').val().substring(1).split('.').join("");
    var singlecpc = $(this).parents('form').find('[name="singlecpc"]').val().substring(1).split('.').join("");

    var form_data = new FormData(form[0]);
    form_data.set('maxcpc', maxcpc);
    form_data.set('mincpc', mincpc);
    form_data.set('singlecpc', singlecpc);
    $.ajax({
      url: action,
      type: 'POST',
      data: form_data,
      contentType: false,
      processData: false,
      success: function(data) {
        console.log(data);
        if(data.errors) {
          var errors_array = data.errors;
          $.each(errors_array, function(key, value) {
            checkRequired(key, value);
          });
          scrollToMistake();
        } else {
          $('#content').html(data.html);
        }
      }
    });
  });

  /*
  *
  * Change list with subproducts related on product was choosed
  * */
  $('#product').on('change', function(){
    var value = $(this).val;
    var form = $(this).parents('form');
    var action = form.attr('action');
    $.ajax({
      url: action,
      type:'POST',
      data: form.serialize() + '&product_updated=1',
      success: function(data) {

        if($(data.subproducts).length > 0){
          $('.input-box-sub').slideDown('fast');
          var $sub_product = $('#sub_product');
          $('#sub_product').empty();
          $sub_product.append('<option value=""></option>');
          for (var i = 0; i < data.subproducts.length; i++) {
            $sub_product.append('<option id=' + data.subproducts[i].id + ' value=' + data.subproducts[i].id + '>' + data.subproducts[i].name + '</option>');
          }
          $('select#sub_product').trigger('refresh');
        } else {
          $('.input-box-sub').slideUp('fast');
        }
      }
    });
  });

  /*
  *
  * Change CPC bid depends of product/subproducts settings
  * */
  $('.change-cpc-ajax').on('change', function(){
    var product_type;
    $(this).parents('.input-box').removeClass('required-error');
    if($(this).attr('name') == 'product'){
      product_type = 'product';
    } else {
      product_type = 'subproduct';
    }

    var form = $(this).parents('form');
    var action = form.attr('action');
    $.ajax({
      url: action,
      type:'POST',
      data: form.serialize() + '&bid_updated=1&product_type='+product_type,
      success: function(data) {
        console.log(data);
        if(data.bid.fixcpc){

          /* For fixed cpc */
          $('input.fixed-cpc').attr('disabled', false);
          $('input.range-cpc').attr('disabled', true);
          $fixed_cpc = data.bid.fixcpc;
          $('.cpc-bid-range-ajax').slideUp('fast');
          $('.cpc-bid-fixed-ajax').slideDown('fast');
          $('input[name="cpc"]').val($fixed_cpc);

        } else {

          /* For range cpc */
          $('input.fixed-cpc').attr('disabled', true);
          $('input.range-cpc').attr('disabled', false);
          $min_cpc = data.bid.mincpc;
          $max_cpc = data.bid.maxcpc;
          //$default_cpc = (($min_cpc + $max_cpc) / 2);
          $default_cpc = data.bid.mincpc;

          $('.cpc-bid-range-ajax').slideDown('fast');
          $('.cpc-bid-fixed-ajax').slideUp('fast');
          $('input[name="cpc"]').val($default_cpc);
          var range_slider_item = $('input[name="cpc-range-slider"]');
          range_slider = $(range_slider_item).data("ionRangeSlider");
          range_slider.update({
            type: 'single',
            min: $min_cpc,
            max: $max_cpc,
            to: data.bid.maxcpc
          });
          range_slider.reset();
        }
      }
    });
  });

  /*
  *
  * Add campaign function
  * */
  $('.btn-add-campaign').click(function(e) {
    e.preventDefault();
    var form = $(this).parents('form');
    var action = form.attr('action');
    /* For range cpc */
    var cpc = $(this).parents('form').find('[name="cpc"]').val();
    var data = form.serializeArray();

    data.find(item => item.name === 'cpc').value = cpc;
    console.log(data);
    $.ajax({
      url: action,
      type:'POST',
      data: data,
      success: function(data) {
        console.log(data);
        if(data.errors) {
          var errors_array = data.errors;
          $.each(errors_array, function(key, value) {
            checkRequired(key, value);
          });
          scrollToMistake();
        } else {
          $('#content').html(data.html)
        }
      }
    });
  });

  /*
  *
  * Registration form
  * */
  $(".btn-registration").click(function(e){
    e.preventDefault();

    var _token = $("input[name='_token']").val();
    var name = $("input[name='name']").val();
    var email = $("input[name='email']").val();
    var organization = $("input[name='organization']").val();
    var password = $("input[name='password']").val();
    var password_confirmation = $("input[name='password_confirmation']").val();
    var role = $("input[name='role']").val();
    var action = $(this).parents('form').attr('action');

    $.ajax({
      url: action,
      type:'POST',
      data: {_token:_token, name:name, email:email, organization:organization, role: role, password: password, password_confirmation: password_confirmation},
      success: function(data) {
        if(data.errors) {
          var errors_array = data.errors;
          $.each(errors_array, function(key, value) {
            checkRequired(key, value);
          });
          scrollToMistake();
        } else {
          $('.main').removeClass('auth-page');
          $('#content').html(data.html)
        }
      }
    });
  });

  /*
  * Check required fields function
  *
  * */

  function checkRequired(field, value) {
    if(field){
      switch(field) {
        case 'password':
          $('input[name="'+field+'"]').parents('.input-field-required').removeClass('required-ok').addClass('required-error');
          $('input[name="password_confirmation"]').parents('.input-field-required').removeClass('required-ok').addClass('required-error');
        break;
        case 'image':
          $('input[name="'+field+'"]').parents('.input-field-required').removeClass('required-ok').addClass('required-error');
        break;

        case 'product':
          $('select[name="product"]').parents('.input-box').removeClass('required-ok').addClass('required-error');
        break;

        default:
          $('.input-field[name="'+field+'"]').parents('.input-field-required').removeClass('required-ok').addClass('required-error');
        break;
      }
      switch(value[0]) {
        case 'The email has already been taken.':
          console.log('email');
          $('input[name="email"]').parents('.input-field-required').append('<span class="input-field-note">The email has already been taken.</span>');
        break;

        default:

        break;
      }
    } else {
      $('input[name="'+field+'"]').parents('.input-field-required').removeClass('required-error').addClass('required-ok');
      $('select[name="'+field+'"]').parents('.input-box').removeClass('required-error').addClass('required-ok');
    }
  }

  /*
  *
  * Scroll to mistakenly required input
  * */

  function scrollToMistake() {
    let body = $('body');
    let element = body.find('.required-error').not('.required-ok').first();
    let element_top = element.offset().top - 100;
    $('html, body').animate({ scrollTop: element_top }, 500);
    element.find('.input-field').focus();
  }

  /*
  * Disable campaign button
  *
  * */

  $('.deactivate-campaign').on('click', function(){
    var id = $(this).data('campaign');
    var title = $(this).data('title');
    $('#disable-campaign').find('.campaign-title').text(title);
    $('#disable-campaign').find('.btn-disable-campaign').attr('data-campaign', id);
  });

  $('.btn-disable-campaign').on('click', function(e) {
    e.preventDefault();
    var action = $(this).data('action');
    var id = $(this).data('campaign');
    var data = {
      id: id
    };
    $.ajax({
      url: action,
      type:'POST',
      data: data,
      success: function(data) {
        if(!data.success) {
          console.log(data);
        } else {
          $.fancybox.close();
          $('#content').html(data.html)
        }
      }
    });
  });

  /*
  * Edit forms
  * */

  $('#faq-edit-title').on('submit', function(e){
    e.preventDefault();
    var action = $(this).attr('action');
    var data = $(this).serialize();
    ajax_edit_faq(action, data);
  });

  $('#faq-add').on('submit', function(e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var data = $(this).serialize();
    ajax_edit_faq(action, data);
  });

  $('.faq-edit').on('submit', function(e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var data = $(this).serialize();
    ajax_edit_faq(action, data);
  });

  $('.faq-delete').on('click', function(e) {
    e.preventDefault();
    var action = $(this).parents('form').attr('action');
    var data = $(this).parents('form').serialize() + '&delete=1';

    ajax_edit_faq(action, data, 'del', $(this));
  });

  function ajax_edit_faq(action, data, func, element)
  {
    $.ajax({
      url: action,
      type:'POST',
      data: data,
      success: function (data) {
        switch(func) {
          case 'del':
            var id = element.data('id');
            $('*[data-faq="' + id + '"]').hide('fast');
            break;
          default:

            break;
        }
        console.log(data);
      }
    });
  }

  $('#faq_search').on('submit', function(e){
    e.preventDefault();
    var action = $(this).attr('action');
    var data = $(this).serialize();
    $.ajax({
      url: action,
      type: 'POST',
      data: data,
      success: function (data) {
        console.log(data);
      }
    });
    return false;
  });
});