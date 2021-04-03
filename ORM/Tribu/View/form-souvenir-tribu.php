<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){

	echo "<h2 class=\"prenom-title\">".$result[0]->getNomTribu()."</h2>
    <div id=\"zone-form\" class=\"wrap content\">".$result[1]->getForm()."</div>";

}