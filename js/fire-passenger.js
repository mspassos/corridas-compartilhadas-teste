var config = {
    apiKey: "AIzaSyBW6DBsrsCm1UJP_pTFsWnzAUuK366NI5s",
    authDomain: "matheus-teste-3257a.firebaseapp.com",
    databaseURL: "https://matheus-teste-3257a.firebaseio.com",
    projectId: "matheus-teste-3257a",
    storageBucket: "matheus-teste-3257a.appspot.com",
    messagingSenderId: "420700656247"
};
firebase.initializeApp(config);

var idPassenger = 0;

firebase.database().ref('passenger').once('value').then(function(snap) {
	if (snap.val() !== null) {
		idPassenger = snap.val().length;
	}
});

function save_passenger() {
	var genre;

	if (document.getElementById('masculino').checked) {
		genre = 'Masculino';
	} else {
		genre = 'Feminino';
	}

	var passenger = {
		id: idPassenger,
		name: document.getElementById('name').value,
		birth: document.getElementById('birth').value,
		cpf: document.getElementById('cpf').value,
		genre: genre
	};

	if (validate(passenger)) {
		firebase.database().ref('passengers/' + passenger.id).set({
			name: passenger.name,
			birth: passenger.birth,
			cpf: passenger.cpf,
			genre: passenger.genre
		});

		window.location = 'passageiros.php';
	} else {
		document.getElementById('erro').innerHTML = "Preencha todos os campos!";
	}
}

function validate(passenger) {
	if (passenger.name == "" || passenger.name == null) {
		return false;
	} else if (passenger.birth == "" || passenger.birth == null) {
		return false;
	} else if (passenger.cpf == "" || passenger.cpf == null) {
		return false;
	} else if (passenger.genre == "" || passenger.genre == null) {
		return false;
	}

	return true;
}