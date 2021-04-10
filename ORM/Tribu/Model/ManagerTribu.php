<?php
namespace ORM\Tribu\Model;
use OCFram\Manager;
use ORM\Amis\Entity\Amis;
use ORM\Tribu\Entity\Tribu;


class ManagerTribu extends Manager {
    //----------------------------------------------------------
    //Insertion automatique à la creation de compt 
    //----------------------------------------------------------

    function insertTribu(){
        $nom_tribu = "Ma tribu";
        $user_id = $_SESSION["auth"]["id"];
       
        $req = "INSERT INTO tribu VALUES(
			NULL,
			'$nom_tribu',
			'$user_id',
			NULL
		)";
        $query = $this->db->query($req);
		return $this->db->insert_id;
    }
    //----------------------------------------------------------
    //Insertion d'une nouvelle tribu
    //----------------------------------------------------------

    function insertNewTribu(Tribu $new_tribu){
        $nom_tribu  = $this->db->real_escape_string($new_tribu->getNomTribu());
        $user_id = $_SESSION["auth"]["id"];
       
        $req = "INSERT INTO tribu VALUES(
			NULL,
			'$nom_tribu',
			'$user_id',
			NULL
		)";
        $query = $this->db->query($req);
		return $this->db->insert_id;
    }
    //----------------------------------------------------------
    //Une/des tribu avec ses baby(s) dans la bdd avec -> cet user 
    //----------------------------------------------------------
    
    function oneTribuWithBabys(){
        $user_id = $_SESSION["auth"]["id"];

        $req = "SELECT 
            tribu.id_tribu,
            tribu.nom_tribu,
            GROUP_CONCAT(baby.id_baby SEPARATOR '/') AS liste_id,
            GROUP_CONCAT(baby.nom_baby SEPARATOR '/') AS liste_nom,
            GROUP_CONCAT(baby.photo_baby SEPARATOR '/') AS liste_photo
            FROM tribu LEFT JOIN baby ON baby.tribu_id_tribu = tribu.id_tribu
         WHERE tribu.user_id_parent1 = $user_id
         OR tribu.user_id_parent2 = $user_id
         GROUP BY tribu.id_tribu";

        $query = $this->db->query($req);
        if($query->num_rows > 0){
            while($row = $query->fetch_array()){
                $tribus_babys[] = new Tribu($row);
            }
            return $tribus_babys;
        }else{
            return null;
        }
    }
	//----------------------------------------------------------
	//Pour la modification/suppression je verifie si cette tribu existe en BDD par son id ?
	//----------------------------------------------------------
    function oneTribuById($id){
        if(is_numeric($id)){
            $req="SELECT * FROM tribu WHERE id_tribu = $id";

            $query = $this->db->query($req);
            if($query->num_rows == 1){
                while($row = $query->fetch_array()){
                    $objet = new Tribu($row);
                    }
                return $objet;
            }else{
                return null;
            }
        }
    }
    //----------------------------------------------------------
	//Modification du nom de la tribu avec cette id dans la BDD
	//----------------------------------------------------------

    function updateTribu(Tribu $tribu){
		$nom_tribu = $this->db->real_escape_string($tribu->getNomTribu());
		$id_tribu = $this->db->real_escape_string($tribu->getIdTribu());
        if(is_numeric($id_tribu)){
			$req = "UPDATE tribu SET 
				nom_tribu		= '$nom_tribu'
				WHERE id_tribu = $id_tribu";
	
			$query = $this->db->query($req);
			return ($this->db->affected_rows == 1)?TRUE:FALSE;
        }
	
	}
    //----------------------------------------------------------
	//Suppression de la tribu avec son id dans la BDD
	//----------------------------------------------------------
    function deleteTribu($id_tribu){
        if(is_numeric($id_tribu)){
            $req = "DELETE FROM tribu WHERE id_tribu = $id_tribu";
            $query = $this->db->query($req);
            return ($this->db->affected_rows == 1)?true:false;
        }
    }
    //----------------------------------------------------------
	//Modification de l'id parent2 à => acceptation tribu
	//----------------------------------------------------------

    function updateTribuUser2(Amis $amis){
        $id_user2 = $this->db->real_escape_string($amis->getUserIdDestinataire());
        $id_tribu = $this->db->real_escape_string($amis->getTribuIdTribu());
        if((is_numeric($id_tribu)) && (is_numeric($id_user2))){
            $req = "UPDATE tribu SET 
                    user_id_parent2 		= '$id_user2'
                    WHERE id_tribu = $id_tribu";
                $query = $this->db->query($req);
                return ($this->db->affected_rows == 1)?TRUE:FALSE;
        }
    }

    //----------------------------------------------------------
	//verif user pour ajout commentaire, id article pour trouver la tribu
	//----------------------------------------------------------

    function oneTribuByIdArticle($id_article,$id_baby){
        if((is_numeric($id_article))&&(is_numeric($id_baby))){
            $req = "SELECT *  FROM tribu 
            INNER JOIN baby
            ON baby.tribu_id_tribu = tribu.id_tribu
            INNER JOIN baby_has_article
            ON baby_has_article.baby_id_baby = baby.id_baby
            INNER JOIN article
            ON article.id_article = baby_has_article.article_id_article
            WHERE article.id_article = $id_article
            And baby.id_baby = $id_baby";
                $query = $this->db->query($req);
                return ($query->num_rows > 0)?new Tribu($query->fetch_array()):NULL;
            }
    }



}
