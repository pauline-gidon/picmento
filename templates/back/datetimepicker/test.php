<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="datetimepicker.css">

<script>
$(function(){
	$(".flatpickr").flatpickr({
		dateFormat: "d/m/Y H:i:",
		enableTime: true,
		time_24hr: true
	});	
	
});
</script>
</head>

<body>
<p>
<input class="flatDate flatpickr flatpickr-input active" placeholder="Sélectionnez" data-id="datetime" readonly type="text">
</p>

</body>
</html>