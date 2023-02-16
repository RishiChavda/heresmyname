$(document).ready(function(){
	$('.readtext').css("font-size", $('#zoombox').val() + "px");
	$("#zoombox").change(function(){
		$('.readtext').css("font-size", $('#zoombox').val() + "px");
	});

});

function hmnbk(){window.location='discover.php';}