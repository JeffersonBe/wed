/*
	Author: Jefferson Bonnaire
*/

$(document).ready(function() {
	$('#resa').hide();
	$('#resa').validationEngine();
	$('#inscription').click(function Reveal() {
	  	$('#resa').slideToggle("slow");
	  		$('#inscription').slideUp("fast");
  	});

});