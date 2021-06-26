<?php
namespace Vendors\File;
use Vendors\Nettoyage\Chaine;


class Uploader {

	private $name;
	private $tmp_name;
	private $destination;

	function __construct($fichier,$destination){
		$this->name 		= $fichier["name"];
		$this->tmp_name 	= $fichier["tmp_name"];
		$this->destination 	= $destination;
	}


	function upload(){
		$nettoyage_chaine 	= new Chaine();
		$this->name = $nettoyage_chaine->clear($this->name,TRUE);

		//Si le fichier a été téléchargé par HTTP POST
		if(is_uploaded_file($this->tmp_name)){
			//On l'emmène dans le bon dossier avec un nom d'origine 
			//nettoyé et marqué

			//medias/avatars/176942349-logo-ecole-aries.jpg
            //retourner l'image si nécessaire
            
            if(
				move_uploaded_file(
					$this->tmp_name,
					$this->destination.$this->name
				)
			){
				//Retourner au Controller le nom nettoyé et marqué 
				//pour faire l'Update de la table User
				return $this->name;
			}else{
				return NULL;
			}
		}
	}


	function imageSizing($new_largeur){
		//Le redimensionnement ne se fait pas durant l'upload
		//car on peut avoir envie d'uploader un PDF par ex.
		//ce qui ne suppose pas de redimensionnement
		//On travaille donc sur l'image qui a été move_uploaded_file()


        list($largeur,$hauteur,$typefile,$attr) = getimagesize($this->destination.$this->name);
        
        //Pour ne pas endommager l'image d'origine au cas où le redimensionnement plante
        //Je vais travailler sur une copie de l'originale
        if($typefile == 2){
            $copie = imagecreatefromjpeg($this->destination.$this->name);
            $erase = "imagejpeg";
        }else if($typefile == 3){
            $copie = imagecreatefrompng($this->destination.$this->name);
            $erase = "imagepng";
        }else {
            $copie = imagecreatefromjpeg($this->destination.$this->name);
            $erase = "imagejpeg";
        }
        
        // en fonction de l'orientation lue en EXIF on fait tourner l'image pour la remettre d'aplomb
        $exif = exif_read_data($this->destination.$this->name);
        if(!empty($exif['Orientation'])) {
            $inversionHL = TRUE;
            switch($exif['Orientation']) {
                case 8:
                    $copie = imagerotate($copie,90,0);
                    break;
                case 3:
                    $copie = imagerotate($copie,180,0);
                    $inversionHL = FALSE;
                    break;
                case 6:
                    $copie = imagerotate($copie,-90,0);
                    break;
            }
        }

        if($inversionHL===TRUE) {
                            // inversion largeur et hauteur
                            $temp = $hauteur;
                            $hauteur = $largeur;
                            $largeur = $temp;
        }
        // si image est trop grande
		if($largeur > $new_largeur){
			$new_hauteur = ($new_largeur * $hauteur) / $largeur;

			//Créons un fichier vide à la bonne taille
			$crea = imagecreatetruecolor($new_largeur,$new_hauteur);

			//Rééchantillonage de copie dans crea
			if(imagecopyresampled(
				$crea, $copie,
				0,0,0,0,
				$new_largeur, $new_hauteur,
				$largeur, $hauteur
			)){
				//J'écrase l'original par crea
				if($erase($crea,$this->destination.$this->name)){
					//Et je détruis la copie temporaire
					imagedestroy($copie);
				}
			}
		}
	}

    // function ImageOrientation($filename){
        
    //     $image = imagecreatefromstring(file_get_contents($filename));
    //     $exif = exif_read_data($filename);
    //     if(!empty($exif['Orientation'])) {
    //         switch($exif['Orientation']) {
    //             case 8:
    //                 $image = imagerotate($image,90,0);
    //                 break;
    //             case 3:
    //                 $image = imagerotate($image,180,0);
    //                 break;
    //             case 6:
    //                 $image = imagerotate($image,-90,0);
    //                 break;
    //         }
    //     }
    //           // puis réécrire l'image retournée sur le disque en tant que $filename  
    //          //  imagejpeg($img, $this->tmp_name, 95);
    //          imagejpeg($image);
            
 
    //   }




}