<?php

require_once(__DIR__.'/../libs/RedBean/setup.php');

class Turma	{

	private $id; //id vindo do banco (int)
	private $materia; //(bean) materia
	private $docente; //(bean) docente
	private $horarios; // array de beans
	private $curso; //(bean curso)
	private $bean; //bean da turma carregada
	
	////////CRUD
	
	
	function __construct($id_materia = null,$id_docente = null,$id_curso = null){
		if ($id_docente)$this->docente = R::load('docente',$id_docente);
		if ($id_materia)$this->materia = R::load('materia',$id_materia);
		if ($id_curso)$this->curso = R::load('curso',$id_curso);
	}
	
	public function Salvar(){
	
		$turma = R::dispense('turma');
		if (!$this->id) $this->id = 0;
		$turma->id = $this->id;
		$turma->materia = $this->materia;
		$turma->docente = $this->docente;
		$turma->curso = $this->curso;
		$this->id = R::store($turma);
		$this->bean = R::load('turma',$this->id);
	}
	
	public function Carregar($_id){
		$turma = R::load('turma',$_id);
		
		$this->id = $turma->id;
		$this->materia = $turma->materia;
		$this->docente = $turma->docente;
		$this->horarios = R::find('horarios', "turma_id = $turma->id");
		$this->curso = $turma->curso;
		$this->bean = $turma;
	}
	
	public function Remover($_id){
		$this->Carregar($_id);
		R::trash($this->bean);
	}
	
	public function SetDocente($id_docente){
		$this->docente = R::load('docente', $id_docente);
	}
	
	public function GetDocente(){
		return $this->docente;
	}
	
	public function SetCurso($id_curso){
		$this->curso = R::load('curso', $id_curso);
	}
	
}

?>