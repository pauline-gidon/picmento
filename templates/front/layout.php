<?php 
if(!defined('DOMAINE')) die();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title><?php if(isset($title)) echo $title; ?></title>

	<!-- Nos feuilles de style -->
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE ?>templates/front/css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE ?>templates/front/css/starter.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE ?>templates/front/css/design.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE ?>templates/front/css/responsive.css">
	<!-- Le lien vers fontawesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- lien vers les fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"> 
	<!-- <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">  -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/picmento/site/templates/front/js/slideshow.js"></script>


	<!-- Le lien vers le CDN de jQuery -->

</head>

<body <?php if(isset($body_class)) echo "class=\"".$body_class."\""; ?>>
	<header>
        <input type="checkbox" id="burger">
        <label for="burger">Menu</label>
        <a id="logo" href="<?php echo DOMAINE; ?>" title="Logo Souvenir">Picmento
        </a>
        <nav>
            <ul class="fc wrap fw ai-c">
                <li  class="mla">
                    <a href="<?php echo DOMAINE; ?>contact" title="Contact Picmento">Contact</a>
                </li>
				<?php if(!isset($_SESSION["auth"])): ?>
					
				<li>
					<a href="<?php echo DOMAINE; ?>inscription" title="Inscription Picmento">
						Inscription
					</a>
				</li>

				<li>
					<a href="<?php echo DOMAINE; ?>connexion" title="Connexion Picmento">
						Connexion
					</a>
				</li>

				<?php else: ?>

				<li>
					<a href="<?php echo DOMAINE; ?>deconnexion" title="Déconnexion">
						Déconnexion
					</a>
				</li>
			<?php endif; ?>

			</ul>
		</nav>
	</header>
    <div id="imgBandeau">&nbsp;</div>
	<h1><?php if(isset($title)) echo $title; ?></h1>


	<div><?php if(isset($vue)) include($vue); ?></div>

		<footer id="bottom">
		
			<p class="fc fw jc-c ai-c">
				<a href="<?php echo DOMAINE; ?>mentions-legales" title="Mentions légales">
					Mentions légales
				</a> 
                <span>|</span> 
				<a href="<?php echo DOMAINE; ?>politique-confidentialite" title="Politique de confidentialité">
					Politique de confidentialité
				</a> 
				<span id="pipe">|</span> 
				<a href="<?php echo DOMAINE; ?>cgu" title="Conditions Générales d'Utilisation">
					Conditions Générales d'Utilisation
				</a>
			</p>

	</footer>

</body>

</html>