<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){
    $flash = new Flash;
    
        echo "<li>
        <a href=\"ajouter-timeline-".$result[0]->getIdBaby()."\" title=\"Ajouter une photo à la timeline de ".$result[0]->getNomBaby()."\">
        Ajouter <i class=\"fas fa-camera\"></i>
        </a>
        </li>";
        foreach($result[1] as $obj){

            echo "<img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">";

        }

    


}