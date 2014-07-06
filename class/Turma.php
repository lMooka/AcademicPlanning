<?php

require_once(__DIR__.'/../libs/RedBean/setup.php');

class Turma	{
	private $id; //id vindo do banco (int)
	private $nome; //nome (string)
	private $credito; //credito vindo do banco (int)
	private $docente; //(bean) docente
	private $horarios; // array de beans
	private $curso; //(bean) curso
	private $bean; //bean da turma carregada
	
	
	function __construct($nome_=null,$credito_= NULL,$docente_= NULL,$curso_= NULL){
		$this->nome = $nome_;
		$this->credito = $credito_;
		$this->docente = $docente_;
		$this->curso = $curso_;
	}
	
	public function Salvar(){
	
		$turma = R::dispense('turma');
		//$turma->id = $this->id;
		$turma->nome = $this->nome;
		$turma->credito = $this->credito;
		$turma->docente = $this->docente;
		$turma->curso = $this->curso;
		$this->id = R::store($turma);
	}
	
	public function Carregar($_id){
		$turma = R::load('turma',$_id);
		
		$this->id = $turma->id;
		$this->nome = $turma->nome;
		$this->credito = $turma->credito;
		$this->docente = $turma->docente;
		$this->horarios = R::find('horarios', "turma_id = $turma->id");
		$this->curso = $turma->curso;
		$this->bean = $turma;
	}
	
	public function Remover($_id){
		$this->Carregar($_id);
		R::trash($this->bean);
	}
	
}

?>