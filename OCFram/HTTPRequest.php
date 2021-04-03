<?php
namespace OCFram;

//Une classe qui retourne les datas manipulées par le server
//à chaque requête HTTP de l'internaute
//Cela permettrait, dans certains cas, un premier nettoyage des datas
//(par ex. sur un POST avec du htmlspecialchars, du strip_tags, du trim)
class HTTPRequest {

	//---------------------------------------------------------------------
	//Pour que le Router récupère l'URI dans la barre d'URL
	//---------------------------------------------------------------------
	function getUri() {
		return htmlspecialchars(strip_tags($_SERVER["REQUEST_URI"]));
	}


	//---------------------------------------------------------------------
	//$_POST avec pré nettoyage
	//---------------------------------------------------------------------
	function getDataPost($nom,$security=3){
		if($security === 3){
			return isset($_POST[$nom]) 
			? htmlspecialchars(strip_tags(trim($_POST[$nom]))) : NULL;

		}else if($security === 2){
			return isset($_POST[$nom]) 
			? htmlspecialchars(trim($_POST[$nom])) : NULL;

		}else if($security === 1) {
			return isset($_POST[$nom]) 
			? trim($_POST[$nom]) : NULL;
		}
	}

	function postExist($nom){
		return isset($_POST[$nom]);
	}

	//Parcourir le tableau $_POST pour y retrouver les values
	//d'éventuelles cases à cocher créées dynamiquement 
	//(donc avec un name dynamique)
	function getDataMultipleChoice($pattern){
		$values = [];
		foreach($_POST as $key => $value){
			if(preg_match($pattern,$key)){
				$values[] = $value;
			}
		}
		return $values;
	}

	//---------------------------------------------------------------------
	//$_GET avec pré nettoyage
	//---------------------------------------------------------------------
	function getDataGet($nom){
		return isset($_GET[$nom]) 
		? htmlspecialchars(strip_tags(trim($_GET[$nom]))) : NULL;
	}


	//---------------------------------------------------------------------
	//$_FILES (les datas d'un Upload de fichier)
	//---------------------------------------------------------------------
	function getDataFiles($nom,$key=NULL){
		if(is_null($key)){
			return isset($_FILES[$nom])?$_FILES[$nom]:NULL;
		}else{
			return isset($_FILES[$nom][$key])?$_FILES[$nom][$key]:NULL;
		}
	}

}
