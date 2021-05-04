<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

echo "<p><a href=\"demande-ami\" title=\"Demande d'ami\">Ajouter un ami</a></p>";
if(isset($result)){
// die();
    echo"<div class=\"amis\">";
    foreach ($result as $obj) {
        echo"<div class=\"fc fw \">
                <p>".$obj->getPrenomUser()." ".$obj->getNomUser()."</p>
                <p><a href=\"voir-tribu-amis-".$obj->getIdUser()."\" title=\"\">Voir sa tribu</a></p>
            </div>";
    }
    echo "</div>";
}
