<?php
namespace Vendors\StaticPage\Controller;
use OCFram\Controller;

class AfficherPolitiqueConfidentialite extends Controller {

	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Politique de Confidentialite");
		$this->setView("Vendors/StaticPage/View/politique-confidentialite.php");

		
	}

}