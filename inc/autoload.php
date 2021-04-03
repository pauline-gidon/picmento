<?php
spl_autoload_register(function($class){
	//$class = namespace\NomClasseInstanciee
	//$class = ORM\Serie\Model\ManagerSerie

	//Selon l'environnement dans lequel se joue mon application, le back slash
	//ne permet peut-être pas de construire un chemin valide
	$class = strtr($class,"\\",DIRECTORY_SEPARATOR);
	require_once($class.".php");
});