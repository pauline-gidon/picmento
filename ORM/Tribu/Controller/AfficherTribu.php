<?php
namespace ORM\Tribu\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Tribu\Model\ManagerTribu;
// use ORM\Tribu\Entity\Tribu;
// use ORM\Baby\Entity\Baby;
// use ORM\Baby\Model\ManagerBaby;


class AfficherTribu extends Controller {

	function getResult() {
		$this->setLayout("back");
		$this->setTitle("Toutes mes tribus");
		$this->setView("ORM/Tribu/View/afficher-tribu.php");

		$cx = new Connexion();
		$manager = new ManagerTribu($cx);
		
		$tribus = $manager->oneTribuWithBabys();
		
		$cx->close();
        // je supprime la session si le user vien de visiter un de ces ami
        unset($_SESSION["ami"]);

		return $tribus;

    }
}


		


