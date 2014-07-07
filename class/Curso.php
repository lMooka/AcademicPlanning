<?php

require_once(__DIR__.'/../libs/RedBean/setup.php');

class Curso	{

	private $id; //id vindo do banco (int)
	private $nome; //(string) 
	private $bean; //bean do curso carregado
	
	
	function __construct($nome_ = null){
		$this->nome = $nome_;
	}
	
	public function Salvar(){
	
		$curso = R::dispense('curso');
		if (!$this->id) $this->id = 0;
		$curso->id = $this->id;
		$curso->nome = $this->nome;
		$curso->id = R::store($curso);
		$curso->bean = R::load('curso',$this->id);
	}
	
	public function Carregar($_id){
		$curso = R::load('curso',$_id);
		
		$this->id = $curso->id;
		$this->nome = $curso->nome;
				
		$this->bean = $curso;
	}
	
	public function Remover($_id){
		$this->Carregar($_id);
		R::trash($this->bean);
	}
	
}

?>