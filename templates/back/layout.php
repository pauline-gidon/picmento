<?php if(!defined('DOMAINE')) die();?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title><?php if(isset($title)) echo $title; ?></title>
    <link rel="icon" type="image/png" href="<?php echo DOMAINE; ?>templates/front/images/favicon.png" />

	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/back/css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/back/css/starter.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/back/css/design.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/back/css/responsive.css">
	<!-- lien pour les fonts icone -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> 
	<link rel="stylesheet" href="<?php echo DOMAINE; ?>templates/back/css/icofont/icofont.min.css">
	<!-- lien pour la typo -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&display=swap" rel="stylesheet"> 

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"> 



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo DOMAINE; ?>templates/back/js/traitBaby.js" defer></script>
	<script src="<?php echo DOMAINE; ?>templates/back/datetimepicker/datetimepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/back/datetimepicker/datetimepicker.css">

</head>

<body <?php if(isset($body_class)) echo "class=\"".$body_class."\"" ?> >
<header>
	<input type="checkbox" id="burger">
	<label for="burger">Menu</label>
	<a id="logo" href="<?php echo DOMAINE; ?>afficher-tribu" title="Logo Souvenir">Picmento
	</a>
	<nav>
		<ul class="fc wrap fw">
				
			<?php if(!isset($_SESSION["auth"])): ?>
				
			<li>
				<a href="<?php echo DOMAINE; ?>inscription" title="Inscription WOW">
					Inscription
				</a>
			</li>

			<li>
				<a href="<?php echo DOMAINE; ?>connexion" title="Connexion WOW">
					Connexion
				</a>
			</li>

			<?php else: ?>

			<li class="mla">
				<a href="<?php echo DOMAINE; ?>espace-perso" title="Votre espace personnel">
					<i class=" i-user fas fa-user-circle"></i>
					<?php
					if((isset($_SESSION["auth"]["pseudo"]))&&(!empty($_SESSION["auth"]["pseudo"]))){
						 echo $_SESSION["auth"]["pseudo"];
						}else{
						 echo $_SESSION["auth"]["prenom"];}?> 
					
				</a>
			</li>
			<li>
				<a class="iamis" href="<?php echo DOMAINE; ?>amis" title="Amis">
				<i class="fas fa-user-friends iamis"></i>&nbsp;Amis
				</a>
			</li>

			<li>
				<a href="<?php echo DOMAINE; ?>deconnexion" title="Déconnexion">
					Déconnexion
				</a>
			</li>
		</ul>
		<?php endif; ?>
	</nav>

</header>

<hgroup class="vue">
	<h1><?php if(isset($title)) echo $title; ?></h1>
</hgroup>

	

<div class="content"><?php if(isset($vue)) include($vue); ?></div>




<footer id="bottom">
	<div>
		<p class="fc fw jc-c ai-c">
			<a href="<?php echo DOMAINE; ?>mentions-legales" title="Mentions légales">
				Mentions légales
			</a> 
			| 
			<a href="<?php echo DOMAINE; ?>politique-confidentialite" title="Politique de confidentialité">
				Politique de confidentialité
			</a> 
			| 
			<a href="<?php echo DOMAINE; ?>cgu" title="Conditions Générales d'Utilisation">
				Conditions Générales d'Utilisation
			</a>
		</p>
	</div>
</footer>

</body>
</html>