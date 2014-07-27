<?php
error_reporting(0);
require_once(__DIR__.'/../class/curso.php');

$nome = $_POST['curso'];

$curso = new Curso($nome);
$curso->Salvar();

echo $curso->bean;
?>