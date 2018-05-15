var config = {
    apiKey: "AIzaSyBW6DBsrsCm1UJP_pTFsWnzAUuK366NI5s",
    authDomain: "matheus-teste-3257a.firebaseapp.com",
    databaseURL: "https://matheus-teste-3257a.firebaseio.com",
    projectId: "matheus-teste-3257a",
    storageBucket: "matheus-teste-3257a.appspot.com",
    messagingSenderId: "420700656247"
};
firebase.initializeApp(config);

var idCorrida = 0;
var drivers;
var passengers;

function carregar() {
	firebase.database().ref('runs').once('value').then(function(snap) {
		if (snap.val() != null) {
			idCorrida = snap.val().length;
			for (var i in snap.val()) {
				var run = snap.val()[i];
				addElement(run, i);
			}
			var node = document.getElementById('remove').remove();
		}
	});
}

function addElement(run, id) {
	var tableBody = document.getElementById('table-body');
	tableBody.innerHTML += "<tr id=\"" + id + "\"></tr>"
	var tr = document.getElementById(id);
	
	var driver = drivers[run.driver];
	var passenger = passengers[run.passenger];

	if (driver.status) {
		tr.innerHTML += "<td>" + driver.name + "</td>";
		tr.innerHTML += "<td>" + passenger.name + "</td>";
		tr.innerHTML += "<td>R$ " + run.price + "</td>";
	}
}

function addDrivers() {
	firebase.database().ref('drivers').once('value').then(function(snap) {
		if (snap.val() != null) {
			drivers = snap.val();
			var html = "<option value disabled selected>Escolha uma opção</option>";
			for (var key in snap.val()) {
				html += "<option value=" + key  + ">" +snap.val()[key].name + "</option>"
			}
			document.getElementById('drivers').innerHTML = html;
			$('select').material_select();
		}
	});
}

function addPassenger() {
	firebase.database().ref('passengers').once('value').then(function(snap) {
		if (snap.val() != null) {
			passengers = snap.val();
			var html = "<option value disabled selected>Escolha uma opção</option>";
			for (var key in snap.val()) {
				html += "<option value=" + key  + ">" +snap.val()[key].name + "</option>"
			}
			document.getElementById('passengers').innerHTML = html;
			$('select').material_select();
		}
	});
}

function save_run() {
	var selectMotorista = document.getElementById('drivers');
	var idMotorista = selectMotorista.options[selectMotorista.selectedIndex].value;
	var selectPassegeiro = document.getElementById('passengers');
	var idPassageiro = selectPassegeiro.options[selectPassegeiro.selectedIndex].value;
	var valorCorrida = document.getElementById('price').value;

	var run = {
		id: idCorrida,
		driver: idMotorista,
		passenger: idPassageiro,
		price: valorCorrida
	};

	if (validate(run)) {
		firebase.database().ref('runs/' + run.id).set({
			driver: run.driver,
			passenger: run.passenger,
			price: run.price,
		});

		window.location = 'corridas.php';
	} else {
		document.getElementById('erro').innerHTML = "Preencha todos os campos!";
	}
}

function validate(run) {
	if (run.driver == "" || run.driver == null) {
		return false;
	} else if (run.passenger == "" || run.passenger == null) {
		return false;
	} else if (run.price == "" || run.price == null) {
		return false;
	}

	return true;
}