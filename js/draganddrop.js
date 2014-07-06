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
Masks();

});







//===== FUNCÇÕES PARA APÓS DROP NA TABELA
function MateriaDrop(){
	alert("Matéria adicionada a tabela. Chamar JSON");
}

function DocenteDrop(){
	alert("Docente adicionado a turma. Chamar JSON");
}

function HorarioDrop(){
	alert("Horário adicionado a turma. Chamar JSON");
}


//=====
function NovoHorario(){
	$("#panelhorario").append(novohorario);
	Draggables();
	Masks();
}



//====STRINGS
var novohorario = '<div class="well well-sm item-horario drop-turma"> Dia: <select> <option value="1">Segunda-feira</option> <option value="2">Terça-feira</option> </select> <br/><hr> Inicio: <input class="text-horario" size="5" ></br><hr> Fim:<input class="text-horario" size="5" ></div>';


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

function Masks(){
	$('.text-horario').mask('29:59', {translation:  {'2': {pattern: /[0-2]/, optional: false},'5': {pattern: /[0-5]/, optional: false}}});
	//$('.horario').mask('29:59', {translation: {'2': {pattern: /[0-2]/},'5': {pattern: /[0-5]/} } };
}