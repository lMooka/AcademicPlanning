<?php
error_reporting(0);
require_once(__DIR__.'/../class/docente.php');

$id = $_POST['id'];

$docente = new Docente();
$docente->Remover($id);


?>