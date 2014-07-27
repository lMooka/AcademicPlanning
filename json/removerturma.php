<?php
//error_reporting(0);
require_once(__DIR__.'/../class/Turma.php');

$id_turma = $_POST['turma'];


//$id = $_POST['nome'];
$turma = new Turma();
$turma->Remover($id_turma);


$return['msg'] = 'ok';

echo json_encode($return);

?>