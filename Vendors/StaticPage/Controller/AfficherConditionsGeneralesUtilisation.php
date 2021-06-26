<?php
namespace Vendors\StaticPage\Controller;
use OCFram\Controller;

class AfficherConditionsGeneralesUtilisation extends Controller {

	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Conditions generales d'utilisation");
		$this->setView("Vendors/StaticPage/View/conditions-generales-utilisation.php");

		
	}

}