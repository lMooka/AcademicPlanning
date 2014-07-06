<?php

require_once(__DIR__.'/../class/Turma.php');


$nome = $_POST['nome'];
$creditos = $_POST['creditos'];

$turma = new Turma('Cálculo B',2);

$turma->Salvar();
?>