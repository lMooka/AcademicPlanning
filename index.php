<?php
error_reporting(0);
require_once(__DIR__.'/libs/RedBean/setup.php');
require_once(__DIR__.'/class/Horario.php');
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
        <button type="button" class="btn btn-default navbar-btn btn-primary" id="btnMaterias">Matérias</button>
        <button type="button" class="btn btn-default navbar-btn btn-primary" id="btnDocentes">Docentes</button>
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
                    <th>Docente</th>
                    <th>CR</th>
                    <th>Nome Disciplina</th>
                    <th>Horarios</th>
                </tr>
            </thead>

            <?php
            //PREENCHE TABELA COM TURMAS JÁ CRIADAS
            $turmas = R::findAll('turma');
            
			
            foreach($turmas as $id => $turma) {
				$horariostr = '';
                $horarios = R::find('horario', "turma_id = $turma->id");
				foreach ($horarios as $h){
					$HR = new Horario();
					
					$HR->Carregar($h->id);
					$str = $HR->GetString();
					
					$horariostr .= '<div style="display:inline-block; margin-top: 2px;" class="label label-primary">'.$str.' <span id="'.$h->id.'" class="remove-horario" style="cursor:pointer;height:100%;margin-left:3px;padding-left:2px;font-size:9px;border-left: 1px solid #7FA4CE;color: #CCDEF3;"> X</span> </div>';
					
				}
                echo "<tr id='$id'>	<td class='ref'>".$turma->materia->ref."</td>	<td class='curso'>".$turma->curso->nome."</td>	<td class='docente'>".$turma->docente->nome."</td>	<td class='credito'>".$turma->materia->credito."</td>	<td class='disciplina'>".$turma->materia->nome."</td> <td class='horario' style='max-width:300px;'>".$horariostr."</td></tr>";
            }
            ?>
        </table>
    </section>

    <aside class="bs-docs-section nav-right">

        <div class="page-header">
            <div class="col-lg-2">
                <div id="divPopout" class="bs-component">
                    <!-- DIV ADD MATERIA -->
                    <div class="panel panel-primary" id="div-add-materia" style="z-index: 10;" title="Adicionar Matéria">
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon">Código</span>
                                <input id='matcod' type="text" class="form-control" placeholder="ex. MATA00">
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon">Nome</span>
                                <input id='matnome' type="text" class="form-control" placeholder="ex. Cálculo A">
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon">Creditos</span>
                                <input id='matcr' type="number" class="form-control">
                            </div>
                            <br />
                            <span class="btn-group">
                                <button type="button" class="btn btn-primary btn-group-sm" id='btnAddMateria'>Adicionar</button>
                            </span>
                        </div>
                    </div>

                    <!-- DIV ADD DOCENTE -->
                    <div class="panel panel-primary" id="div-add-docente" style="z-index: 10;" title='Adicionar Docente'>
                        <div class="panel-body">

                            <div class="input-group">
                                <span class="input-group-addon">Nome</span>
                                <input id='nomedocente' type="text" class="form-control" placeholder="ex. Frederico Araujo Durao">
                            </div>
                            <br />
                            <span class="btn-group">
                                <button type="button" class="btn btn-primary btn-group-sm" id='btnAddDocente'>Adicionar</button>
                            </span>
                        </div>
                    </div>

                    <!-- DIV ADD CURSOS -->
                    <div class="panel panel-primary" id="div-add-curso" style="z-index: 10;" title='Adicionar Curso'>
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon">Nome</span>
                                <input id='nomecurso' type="text" class="form-control" placeholder="ex. Sistemas de Informação">
                            </div>
                            <br />
                            <span class="btn-group">
                                <button type="button" class="btn btn-primary btn-group-sm" id='btnAddCurso'>Adicionar</button>
                            </span>
                        </div>
                    </div>

                    <!-- ===== DIVS DE LISTAS ===== -->

                    <!-- DIV MATERIAS -->
                    <div class="panel panel-primary" id="materiascol" title="Matérias">
                        <div id="div-materias" class="panel-body" style='z-index: 10; overflow-y: scroll; height: 300px;'>

                            <?php
                            //PREENCHE COM MATÉRIAS DO BANCO
                            $materias = R::findAll('materia');

                            foreach($materias as $id=>$materia){
                                echo "<div class='well well-sm materiadrag btn-fade' id='$id'>$materia->ref &nbsp".
                                "<button type='button' onclick='DescadastrarMateria(this)' class='btn btn-primary btn-xs' style='font-size: 15px; display: none;' id='$id'>x</button>".
                                "</div>";
                            }
                            ?>
                        </div>
                        <button type="button" class="btn btn-info btn-sm" style="width: 100%; margin-top: 10px;" id='btnMostrarDivMateria'>Adicionar Matéria</button>
                    </div>

                    <!-- DIV DOCENTES -->
                    <div class="panel panel-primary" id="docentescol" title='Docentes'>
                        <div id='div-docentes' class="panel-body" style='z-index: 10; overflow-y: scroll; height: 300px;'>
                            <?php
                            //PREENCHE COM DOCENTES DO BANCO
                            $docentes = R::findAll('docente');
                            foreach ($docentes as $id => $docente){
                                echo "<div class='well well-sm docentedrag drop-turma btn-fade' id='$id'>$docente->nome &nbsp".
                                "<button type='button' onclick='DescadastrarDocente(this)' class='btn btn-primary btn-xs' style='font-size: 15px; display: none;' id='$id'>x</button>".
                                "</div>";
                            }
                            ?>
                        </div>
                        <button type="button" class="btn btn-info btn-sm" style="width: 100%; margin-top: 10px;" id='btnMostrarDivDocente'>Adicionar Docente</button>
                    </div>

                    <!-- DIV CURSOS -->
                    <div class="panel panel-primary" id="cursoscol" title='Cursos'>
                        <div id='div-cursos' class="panel-body" style='z-index: 10; overflow-y: scroll; height: 300px;'>
                            <?php
                            //PREENCHE COM DOCENTES DO BANCO
                            $cursos = R::findAll('curso');
                            foreach ($cursos as $id => $curso){
                                echo "<div class='well well-sm cursodrag drop-turma btn-fade' id='$id'>$curso->nome".
                                "<button type='button' onclick='DescadastrarCurso(this)' class='btn btn-primary btn-xs' style='font-size: 15px; display: none;' id='$id'>x</button>".
                                "</div>";
                            }
                            ?>
                        </div>
                        <button type="button" class="btn btn-info btn-sm" style="width: 100%; margin-top: 10px;" id='btnMostrarDivCurso'>Adicionar Curso</button>
                    </div>

                    <!-- DIV HORARIO -->
                    <div class="panel panel-primary" id='horarioscol' title='HORÁRIOS' style='display: none;'>
                        <div class="panel-body" id='panelhorario'>
                            <div id='divhorario'>
                                <div class="well well-sm" style='float: left;'>
                                    Dia:
                                    <select id='dia'>
                                        <option value="1">Segunda-feira</option>
                                        <option value="2">Terça-feira</option>
                                        <option value="3">Quarta-feira</option>
                                        <option value="4">Quinta-feira</option>
                                        <option value="5">Sexta-feira</option>
                                        <option value="6">Sábado</option>
                                    </select>
                                    Inicio:
                                    <input class="text-horario" size="5" id='inicio'>
                                    Fim:<input class="text-horario" size="5" id='fim'>
                                    <button type="button" class="btn btn-success btn-xs btn-salva">✓</button>
                                    <button type="button" class="btn btn-danger btn-xs btn-remove">✖</button>
                                </div>
                            </div>
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
