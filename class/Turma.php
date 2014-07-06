<?php

class Turma	{
	private $id; //id vindo do banco (int)
	private $nome; //nome (string)
	private $credito; //credito vindo do banco (int)
	private $docente; //(bean) docente
	private $horarios; // array de beans
	private $curso; //(bean) curso
	private $bean; //bean da turma carregada
	
	
	public __construct($_nome=null,$_credito=null,$_docente=null,$_curso=null){
		$this->nome = $_nome
		$this->credito = $_credito;
		$this->docente = $_docente;
		$this->curso = $_curso;
	}
	
	public Salvar(){
	
		$turma = R::dispense('turma');
		$turma->id = $this->id;
		$turma->nome = $this->nome;
		$turma->credito = $this->credito;
		$turma->docente = $this->docente;
		$turma->curso = $this->curso;
		$this->id = R::store($turma);
	}
	
	public Carregar($_id){
		$turma = R::load('turma',$_id);
		
		$this->id = $turma->id;
		$this->nome = $turma->nome;
		$this->credito = $turma->credito;
		$this->docente = $turma->docente;
		$this->horarios = R::find('horarios', "turma_id = $turma->id");
		$this->curso = $turma->curso;
		$this->bean = $turma;
	}
	
	public Remover($_id){
		$this->Carregar($_id);
		R::trash($this->bean);
	}
	
}

?>