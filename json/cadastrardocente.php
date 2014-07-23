<?php
error_reporting(0);
require_once(__DIR__.'/../class/docente.php');

$nome = $_POST['docente'];

$docente = new Docente($nome);
$docente->Salvar();

$return['id'] = $docente->bean->id;

echo json_encode($return);

?>