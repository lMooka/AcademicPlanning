<?php

require_once(__DIR__.'/../libs/RedBean/setup.php');

class Materia	{

	private $id; //id vindo do banco (int)
	private $nome; // (string) nome
	private $ref; //(string) cod de referencia da disciplina ex. MATC84
	private $credito;//(int) creditos da materia
	private $bean; //bean da materia carregada
	
	
	function __construct($nome_ = null, $ref_ = null, $credito_ = null){
		$this->nome = $nome_;
		$this->credito = $credito_;
		$this->ref = $ref_;
	}
	
	public function Salvar(){
	
		$materia= R::dispense('materia');
		if (!$this->id) $this->id = 0;
		$materia->id = $this->id;
		$materia->nome = $this->nome;
		$materia->credito = $this->credito;
		$materia->ref = $this->ref;
		$this->id = R::store($materia);
		$this->bean = R::load('materia',$this->id);
	}
	
	public function Carregar($_id){
		$materia = R::load('materia',$_id);
		
		$this->id = $materia->id;
		$this->nome = $materia->nome;
		$this->credito = $materia->credito;
		$this->ref = $materia->ref;
		$this->bean = $materia;
	}
	
	public function Remover($_id){
		$this->Carregar($_id);
		R::trash($this->bean);
	}
	
}

?>