<?php
namespace Vendors\StaticPage\Controller;
use OCFram\Controller;

class AfficherMentionsLegales extends Controller {

	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Mentions légales");
		$this->setView("Vendors/StaticPage/View/mentions-legales.php");

		
	}

}