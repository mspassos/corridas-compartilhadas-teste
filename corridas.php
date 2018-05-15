<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Teste - Corridas Compartilhadas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/materialize.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/5.0.2/firebase.js"></script>
    <script type="text/javascript" src="js/fire-runs.js"></script>
</head>
<body>
	<?php include_once "statics/header.php" ?>

	<table class="container">
		<thead>
			<tr>
				<th>Motorista</th>
				<th>Passageiro</th>
				<th>Valor da Corrida</th>
			</tr>
		</thead>
		<tbody id="table-body">
			<tr id="remove">
				<td colspan="3">
					<div class="progress center">
		      			<div class="indeterminate"></div>
		  			</div>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="fixed-action-btn">
		<a class="btn-floating btn-large waves-effect waves-light teal darken-1 btn modal-trigger" href="#modalCadastro">
			<i class="material-icons">add</i>
		</a>
	</div>

	<div id="modalCadastro" class="modal modal-fixed-footer">
   		<div class="modal-content">
   			<h4>Cadastro de Corrida</h4>
   			<p id="erro" style="color: red"></p>
   			<div class="row">
   				<form class="col s12">
   					<div class="row">
   						<div class="input-field col s12">
   							<select id="drivers">
   								<option value="" disabled selected>Escolha uma opção</option>
   							</select>
   							<label>Motorista</label>
   						</div>
   						<div class="input-field col s12">
   							<select id="passengers">
   								
   							</select>
   							<label>Passageiros</label>
   						</div>
   						<div class="input-field col s12">
   							<input type="text" id="price" required class="validate">
   							<label for="price">Valor da Corrida</label>
   						</div>
   					</div>
   				</form>
   			</div>
   		</div>
   		<div class="modal-footer">
   			<a onclick="save_run()" class="modal-action waves-effect waves-green btn-flat">Cadastrar</a>
   		</div>
   	</div>

   	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
    		$('select').material_select();
			$('.fixed-action-btn').openFAB();
			$('.fixed-action-btn').closeFAB();
			$('.modal').modal();
			$('#price').mask('99,99');
		});

		window.onload = function() {
			addDrivers();
			addPassenger();
			carregar();
		}
    </script>
</body>
</html>