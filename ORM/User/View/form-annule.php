<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){

	echo "<div class=\"wrap\">
            <h2>Une demande a déjà été envoyer a ".$result[0]->getEmailUser()." mais elle n'a pas encore été accepter, voulez-vous annuler cette demande pour en faire une nouvelle ? </h2>
            <div id=\"zone-form\" class=\"wrap content\">".$result[1]->getForm()."</div>
        </div>";

}
