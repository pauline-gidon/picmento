<?php
echo"<section class=\"wrap\">
        <div class=\"userMsg\">";
if(isset($result["user"])){

    if(is_null($result["user"]->getAvatarUser())){
        $avatar = "avatar-picmento.png";
    }else{
        $avatar = $result["user"]->getAvatarUser();
    }
    echo"<div class=\"fc ai-c\">
            <div class=\"avatar-rond\">
            <img src=\"".DOMAINE."medias/avatar/".$avatar."\" alt=\"Photo de ".$result["user"]->getPrenomUser()." ".$result["user"]->getNomUser()."\">
            </div>
            <p class=\"nomUserMessagerie\">".$result["user"]->getPrenomUser()." ".$result["user"]->getNomUser()."</p>
        ";

        if(isset($result["message"])){
                $date = new DateTime($result["message"]->getDateMessage());
                
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
        
        
        
                       echo" <div class=\"date-mail\">
                                <p>".$jour."</p>
                                <p>".$mois."</p>
                            </div>
                        </div>
                <div class=\"textMsg\">".
                $result["message"]->getTextMessage()."
                </div>
                </div>";
        
    
}

            echo"</section>
                
                
                ";
        
    }
    
    
  
    if(isset($result["form"])){
        echo "<div id=\"zone-form\" class=\"wrap content\">".$result["form"]->getForm()."</div>";
        
    
    }
    



    


?>
<script src="templates/back/js/confirmation.js" defer></script>
<script src="templates/back/js/openMessage.js" defer></script>
<script src="templates/back/js/messageLuAjax.js" defer></script>
