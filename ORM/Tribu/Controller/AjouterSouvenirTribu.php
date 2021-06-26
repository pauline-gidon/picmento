<?php
namespace ORM\Tribu\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;

use Vendors\Flash\Flash;

use ORM\Article\Entity\Article;
use ORM\Baby\Model\ManagerBaby;
use ORM\Tribu\Model\ManagerTribu;
use ORM\Article\Model\ManagerArticle;
use Vendors\FormBuilded\FormSouvenirTribu;

class AjouterSouvenirTribu extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Ajouter un souvenir à la tribu");
		$this->setView("ORM/Tribu/View/form-souvenir-tribu.php");

        $flash = new Flash();
		$http = new HTTPRequest();
		$id_tribu = $http->getDataGet("id");
		$cx			= new Connexion();
		$managerT	= new ManagerTribu($cx);
        //je récupère la tribu par son id
        $tribu = $managerT->oneTribuById($id_tribu);
        //si elle est pas null je récupère les ids des parents
        if(!is_null($tribu)){
            $parent1 = $tribu->getUserIdParent1();
            $parent2 = $tribu->getUserIdParent2();
            //je vérifie si c'est bien l'un des deux parents 
            //qui ajoute le souvenir à la tribu
            if($parent1 == $_SESSION["auth"]["id"] || 
            $parent2 == $_SESSION["auth"]["id"]){
                //j'instantie le managerBaby
                $managerB = new ManagerBaby($cx);
                // je vais chercher tous les babys de la tribu
                $babys = $managerB->tribuHasBaby($id_tribu);
                if(!is_null($babys)){                         
                // je mets la tribu dans un tableau general 
                //pour la personalisation du formulaire
                $general[] = $tribu;
                // j'instantie le formulaire souvenir
                $form 		= new FormSouvenirTribu();
                $build 		= $form->buildForm($babys);
                // je le mets dans le tableau generale pour l'affichage dans la view
                $general[]= $build;
                //si je formulaire est soumit et valide (2 submit dans 2 possibilité)
                if((($form->isSubmit("souvenir"))&&($form->isValid())) ||
                 (($form->isSubmit("addPhoto"))&&($form->isValid()))){
                    //je crée un souvenir en récupérant les donnée poster
                    $new_souvenir = new Article([
                        "titre_article" 	    => ucfirst($http->getDataPost("titre_article")),
                        "description_article" 	=> ucfirst($http->getDataPost("description_article")),
                        "date_article" 	        => $http->getDataPost("date_article"),
                        "actif_article" 	    => $http->getDataPost("actif_article"),
                        "validation_article"    => 1
                    ]);

                    // je récupère les babyz sélectionné pour l'ajout du souvenir tribu
                    $pattern = "/^baby[0-9]+$/";
                    $values = $http->getDataMultipleChoice($pattern);

                    $managerA = new ManagerArticle($cx);
                    // j'insert d'abord l'article et récupère son id
                    $new_id_article = $managerA->insertArticle($new_souvenir);
                    //si il a bien été inséré
                    if($new_id_article > 0) {
                        //Insertion dans la table baby_has_article
                        //si l'utilisateur a bien sélectionné des babys
                        if(!empty($values)){
                            //je parcours le tableau
                            foreach ($values as $id_baby) {
                                // je fais une insertion pour chaque baby
                                $managerA->insertArticleHasbaby($id_baby, $new_id_article);
                                }
                            //si l'utilisateur veux ajouter des photos je l'envoie vers le formulaire d'ajout de photos
                            if(($form->isSubmit("addPhoto")) && ($form->isValid())){
                                $flash->setFlash("Votre souvenir a bien été ajouté à la tribu. Ajoutez-lui des photos !");
                                $_SESSION["newIdSouvenir"] = $new_id_article;
                                header("location: tribu-ajouter-photos-souvenir-".$new_id_article."");
                                exit();
                            }               
                            $flash->setFlash("Votre souvenir a bien été 
                            ajouté à la tribu !");
                        }else{ // il n'a pas selectionner de baby
                            $flash->setFlash("Vous devez séléctionner au moins
                            un enfant pour l'ajout de ce souvenir !");
                        }
                        header("location: afficher-tribu");
                        exit();
        
                        }else{ // pb insertion
                            $flash->setFlash("Impossible d'ajouter un souvenir à la tribu.
                             Veuillez réessayer ou contacter l'équipe 
                             <span class=\"flash-logo\">Picmento</span> !");
                        }
                    }//fin du if submit && valid
                    
                    // je ferme la connection
                    $cx->close();
                    //je retourne le jeu de résultat pour la view
                    return $general;

                }else{ // la tribu n'a pas encore d'enfant
                    $flash->setFlash("Pour ajouter un souvenir, 
                    votre tribu doit être composée d'au moins un enfant !");
                    header("location: afficher-tribu");
                    exit();

                }
            }else{//user not parent
                header("location: ".DOMAINE."errors/404.php");
                exit();
            }
        }else{// tribu is_null
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}


		


