<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){
// var_dump($result); die();
    echo "<p>".$result[0]->getPrenomUser()." ".$result[0]->getNomUser()." Vous demande si vous accepter d'être le deuxième parent pour construire les souvenir de sa tribu.</p>";
	echo "<div id=\"zone-form\" class=\"wrap content\">".$result[1]->getForm()."</div>";

}
