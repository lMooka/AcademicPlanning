<?php
error_reporting(0);
require_once(__DIR__.'/../class/materia.php');

$id = $_POST['id'];

$materia = new Materia();
$materia->Remover($id);


?>