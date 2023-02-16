$(document).ready(function(){
$(function(){$('a[href*=#]:not([href=#])').click(function(){if(location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname){var target = $(this.hash); target = target.length ? target : $('[name=' + this.hash.slice(1) +']'); if (target.length){$('html,body').animate({scrollTop: target.offset().top}, 800);return false;}}});});

$("#email").keyup(function(){ checkEmailMatch(); });
$("#confemail").keyup(function(){ checkEmailMatch(); });
$("#pass").keyup(function(){ checkPassMatch(); });
$("#confpass").keyup(function(){ checkPassMatch(); });

$('#login').click(function(){$('#loginbox').slideToggle('fast');});
$('#login').dblclick(function(){$('#loginbox').slideUp('fast');});
$('#closeloginbox').click(function(){$('#loginbox').slideUp('fast');});
$('#page').click(function(){$('#loginbox').slideUp('fast');});
$('#link').click(function(){$('#loginbox').slideUp('fast');});
});

var scrollp = 0;
$(document).scroll(function(){
scrollp = $(this).scrollTop();
if(scrollp > 50){$("#topbar").css('background-color', 'rgba(255, 255, 255, 1)'); $("#topbar").css('border-bottom', '1px solid #336CA6'); $("#logo a").css('color', '#336CA6'); $(".link").css('color', '#336CA6');}
else{$("#topbar").css('background-color', 'rgba(255, 255, 255, 0.1)'); $("#topbar").css('border-bottom', '1px solid #ffffff'); $("#logo a").css('color', '#ffffff'); $(".link").css('color', '#ffffff');}
});