<?php
if(!defined('DOMAINE')) include_once("../config/settings.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>404</title>
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/front/css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/front/css/404.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Dosis&family=Montserrat&display=swap" rel="stylesheet"> </head>

<body>
	<h1>Page introuvable</h1>
	<h2>Erreur&nbsp;404</h2>
	<p id="oups">Oups c'est embarrassant, il semblerait que cette page n'existe pas ou n'existe plus.</p>
	<a href="<?php echo DOMAINE; ?>" title="Retourner au site"><img src="<?php echo DOMAINE; ?>templates/front/images/tigrec.png" alt="Continuer"></a>
</body>
</html>