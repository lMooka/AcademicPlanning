<?php

require_once(__DIR__.'/class/Horario.php');


//$id = $_POST['nome'];
//$turma = new Materia('Calculo Z','MATA01',4,true);
//$turma->Salvar();

$str = "9:51";
$str2 = "09:51";

$time = strtotime($str);
$time2 = strtotime($str2);



//echo date('h:i',$time);

//echo date('h:i', $time);

try{
$h = new Horario();
$h->Carregar(12);
echo $h->GetString();
}catch(Exception $e){
	echo $e->getMessage();
}

//somaHoras(array('09:51', '02:03'));
?>