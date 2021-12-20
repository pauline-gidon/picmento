<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){

echo "<section class=\"baby\">";
    foreach ($result as $obj) {
        echo "<div class=\"photo-carre-tribu\">
                 <div class=\"cassbonbon\">
                    <img class=\"id-baby\" src=\"".DOMAINE."medias/photo-baby/".$obj->getPhotoBaby()."\" alt=\"Photo de ".$obj->getNomBaby()."\">
                </div>
                <h2 class=\"id-baby nom-baby\">".$obj->getNomBaby()."</h2>
            </div>
               <ul>
               <li><a href=\"ami-afficher-souvenirs-".$obj->getIdBaby()."\" title=\"Voir les souvenirs de ".$obj->getNomBaby()."\">Souvenirs</a></li>
               <li><a href=\"ami-afficher-naissance-".$obj->getIdBaby()."\" title=\"Naissance de ".$obj->getNomBaby()."\">Naissance</a></li>
               <li><a href=\"ami-afficher-timeline-".$obj->getIdBaby()."\" title=\"Afficher timeline de ".$obj->getNomBaby()."\">Timeline</a></li>
               </ul>";
            }
   echo "</section>";
  
}
