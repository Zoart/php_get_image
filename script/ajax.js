$(document).ready(()=>{
  $('#btn').click(() => {
    sendAjaxForm('result__form', 'ajax_form', './action_ajax_form.php');
    return false;
  })
});

function sendAjaxForm(result__form, ajax_form, url) {
  $.ajax({
    url: url,
    type: 'POST',
    dataType: 'html', 
    data: $('#'+ajax_form).serialize(),
    success: function(response) {
      result = $.parseJSON(response);
      $('#result__form').html(result);
      //  alert(response);
    },
    error: function(response) {
      $('#result__form').html('Failed')
    }
  })
}

