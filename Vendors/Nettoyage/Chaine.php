<?php
namespace Vendors\Nettoyage;

class Chaine {

	function clear($chaine,$marquage=false){
		//Conversion en caractères non accentués
		setlocale(LC_CTYPE, 'cs_CZ');
		$chaine = iconv("UTF-8","ASCII//TRANSLIT",$chaine);

		//Remplacement des espaces par des tirets
		$chaine = str_replace(' ','-',$chaine);

		//On ne garde que A-Za-z0-9-.
		//preg_replace[^] = les caractères à préserver, les autres supprimés
		$chaine = preg_replace("/[^A-Za-z0-9-.]/","",$chaine);

		//Passage en minuscules
		$chaine = strtolower($chaine);

		//Supprimer les multi ---
		$chaine = preg_replace("/(-)+/","-",$chaine);

		//Si marquage demandé
		if($marquage){
			$chaine = uniqid()."-".$chaine;
		}


		return $chaine;
	}


}