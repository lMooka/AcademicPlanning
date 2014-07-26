<?php
error_reporting(0);
require_once(__DIR__.'/libs/RedBean/setup.php');
?>
<html>
<head>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
	<script src="/js/erro.js"></script>
    <script src="/js/draganddrop.js"></script>
    <script src="/js/jquery.mask.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	
	
	<link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="/css/jquery-ui.structure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/jquery-ui.theme.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index.php">Home</a>
        </div>
		<button type="button" class="btn btn-default navbar-btn btn-primary" id="btnDocentes">Docentes</button>
		<button type="button" class="btn btn-default navbar-btn btn-primary" id="btnMaterias">Matérias</button>
		<button type="button" class="btn btn-default navbar-btn btn-primary" id="btnCursos">Cursos</button>
        <button type="button" class="btn btn-default navbar-btn navbar-right btn-success">Fazer Login</button>
    </nav>
	<div id='errors' style='position: absolute; top: 5%; width: 50%; left: 25%; text-align: center; margin-left: auto; margin-right: auto;'>
		
	</div>
	
    <section id="table" class="panel panel-default panel-primary" style="margin: 15px 15px 15px 15px;">
        <!-- Default panel contents -->
        <div class="panel-heading">Planilha</div>

        <table class="table panel-body" id="planilha">

            <thead>
                <tr>
                    <th>Disciplina</th>
                    <th>Curso</th>
                    <th>Seg</th>
                    <th>Ter</th>
                    <th>Qua</th>
                    <th>Qui</th>
                    <th>Sex</th>
                    <th>Docente</th>
                    <th>CR</th>
                    <th>Nome Disciplina</th>
                </tr>
            </thead>

            <!--            <th>Disciplina</th>
            <th>Curso</th>
            <th>Horário</th>
            <th>Docente</th>
            <th>CR</th>
            <th>Nome Disciplina</th>
            <tr>
                <td>MAT992</td>
                <td>BCC</td>
                <td><span class="label label-primary">Ter 18:30 - 20:30</span>
                <span class="label label-primary">Qui 18:30 - 20:30</span></td>
                <td>Lol Lol Lol</td>
                <td>2</td>
                <td>Programação III</td>-->

            <?php
            //PREENCHE TABELA COM TURMAS JÁ CRIADAS
            $turmas = R::findAll('turma');
            
            foreach($turmas as $id => $turma) {
                
                echo "<tr id='$id'>	<td class='ref'>".$turma->materia->ref."</td>	<td class='curso'>".$turma->curso->nome."</td>	<td class='seg'></td>	<td class='ter'></td>	<td class='qua'></td>	<td class='qui'></td>	<td class='sex'></td>	<td class='docente'>".$turma->docente->nome."</td>	<td class='credito'>".$turma->materia->credito."</td>	<td class='disciplina'>".$turma->materia->nome."</td>	</tr>";
            }
            ?>
        </table>
    </section>
    <aside class="bs-docs-section nav-right">

        <div class="page-header">
            <div class="col-lg-2">
                <div class="bs-component">
                    <div class="panel panel-primary hidden" id="div-add-materia">
                        <div class="panel-heading">Adicionar Matéria</div>
                        <div class="panel-body">

                            <div class="input-group">
                                <span class="input-group-addon">Nome</span>
                                <input id='matnome' type="text" class="form-control" placeholder="ex. Cálculo A">
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon">Código</span>
                                <input id='matcod' type="text" class="form-control" placeholder="ex. MATA00">
                            </div>
                            <br />
                            <span class="btn-group">
                                <button type="button" class="btn btn-primary btn-group-sm" id='btnAddMateria'>Adicionar</button>
                                <button type="button" class="btn btn-danger btn-group-sm" id='btnAddMatCancelar'>x</button>
                            </span>
                        </div>
                    </div>

                    <div class="panel panel-primary" id="materiascol" title="Matérias">
                        <!--<div class="panel-heading">
                            Matérias &nbsp
                                <button type="button" style='text-align: right;' class="btn btn-info btn-sm btn-right" id='btnMostrarDivMateria'>+</button>
                        </div>-->

                        <div id="div-materias" class="panel-body">
                            <?php
                            //PREENCHE COM MATÉRIAS DO BANCO
                            $materias = R::findAll('materia');
                            
                            foreach($materias as $id=>$materia){
                                echo "<div class='well well-sm materiadrag' id='$id'>$materia->ref</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="bs-component">
                    <!-- DIV ADD DOCENTE -->
                    <div class="panel panel-primary hidden" id="div-add-docente">
                        <div class="panel-heading">Adicionar Docente</div>
                        <div class="panel-body">

                            <div class="input-group">
                                <span class="input-group-addon">Nome</span>
                                <input id='nomedocente' type="text" class="form-control" placeholder="ex. Frederico Araujo Durao">
                            </div>
                            <br />
                            <span class="btn-group">
                                <button type="button" class="btn btn-primary btn-group-sm" id='btnAddDocente'>Adicionar</button>
                                <button type="button" class="btn btn-danger btn-group-sm" id='btnAddDocCancelar'>x</button>
                            </span>
                        </div>
                    </div>

                    <div class="panel panel-primary" id="docentescol" style='z-index: 10;' title='DOCENTES'>
                        <!--<div class="panel-heading">
                            Docentes &nbsp
                                <button type="button" style='text-align: right;' class="btn btn-info btn-sm btn-right" id='btnMostrarDivDocente'>+</button>
                        </div>-->

                        <div class="panel-body">
                            <!--                                <div class="well well-sm docentedrag drop-turma" id='150'>
                                    Fred Durão
		
                                </div>-->

                            <?php
                            //PREENCHE COM DOCENTES DO BANCO
                            $docentes = R::findAll('docente');
                            foreach ($docentes as $id => $docente){
                                echo "<div class='well well-sm docentedrag drop-turma' id='$id'>$docente->nome</div>";
                            }
                            ?>
                        </div>
                    </div>
					
					<div class="panel panel-primary" id="cursoscol" style='z-index: 10;' title='CURSOS'>
                        <!--<div class="panel-heading">
                            Docentes &nbsp
                                <button type="button" style='text-align: right;' class="btn btn-info btn-sm btn-right" id='btnMostrarDivDocente'>+</button>
                        </div>-->

                        <div class="panel-body">
                            <!--                                <div class="well well-sm docentedrag drop-turma" id='150'>
                                    Fred Durão
		
                                </div>-->

                            <?php
                            //PREENCHE COM DOCENTES DO BANCO
                            $cursos = R::findAll('curso');
                            foreach ($cursos as $id => $curso){
                                echo "<div class='well well-sm cursodrag drop-turma' id='$id'>$curso->nome</div>";
                            }
                            ?>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-lg-2">
                <div class="bs-component">
                    <div class="panel panel-primary" id='horarioscol' title='HORÁRIOS'>


                        <div class="panel-body" id='panelhorario'>
                            <div class="well well-sm item-horario drop-turma"> Dia: <select> <onption value="1">Segunda-feira</option> <option value="2">Terça-feira</option> </select> <br/><hr> Inicio: <input class="text-horario" size="5" ></br><hr> Fim:<input class="text-horario" size="5" ></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <footer>
    </footer>
</body>
</html>
