<?php
namespace ORM\User\Controller;
use OCFram\Controller;


class AfficherEspacePerso extends Controller {

	function getResult() {
		$this->setLayout("back");
		$this->setTitle("Votre espace");
		$this->setView("ORM/User/View/afficher-espace-perso.php");

		}


		
	}

