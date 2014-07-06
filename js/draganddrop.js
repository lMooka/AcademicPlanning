$(function() {

$('#addhorario').click(function(){
	NovoHorario();
});


//======DROPPABLES

$( "table" ).droppable({
	accept: ".materiadrag",
	drop: function(){
		MateriaDrop();
	}

});


$('tr').droppable({
	accept: ".drop-turma",
	drop: function(event, ui){
	
		if (ui.draggable.hasClass('docentedrag')){
			DocenteDrop();
		}
		
		if (ui.draggable.hasClass('item-horario')){
			HorarioDrop();
		}
		
		$(this).removeClass('info');
	},
	over: function(){
		$(this).addClass('info');
	}
});


Draggables();


});




//====Transforma .horas e .minutos em um spinner
function GeraSpinners(){
	$(".horas").spinner({
		max: 22,
		min: 7
	});
	
	$(".minutos").spinner({
		max: 59,
		min: 00,
	})
}


//===== FUNC��ES PARA AP�S DROP NA TABELA
function MateriaDrop(){
	alert("Mat�ria adicionada a tabela. Chamar JSON");
}

function DocenteDrop(){
	alert("Docente adicionado a turma. Chamar JSON");
}

function HorarioDrop(){
	alert("Hor�rio adicionado a turma. Chamar JSON");
}


//=====
function NovoHorario(){
	$("#panelhorario").append(novohorario);
	GeraSpinners();
	Draggables();
}



//====STRINGS
var novohorario = '<div class="well well-sm item-horario drop-turma"> Dia: <select> <option value="1">Segunda-feira</option> <option value="2">Ter�a-feira</option> </select> <br/><hr> Inicio: <input class="horas" size="2" disabled>:<input class="minutos" size="2" disabled> </br><hr> Fim:<input class="horas" size="2" disabled>:<input class="minutos" size="2" disabled></div>';


function Draggables(){
$(".docentedrag").draggable({

	revert: true
});

$( ".materiadrag" ).draggable({ 

	revert: true,
	
	drag: function(){
		$('table').css('border-color', 'red');
	},
	
	stop: function(){
		$('table').css('border-color', 'grey');
	}
	
});

$(".item-horario").draggable({
	revert: true
})



}