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
            $this->setView("ORM/Baby/View/ami-afficher-naissance-baby.php");
            $http = new HTTPRequest();
            $id_baby = $http->getDataGet("id");
            $cx			= new Connexion();
            $managerU = new ManagerUser($cx);
            //une variable de session a été crée à, l'affichage des tribu de mon amis avec id ami $_SESSION["ami"]["id"]
            //je verifie si la personne connecter et le profil visité son bien amis
            //je recupère la tribu de du baby pour recupérer les parents 
    
            $id_user = $_SESSION["ami"]["id"];
            if($managerU->verifUserAmis($id_user)){
                
                //je verifie si ce baby appartien bien a id du parent
            if($managerU->verifUserBaby($id_baby, $id_user)){
                $manager = new ManagerBaby($cx);
                $baby = $manager->oneBabyById($id_baby);
                if(!is_null($baby)){
                    $cx->close();
                    return $baby;
                }
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


		


