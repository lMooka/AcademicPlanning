<html>
<head>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <script src="/js/draganddrop.js"></script>
  <script src="/js/jquery.mask.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  </head>

<body>

<table class="table table-striped table-hover" style="border-style: solid;border-width: 2px;width: 80%;">
	<tr>
		<th>Disciplina</th> <th>Curso</th>	<th>Seg</th>	<th>Ter</th>	<th>Qua</th>	<th>Qui</th>	<th>Sex</th>	<th>Docente</th>	<th>CR</th>	<th>Nome Disciplina</th>
		<tr><td>MAT992</td>	<td>BCC</td>	<td></td>	<td>15:00-17:00</td>	<td></td>	<td>15:00-17:00</td>	<td></td>	<td>Lol Lol Lol</td>	<td>2</td>	<td>Programação III</td></tr>
	</tr>
</table>

<div class="bs-docs-section">

<div class="page-header">
<div class="col-lg-2">
<div class="bs-component" >
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Matérias</h3>
		</div>
		
		<div class="panel-body">
			<div class="well well-sm materiadrag" id='matc84'>
			MATC84
			</div>
		</div>
	</div>
	</div>
</div>


<div class="col-lg-2">
<div class="bs-component" >
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Docentes</h3>
		</div>
		
		<div class="panel-body">
			<div class="well well-sm docentedrag drop-turma" id='150'>
			Fred Durão
			</div>
		</div>
	</div>
	</div>
</div>

<div class="col-lg-2">
<div class="bs-component" >
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Horário</h3>
		</div>
		
		<div class="panel-body" id='panelhorario'>
			<button type="button" class="btn btn-primary" id='addhorario'>Adicionar</button>
			
		</div>
	</div>
	</div>
</div>


</div>
</div>
</body>
</html>