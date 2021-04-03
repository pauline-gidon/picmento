<?php
namespace ORM\Baby\Entity;
use OCFram\Hydrator;

class Baby {
	use Hydrator;	
	private $id_baby;
	private $nom_baby;
	private $photo_baby;
	private $date_naissance_baby;
	private $heure_naissance_baby;
	private $lieu_naissance_baby;
	private $poids_naissance_baby;
	private $taille_naissance_baby;
	private $tribu_id_tribu;


	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTERS
	function getIdBaby(){
		return $this->id_baby;
	}
	function getNomBaby(){
		return $this->nom_baby;
	}
	function getPhotoBaby(){
		return $this->photo_baby;
	}
	function getDateNaissanceBaby(){
		return $this->date_naissance_baby;
	}
	
	function getHeureNaissanceBaby(){
		return $this->heure_naissance_baby;
	}
	
	function getLieuNaissanceBaby(){
		return $this->lieu_naissance_baby;
	}
	
	function getPoidsNaissanceBaby(){
		return $this->poids_naissance_baby;
	}
	
	function getTailleNaissanceBaby(){
		return $this->taille_naissance_baby;
	}
	
	function getTribuIdTribu(){
		return $this->tribu_id_tribu;
	}
	


	//SETTERS
	
	function setNomBaby($val){
		$this->nom_baby = $val;
	}
	function setPhotoBaby($val){
		$this->photo_baby = $val;
	}
	function setDateNaissanceBaby($val){
		$this->date_naissance_baby = $val;
	}
	function setHeureNaissanceBaby($val){
		$this->heure_naissance_baby = $val;
	}
	function setLieuNaissanceBaby($val){
		$this->lieu_naissance_baby = $val;
	}
	function setPoidsNaissanceBaby($val){
		$this->poids_naissance_baby = $val;
	}
	function setTailleNaissanceBaby($val){
		$this->taille_naissance_baby = $val;
	}
	function setTribuIdTribu($val){
		$this->tribu_id_tribu = $val;
	}
	
	




}
