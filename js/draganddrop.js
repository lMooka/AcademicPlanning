$(function() {


$( "table" ).droppable({
	accept: ".materiadrag",
	drop: function(){
	alert("oi");
	}

});

$( ".materiadrag, #draggable-nonvalid" ).draggable({ 

	revert: true,
	
	drag: function(){
		$('table').css('border-color', 'red');
	},
	
	stop: function(){
		$('table').css('border-color', 'grey');
	}
	
});

});

var posicoes = [];




function MateriaDrop(){
}