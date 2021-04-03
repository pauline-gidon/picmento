<?php
namespace ORM\User\Entity;
use OCFram\Hydrator;

	
class User {
	use Hydrator;
	private $id_user;
	private $nom_user;
	private $prenom_user;
	private $pseudo_user;
	private $email_user;
	private $pass_user;
	private $avatar_user;
	private $rgpd_user;
	private $date_rgpd_user;
	private $statut_user;
	private $actif_user;
	private $token_user;
	private $validity_token_user;

	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTERS
	function getIdUser(){
		return $this->id_user;
	}
	function getNomUser(){
		return $this->nom_user;
	}
	function getPrenomUser(){
		return $this->prenom_user;
	}
	function getPseudoUser(){
		return $this->pseudo_user;
	}
	function getEmailUser(){
		return $this->email_user;
	}
	function getPassUser(){
		return $this->pass_user;
	}
	function getAvatarUser(){
		return $this->avatar_user;
	}
	function getRgpdUser(){
		return $this->rgpd_user;
	}
	function getDateRgpdUser(){
		return $this->date_rgpd_user;
	}
	function getStatutUser(){
		return $this->statut_user;
	}
	function getActifUser(){
		return $this->actif_user;
	}
	function getTokenUser(){
		return $this->token_user;
	}
	function getValidityTokenUser(){
		return $this->validity_token_user;
	}


	//SETTERS
	function setNomUser($val){
		$this->nom_user = $val;
	}
	function setPrenomUser($val){
		$this->prenom_user = $val;
	}
	function setPseudoUser($val){
		$this->pseudo_user = $val;
	}
	function setEmailUser($val){
		$this->email_user = $val;
	}
	function setPassUser($val){
		$this->pass_user = $val;
	}
	function setAvatarUser($val){
		$this->avatar_user = $val;
	}
	function setRgpdUser($val){
		$this->rgpd_user = $val;
	}
	function setDateRgpdUser($val){
		$this->date_rgpd_user = $val;
	}
	function setStatutUser($val){
		$this->statut_user = $val;
	}
	function setActifUser($val){
		$this->actif_user = $val;
	}
	function setTokenUser($val){
		$this->token_user = $val;
	}
	function setValidityTokenUser($val){
		$this->validity_token_user = $val;
	}



}
