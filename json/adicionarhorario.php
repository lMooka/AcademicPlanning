<?php
error_reporting(0);


require_once(__DIR__.'/../class/Turma.php');
require_once(__DIR__.'/../class/Horario.php');


$id_turma = $_POST['turma'];
$inicio = $_POST['inicio'];
$fim = $_POST['fim'];
$dia = $_POST['dia'];


$h = new Horario($dia,$inicio,$fim,$id_turma);
try{
	$h->Salvar();
	$return['horario'] = $h->GetString();
	$return['id'] = $h->bean->id;
}catch(Exception $e){
	$return['error'] = $e->getMessage();
}

echo json_encode($return);

?>