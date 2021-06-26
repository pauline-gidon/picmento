<?php
define("PTH","/picmento/site/");

/*LES PAGES DU FRONT*/
$route[] = [
	"url" 				=> PTH,
	"namespace" 	    => "Vendors",
	"module" 			=> "StaticPage",
	"action" 			=> "AfficherPresentation",
	"logged" 			=> false,
	"droits" 			=> null
];

$route[] = [
	"url" 				=> PTH."index.php",
	"namespace" 	    => "Vendors",
	"module" 			=> "StaticPage",
	"action" 			=> "AfficherPresentation",
	"logged" 			=> false,
	"droits" 			=> null
];





/*LE SEVICE UTILISATEUR*/
$route[] = [
	"url" 				=> PTH."inscription",
	"namespace" 	    => "ORM",
	"module" 			=> "User",
	"action" 			=> "InscrireCompte",
	"logged" 			=> false,
	"droits" 			=> null
];

$route[] = [
	"url" 				=> PTH."connexion",
	"namespace"     	=> "ORM",
	"module" 			=> "User",
	"action" 			=> "ConnecterCompte",
	"logged" 			=> false,
	"droits" 			=> null
];
$route[] = [
	"url" 				=> PTH."contact",
	"namespace" 	    => "Vendors",
	"module" 			=> "StaticPage",
	"action" 			=> "GererFormContact",
	"logged" 			=> false,
	"droits" 			=> null
];

$route[] = [
	"url"				=> PTH."activation-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "User", 
	"action"			=> "ActiverCompte",  
	"logged"			=> false, 
	"droits"			=> null
];

$route[]=	[
	"url"				=> PTH."nouvelle-activation",
	"namespace"		    => "ORM",
	"module"			=> "User",
	"action"			=> "NewActivation",
	"logged"			=> false,
	"droits"			=> null
];

$route[]=	[
	"url"				=> PTH."deconnexion",
	"namespace"		    => "ORM",
	"module"			=> "User",
	"action"			=> "LogOut",
	"logged"			=> true,
	"droits"			=> 1
];

$route[]=	[
	"url"				=> PTH."mot-passe-oublie",
	"namespace"		    => "ORM",
	"module"			=> "User",
	"action"			=> "NewMdp",
	"logged"			=> false,
	"droits"			=> null
];

$route[]=	[
	"url"				=> PTH."nouveau-mdp-([0-9]+)",
	"namespace"		    => "ORM",
	"module"			=> "User",
	"action"			=> "CreateMdp",
	"logged"			=> false,
	"droits"			=> null
];

$route[]=	[
	"url"				=> PTH."modifier-profil",
	"namespace"		    => "ORM",
	"module"			=> "User",
	"action"			=> "ModifierProfil",
	"logged"			=> true,
	"droits"			=> 1
];

$route[]=	[
	"url"				=> PTH."modifier-mdp",
	"namespace"		    => "ORM",
	"module"			=> "User",
	"action"			=> "ModifierMdp",
	"logged"			=> true,
	"droits"			=> 1
];

$route[]=	[
	"url"				=> PTH."supprimer-compte",
	"namespace"		    => "ORM",
	"module"			=> "User",
	"action"			=> "SupprimerCompte",
	"logged"			=> true,
	"droits"			=> 1
];

$route[]=	[
	"url"				=> PTH."suppression-compte",
	"namespace"		    => "ORM",
	"module"			=> "User",
	"action"			=> "SuppressionCompte",
	"logged"			=> true,
	"droits"			=> 1
];

$route[]=	[
	"url"				=> PTH."modifier-avatar",
	"namespace"		    => "ORM",
	"module"			=> "User",
	"action"			=> "ModifierAvatar",
	"logged"			=> true,
	"droits"			=> 1
];

$route[] = [
	"url"				=> PTH."espace-perso", 
	"namespace"		    => "ORM", 
	"module"			=> "User", 
	"action"			=> "AfficherEspacePerso",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."associer-parent-tribu-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "User", 
	"action"			=> "AssocierParentTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"				=> PTH."annuler-demande-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "User", 
	"action"			=> "AnnulerDemande",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."amis-acceptation-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Amis", 
	"action"			=> "AcceptationAmis",  
	"logged"			=> false, 
	"droits"			=> null
];
$route[] = [
	"url"				=> PTH."parent-acceptation-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Amis", 
	"action"			=> "AcceptationParent",  
	"logged"			=> false, 
	"droits"			=> null
];




//---------------------------------------------------service tribu

$route[] = [
	"url"				=> PTH."afficher-tribu", 
	"namespace"	    	=> "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "AfficherTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"				=> PTH."editer-tribu-([0-9]+)", 
	"namespace"	    	=> "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "EditerTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"				=> PTH."ajouter-tribu", 
	"namespace"		    => "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "AjouterTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."ajouter-souvenir-tribu-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "AjouterSouvenirTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"				=> PTH."supprimer-tribu-([0-9]+)", 
	"namespace"	    	=> "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "SupprimerTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"				=> PTH."ajouter-baby-tribu-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Baby", 
	"action"			=> "AjouterBabyTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"				=> PTH."amis-ajouter-souvenir-tribu-([0-9]+)", 
	"namespace"			=> "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "AjouterSouvenirTribuAmis",  
	"logged"			=> true, 
	"droits"			=> 1
];

//------------------------------------------------------service souvenir

$route[] = [
	"url"				=> PTH."afficher-souvenirs-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Article", 
	"action"			=> "AfficherSouvenirsBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"				=> PTH."ajouter-souvenir-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Article", 
	"action"			=> "AjouterSouvenirBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."editer-souvenir-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Article", 
	"action"			=> "EditerSouvenir",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."ajouter-photo-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Article", 
	"action"			=> "AjouterPhoto",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."ajouter-photos-souvenir-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Article", 
	"action"			=> "AjouterPhotosSouvenir",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."tribu-ajouter-photos-souvenir-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "AjouterPhotosSouvenirTribu",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."editer-souvenir-photo-([0-9]+)-([0-9]+)-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Medias", 
	"action"			=> "EditerPhoto",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."supprimer-souvenir-photo-([0-9]+)-([0-9]+)-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Medias", 
	"action"			=> "SupprimerPhoto",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."visible-souvenir-([0-9]+)-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Article", 
	"action"			=> "VisibleSouvenir",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."supprimer-souvenir-([0-9]+)-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Article", 
	"action"			=> "SupprimerSouvenir",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."supprimer-souvenir-proposer-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Article", 
	"action"			=> "SupprimerSouvenirProposer",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."accepter-souvenir-proposer-([0-9]+)", 
	"namespace"	    	=> "ORM", 
	"module"			=> "Article", 
	"action"			=> "AccepterSouvenirProposer",  
	"logged"			=> true, 
	"droits"			=> 1
];
//--------------------------------------------------Service Commentaire
$route[] = [
	"url"				=> PTH."ajouter-commentaire-souvenir-([0-9]+)-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Commentaire", 
	"action"			=> "AjouterCommentaire",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."supprimer-commentaire-([0-9]+)-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Commentaire", 
	"action"			=> "SupprimerCommentaire",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."editer-commentaire-([0-9]+)-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Commentaire", 
	"action"			=> "EditerCommentaire",  
	"logged"			=> true, 
	"droits"			=> 1
];

//---------------------------------------------------service naissance

$route[] = [
	"url"				=> PTH."afficher-naissance-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Baby", 
	"action"			=> "AfficherNaissanceBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];

//------------------------------------------------- Service baby
$route[] = [
	"url"				=> PTH."modifier-baby-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Baby", 
	"action"			=> "EditerBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
    "url"				=> PTH."modifier-photo-baby-([0-9]+)", 
    "namespace"		    => "ORM", 
	"module"			=> "Baby", 
	"action"			=> "EditerPhotoBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"				=> PTH."supprimer-baby-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Baby", 
	"action"			=> "SupprimerBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];
//------------------------------------------------------service timline

$route[] = [
    "url"				=> PTH."afficher-timeline-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Timeline", 
	"action"			=> "AfficherTimelineBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
    "url"				=> PTH."ajouter-timeline-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Timeline", 
	"action"			=> "AjouterTimelineBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];

//------------------------------------------------------service amis
$route[] = [
    "url"				=> PTH."amis", 
	"namespace"		    => "ORM", 
	"module"			=> "Amis", 
	"action"			=> "AfficherAmis",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
    "url"				=> PTH."demande-ami", 
	"namespace"		    => "ORM", 
	"module"			=> "Amis", 
	"action"			=> "DemandeAmi",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
    "url"				=> PTH."amis-voir-tribu-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Tribu", 
	"action"			=> "VoirTribuAmis",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
	"url"				=> PTH."ami-afficher-souvenirs-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Article", 
	"action"			=> "AmisAfficherSouvenirsBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."ami-afficher-naissance-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Baby", 
	"action"			=> "AmisAfficherNaissanceBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."ami-afficher-timeline-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Timeline", 
	"action"			=> "AmisAfficherTimelineBaby",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."ami-ajouter-commentaire-souvenir-([0-9]+)-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Commentaire", 
	"action"			=> "AmisAjouterCommentaire",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."ami-supprimer-commentaire-([0-9]+)-([0-9]+)", 
	"namespace"	    	=> "ORM", 
	"module"			=> "Commentaire", 
	"action"			=> "AmisSupprimerCommentaire",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."ami-editer-commentaire-([0-9]+)-([0-9]+)", 
	"namespace"	    	=> "ORM", 
	"module"			=> "Commentaire", 
	"action"			=> "AmisEditerCommentaire",  
	"logged"			=> true, 
	"droits"			=> 1
];

//------------------------------------------------------service messages

$route[] = [
	"url"				=> PTH."afficher-messages-recu", 
	"namespace"		    => "ORM", 
	"module"			=> "Message", 
	"action"			=> "AfficherMessagesRecu",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."afficher-souvenirs-proposer", 
	"namespace"		    => "ORM", 
	"module"			=> "Article", 
	"action"			=> "AfficherSouvenirsProposer",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."message-lu", 
	"namespace"		    => "ORM", 
	"module"			=> "Message", 
	"action"			=> "MessageLu",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."supprimer-message-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Message", 
	"action"			=> "SupprimerMessage",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."amis-envoyer-message-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Message", 
	"action"			=> "EnvoyerMessage",  
	"logged"			=> true, 
	"droits"			=> 1
];
$route[] = [
	"url"				=> PTH."repondre-([0-9]+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Message", 
	"action"			=> "Repondre",  
	"logged"			=> true, 
	"droits"			=> 1
];

//------------------------------------------------------trait recherche autocomplete

$route[] =	[
    "url"				=> PTH."autocomplete",
	"namespace"	    	=> "ORM",
	"module"			=> "Article",
	"action"			=> "Autocomplete",
	"logged"			=> true, 
	"droits"			=> 1
];

//------------------------------------------------------signalement
$route[] = [
    "url"				=> PTH."ami-signaler-photo-(.+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Signalement", 
	"action"			=> "SignalementPhoto",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
    "url"				=> PTH."ami-signaler-commentaire-(.+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Signalement", 
	"action"			=> "SignalementCom",  
	"logged"			=> true, 
	"droits"			=> 1
];

$route[] = [
    "url"				=> PTH."ami-signaler-souvenir-(.+)", 
	"namespace"		    => "ORM", 
	"module"			=> "Signalement", 
	"action"			=> "SignalementSouvenir",  
	"logged"			=> true, 
	"droits"			=> 1
];
//------------------------------------------------------super admin
$route[] = [
    "url"				=> PTH."gerer-signalement", 
	"namespace"		    => "ORM", 
	"module"			=> "Signalement", 
	"action"			=> "GererSignalement",  
	"logged"			=> true, 
	"droits"			=> 3
];
$route[] = [
    "url"				=> PTH."gerer-users", 
	"namespace"		    => "ORM", 
	"module"			=> "User", 
	"action"			=> "GererUsers",  
	"logged"			=> true, 
	"droits"			=> 3
];
//------------------------------------------------------ footer
$route[] = [
	"url" 				=> PTH."mentions-legales",
	"namespace" 	    => "Vendors",
	"module" 			=> "StaticPage",
	"action" 			=> "AfficherMentionsLegales",
	"logged" 			=> false,
	"droits" 			=> null
];
$route[] = [
	"url" 				=> PTH."politique-confidentialite",
	"namespace" 	    => "Vendors",
	"module" 			=> "StaticPage",
	"action" 			=> "AfficherPolitiqueConfidentialite",
	"logged" 			=> false,
	"droits" 			=> null
];
$route[] = [
	"url" 				=> PTH."cgu",
	"namespace" 	    => "Vendors",
	"module" 			=> "StaticPage",
	"action" 			=> "AfficherConditionsGeneralesUtilisation",
	"logged" 			=> false,
	"droits" 			=> null
];

return $route;