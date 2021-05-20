<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){

	echo "<div class=\"containerAnnulerDemande wrap\">
          
            <div id=\"zone-form\" class=\"wrap content\">".$result[1]->getForm()."</div>
        </div>";

}
