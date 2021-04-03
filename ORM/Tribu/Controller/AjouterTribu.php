<?php
namespace ORM\Tribu\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;
use ORM\Tribu\Model\ManagerTribu;
use ORM\Tribu\Entity\Tribu;
// use ORM\Baby\Entity\Baby;
// use ORM\Baby\Model\ManagerBaby;
use Vendors\FormBuilded\FormNewTribu;
use Vendors\Flash\Flash;
// use Vendors\FormBuilded\FormTribu;




class AjouterTribu extends Controller {

	function getResult() {
		$this->setLayout("back");
		$this->setTitle("Ajouter une tribu");
		$this->setView("ORM/Tribu/View/form-tribu.php");



		$form 		= new FormNewTribu();
		$build 		= $form->buildForm();



		
		if(($form->isSubmit("addtribu"))&&($form->isValid())){
			$http = new HTTPRequest();
			$flash = new Flash();

			$new_tribu = new Tribu([
				'nom_tribu'=>$http->getDataPost("nom_tribu")
				]);

			$cx			= new Connexion();
			$manager	= new ManagerTribu($cx);
		

			if($manager->insertNewTribu($new_tribu)){
				$flash->setFlash("Votre nouvelle tribu a été ajoutée");
				header("Location: afficher-tribu");
			}else{
				$flash->setFlash("l'ajout de votre tribu n'a pas fonctionné, veuillez ressayer ou contacter l'équipe picmento");

			}

		
		}
		return $build;

	}

}


		


