<?php
namespace ORM\Amis\Model;
use OCFram\Manager;
use ORM\Amis\Entity\Amis;

class ManagerAmis extends Manager {

//-------------------------------------------------------------------------------------------------
// Une invitation existe en bdd avec cet id de tribu
//-------------------------------------------------------------------------------------------------
	function oneAmisByIdTribu($id){
        if(is_numeric($id)){
			$req 	= "
				SELECT * 
				FROM amis 
				WHERE 
                tribu_id_tribu = $id 
			";
			$query 	= $this->db->query($req);
			return ($query->num_rows == 1)?new Amis($query->fetch_array()):NULL;
		}
    }
//-------------------------------------------------------------------------------------------------
// supprimerssion de la demande par annulation id_tribu id_destinataire
//-------------------------------------------------------------------------------------------------
	function deleteAmisByIdTribuAndIdDestinatatire($id_tribu,$id_destinataire){
        if((is_numeric($id_tribu)) && (is_numeric($id_destinataire))){
			$req 	= " DELETE  
				FROM amis 
				WHERE 
                tribu_id_tribu = $id_tribu
                AND  user_id_destinataire = $id_destinataire
			";
			$query 	= $this->db->query($req);
            return ($this->db->affected_rows == 1)?TRUE:FALSE;
		}

    }
//-------------------------------------------------------------------------------------------------
// supprimerssion de la demande par suppremiier de tribu par id_tribu
//-------------------------------------------------------------------------------------------------
function deleteAmisByIdTribu($id_tribu){
    if(is_numeric($id_tribu)){
        $req 	= " DELETE  
            FROM amis 
            WHERE 
            tribu_id_tribu = $id_tribu
        ";
        $query 	= $this->db->query($req);
        return ($this->db->affected_rows == 1)?TRUE:FALSE;
    }

}
//-------------------------------------------------------------------------------------------------
// insert invitation association tribu avec le 2eme parent
//-------------------------------------------------------------------------------------------------
	function insertAmisTribu(Amis $amis){
        $user_id_expediteur   = $this->db->real_escape_string($amis->getUserIdExpediteur());
        $user_id_destinataire   = $this->db->real_escape_string($amis->getUserIdDestinataire());
        $tribu_id_tribu   = $this->db->real_escape_string($amis->getTribuIdTribu());
        $token_tribu   = $this->db->real_escape_string($amis->getTokenTribu());
        $validity_token_tribu   = $this->db->real_escape_string($amis->getValidityTokenTribu());
       
        $req = "INSERT INTO amis VALUES(
			NULL,
            NULL,
            NULL,
			'$user_id_expediteur',
			'$user_id_destinataire',
			'$tribu_id_tribu',
			'$validity_token_tribu',
			'$token_tribu'
		)";
        $query = $this->db->query($req);

		return $this->db->insert_id;

    }
//-------------------------------------------------------------------------------------------------
// verification d'invitation par le token
//-------------------------------------------------------------------------------------------------
	function oneAmisByToken($token){
        if(is_numeric($token)){
			$req 	= " SELECT * 
				FROM amis 
				WHERE 
                token_tribu = $token
			";
			$query 	= $this->db->query($req);
			return ($query->num_rows == 1)?new Amis($query->fetch_array()):NULL;
		}

    }
//-------------------------------------------------------------------------------------------------
// update d'invitation par le token
//-------------------------------------------------------------------------------------------------
	function updateAmisByToken(Amis $amis){
        $accept = $amis->getAcceptationAmis();
        $actif = $amis->getActifAmis();
        $token = $amis->getTokenTribu();
        if(is_numeric($token)){
            $req = "UPDATE amis SET 
            acceptation_amis    = '$accept',
            actif_amis		    = '$actif'
            WHERE token_tribu = $token";
            $query 	= $this->db->query($req);
            return ($this->db->affected_rows == 1)?TRUE:FALSE;
		}

    }
//-------------------------------------------------------------------------------------------------
// full ami by id user
//-------------------------------------------------------------------------------------------------
	function fullAmisActif(){
        $id = $_SESSION["auth"]["id"];
        if(is_numeric($id)){
            $req = "SELECT * FROM amis
            WHERE actif_amis = 1
            AND acceptation_amis = 1
            AND user_id_expediteur = $id
            OR user_id_destinataire = $id";
            $query = $this->db->query($req);     

            if($query->num_rows > 0){
                while($row = $query->fetch_array()){
                $objs[] = new Amis($row);
                }
                return $objs;
            }else{
                return null;
            }      
		}

    }
//-------------------------------------------------------------------------------------------------
// insert invitation association tribu avec le 2eme parent
//-------------------------------------------------------------------------------------------------
function insertAmis(Amis $amis){
    $user_id_expediteur   = $this->db->real_escape_string($amis->getUserIdExpediteur());
    $user_id_destinataire   = $this->db->real_escape_string($amis->getUserIdDestinataire());
    $validity_token_tribu   = $this->db->real_escape_string($amis->getValidityTokenTribu());
    $token_tribu   = $this->db->real_escape_string($amis->getTokenTribu());
   
    $req = "INSERT INTO amis VALUES(
        NULL,
        NULL,
        NULL,
        '$user_id_expediteur',
        '$user_id_destinataire',
        NULL,
        '$validity_token_tribu',
        '$token_tribu'
    )";
    $query = $this->db->query($req);

    return $this->db->insert_id;

}

//-------------------------------------------------------------------------------------------------
// je verifie si une demande amis existe entre ces deux personne
//-------------------------------------------------------------------------------------------------
function oneAmisByUsersIds($id_amis){
    $id = $_SESSION["auth"]["id"];
    
    if((is_numeric($id))&&(is_numeric($id_amis))){
        $req = "SELECT * FROM amis
        WHERE actif_amis = 1
        AND acceptation_amis = 1
        AND user_id_expediteur = $id AND user_id_destinataire = $id_amis
        OR user_id_destinataire = $id AND user_id_expediteur = $id_amis";
        $query = $this->db->query($req);

        return ($query->num_rows == 1)?new Amis($query->fetch_array()):NULL;
     
    }

}


}
