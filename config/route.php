<?php
define("PTH","/picmento/site/");

/*LES PAGES DU FRONT*/
$route[] = [
	"url" 				=> PTH,
	"namespace" 	=> "Vendors",
	"module" 			=> "StaticPage",
	"action" 			=> "AfficherPresentation",
	"logged" 			=> false,
	"droits" 			=> null
];

$route[] = [
	"url" 				=> PTH."index.php",
	"namespace" 	=> "Vendors",
	"module" 			=> "StaticPage",
	"action" 			=> "AfficherPresentation",
	"logged" 			=> false,
	"droits" 			=> null
];





/*LE SEVICE UTILISATEUR*/
$route[] = [
	"url" 				=> PTH."inscription",
	"namespace" 	=> "ORM",
	"module" 			=> "User",
	"action" 			=> "InscrireCompte",
	"logged" 			=> false,
	"droits" 			=> null
];

$route[] = [
	"url" 				=> PTH."connexion",
	"namespace" 	=> "ORM",
	"module" 			=> "User",
	"action" 			=> "ConnecterCompte",
	"logged" 			=> false,
	"droits" 			=> null
];
$route[] = [
	"url" 				=> PTH."contact",
	"namespace" 	=> "Vendors",
	"module" 			=> "StaticPage",
	"action" 			=> "GererFormContact",
	"logged" 			=> false,
	"droits" 			=> null
];

$route[] = [
	"url"					=> PTH."activation-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "User", 
	"action"			=> "ActiverCompte",  
	"logged"			=> false, 
	"droits"			=> null
];

$route[]=	[
	"url"					=> PTH."nouvelle-activation",
	"namespace"		=> "ORM",
	"module"			=> "User",
	"action"			=> "NewActivation",
	"logged"			=> false,
	"droits"			=> null
];

$route[]=	[
	"url"					=> PTH."deconnexion",
	"namespace"		=> "ORM",
	"module"			=> "User",
	"action"			=> "LogOut",
	"logged"			=> true,
	"droits"			=> 1
];

$route[]=	[
	"url"					=> PTH."mot-passe-oublie",
	"namespace"		=> "ORM",
	"module"			=> "User",
	"action"			=> "NewMdp",
	"logged"			=> false,
	"droits"			=> null
];

$route[]=	[
	"url"					=> PTH."nouveau-mdp-([0-9]+)",
	"namespace"		=> "ORM",
	"module"			=> "User",
	"action"			=> "CreateMdp",
	"logged"			=> false,
	"droits"			=> null
];

$route[]=	[
	"url"					=> PTH."modifier-profil",
	"namespace"		=> "ORM",
	"module"			=> "User",
	"action"			=> "ModifierProfil",
	"logged"			=> true,
	"droits"			=> 1
];

$route[]=	[
	"url"					=> PTH."modifier-mdp",
	"namespace"		=> "ORM",
	"module"			=> "User",
	"action"			=> "ModifierMdp",
	"logged"			=> true,
	"droits"			=> 1
];

$route[]=	[
	"url"					=> PTH."supprimer-compte",
	"namespace"		=> "ORM",
	"module"			=> "User",
	"action"			=> "SupprimerCompte",
	"logged"			=> true,
	"droits"			=> 1
];

$route[]=	[
	"url"					=> PTH."suppression-compte",
	"namespace"		=> "ORM",
	"module"			=> "User",
	"action"			=> "SuppressionCompte",
	"logged"			=> true,
	"droits"			=> 1
];

$route[]=	[
	"url"					=> PTH."modifier-avatar",
	"namespace"		=> "ORM",
	"module"			=> "User",
	"action"			=> "ModifierAvatar",
	"logged"			=> true,
	"droits"			=> 1
];

$route[] = [
	"url"					=> PTH."espace-perso", 
	"namespace"		=> "ORM", 
	"module"			=> "User", 
	"action"			=> "AfficherEspacePerso",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"					=> PTH."associer-parent-tribu-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "User", 
	"action"			=> "AssocierParentTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"					=> PTH."annuler-demande-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "User", 
	"action"			=> "AnnulerDemande",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"					=> PTH."acceptation-tribu-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Amis", 
	"action"			=> "AcceptationAssociationTribu",  
	"logged"			=> false, 
	"droits"			=> null
];




//---------------------------------------------------service tribu

$route[] = [
	"url"					=> PTH."afficher-tribu", 
	"namespace"		=> "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "AfficherTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"					=> PTH."editer-tribu-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "EditerTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"					=> PTH."ajouter-tribu", 
	"namespace"		=> "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "AjouterTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"					=> PTH."ajouter-souvenir-tribu-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "AjouterSouvenirTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"					=> PTH."supprimer-tribu-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "SupprimerTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"					=> PTH."ajouter-baby-tribu-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Baby", 
	"action"			=> "AjouterBabyTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"				=> PTH."ajouter-souvenir-tribu-([0-9]+)", 
	"namespace"			=> "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "AjouterSouvenirTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

//------------------------------------------------------service souvenir

$route[] = [
	"url"					=> PTH."afficher-souvenirs-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Article", 
	"action"			=> "AfficherSouvenirsBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"					=> PTH."ajouter-souvenir-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Article", 
	"action"			=> "AjouterSouvenirBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"					=> PTH."editer-souvenir-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Article", 
	"action"			=> "EditerSouvenir",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"					=> PTH."ajouter-une-photo-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Article", 
	"action"			=> "AjouterPhoto",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"					=> PTH."editer-souvenir-photo-([0-9]+)-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Medias", 
	"action"			=> "EditerPhoto",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"					=> PTH."supprimer-souvenir-photo-([0-9]+)-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Medias", 
	"action"			=> "SupprimerPhoto",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"					=> PTH."visible-souvenir-([0-9]+)-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Article", 
	"action"			=> "VisibleSouvenir",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"					=> PTH."supprimer-souvenir-([0-9]+)-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Article", 
	"action"			=> "SupprimerSouvenir",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"					=> PTH."ajouter-commentaire-souvenir-([0-9]+)-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Commentaire", 
	"action"			=> "AjouterCommentaire",  
	"logged"			=> true, 
	"droits"			=> 1
];

//---------------------------------------------------service naissance

$route[] = [
	"url"					=> PTH."afficher-naissance-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Baby", 
	"action"			=> "AfficherNaissanceBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];

//------------------------------------------------- Service baby
$route[] = [
	"url"					=> PTH."modifier-baby-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Baby", 
	"action"			=> "EditerBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"					=> PTH."modifier-photo-baby-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Baby", 
	"action"			=> "EditerPhotoBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"					=> PTH."supprimer-baby-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Baby", 
	"action"			=> "SupprimerBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];
//------------------------------------------------------service timline

$route[] = [
	"url"					=> PTH."afficher-timeline-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Timeline", 
	"action"			=> "AfficherTimelineBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"					=> PTH."ajouter-timeline-([0-9]+)", 
	"namespace"		=> "ORM", 
	"module"			=> "Timeline", 
	"action"			=> "AjouterTimelineBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];







return $route;