<select id="drivers" >
	
</select>

<script type="text/javascript">
	$(document).ready(function() {
    		$('select').material_select();
	});

	function addDrivers(driver, id) {
			firebase.database().ref('drivers').once('value').then(function(snap) {
				if (snap.val() != null) {
					drivers = snap.val();
					var html = "";
					for (var key in snap.val()) {
						html += "<option value=" + key  + ">" +snap.val()[key] + "</option>"
					}
				}
			});
		}
</script>