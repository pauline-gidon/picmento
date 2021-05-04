<?php
namespace ORM\Baby\Controller;
use OCFram\Navbaby;
use OCFram\Connexion;
use OCFram\Controller;


use OCFram\HTTPRequest;
// use ORM\Baby\Entity\Baby;
use ORM\Baby\Model\ManagerBaby;
use ORM\User\Model\ManagerUser;
use ORM\Tribu\Model\ManagerTribu;





class AmisAfficherNaissanceBaby extends Controller {
        use Navbaby;
        
        function getResult() {	
            $this->setLayout("back");
            $this->setTitle("Naissance");
            $this->setView("ORM/Baby/View/afficher-naissance-baby.php");
            $http = new HTTPRequest();
            $id_baby = $http->getDataGet("id");
            $cx			= new Connexion();
            $managerT = new ManagerTribu($cx);
            //je recupère la tribu de du baby pour recupérer les parents 
            $tribu = $managerT->oneTribuByIdBaby($id_baby);
            $id_parent1 = $tribu->getUserIdParent1();
            $id_parent2 = $tribu->getUserIdParent2();
            $managerU = new ManagerUser($cx);
            // et verifier si la personne est amis avec l'un des deux parent
            $user = $managerU->verifUserAmisUserConnecter($id_parent1, $id_parent2);
            if(!is_null($user)){
                $manager = new ManagerBaby($cx);
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


		


