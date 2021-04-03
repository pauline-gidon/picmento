<?php
namespace ORM\User\Controller;
use OCFram\Controller;

class SupprimerCompte extends Controller {

	function getResult(){

		$this->setLayout("back");
		$this->setTitle("Supprimer votre compte");
		$this->setView("ORM/User/View/supprimer.php");
		
	}

}


