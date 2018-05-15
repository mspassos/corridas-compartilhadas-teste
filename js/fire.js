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
var idPassenger = 0;

firebase.database().ref('drivers').once('value').then(function(snap) {
	if (snap.val() !== null) {
		idDriver = snap.val().length;
	}
});

function save_driver() {
	var driver = {
		id: idDriver,
		name: document.getElementById('name').value,
		birth: document.getElementById('birth').value,
		cpf: document.getElementById('cpf').value,
		car: document.getElementById('car').value,
		genre: document.getElementById('genre').value
	};

	firebase.database().ref('drivers/' + driver.id).set({
		name: driver.name,
		birth: driver.birth,
		cpf: driver.cpf,
		car: driver.car,
		status: true,
		genre: driver.genre
	});
}

function save_passenger() {
	var passenger = {
		id: idPassenger,
		name: document.getElementById('name').value,
		birth: document.getElementById('birth').value,
		cpf: document.getElementById('cpf').value,
		genre: document.getElementById('genre').value
	};

	firebase.database().ref('passenger/' + passenger.id).set({
		name: passenger.name,
		birth: passenger.birth,
		cpf: passenger.cpf,
		genre: passenger.genre
	});
}