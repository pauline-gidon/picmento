<?php
namespace Vendors\Flash;

class Flash {

	
	function setFlash($message){
		$_SESSION["flash"] = $message;
	}


	function getFlash($class="feedback"){
		if(isset($_SESSION["flash"])){
			$flash = $_SESSION["flash"];
			unset($_SESSION["flash"]);
			return "<div class=\"".$class."\">".$flash."</div>";
		}
	}

}

