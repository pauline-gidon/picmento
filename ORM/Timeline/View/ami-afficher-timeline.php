<?php
use Vendors\Flash\Flash;
$flash = new Flash();
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
   
    


