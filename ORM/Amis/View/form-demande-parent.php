

<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){
    echo "<p class=\"wrap invitation\">".$result[0]->getPrenomUser()." ".$result[0]->getNomUser()." souhaite vous ajouter comme 2eme parent !</p>";
	echo "<div id=\"zone-form\" class=\"wrap content\">".$result[1]->getForm()."</div>";

}
