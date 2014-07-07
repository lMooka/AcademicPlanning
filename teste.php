<?php

require_once(__DIR__.'/class/Turma.php');


//$id = $_POST['nome'];
$turma = new Turma('Fred Durão');

$turma->Salvar();
?>