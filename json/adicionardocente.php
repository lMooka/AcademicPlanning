<?php
error_reporting(0);
require_once(__DIR__.'/../class/Turma.php');

$id_turma = $_POST['turma'];
$id_docente = $_POST['docente'];


//$id = $_POST['nome'];
$turma = new Turma();
$turma->Carregar($id_turma);
try{
	$turma->SetDocente($id_docente);
}catch (Exception $e) {
	$return['error'] = $e->getMessage();
}

$turma->Salvar();


$return['docente'] = $turma->bean->docente->nome;

echo json_encode($return);

?>