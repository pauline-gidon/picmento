<?php
use Vendors\Flash\Flash;
$flash = new Flash();

if(isset($_SESSION["ami"]["id"])){
    echo " 
    <a href=\"amis-voir-tribu-".$_SESSION["ami"]["id"]."\" title=\"Retour au tribus de mon ami\" class=\"btn-tribu-ami\">
    <i class=\"fas fa-undo-alt\"></i> Tribus ami
    </a>
    ";
}
echo $flash->getFlash();
if(isset($result[1])){
    $flash = new Flash;
    echo"<h2>".$result[0]->getNomBaby()."</h2><div class=\"fc fw div-time\">";
    foreach($result[1] as $obj){
        
        echo "<div class=\"time-carre\">
                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
            </div>";
        
    }
    echo"</div>";
}
   
    


