<?php

require_once(__DIR__.'/class/Horario.php');


//$id = $_POST['nome'];
//$turma = new Materia('Calculo Z','MATA01',4,true);
//$turma->Salvar();

$str = "9:51";
$str2 = "09:51";

$time = strtotime($str);
$time2 = strtotime($str2);

echo $time;
echo '    ';
echo $time2;echo '    ';

//echo date('h:i',$time);

//echo date('h:i', $time);

$h = new Horario(1,'08:00','09:00',22);
$h->Salvar();

//somaHoras(array('09:51', '02:03'));
?>