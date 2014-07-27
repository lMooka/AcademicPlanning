<?php
//error_reporting(0);
require_once(__DIR__.'/../class/Turma.php');

$id_turma = $_POST['turma'];


//$id = $_POST['nome'];
$turma = new Turma();
$turma->Carregar($id_turma);

$turma->SetDocente(NULL);


$turma->Salvar();


$return['msg'] = 'ok';

echo json_encode($return);

?>