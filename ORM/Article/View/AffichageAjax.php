<?php
namespace ORM\Article\View;

trait AffichageAjax {

	function affichage($tableau){
		echo json_encode($tableau);
	}


}