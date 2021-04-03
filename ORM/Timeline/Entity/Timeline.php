<?php
namespace ORM\Timeline\Entity;
use OCFram\Hydrator;

class Timeline {
	use Hydrator;	
	private $id_timeline;
	private $nom_photo_timeline;
	private $annee_photo_timeline;
	private $mois_photo_timeline;
	private $baby_id_baby;


	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTERS
	function getIdTimeline(){
		return $this->id_Timeline;
	}
	function getNomPhotoTimeline(){
		return $this->nom_photo_timeline;
	}
	function getAnneePhotoTimeline(){
		return $this->annee_photo_timeline;
	}
	function getMoisPhotoTimeline(){
		return $this->mois_photo_timeline;
	}
	function getBabyIdBaby(){
		return $this->baby_id_baby;
	}


	//SETTERS

	function setNomPhotoTimeline($val){
		 $this->nom_photo_timeline = $val;
	}
	function setAnneePhotoTimeline($val){
		 $this->annee_photo_timeline = $val;
	}
	function setMoisPhotoTimeline($val){
		 $this->mois_photo_timeline = $val;
	}
	function setBabyIdBaby($val){
		 $this->baby_id_baby = $val;
	}


}
