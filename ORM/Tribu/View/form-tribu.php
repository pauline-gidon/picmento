<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){

	echo "<div id=\"zone-form\" class=\"wrap content\">".$result->getForm()."</div>";

}