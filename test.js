$('#modal-signup').on('show', function(e) {
  if(!data) return e.preventDefault();
  alert("modalsignup shown");
});
function commandtip()
{
  $("span#commandtip").innerHTML="My First External JavaScript";
  $("span#commandtip").show();
  alert("hello");
}
$(document).ready(function(){});

/*
//表單送出只更新網頁部分內容
$('form').submit(function() {
  $('span#commandtip').show();
  $('span#commandtip').fadeOut(5000);

  $.ajax({
  data: $(this).serialize(),
  type: $(this).attr('method'),
  //contentType:attr("enctype","multipart/form-data"),
  url: $(this).attr('action'),
  success: function(response) {
    $('div#left').html(response);
    $('div#content').html(response);
  }
});

return false;
//loaddivbody(,,$("#edit_no"),val);
});
*/

