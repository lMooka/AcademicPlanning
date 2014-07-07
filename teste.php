<?php

require_once(__DIR__.'/class/Materia.php');


//$id = $_POST['nome'];
$curso = new Materia('Laboratório de Programação WEb','MATC84',2);

$curso->Salvar();
?>