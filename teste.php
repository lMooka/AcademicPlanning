<?php

require_once(__DIR__.'/class/Turma.php');


//$id = $_POST['nome'];
$turma = new Turma(1);
$turma->Salvar();
?>