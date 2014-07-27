<?php

require_once(__DIR__.'/../libs/RedBean/setup.php');
require_once(__DIR__.'/../config.php');

class Turma	{

	private $id; //id vindo do banco (int)
	private $materia; //(bean) materia
	private $docente; //(bean) docente
	private $horario; // array de beans
	private $curso; //(bean curso)
	public $bean; //bean da turma carregada
	
	////////CRUD
	
	function __construct($id_materia = null, $id_docente = null, $id_curso = null){
		if ($id_docente)$this->docente = R::load('docente', $id_docente);
		if ($id_materia)$this->materia = R::load('materia', $id_materia);
		if ($id_curso)$this->curso = R::load('curso', $id_curso);
	}
	
	public function Salvar(){
        
		$turma = R::dispense('turma');
		if (!$this->id) $this->id = 0;
		
		$turma->id = $this->id;
		
		if ($this->materia){$turma->materia = $this->materia;}else{$turma->materia_id = NULL;}
		if ($this->docente){ $turma->docente = $this->docente;}else{$turma->docente_id = NULL;}
		if ($this->curso){ $turma->curso = $this->curso; }else{$turma->curso_id = NULL;}
		$this->id = R::store($turma);
		$this->bean = R::load('turma',$this->id);
	}
	
	public function Carregar($_id){
		$turma = R::load('turma',$_id);
		
		$this->id = $turma->id;
		$this->materia = $turma->materia;
		$this->docente = $turma->docente;
		$this->horario = R::find('horario', "turma_id = $_id");
		$this->curso = $turma->curso;
		$this->bean = $turma;
	}
	
	public function Remover($_id){
		$this->Carregar($_id);
		R::trash($this->bean);
		//remove horarios
		$horarios = R::find('horario', 'turma_id = $_id');
		foreach($horario as $h){
			R::trash($h);
		}
	}
	
	public function SetDocente($id_docente){
	
		if (!$id_docente == NULL){
			$crtotal = 0;
			
			if (isset($this->materia) && $this->materia->id > 0){ //verifica se ao tentar adicionar docente ultrapassa o CR máximo do docente
				$turmas = R::find('turma',"docente_id = $id_docente");
				foreach ($turmas as $t){
					
					
					
					$crtotal += $t->materia->credito;
				}
				
				
				if ($crtotal + $this->materia->credito > MAX_CR){
					throw new Exception("Docente excederá o máximo de CR permitido. (CR atual: $crtotal / Máximo:".MAX_CR.")");
				}
			}
			
			$this->docente = R::load('docente', $id_docente);
		}else{
			$this->docente = NULL;
		}
	}
	
	public function GetDocente(){
		return $this->docente;
	}
	
	public function SetCurso($id_curso){
		if (!$id_curso==null){
		
			$this->curso = R::load('curso', $id_curso);
		}else{
			$this->curso=null;
		}
	}
	
	public function GetCurso(){
		return $this->curso;
	}
	
	public function GetHorario(){
		return $this->horario;
	}
}

?>