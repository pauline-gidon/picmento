<?php
namespace ORM\Tribu\Entity;
use OCFram\Hydrator;

class Tribu {
	use Hydrator;	
	private $id_tribu;
	private $nom_tribu;
	private $user_id_parent1;
	private $user_id_parent2;


	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTERS
	function getIdTribu(){
		return $this->id_tribu;
	}
	function getNomTribu(){
		return $this->nom_tribu;
	}
	function getUserIdParent1(){
		return $this->user_id_parent1;
	}
	function getUserIdParent2(){
		return $this->user_id_parent2;
	}


	//SETTERS
	function setNomTribu($val){
		$this->nom_tribu = $val;
	}
	function setUserIdParent1($val){
		$this->user_id_parent1 = $val;
	}
	function setUserIdParent2($val){
		$this->user_id_parent2 = $val;
	}



}
