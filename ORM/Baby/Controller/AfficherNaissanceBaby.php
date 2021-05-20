<?php
namespace ORM\Baby\Controller;
use OCFram\Navbaby;
use OCFram\Connexion;
use OCFram\Controller;


use OCFram\HTTPRequest;
// use ORM\Baby\Entity\Baby;
use ORM\Baby\Model\ManagerBaby;
use ORM\User\Model\ManagerUser;





class AfficherNaissanceBaby extends Controller {
        use Navbaby;
        
        function getResult() {	
            $this->setLayout("back");
            $this->setTitle("Naissance");
            $this->setView("ORM/Baby/View/afficher-naissance-baby.php");
            $http = new HTTPRequest();
            $id_baby = $http->getDataGet("id");
            $cx			= new Connexion();
            $managerU = new ManagerUser($cx);
            $id_user = $_SESSION["auth"]["id"];

            if($managerU->verifUserBaby($id_baby, $id_user)){
                
                $manager = new ManagerBaby($cx);
                $id_user = $_SESSION["auth"]["id"];
                $babys=  $manager->allBabyHasUser($id_user);
                $this->navConstruction($babys);
                $baby = $manager->oneBabyById($id_baby);
                if(!is_null($baby)){
                    return $baby;
                }
            }else{
                $cx->close();
                header("location: ".DOMAINE."errors/404.php");
                exit();
            }
        }
	
}


		


