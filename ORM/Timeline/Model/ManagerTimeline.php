<?php
namespace ORM\Timeline\Model;
use OCFram\Manager;
use ORM\Timeline\Entity\Timeline;

class ManagerTimeline extends Manager {
//-------------------------------------------------------------
// Delete de la timeline par id de baby
//-------------------------------------------------------------
function deteleTimelineByIdBaby($id){
    if(is_numeric($id)){
        $req = "DELETE FROM timeline WHERE baby_id_baby = $id";
        $query = $this->db->query($req);
        return ($this->db->affected_rows == 1)?true:false;
    }
}

//-------------------------------------------------------------
// Timeline par id de baby
//-------------------------------------------------------------
function oneTimelineByIdBaby($id){
    if(is_numeric($id)){
        $req = "SELECT * FROM timeline
         WHERE baby_id_baby = $id
         ORDER BY annee_photo_timeline ASC, mois_photo_timeline ASC
        ";
        $query = $this->db->query($req);
        if($query->num_rows > 0){
            while($row = $query->fetch_array()){
            $timeline[] = new Timeline($row);
            }
            return $timeline;
        }else{
            return null;
        }      
    }
}

//----------------------------------------------------------
//insert imeline
//----------------------------------------------------------
function insertNewTimeline(Timeline $obj){
    $nom_photo_timeline = $this->db->real_escape_string($obj->getNomPhotoTimeline());
    $annee_photo_timeline = $this->db->real_escape_string($obj->getAnneePhotoTimeline());
    $mois_photo_timeline = $this->db->real_escape_string($obj->getMoisPhotoTimeline());
    $baby_id_baby  = $this->db->real_escape_string($obj->getBabyIdBaby());

    $req = "
    INSERT INTO timeline VALUES(
        NULL,
        '$nom_photo_timeline',
        '$annee_photo_timeline',
        '$mois_photo_timeline',
        '$baby_id_baby')";
    $query = $this->db->query($req);
    return $this->db->insert_id;


}


}
