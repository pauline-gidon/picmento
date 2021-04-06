<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){
var_dump($result); 
die();
    foreach ($result as $obj) {
        echo"<p>".$obj->get."</p>";
    }

}
