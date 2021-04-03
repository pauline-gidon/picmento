<?php
namespace ORM\Baby\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;


use OCFram\Navbaby;
// use ORM\Baby\Entity\Baby;
use ORM\Baby\Model\ManagerBaby;





class AfficherNaissanceBaby extends Controller {
        
        
        use Navbaby;
        
        function getResult() {	
                $cx			= new Connexion();
                $manager	= new ManagerBaby($cx);
                $babys=  $manager->allBabyHasUser();
                $this->navConstruction($babys);
                $http = new HTTPRequest();
                $id = $http->getDataGet("id");
                $cx	= new Connexion();
                $manager = new ManagerBaby($cx);
                $baby = $manager->oneBabyById($id);
                $nom = $baby->getNomBaby();
                $this->setLayout("back");
                $this->setTitle("Naissance");
                $this->setView("ORM/Baby/View/afficher-naissance-baby.php");
                return $baby;
                }
	
}


		


