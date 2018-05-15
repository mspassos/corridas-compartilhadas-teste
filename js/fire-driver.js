var config = {
    apiKey: "AIzaSyBW6DBsrsCm1UJP_pTFsWnzAUuK366NI5s",
    authDomain: "matheus-teste-3257a.firebaseapp.com",
    databaseURL: "https://matheus-teste-3257a.firebaseio.com",
    projectId: "matheus-teste-3257a",
    storageBucket: "matheus-teste-3257a.appspot.com",
    messagingSenderId: "420700656247"
};
firebase.initializeApp(config);

var idDriver = 0;

firebase.database().ref('drivers').once('value').then(function(snap) {
	if (snap.val() !== null) {
		idDriver = snap.val().length;
	}
});

function save_driver() {
	var genre;

	if (document.getElementById('masculino').checked) {
		genre = 'Masculino';
	} else {
		genre = 'Feminino';
	}

	var driver = {
		id: idDriver,
		name: document.getElementById('name').value,
		birth: document.getElementById('birth').value,
		cpf: document.getElementById('cpf').value,
		car: document.getElementById('car').value,
		genre: genre
	};

	if (validate(driver)) {
		firebase.database().ref('drivers/' + driver.id).set({
			name: driver.name,
			birth: driver.birth,
			cpf: driver.cpf,
			car: driver.car,
			status: true,
			genre: driver.genre
		});

		window.location = 'motoristas.php';
	} else {
		document.getElementById('erro').innerHTML = "Preencha todos os campos!";
	}
}

function atualizar_driver() {
	let id = document.getElementById('id').value;
	let status;
	if (document.getElementById('ativo').checked) {
		status = true;
	} else {
		status = false;
	}
	let driver = drivers[id];
	firebase.database().ref('drivers/' + id).set({
		name: driver.name,
		birth: driver.birth,
		cpf: driver.cpf,
		car: driver.car,
		status: status,
		genre: driver.genre
	});
	
	window.location = 'motoristas.php';
}

function validate(driver) {
	console.log(driver);

	if (driver.name == "" || driver.name == null) {
		return false;
	} else if (driver.birth == "" || driver.birth == null) {
		return false;
	} else if (driver.cpf == "" || driver.cpf == null) {
		return false;
	} else if (driver.car == "" || driver.car == null) {
		return false;
	} else if (driver.genre == "" || driver.genre == null) {
		return false;
	}

	return true;
}