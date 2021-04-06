<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){
    $flash = new Flash;
    echo"<div class=\"fc fw div-time\">";
    foreach($result[1] as $obj){
        
        echo "<div class=\"time-carre\">
                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
            </div>";
        
    }
    echo"</div>";
    echo "<p class=\"btnaddtimeline\">
    <a href=\"ajouter-timeline-".$result[0]->getIdBaby()."\" title=\"Ajouter une photo à la timeline de ".$result[0]->getNomBaby()."\">
    Ajouter <i class=\"fas fa-camera\"></i>
    </a>
    </p>";

    


}