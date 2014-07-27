<?php

require_once(__DIR__.'/../libs/RedBean/setup.php');

class Docente	{

	private $id; //id vindo do banco (int)
	private $nome; //(string) 
	public $bean; //bean do docente carregado
	
	
	function __construct($nome_ = null){
		$this->nome = $nome_;
	}
	
	public function Salvar(){
	
		$docente = R::dispense('docente');
		if (!$this->id) $this->id = 0;
		$docente->id = $this->id;
		$docente->nome = $this->nome;
		$this->id = R::store($docente);
		$this->bean = R::load('docente',$this->id);
	}
	
	public function Carregar($_id){
		$docente = R::load('docente',$_id);
		
		$this->id = $docente->id;
		$this->nome = $docente->nome;
				
		$this->bean = $docente;
	}
	
	public function Remover($_id){
		$this->Carregar($_id);
		R::trash($this->bean);
	}
	
}

?>