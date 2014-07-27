<?php
error_reporting(0);
require_once(__DIR__.'/../class/materia.php');

$matnome = $_POST['matnome'];
$matcod = $_POST['matcod'];
$matcr = $_POST['matcr'];

$materia = new Materia($matnome, $matcod, $matcr);
$materia->Salvar();

$return['id'] = $materia->bean->id;


echo json_encode($return);

?>