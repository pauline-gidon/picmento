<?php
namespace ORM\Baby\Model;
use OCFram\Manager;
use ORM\Baby\Entity\Baby;

class ManagerBaby extends Manager {

	//----------------------------------------------------------
	//Des baby existent avec cette tribu en BDD
	//----------------------------------------------------------
    function tribuHasBaby($id_tribu){
        if(is_numeric($id_tribu)){
            $req = "SELECT * FROM baby INNER JOIN tribu
             ON baby.tribu_id_tribu = tribu.id_tribu
             WHERE tribu.id_tribu = $id_tribu
             ORDER BY baby.id_baby";
			$query = $this->db->query($req);
            if($query->num_rows > 0){
                while($row = $query->fetch_array()){
                    $babys[] = new Baby($row);
                }
                return $babys;
            }else{
                return null;
            }      
        }
    }
    //----------------------------------------------------------
	//insert baby BDD
	//----------------------------------------------------------
    function insertNewBaby(Baby $obj){
            $nom_baby = $this->db->real_escape_string($obj->getNomBaby());
            $photo_baby  = $obj->getPhotoBaby();
            $date_naissance_baby = $this->db->real_escape_string($obj->getDateNaissanceBaby());
            $heure_naissance_baby = $obj->getHeureNaissanceBaby();
            $lieu_naissance_baby = $obj->getLieuNaissanceBaby();
            $poids_naissance_baby = $this->db->real_escape_string($obj->getPoidsNaissanceBaby());
            $taille_naissance_baby  = $obj->getTailleNaissanceBaby();
            $tribu_id_tribu  = $obj->getTribuIdTribu();
        
            $req = "
			INSERT INTO baby VALUES(
				NULL,
				'$nom_baby',
				'$photo_baby',
				'$date_naissance_baby',
				'$heure_naissance_baby',
				'$lieu_naissance_baby',
				$poids_naissance_baby,
				$taille_naissance_baby,
				$tribu_id_tribu
			)
		";
        $query = $this->db->query($req);
		return $this->db->insert_id;


        }
    //----------------------------------------------------------
	//Tous les baby de cet user en bdd
	//----------------------------------------------------------
        function allBabyHasUser($id_user){
            if(is_numeric($id_user)){

                $req = "SELECT * FROM baby
                  INNER JOIN tribu
                       ON baby.tribu_id_tribu = tribu.id_tribu
                          WHERE tribu.user_id_parent1 = $id_user
                          OR tribu.user_id_parent2 = $id_user
                          ORDER BY baby.id_baby";
                
                $query = $this->db->query($req);
                if($query->num_rows > 0){
                    while($row = $query->fetch_array()){
                        $babys[] = new Baby($row);
                        }
                        return $babys;
                    }else{
                        return null;
                    }      
            }
        }
    //----------------------------------------------------------
	//Tous les baby de cet user en bdd qui ne sont ceux du user connecter
	//----------------------------------------------------------
        function allBabyHasUserAmi($id_user_amis){
            if(is_numeric($id_user_amis)){
                $id_user_co = $_SESSION["auth"]["id"];
                $req = "SELECT * FROM baby, tribu
                        WHERE  baby.tribu_id_tribu = tribu.id_tribu
                        AND (tribu.user_id_parent1 = $id_user_amis AND (tribu.user_id_parent2 !=$id_user_co OR tribu.user_id_parent2 IS NULL)
                        OR(tribu.user_id_parent2 = $id_user_amis AND tribu.user_id_parent1 !=$id_user_co))
                        ORDER BY baby.id_baby";

                // var_dump($req);die();
                $query = $this->db->query($req);
                if($query->num_rows > 0){
                    while($row = $query->fetch_array()){
                        $babys[] = new Baby($row);
                        }
                        return $babys;
                    }else{
                        return null;
                    }      
            }
        }
    //----------------------------------------------------------
	// baby avec cet id en bdd
	//----------------------------------------------------------
    function oneBabyById($id){
        if(is_numeric($id)){
        $req = "SELECT * FROM baby  WHERE id_baby = $id";
        
        $query = $this->db->query($req);
        if($query->num_rows == 1){
            $row = $query->fetch_array();
            $objet = new Baby($row);
            return $objet;
            }else{
                return null;
            }      
        }

    }


    //----------------------------------------------------------
	// update profil baby
	//----------------------------------------------------------
    function updateProfilBaby(Baby $baby){
		$nom_baby		        = $this->db->real_escape_string($baby->getNombaby());
		$date_naissance_baby	= $this->db->real_escape_string($baby->getDateNaissanceBaby());
		$heure_naissance_baby	= $this->db->real_escape_string($baby->getHeureNaissanceBaby());
		$lieu_naissance_baby	= $this->db->real_escape_string($baby->getLieuNaissanceBaby());
		$poids_naissance_baby	= $this->db->real_escape_string($baby->getPoidsNaissanceBaby());
		$taille_naissance_baby	= $this->db->real_escape_string($baby->getTailleNaissanceBaby());

        $req = "UPDATE baby SET 
        nom_baby			        = '$nom_baby',
        date_naissance_baby		    = '$date_naissance_baby',
        heure_naissance_baby		= '$heure_naissance_baby', 
        lieu_naissance_baby		    = '$lieu_naissance_baby', 
        poids_naissance_baby		= '$poids_naissance_baby', 
        taille_naissance_baby		= '$taille_naissance_baby' 
        WHERE id_baby = ".$baby->getIdBaby();
        
        $query = $this->db->query($req);
        if($this->db->affected_rows == 1){
			return true;
		}else{
			return false;
		}
        

    }
    //----------------------------------------------------------
	// update Photo baby
	//----------------------------------------------------------
    function updatePhotoBaby(Baby $baby){
		$photo_baby = $this->db->real_escape_string($baby->getphotoBaby());

        $req = "UPDATE baby SET 
        photo_baby		            = '$photo_baby'
        WHERE id_baby = ".$baby->getIdBaby();
        
        $query = $this->db->query($req);
        if($this->db->affected_rows == 1){
			return true;
		}else{
			return false;
		}
    }


    //----------------------------------------------------------
	// delete de baby avec son id
	//----------------------------------------------------------
    function deleteBabyById($id){
    if(is_numeric($id)){
        $req = "DELETE FROM  baby 
        WHERE id_baby = $id";
        $query = $this->db->query($req);
        return ($this->db->affected_rows == 1)?TRUE:FALSE;
        }
    }


    //----------------------------------------------------------
	//Tous les baby de cet user en bdd
	//----------------------------------------------------------
    function allBabyAmis($user_id){
            if(is_numeric($user_id)){

                $req = "SELECT * FROM baby
                  INNER JOIN tribu
                       ON baby.tribu_id_tribu = tribu.id_tribu
                          WHERE tribu.user_id_parent1 = $user_id
                          OR tribu.user_id_parent2 = $user_id
                          ORDER BY baby.id_baby";
                
                $query = $this->db->query($req);
                if($query->num_rows > 0){
                    while($row = $query->fetch_array()){
                        $babys[] = new Baby($row);
                        }
                        return $babys;
                    }else{
                        return null;
                    }      
            }
        }
    //----------------------------------------------------------
	//verification de cet id_baby avec cet id_tribu en bdd
	//----------------------------------------------------------
    function oneBabyByIdTribu($id_baby, $id_tribu){

            if((is_numeric($id_baby))&&(is_numeric($id_tribu))){

                $req = "SELECT * FROM baby
                          WHERE tribu_id_tribu = $id_tribu
                          OR id_baby = $id_baby";
                
                $query = $this->db->query($req);
                return ($this->db->num_rows == 1)?TRUE:FALSE;
            }
        }


}