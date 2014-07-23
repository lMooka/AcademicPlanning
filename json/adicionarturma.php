<?php
error_reporting(0);
require_once(__DIR__.'/../class/Turma.php');

$id_materia = $_POST['materia'];


//$id = $_POST['nome'];
$turma = new Turma($id_materia);
$turma->Salvar();

	$return['id'] = $turma->bean->id;
	$return['ref'] = $turma->bean->materia->ref;
	$return['disciplina'] = $turma->bean->materia->nome;
	$return['credito'] = $turma->bean->materia->credito;
	
	echo json_encode($return);

?>