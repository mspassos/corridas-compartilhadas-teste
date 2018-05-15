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
    <script type="text/javascript" src="js/fire-passenger.js"></script>
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
			</tr>
		</thead>
		<tbody id="table-body">
			<tr id="remove">
        <td colspan="4">
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
   			<h4>Cadastro de Passageiro</h4>
   			<p id="erro" style="color: red"></p>
   			<div class="row">
   				<form class="col s12">
   					<div class="row">
   						<div class="input-field col s12">
   							<input type="text" id="name" class="validate" required="required"/>
   							<label for="name">Nome do Passageiro</label>
   						</div>
   						<div class="input-field col s12">
   							<input type="text" id="cpf" class="validate" required="required"/>
   							<label for="cpf">CPF:</label>
   						</div>
   						<div class="input-field col s12">
	   						<label for="birth">Data de Nascimento:</label>   						
	   						<input type="text" id="birth" class="validate" required="required"/>
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
   			<a onclick="save_passenger()" class="modal-action waves-effect waves-green btn-flat">Cadastrar</a>
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

      var passengers;

      firebase.database().ref('passengers').once('value').then(function(snap) {
        if (snap.val() != null) {
          passengers = snap.val();
          for (var i = 0; i < snap.val().length; i++) {
            var passenger = snap.val()[i];
            addElement(passenger, i);
          }
          var node = document.getElementById('remove').remove();
        }
      });

      function addElement(driver, indice) {
        var tableBody = document.getElementById('table-body');
        tableBody.innerHTML += "<tr id=\"" + indice + "\"></tr>"
        var tr = document.getElementById(indice);
        tr.innerHTML += "<td>" + driver.name + "</td>";
        tr.innerHTML += "<td>" + driver.cpf + "</td>";
        tr.innerHTML += "<td>" + driver.birth + "</td>";
        tr.innerHTML += "<td>" + driver.genre + "</td>";
      }
    </script>
  </body>
</html>