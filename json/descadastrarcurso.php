<?php
error_reporting(0);
require_once(__DIR__.'/../class/curso.php');

$id = $_POST['id'];

$curso = new Curso();
$curso->Remover($id);


?>