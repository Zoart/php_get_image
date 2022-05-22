$(document).ready(()=>{
  $('#btn').click(() => {
    sendAjaxForm('result_form', 'ajax_form', './action_ajax_form.php');
    return false;
  })
});

function sendAjaxForm(result_form, ajax_form, url) {
  $.ajax({
    url: url,
    type: 'POST',
    dataType: 'html', 
    data: $('#'+ajax_form).serialize(),
    success: function(response) {
      result = $.parseJSON(response);
      
      $('#result_form').html(result); //What post
      // alert(response);
    },
    error: function(response) {
      $('#result_form').html('Failed')
    }
  })
}

// for (let i = 0; i < result.length; i++)
      //   {
          // $('#result_form').html(result[i]); //What post
        // }