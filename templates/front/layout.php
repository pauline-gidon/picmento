<?php 
if(!defined('DOMAINE')) die();


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">

        <!-- cookies osano -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
      
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta name="description" content="Toutes vos photos et videos conservées dans une capsule
     temporelle à partager avec vos proches ! N'hésitez plus et sauvegardez vos souvenirs en ligne">

	<title><?php if(isset($title)) echo $title; ?></title>
    <!-- lien favicon -->
    <link rel="icon" type="image/png" href="<?php echo DOMAINE; ?>templates/front/images/favicon.png" />
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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&display=swap" rel="stylesheet"> 
	<!-- <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">  -->
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="<?php echo DOMAINE; ?>templates/front/js/slideshow.js"></script>

	<!-- lien loader -->
	<script src="<?php echo DOMAINE; ?>templates/front/js/loader.js" defer></script>
    
	<!-- lien recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LefU_YaAAAAAH4NSe1qGr5kNh086h3QMfyWDRtR"></script>


	<!-- Le lien vers le CDN de jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



</head>

<body <?php if(isset($body_class)) echo "class=\"".$body_class."\""; ?>>
<!-- <div class="loader">
<img src="<?php echo DOMAINE; ?>templates/front/images/photo-loader-picmento.png" alt="loader">
</div> -->
	<header>
        <input type="checkbox" id="burger">
        <label for="burger">Menu</label>
        <a id="logo" href="<?php echo DOMAINE; ?>" title="Logo Souvenir">Picmento
        </a>
        <nav>
            <ul class="fc fw ai-c">
                
				<?php if(!isset($_SESSION["auth"])): ?>
					
				<li class="mla">
					<a href="<?php echo DOMAINE; ?>inscription" title="Inscription Picmento">
						Inscription
					</a>
				</li>

				<li>
					<a href="<?php echo DOMAINE; ?>connexion" title="Connexion Picmento">
						Connexion
					</a>
				</li>

				<?php else: if((isset($_SESSION["auth"]) && isset($_GET["id"]))){
                            //    header("location: amis-acceptation-".$_GET["id"]."");
                                }else{
                            //    header("location: afficher-tribu");
                                }  ?>
                			<li class="mla">
				<a class="" href="<?php echo DOMAINE; ?>afficher-tribu" title="Vos tribus">
                <i class="fas fa-users"></i>
                Mes tribus
					
				</a>
			</li>

			<li>
				<a class="iamis" href="<?php echo DOMAINE;?>amis" title="Amis">
				<i class="fas fa-user-friends iamis"></i>&nbsp;Amis
				</a>
			</li>
            <li >
				<a class="" href="<?php echo DOMAINE; ?>espace-perso" title="Votre espace personnel">
					<i class=" i-user fas fa-user-circle"></i>
					<?php
					if((isset($_SESSION["auth"]["pseudo"]))&&(!empty($_SESSION["auth"]["pseudo"]))){
						 echo $_SESSION["auth"]["pseudo"];
						}else{
						 echo $_SESSION["auth"]["prenom"];}?> 
					
				</a>
			</li>
				<li>
					<a href="<?php echo DOMAINE; ?>deconnexion" title="Déconnexion">
                    <i class="fas fa-sign-out-alt"></i>
                    Déconnexion
					</a>
				</li>
			<?php endif; ?>

			</ul>
		</nav>
	</header>
    <div id="imgBandeau">&nbsp;</div>
	<h1><?php if(isset($title)) echo $title; ?></h1>



	<div class="view"><?php if(isset($vue)) include($vue); ?></div>

		<footer id="bottom">
		
			<p class="fc fw jc-c ai-c">
            
                <a href="<?php echo DOMAINE; ?>contact" title="Contact Picmento">Contact</a>
                <span>|</span> 
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
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script>
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#64386b",
      "text": "#ffcdfd"
    },
    "button": {
      "background": "#f8a8ff",
      "text": "#3f0045"
    }
  },
  "content": {
    "message": "Ce site utilise des cookies pour offrir aux visiteurs une expérience de navigation bien meilleure et des services adaptés aux besoins et aux intérêts de chacun.",
    "dismiss": "J'ai compris !",
    "link": "En savoir plus",
    "href": "https://picmento.fr/politique-confidentialite"
  }
});
</script>
</body>

</html>

