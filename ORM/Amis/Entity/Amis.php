<?php
namespace ORM\Amis\Entity;
use OCFram\Hydrator;

class Amis {
	use Hydrator;	
	private $id_amis;
	private $acceptation_amis;
	private $actif_amis;
	private $user_id_expediteur;
	private $user_id_destinataire;
	private $tribu_id_tribu;
	private $validity_token_tribu;
	private $token_tribu;



	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTERS
	function getIdAmis(){
		return $this->id_amis;
	}
	function getAcceptationAmis(){
		return $this->acceptation_amis;
	}
	function getActifAmis(){
		return $this->actif_amis;
	}
	function getUserIdExpediteur(){
		return $this->user_id_expediteur;
	}
	function getUserIdDestinataire(){
		return $this->user_id_destinataire;
	}
	function getTribuIdTribu(){
		return $this->tribu_id_tribu;
	}
	function getTokenTribu(){
		return $this->token_tribu;
	}
	function getValidityTokenTribu(){
		return $this->validity_token_tribu;
	}
	


	//SETTERS
	
	function setAcceptationAmis($val){
		$this->acceptation_amis = $val;
	}
	function setActifAmis($val){
		$this->actif_amis = $val;
	}
	function setUserIdExpediteur($val){
		$this->user_id_expediteur = $val;
	}
	function setUserIdDestinataire($val){
		$this->user_id_destinataire = $val;
	}
	function setTribuIdTribu($val){
		$this->tribu_id_tribu = $val;
	}
	function setTokenTribu($val){
		$this->token_tribu = $val;
	}
	function setValidityTokenTribu($val){
		$this->Validity_token_tribu = $val;
	}



}
