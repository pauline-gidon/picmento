<?php
namespace ORM\Message\Entity;
use OCFram\Hydrator;

class Message {
	use Hydrator;	
	private $id_message;
	private $text_message;
	private $date_message;
	private $user_id_expediteur;
	private $user_id_destinataire;


	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTERS
	function getIdMessage(){
		return $this->id_message;
	}
	function getTextMessage(){
		return $this->text_message;
	}
	function getDateMessage(){
		return $this->date_message;
	}
	function getUserIdExpediteur(){
		return $this->user_id_expediteur;
	}
	function getUserIdDestinataire(){
		return $this->user_id_destinataire;
	}


	//SETTERS
	
	function setTextMessage($val){
		$this->text_message = $val;
	}
	function setDateMessage($val){
		$this->date_message = $val;
	}
	function setUserIdExpediteur($val){
		$this->user_id_expediteur = $val;
	}
	function setUserIdDestinataire($val){
		$this->user_id_destinataire = $val;
	}


}
