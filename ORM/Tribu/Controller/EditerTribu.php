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
        if(!is_null($tribu)){
            //je verifie si c'est bien l'un des deux parent qui ajoute le souvenir à la tribu
            $parent1 = $tribu->getUserIdParent1();
            $parent2 = $tribu->getUserIdParent2();
            if($parent1 == $_SESSION["auth"]["id"]||$parent2 == $_SESSION["auth"]["id"]){
                $form 		= new FormTribu('post',$tribu);
                $build 		= $form->buildForm();
        
                if(($form->isSubmit("nom-tribu"))&&($form->isValid())){
                    $flash = new Flash();
                    $tribu->setNomTribu(ucfirst($http->getDataPost("nom_tribu")));
        
                    if($manager->updateTribu($tribu)){
                        $flash->setFlash("Modification appliquée");
                        header("location: afficher-tribu");
                        exit();
                    }else{
                        $flash->setFlash("La modification n'a pas pu être appliquée veuillez ressayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span> !");
        
                    }
        
                }
            
        
                $cx->close();
                return $build;
    
            }else{
                header("location: ".DOMAINE."errors/404.php");
                exit();
            }	


        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}


		


