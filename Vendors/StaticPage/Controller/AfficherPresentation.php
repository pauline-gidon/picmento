<?php
namespace Vendors\StaticPage\Controller;
use OCFram\Controller;

class AfficherPresentation extends Controller {

	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Sauvegarde de souvenirs en ligne");
		$this->setView("Vendors/StaticPage/View/presentation.php");

		
	}

}