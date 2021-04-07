<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){
// var_dump($result); 
// die();
    echo"<div class=\"amis\">";
    foreach ($result as $obj) {
        echo"<div class=\"fc fw \"><p>".$obj->getNomUser()."</p></div>";
    }
    echo "</div>";
}
