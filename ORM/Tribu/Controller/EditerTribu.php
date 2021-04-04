<?php
namespace ORM\Tribu\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;


use ORM\Tribu\Model\ManagerTribu;
// use ORM\Tribu\Entity\Tribu;
// use ORM\Baby\Model\ManagerBaby;
use Vendors\FormBuilded\FormTribu;

use Vendors\Flash\Flash;

class EditerTribu extends Controller {

	function getResult() {
		$this->setLayout("back");
		$this->setTitle("Modifier le nom de ma tribu");
		$this->setView("ORM/Tribu/View/form-tribu.php");

		$http = new HTTPRequest();
		$id = $http->getDataGet("id");

		$cx			= new Connexion();
		$manager	= new ManagerTribu($cx);
		$tribu 		= $manager->oneTribuById($id);
		// var_dump($tribu);
		// die();


		$form 		= new FormTribu('post',$tribu);
		$build 		= $form->buildForm();

		if(($form->isSubmit("nom-tribu"))&&($form->isValid())){
			$flash = new Flash();
			$tribu->setNomTribu($http->getDataPost("nom_tribu"));

			if($manager->updateTribu($tribu)){
				$flash->setFlash("Modification appliquée <a href=\"afficher-tribu\" title=\"Retour Tribu\" class=\"flash-retour\"><i class=\"fas fa-undo-alt\"></i> Retour</a>");
			}else{
				$flash->setFlash("La modification n'a pas pu être appliquée <a href=\"afficher-tribu\" title=\"Retour Tribu\" class=\"flash-retour\"><i class=\"fas fa-undo-alt\"></i> Retour</a>");

			}

		}
	

		return $build;
        $cx->close();

		}
	}


		


