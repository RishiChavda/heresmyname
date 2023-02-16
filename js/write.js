$(document).ready(function(){
$('#status').click(function(){$('#status').slideUp('fast');});
$('#error').click(function(){$('#error').slideUp('fast');});
$('#openatts').click(function(){$('#storyattributes').slideToggle('fast');});
$('#blurbtoggle').click(function(){$('#blurbbox').slideToggle('fast');});
$('#storytoggle').click(function(){$('#storybox').slideToggle('fast');});
$('#refstoggle').click(function(){$('#refsbox').slideToggle('fast');});

$(window).resize(function(){if($(window).width()>900){$('#storyattributes').slideDown('fast');}});

$('#openmore').click(function(){$('#moreopt').slideToggle('fast');});
$('#openblurb').click(function(){$('#blurbbox').slideToggle('fast');});

$(".storyin").css("font-family", "'"+$("#storyfont").val()+"'");
$("#storyfont").change(function(){$(".storyin").css("font-family", "'"+$("#storyfont").val()+"'");});

});

function hmnbk(){ window.history.back();}

function closeEditorWarning(){return 'Are you sure you want to leave without saving?'}
window.onbeforeunload = closeEditorWarning
