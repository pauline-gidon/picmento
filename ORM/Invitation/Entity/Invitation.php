<?php
namespace ORM\Invitation\Entity;
use OCFram\Hydrator;

class Invitation {
	use Hydrator;	
	private $id_invitation;
	private $rattachement_invitation;
	private $user_id_expediteur;
	private $user_id_destinataire;
	private $tribu_id_tribu;


	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTERS
	function getIdInvitation(){
		return $this->id_invitation;
	}
	function getRattachementInvitation(){
		return $this->rattachement_invitation;
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


	//SETTERS
	
	function setRattachementInvitation($val){
		$this->rattachement_invitation = $val;
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


}
