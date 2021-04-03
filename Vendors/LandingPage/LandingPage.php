<?php
namespace Vendors\LandingPage;

class LandingPage {

	function setPage($value){
		$_SESSION["page"] = $value;
	}

	function getPage(){
		$page = isset($_SESSION["page"])?$_SESSION["page"]:NULL;
		unset($_SESSION["page"]);
		if($page !== NULL) return $page;
	}

	function existPage(){
		return isset($_SESSION["page"]);
	}

}




