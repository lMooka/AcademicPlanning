<?php

require_once(__DIR__.'/../libs/RedBean/setup.php');
class Horario {

	private $id;
	private $dia; //dias da semana 1segunda .... 6sabado
	private $inicio; //hh:mm inicio
	private $fim; //hh:mm fim
	private $turma; // (bean) turma
	public $bean;
	
	function __construct($dia_,$inicio_,$fim_,$turma_id){
	
		if ($this->subtraiHoras($inicio_,$fim_)<= 0 ) throw new Exception("Horário inválido");
		if ($dia_ > 6 || $dia_ <1) throw new Exception("Dia inválido");
		//Valida se não existe um horário "dentro de outro"
		
		
		
		$this->dia = $dia_;
		$this->inicio = $inicio_;
		$this->fim = $fim_;
		$this->turma = R::load('turma',$turma_id);
	}
	
	public function Salvar(){
		//Valida se não existe um horário "dentro de outro"
		$turmaid = $this->turma->id;
		$horarios = R::find('horario', "turma_id = $turmaid AND dia = $this->dia");
		foreach ($horarios as $h){
			if (((strtotime($h->inicio) <  strtotime($this->inicio)) && (strtotime($this->inicio) < strtotime($h->fim)))  ||  ((strtotime($h->inicio) < strtotime($this->fim)) && (strtotime($this->fim) < strtotime($h->fim))){
				throw new Exception("Choque de horários da mesma matéria");
			}
		}
		$horario = R::dispense('horario');
		if (!$this->id) $this->id = 0; //se id não foi setado é um novo horario (id = 0)
		$horario->dia = $this->dia;
		$horario->inicio = $this->inicio;
		$horario->turma = $this->turma;
		$horario->fim = $this->fim;
		$this->id = R::store($horario);
		$this->bean = R::load('horario', $this->id);
	}
	
	public function Carregar($_id){
		$horario = R::load('horario',$_id);
		$this->dia = $horario->dia;
		$this->inicio = $horario->inicio;
		$this->fim = $horario->fim;
		$this->turma = $horario->turma;
		$this->id = $horario->id;
		$this->bean = $horario;
	}
	
	public function Remover($_id){
		$this->Carregar($_id);
		R::trash($this->bean);
	}
	
	private function somaHoras($times){


	$seconds = 0;

	foreach ( $times as $time ){
	   list( $g, $i ) = explode( ':', $time );
	   $seconds += $g * 3600;
	   $seconds += $i * 60;
	}

	$hours = floor( $seconds / 3600 );
	$seconds -= $hours * 3600;
	$minutes = floor( $seconds / 60 );

	echo "{$hours}:{$minutes}";

}

	private function subtraiHoras($inicial,$final){ //verifica se hora final é maior que inicial, resultado em segundos
		$seconds = 0;
		list( $h, $m) = explode( ':', $final);
		$seconds += $h * 3600;
		$seconds += $m * 60;
		
		list ($h,$m) = explode (':', $inicial);
		$seconds -= $h *3600;
		$seconds -= $m * 60;
		
		return $seconds;
	}
}


?>