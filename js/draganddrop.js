$(function () {
	//click para salvar horario
		$(document).on('click', '.btn-salva', function(){
			var inicio,fim,dia;
			
			id_turma = $(this).parent().parent().parent().parent().attr('id');
			inicio = $(this).parent().children('#inicio').val();
			fim = $(this).parent().children('#fim').val();
			dia = $(this).parent().children('#dia').val();
			$(this).parent().parent().remove();
			
			$.post("/json/adicionarhorario.php", { inicio: inicio, fim: fim, dia: dia, turma: id_turma })
			.done(function (data) {
				
				result = $.parseJSON(data);
				if(result['error']){
					MostraErro(result['error']);
				}else{
					var horario = result['horario'];
					var strtag = '<span style="display:inline-block; margin-top: 2px;" class="label label-primary">'+horario+' 	<span id="'+result['id']+'" class="remove-horario" style="cursor:pointer;height:100%;margin-left:3px;padding-left:2px;font-size:9px;border-left: 1px solid #7FA4CE;color: #CCDEF3;"> X</span>				</span>';
					var local = "tr#" + id_turma;
					$(local).children('.horario').append(strtag).hide().fadeIn('slow');
				}
				
				
				
			});
			
		});


	//remover campo de adicionar horario
	$(document).on('click', '.btn-remove', function(){
		$(this).parent().parent().remove();
	});

	//botões de incluir horario na tabela
	$('.horario').hover(function(){
	var count = 0;
		$(this).children('.newhorario').each(function(){
			count++;
		});
		if (count===0){
			btnstring = '<button type="button" class="btn btn-primary btn-xs btn-horario" style="height: 18px;">+</button>';
			$(btnstring).appendTo($(this)).hide().fadeIn(200);
		}
	}, function(){
		$(this).children('.btn-horario').fadeOut(200);
	});
	
	//click no botão add horario
	$(document).on('click', '.btn-horario', function(){
		$(this).parent().append('<div class="newhorario" style="font-size: 10px;width: 350px;">'+$('#divhorario').html()+'</div>');
		$(this).remove();
		Masks();
	});	
	
	$(document).on('keypress', '.newhorario', function(e){
		if(e.which == 13) {
        alert('You pressed enter!');
		}
	});

	//botões de excluir na tabela
	$('td.docente, td.ref, td.curso, td.disciplina').hover(function(){
		if ($(this).html()){
			$(this).children().remove();
			btnstring = ' <button type="button" class="btn btn-danger btn-xs btn-excluir" style="font-size: 8px;opacity:0.6;margin-left: 4px;">X</button>';
			$(btnstring).appendTo($(this)).hide().fadeIn(200);
		}
	}, function(){
		$(this).children().fadeOut(200);

	});
	
	//click botões de excluir
	$(document).on('click', '.btn-excluir', function(e){
		alert($(this).parent().parent().attr("id"));
	});
	
	
	
	$("#docentescol").dialog({ autoOpen: false });
	$("#materiascol").dialog({ autoOpen: false });
	$("#cursoscol").dialog({ autoOpen: false });
	
	
	$("#btnDocentes").click(function(){
		$("#docentescol").dialog('open');
		$('.ui-dialog').css('z-index','10');
		
	});
	
	$("#btnCursos").click(function(){
		$("#cursoscol").dialog('open');
		$('.ui-dialog').css('z-index','10');
		
	});
	
	$("#btnMaterias").click(function(){
		$("#materiascol").dialog('open');
		$('.ui-dialog').css('z-index','10');
	});
	
	
    $('#addhorario').click(function () {
        NovoHorario();
    });

    $('#btnAddMateria').click(function () {
        NovaMateria();
    });

    $('#btnAddDocente').click(function () {
        NovoDocente();
    });

    $('#btnAddMatCancelar').click(function () {
        $("#btnMostrarDivMateria").removeClass('hidden');
        $("#div-add-materia").addClass('hidden');
    });

    $('#btnMostrarDivMateria').click(function () {
        

        $("#btnMostrarDivMateria").addClass('hidden');
        $("#div-add-materia").removeClass('hidden');
    });

    $('#btnAddDocCancelar').click(function () {
        $("#btnMostrarDivDocente").removeClass('hidden');
        $("#div-add-docente").addClass('hidden');
    });

    $('#btnMostrarDivDocente').click(function () {
        $("#btnMostrarDivDocente").addClass('hidden');
        $("#div-add-docente").removeClass('hidden');
    });


    Droppables();
    Draggables();
    Masks();
});







//===== FUNCÇÕES PARA APÓS DROP NA TABELA

function CursoDrop(id_curso,id_turma){
	$.post("/json/adicionarcurso.php", { curso: id_curso, turma: id_turma })
	.done(function (data) {
		
	    result = $.parseJSON(data);
		if(result['error']){
			MostraErro(result['error']);
		}
	    var nomeCurso = result['curso'];
	    var local = "tr#" + id_turma;

	    $(local).children('.curso').html(nomeCurso).hide().fadeIn('slow');
	});
}

function MateriaDrop(id_materia) { //criar uma nova turma
    $.post("/json/adicionarturma.php", { materia: id_materia })
	.done(function (data) {

	    result = $.parseJSON(data);
	    var novaLinha = '<tr id="' + result['id'] + '">	<td class="ref">' + result['ref'] + '</td> <td class="curso"></td>	<td class="docente"></td>	<td class="credito">' + result['credito'] + '</td>	<td class="disciplina">' + result['disciplina'] + '</td> <td class="horario"></td>	</tr>';
	    $(novaLinha).appendTo($("#planilha")).hide().fadeIn('slow');
	    Droppables();
	});
}

function DocenteDrop(id_docente, id_turma) {
    $.post("/json/adicionardocente.php", { docente: id_docente, turma: id_turma })
	.done(function (data) {
		
	    result = $.parseJSON(data);
		if(result['error']){
			MostraErro(result['error']);
		}
	    var nomeDocente = result['docente'];
	    var local = "tr#" + id_turma;

	    $(local).children('.docente').html(nomeDocente).hide().fadeIn('slow');
	});
}

function HorarioDrop() {
    alert("Horário adicionado a turma. Chamar JSON");
}


//=====
function NovoHorario() {
    $("#panelhorario").append(novohorario);
    Draggables();
    Masks();
}

function NovoDocente() {
    var nome = $('#nomedocente').val();

    $.post("/json/cadastrardocente.php", { docente: nome })
        .done(function (data) {
            $('#nomedocente').val('');
        });

    Draggables();
    Masks();
}

function NovaMateria() {
    var nome = $('#matnome').val();
    var cod = $('#matcod').val();

    //alert($('#div-materias').val());

    $.post("/json/adicionarmateria.php", { matnome: nome, matcod: cod });
    //.done(function (data) {
    //    $("#div-materias").html($("#div-materias").html() + "<div class='well well-sm materiadrag'>"+cod+"</div>");
    //});

    Draggables();
    Masks();
}



//====STRINGS
var novohorario = '<br/><div class="well well-sm item-horario drop-turma"> Dia: <select> <onption value="1">Segunda-feira</option> <option value="2">Terça-feira</option> </select> <br/><hr> Inicio: <input class="text-horario" size="5" ></br><hr> Fim:<input class="text-horario" size="5" ></div>';

function Droppables() {
    //======DROPPABLES
	
	


	$('.ui-dialog-content').droppable({
		accept: "div",
		over: function (event,ui){
			
			
			$('table').droppable( "disable" );
			$('tr').droppable( "disable" );
			$('.info').removeClass('info');
			$('#table').css("border","");
			
		},

		out: function (event,ui){
		
			Droppables();
		}
	});
	
	    $('table').droppable({
        accept: ".materiadrag",
        drop: function (event, ui) {
            var id_materia = ui.draggable.attr('id');
			$('#table').css("border","");

            MateriaDrop(id_materia);
        },
		over: function(){
			$('#table').css("border","2px solid blue");
		},

		out: function(){
			$('#table').css("border","");
		}

    });
	
    $('tr').droppable({
        accept: ".drop-turma",

        drop: function (event, ui) {

				if (ui.draggable.hasClass('docentedrag')) {
					var id_docente = ui.draggable.attr('id');
					var id_turma = $(this).attr('id');

					DocenteDrop(id_docente, id_turma);
				}

				if (ui.draggable.hasClass('item-horario')) {
					HorarioDrop();
				}
				
				if (ui.draggable.hasClass('cursodrag')){
					var id_curso = ui.draggable.attr('id');
					var id_turma = $(this).attr('id');
					CursoDrop(id_curso,id_turma);
				}
				
				
			$(this).removeClass('info');
            
        },
        over: function (event,ui) {

				$(this).addClass('info');
				

        },
        out: function (event,ui) {
            $(this).removeClass('info');
        }
    });
	
	$('table').droppable( "enable" );
	$('tr').droppable( "enable" );
	
}

function Draggables() {
    $(".drop-turma").draggable({
        revert: true,
		helper:'clone',
		appendTo: 'body',
		zIndex: 101,
		addClasses: false
    });

    $(".materiadrag").draggable({

        revert: true,
		helper:'clone',
		appendTo: 'body',
		zIndex: 100,
		addClasses: false

    });

    $(".item-horario").draggable({
        revert: true
    })



}

function Masks() {
    $('.text-horario').mask('29:59', { translation: { '2': { pattern: /[0-2]/, optional: false }, '5': { pattern: /[0-5]/, optional: false } } });
    //$('.horario').mask('29:59', {translation: {'2': {pattern: /[0-2]/},'5': {pattern: /[0-5]/} } };
}



//MOSTRA ERROS
