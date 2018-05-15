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
    <script type="text/javascript" src="js/fire-driver.js"></script>
</head>
<body>
	<?php include_once "statics/header.php" ?>
	<table class="container">
		<thead>
			<tr>
				<th>Nome</th>
				<th>CPF</th>
				<th>Data de Nascimento</th>
				<th>Sexo</th>
				<th>Carro</th>
				<th>Status</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody id="table-body">
			<tr id="remove">
				<td colspan="7">
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
   			<h4>Cadastro de Motorista</h4>
   			<p id="erro" style="color: red"></p>
   			<div class="row">
   				<form class="col s12">
   					<div class="row">
   						<div class="input-field col s12">
   							<input type="text" id="name" class="validate" required="required"/>
   							<label for="name">Nome do Motorista</label>
   						</div>
   						<div class="input-field col s12">
   							<input type="text" id="cpf" class="validate" required="required"/>
   							<label for="cpf">CPF:</label>
   						</div>
   						<div class="input-field col s12">
	   						<label for="birth">Data de Nascimento:</label>   						
	   						<input type="text" id="birth" class="validate" required="required"/>
	   					</div>
   						<div class="input-field col s12">
   							<input type="text" id="car" class="validate" required="required"/>
   							<label for="car">Carro</label>
   						</div>
   						<p>Sexo:</p>
   						<p>
   							<input type="radio" name="sexo" id="masculino" checked="checked" />
   							<label for="masculino">Masculino</label>
   						</p>
   						<p>
   							<input type="radio" name="sexo" id="feminino"  />
   							<label for="feminino">Feminino</label>
   						</p>
   						<input type="hidden" id="genre" value="" />
   					</div>
   				</form>
   			</div>
   		</div>
   		<div class="modal-footer">
   			<a onclick="save_driver()" class="modal-action waves-effect waves-green btn-flat">Cadastrar</a>
   		</div>
   	</div>

   	<div id="modalAtualizar" class="modal">
   		<div class="modal-content">
   			<h4 id="title-modal"></h4>
   			<div class="row">
   				<div class="switch">
   					<form>
   						<p>
   							<input type="radio" name="status" id="ativo">
   							<label for="ativo">Ativo</label>
   						</p>
   						<p>
   							<input type="radio" name="status" id="inativo">
   							<label for="inativo">Inativo</label>
   						</p>
   						<input type="hidden" id="id" value="" />
   					</form>
   				</div>
   			</div>
   		</div>
   		<div class="modal-footer">
   			<a onclick="atualizar_driver()" class="modal-action waves-effect waves-green btn-flat">Atualizar</a>
   		</div>
   	</div>

   	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#birth').mask('99/99/9999');
			$('#cpf').mask('999.999.999-99');
			$('.fixed-action-btn').openFAB();
			$('.fixed-action-btn').closeFAB();
			$('.modal').modal();
		});

		var drivers;

		firebase.database().ref('drivers').once('value').then(function(snap) {
			if (snap.val() != null) {
				drivers = snap.val();
				for (var i = 0; i < snap.val().length; i++) {
					var driver = snap.val()[i];
					addElement(driver, i);
					var node = document.getElementById('remove').remove();
				}
			}
		});

		function addElement(driver, indice) {
			var tableBody = document.getElementById('table-body');
			tableBody.innerHTML += "<tr id=\"" + indice + "\"></tr>"
			var tr = document.getElementById(indice);
			var status;
			if (driver.status) {
				status = "Ativo";
			} else {
				status = "Inativo";
			}

			tr.innerHTML += "<td>" + driver.name + "</td>";
			tr.innerHTML += "<td>" + driver.cpf + "</td>";
			tr.innerHTML += "<td>" + driver.birth + "</td>";
			tr.innerHTML += "<td>" + driver.genre + "</td>";
			tr.innerHTML += "<td>" + driver.car + "</td>";
			tr.innerHTML += "<td>" + status + "</td>";
			tr.innerHTML += "<td><a class=\"modal-trigger\" href=\"#modalAtualizar\" id=\"" + indice + "\" onclick=\"edit_driver(" + indice + ")\"><i class=\"material-icons\">edit</i></a>";
		}

		function edit_driver(id) {
			let driver = drivers[id];
			document.getElementById('id').value = id;
			document.getElementById('title-modal').innerHTML = 'Atualizar Status - ' + driver.name;
			if (driver.status) {
				document.getElementById('ativo').checked = "checked";
			} else {
				document.getElementById('inativo').checked = "checked";
			}
		}
	</script>
</body>
</html>