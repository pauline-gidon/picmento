<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use Vendors\LandingPage\LandingPage;


class LogOut extends Controller {	
	
	function getResult(){
		$page = new LandingPage();

		if($page->existPage()){
			$attero = $page->getPage();
		}else{
			$attero = "index.php";
		}

		//unset($_SESSION["auth"]);
		session_unset();
		session_destroy();
		
		header("Location: ".$attero);
	}
	
}
