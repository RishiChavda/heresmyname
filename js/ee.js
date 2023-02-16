$(document).ready(function(){
$('#topbar #servmsg').click(function(){$('#topbar #servmsg').slideUp('fast');});
$('#button').click(function(){$('#usermenu').slideToggle('fast');});
$('#button').dblclick(function(){$('#usermenu').slideUp('fast');});

$('#main').click(function(){$('#usermenu').slideUp('fast');});
$('#wide').click(function(){$('#usermenu').slideUp('fast');});
$('#read').click(function(){$('#usermenu').slideUp('fast');});
$('.saved').click(function(){$(this).slideUp('fast');});
$('.error').click(function(){$(this).slideUp('fast');});
setTimeout(function(){$('.saved').slideUp('fast');}, 10000);
setTimeout(function(){$('.error').slideUp('fast');}, 15000);

$('#sideget').click(function(){$('#mainsection').css('display', 'none'); $('#sidesection').css('display', 'block'); $('#sidesection').css('width', 'auto');});
$('#backget').click(function(){$('#sidesection').css('display', 'none'); $('#mainsection').css('display', 'block'); $('#mainsection').css('width', 'auto');});

$('#terms').click(function(){$('#error').slideUp('fast');});
$('#getpeople').click(function(){$('#stories').hide('fast'); $('#users').show('fast');});
$('#getstories').click(function(){$('#users').hide('fast'); $('#stories').show('fast');});
$(window).resize(function(){if($(window).width()>800){$('#users').show('fast'); $('#stories').show('fast');}});
$('#getmobilemenu').click(function(){$('#mobilemenu').slideToggle('fast');});
$(window).resize(function(){if($(window).width()>800){$('#mobilemenu').slideUp('fast');}});
$('.deleteconf').click(function(){return confirm('Are you sure you want to do this? This process cannot be undone.');});

$('.openshare').click(function(){$('#newshare').slideDown('fast'); var postid = $(this).attr("id"); $('#ptpid').attr('value', postid);});

$('#themecolour').change(function(){
var themecolour = "#" + $('#themecolour').val();
$('#topbar table').css('border-bottom', '1px solid '+themecolour);
$('#topbar #logo').css('background-color', themecolour);
$('#topbar #menu .link').css('color', themecolour);
$('#topbar #search #terms').css('color', themecolour);
$('#topbar #search #terms').css('border', '1px solid '+themecolour);
$('#topbar #search #terms').css('border-top', 'none');
$('#topbar #search #terms').css('border-bottom', 'none');
$('#topbar #search #go').css('color', themecolour);
$('#topbar #search #go').css('border', '1px solid '+themecolour);
$('#topbar #user #button:hover').css('border', '3px solid '+themecolour);
$('#topbar #user #notifcount').css('color', themecolour);
});
$('#getuser').click(function(){$('.storyentry').slideUp('fast'); $('.userentry').slideDown('fast');});
$('#getstory').click(function(){$('.userentry').slideUp('fast'); $('.storyentry').slideDown('fast');});
$('#showuser').click(function(){$('.storyentry').slideUp('fast'); $('.userentry').slideDown('fast');});
$('#showstory').click(function(){$('.userentry').slideUp('fast'); $('.storyentry').slideDown('fast');});


$('#sharestory').click(function(){$('#newshare').slideToggle('fast');});
$('#showcomments').click(function(){$('#comments').slideToggle('fast');});

$('#getsort').click(function(){$('#sorter').slideToggle('fast');});

$(function(){$('a[href*=#]:not([href=#])').click(function(){if(location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname){var target = $(this.hash); target = target.length ? target : $('[name=' + this.hash.slice(1) +']'); if (target.length){$('html,body').animate({scrollTop: target.offset().top}, 800);return false;}}});});
});

function exithmn(){window.location='php/exit.php';}