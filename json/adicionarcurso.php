<?php
error_reporting(0);
require_once(__DIR__.'/../class/Turma.php');

$id_turma = $_POST['turma'];
$id_curso = $_POST['curso'];


//$id = $_POST['nome'];
$turma = new Turma();
$turma->Carregar($id_turma);
try{
	$turma->SetCurso($id_curso);
}catch (Exception $e) {
	$return['error'] = $e->getMessage();
}

$turma->Salvar();


$return['curso'] = $turma->bean->curso->nome;

echo json_encode($return);

?>