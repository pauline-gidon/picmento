<?php
namespace ORM\Message\Model;

use DateTime;
use OCFram\Manager;
use ORM\Message\Entity\Message;

class ManagerMessage extends Manager {
    //----------------------------------------------------------
	//un message avec cet id en bdd
	//----------------------------------------------------------
    function oneMessageById($id){
        if(is_numeric($id)){
            $req = " SELECT * FROM message 
            WHERE id_message = $id";

            $query = $this->db->query($req);     
            return ($query->num_rows == 1 )?new Message($query->fetch_array()):NULL;
        }
    }
	//----------------------------------------------------------
	//update du message lu au click
	//----------------------------------------------------------
	function messageLu(Message $message){
		$req = "UPDATE message SET 
			lu_message		= ".$message->getLuMessage()."
			WHERE id_message = ".$message->getIdMessage();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

    //----------------------------------------------------------
	//tous les message reçu de ce user non lu
	//----------------------------------------------------------
    function fullMessagesNonLu(){
        $id_user = $_SESSION["auth"]["id"];
        $req = " SELECT * FROM message 
        WHERE user_id_destinataire = $id_user
        AND lu_message is NULL
         ";
        $query = $this->db->query($req);     
        if($query->num_rows > 0){
            while($row = $query->fetch_array()){
            $objs[] = new Message($row);
            }
            return $objs;
        }else{
            return null;
        }      

    }
    //----------------------------------------------------------
	//tous les message reçu de ce user 
	//----------------------------------------------------------
    function fullMessages(){
        $id_user = $_SESSION["auth"]["id"];
        $req = " SELECT * FROM message 
        WHERE user_id_destinataire = $id_user
        ORDER BY id_message DESC
      
         ";
        $query = $this->db->query($req);     
        if($query->num_rows > 0){
            while($row = $query->fetch_array()){
            $objs[] = new Message($row);
            }
            return $objs;
        }else{
            return null;
        }      

    }
    //----------------------------------------------------------
	//insert message BDD
	//----------------------------------------------------------
    function insertNewMessage(Message $obj){
        $text_message = $this->db->real_escape_string($obj->getTextMessage());
        $date_message  = $obj->getDateMessage();
        $user_id_expediteur  = $obj->getUserIdExpediteur();
        $user_id_destinataire  = $obj->getUserIdDestinataire();

        $req = "
        INSERT INTO message VALUES(
            NULL,
            '$text_message',
            '$date_message',
            '$user_id_expediteur',
            '$user_id_destinataire',
            NULL
        )
    ";
    $query = $this->db->query($req);
    return $this->db->insert_id;


    }

    //----------------------------------------------------------
	//delet de ce message par son id
	//----------------------------------------------------------
    function deleteMessageById($id){
        if(is_numeric($id)){
            $req = " DELETE FROM message 
            WHERE id_message = $id";

            $query = $this->db->query($req);     
            return ($this->db->affected_rows == 1)?TRUE:FALSE;
        }
    }


	
}
