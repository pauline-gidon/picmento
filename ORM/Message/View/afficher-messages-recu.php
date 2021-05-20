<?php
use Vendors\Flash\Flash;
$flash = new FLash();
if(isset($result)){
    $flash->getFlash();
    echo"<section class=\"wrap \">";

    foreach ($result as $obj) {
        //message couper si trop long
        $message = $obj["contenu"][0]->getTextMessage();
        if(strlen($message) > 25){
            $message = substr_replace($message,"...",25);
        }
        //design message lu ou pas
        if(is_null($obj["contenu"][0]->getLuMessage())){
            $class = "messageNonLu";
        }else{
            $class = "messageLu";
        }
        //avatar de la personne
        if(is_null($obj["exp"][0]->getAvatarUser())){
            $avatar = "avatar-picmento.png";
        }else{
            $avatar = $obj["exp"][0]->getAvatarUser();
        }
        //date
        $date = new DateTime($obj["contenu"][0]->getDateMessage());
        
        $jour = $date->format("d");
        $mois = $date->format("m");
                $tableauDeMois= [
                    'JAN'=> '01',
                    'FEV'=> '02',
                    'MAR'  =>  '03',
                    'AVR' => '04',
                    'MAI'   => '05',
                    'JUN'  =>  '06',
                    'JUL' => '07',
                    'AOU' => '08',
                    'SEP' => '09',
                    'OCT' => '10',
                    'NOV' => '11',
                    'DEC' => '12'    
                ];
        $mois = array_search($mois,$tableauDeMois);


        echo"<section data-id=\"".$obj["contenu"][0]->getIdMessage()."\" class=\"message-recu fc \">
                <div class=\"avatar-rond\">
                    <img src=\"".DOMAINE."medias/avatar/".$avatar."\" alt=\"Photo de ".$obj["exp"][0]->getPrenomUser()." ".$obj["exp"][0]->getNomUser()."\">
                </div>
        
                <div class=\"".$class."\">
                        <p>".$obj["exp"][0]->getPrenomUser()." ".$obj["exp"][0]->getNomUser()."</p>
                        <p>".$message."</p>
                
                </div>
                <div class=\"filou wrap id-".$obj["contenu"][0]->getIdMessage()."\">
                    <div class=\"fc fw\">
                        <div class=\"avatar-rond\">
                            <img src=\"".DOMAINE."medias/avatar/".$avatar."\" alt=\"Photo de ".$obj["exp"][0]->getPrenomUser()." ".$obj["exp"][0]->getNomUser()."\">
                        </div>
                        <p>".$obj["contenu"][0]->getTextMessage()."</p>
                    </div>
                    <nav>
                        <ul class=\"fc fw\">
                            <li class=\"mla\">
                                <a href=\"repondre-".$obj["contenu"][0]->getIdMessage()."\" title=\"Répondre\">
                                    <i class=\"fas fa-pen-square\"></i>
                                </a>
                            </li>
                            <li>
                                <a href=\"supprimer-message-".$obj["contenu"][0]->getIdMessage()."\" title=\"Supprimer message\" class=\"gogo\" data-gogo=\"ce message\">
                                    <i class=\"fas fa-trash\"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class=\"date-mail\">
                    <p>".$jour."</p>
                    <p>".$mois."</p>
                </div>
            </section>
                
                
                ";
        
    }
    
    
    echo"</section>";



    
}

?>
<script src="templates/back/js/confirmation.js" defer></script>
<script src="templates/back/js/openMessage.js" defer></script>
<script src="templates/back/js/messageLuAjax.js" defer></script>
