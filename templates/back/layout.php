<?php if(!defined('DOMAINE')) die();?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title><?php if(isset($title)) echo $title; ?></title>
    <link rel="icon" type="image/png" href="<?php echo DOMAINE; ?>templates/front/images/favicon.png" />

	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/back/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/back/css/starter.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/back/css/design.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/back/css/responsive.css" />
	<!-- lien pour les fonts icone -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" /> 
	<link rel="stylesheet" href="<?php echo DOMAINE; ?>templates/back/css/icofont/icofont.min.css" />
	<!-- lien pour la typo -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&display=swap" rel="stylesheet" /> 
    
	<link rel="preconnect" href="https://fonts.gstatic.com" />
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"> 
    
    
	<!-- lien pour le WYSIWYG -->
    <script src="<?php echo DOMAINE; ?>templates/back/ckeditor/ckeditor.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- pour le slider year -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <!--  le trait nav baby -->
    <script src="<?php echo DOMAINE; ?>templates/back/js/traitBaby.js" defer></script>

    <!--  pour les dates de formulaire -->
	<script src="<?php echo DOMAINE; ?>templates/back/datetimepicker/datetimepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/back/datetimepicker/datetimepicker.css">

    <!-- lien loader -->
	<script src="<?php echo DOMAINE; ?>templates/front/js/loader.js" defer></script>

    <!-- lien Recaptcha antispam -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LefU_YaAAAAAH4NSe1qGr5kNh086h3QMfyWDRtR"></script>
    
    <!-- lien carousel -->
    <link type="text/css" rel="stylesheet" href="magicscroll/magicscroll.css"/>
    <script type="text/javascript" src="magicscroll/magicscroll.js"></script>
</head>

<body <?php if(isset($body_class)) echo "class=\"".$body_class."\"" ?> >
<!-- <div class="loader">
<img src="<?php echo DOMAINE; ?>templates/front/images/photo-loader-picmento.png" alt="loader">
</div> -->
<header>
	<input type="checkbox" id="burger">
	<label for="burger">Menu</label>
	<a id="logo" href="<?php echo DOMAINE; ?>" title="Retour accueil">Picmento
	</a>
	<nav>
		<ul class="fc wrapH fw ai-c">
				
			<?php if(!isset($_SESSION["auth"])): ?>
				
			<li class="mla">
				<a href="<?php echo DOMAINE; ?>inscription" title="Inscription picmento">
					Inscription
				</a>
			</li>

			<li>
				<a href="<?php echo DOMAINE; ?>connexion" title="Connexion picmento">
					Connexion
				</a>
			</li>

			<?php else: ?>

			<li class="mla">
				<a class="<?php
                if(isset($_SERVER['HTTPS'])){ 
                    $url = "https://".$_SERVER["SERVER_NAME"].$_SERVER['REDIRECT_URL'];
                }else{
                    $url = "http://".$_SERVER["SERVER_NAME"].$_SERVER['REDIRECT_URL'];
                }

                if ((preg_match('|'.DOMAINE.'(?!ami)(.*)tribu(.*)|', $url, $matches))){
                    echo ' focus';
                }
                ?>" href="<?php echo DOMAINE; ?>afficher-tribu" title="Vos tribus">
                <i class="fas fa-users"></i>
                Mes tribus
					
				</a>
			</li>

			<li>
				<a class="iamis<?php
                if(isset($_SERVER['HTTPS'])){ 
                    $url = "https://".$_SERVER["SERVER_NAME"].$_SERVER['REDIRECT_URL'];
                }else{
                    $url = "http://".$_SERVER["SERVER_NAME"].$_SERVER['REDIRECT_URL'];
                }

                if (preg_match('|'.DOMAINE.'ami(s?)(.*)|', $url, $matches)) {
                    echo ' focus';
                }
                ?>" href="<?php echo DOMAINE;?>amis" title="Amis">
				<i class="fas fa-user-friends iamis"></i>&nbsp;Amis
				</a>
			</li>
            <li >
				<a class="
                <?php
                if(isset($_SERVER['HTTPS'])){ 
                    $url = "https://".$_SERVER["SERVER_NAME"].$_SERVER['REDIRECT_URL'];
                }else{
                    $url = "http://".$_SERVER["SERVER_NAME"].$_SERVER['REDIRECT_URL'];
                }

                if ((preg_match('|'.DOMAINE.'espace(.*)|', $url, $matches))||(preg_match('|'.DOMAINE.'modifier(.*)|', $url, $matches))) {
                    echo ' focus';
                }
                ?>
                " href="<?php echo DOMAINE; ?>espace-perso" title="Votre espace personnel">
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
                <i class="fas fa-sign-out-alt"></i>&nbsp;Déconnexion
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

</body>
</html>