<?php
//error_reporting(0);
require_once(__DIR__.'/../class/Horario.php');

$id_horario = $_POST['horario'];


//$id = $_POST['nome'];
$horario = new Horario();
$horario->Remover($id_horario);


$return['msg'] = 'ok';

echo json_encode($return);

?>