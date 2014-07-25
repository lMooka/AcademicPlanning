$(function () {

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
function MateriaDrop(id_materia) { //criar uma nova turma
    $.post("/json/adicionarturma.php", { materia: id_materia })
	.done(function (data) {

	    result = $.parseJSON(data);
	    var novaLinha = '<tr id="' + result['id'] + '">	<td class="ref">' + result['ref'] + '</td> <td class="curso"></td>	<td class="seg"></td>	<td class="ter"></td>	<td class="qua"></td>	<td class="qui"></td>	<td class="sex"></td>	<td class="docente"></td>	<td class="credito">' + result['credito'] + '</td>	<td class="disciplina">' + result['disciplina'] + '</td>	</tr>';
	    $(novaLinha).appendTo($("#planilha")).hide().fadeIn('slow');
	    Droppables();
	});
}

function DocenteDrop(id_docente, id_turma) {
    $.post("/json/adicionardocente.php", { docente: id_docente, turma: id_turma })
	.done(function (data) {
		
	    result = $.parseJSON(data);
		
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

    $("table").droppable({
        accept: ".materiadrag",
        drop: function (event, ui) {
            var id_materia = ui.draggable.attr('id');


            MateriaDrop(id_materia);
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

            $(this).removeClass('info');
        },
        over: function () {
            $(this).addClass('info');
        },
        out: function () {
            $(this).removeClass('info');
        }
    });
}

function Draggables() {
    $(".docentedrag").draggable({

        revert: true
    });

    $(".materiadrag").draggable({

        revert: true,

        drag: function () {
            $('table').css('border-color', 'red');
        },

        stop: function () {
            $('table').css('border-color', 'grey');
        }

    });

    $(".item-horario").draggable({
        revert: true
    })



}

function Masks() {
    $('.text-horario').mask('29:59', { translation: { '2': { pattern: /[0-2]/, optional: false }, '5': { pattern: /[0-5]/, optional: false } } });
    //$('.horario').mask('29:59', {translation: {'2': {pattern: /[0-2]/},'5': {pattern: /[0-5]/} } };
}