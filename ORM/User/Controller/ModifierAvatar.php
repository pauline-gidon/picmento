<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Model\ManagerUser;
use ORM\User\Entity\User;

use Vendors\FormBuilded\FormAvatar;
use Vendors\File\Uploader;
Use Vendors\Flash\Flash;


class ModifierAvatar extends Controller {

	function getResult(){

		$this->setLayout("back");
		$this->setTitle("Votre avatar");
		$this->setView("ORM/User/View/avatar.php");

		$connexion	= new Connexion();
		$manager	= new ManagerUser($connexion);
		$user		= $manager->oneUserById($_SESSION["auth"]["id"]);
        
		$form 	= new FormAvatar();
		$build 	= $form->buildForm();
        $flash 		 = New Flash();
        $http 		 = New HTTPRequest();

        // var_dump($user);
		if(($form->isSubmit("go"))&&($form->isValid())){
            
            $user_avatar = $user->getAvatarUser();
            $destination = "medias/avatar/";
            if(!is_null($user_avatar)){
                unlink($destination.$user_avatar);
            }

			$file		 = $http->getDataFiles("avatar_user");
			

			$uploader 	 = new Uploader($file,$destination);
			$avatar 	 = $uploader->upload();

			if(!is_null($avatar)){
				$user->setAvatarUser($avatar);

				//Redimensionnement
				$uploader->imageSizing(400);

				//Update de la table avec le nouveau nom de fichier
				if($manager->updateAvatar($user)){
					$_SESSION["auth"]["avatar"] 	= $avatar;
					$flash->setFlash("Avatar uploadé !");
				}else{
					$flash->setFlash("Impossible de changer l'avatar pour le moment !");
				}

				$connexion->close();
			}else{
				$flash->setFlash("Problème lors de l'upload du fichier !");
			}
            
			
		}
        if(($form->isSubmit("supprimer"))){
            $destination = "medias/avatar/";
            $user_avatar = $user->getAvatarUser();
            unlink($destination.$user_avatar);
            if($manager->deleteAvatar($user)){
                $flash->setFlash("Votre avatard a bien été supprimer");
                $_SESSION["auth"]["avatar"] = null;
            }else{
                
                $flash->setFlash("Problème lors de la suppression de l'avatard !");
            }

        }

		return $build;

	}

}


