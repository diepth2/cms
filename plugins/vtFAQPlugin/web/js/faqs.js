
$(document).ready(function() {
$('#answer').hide();
$('a.question').click(function() {
var id = $(this).attr('id');
var idAnswer = id.replace('question','answer');

  $("div[id^='answer']").hide();
  $('#'+idAnswer).show();

return false;
});
 
}); 