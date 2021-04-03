<?php
namespace ORM\Medias\Entity;
use OCFram\Hydrator;

class Medias {
	use Hydrator;	
	private $id_medias;
	private $nom_medias;


	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTERS
	function getIdMedias(){
		return $this->id_medias;
	}
	function getNomMedias(){
		return $this->nom_medias;
	}


	//SETTERS
	
	function setNomMedias($val){
		$this->nom_medias = $val;
	}


}
