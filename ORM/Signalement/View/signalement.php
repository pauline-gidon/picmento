<?php
use Vendors\Flash\Flash;
$flash = new FLash();
// echo $flash->getFlash();
//$general[0]= baby
echo $flash->getFlash();

// var_dump($_SERVER);

$_SESSION["REF"] = $_SERVER["HTTP_REFERER"];

if(isset($result)){
// var_dump($result);
    if(isset($result["photo"])){

        echo "<div class=\"wrap containerSignalement\">
                <h2> Vous voulez signaler cette photo </h2>
                <div class='signalementImg'>
                <img src=\"".DOMAINE."medias/souvenir/".$result["photo"]->getNomMedias()."\" alt=\"Photo de ".$result["photo"]->getNomMedias()."\">
                </div>

        </div>";
    }
    if(isset($result["com"])){
        echo "<div class=\"wrap containerSignalement\">
        <h2> Vous voulez signaler ce commentaire </h2>
        <div class='signalementCom'>
            <p>".$result["com"]->getDescriptionCommentaire()."</p>
        </div>
        
        </div>";
    }
    if(isset($result["souvenir"])){
        // var_dump($result["souvenir"]);

        echo "<div class=\"wrap containerSignalement\">
                <h2> Vous voulez signaler ce souvenir </h2>
                <div class='signalementSouvenir'>
                    <h3>".$result["souvenir"]->getTitreArticle()."</h3>
                    <div>
                        ".$result["souvenir"]->getDescriptionArticle()."
                    </div>
                </div>
        </div>";
    }


    if(isset($result["formulaire"])){

        echo "<div id=\"zone-form\" class=\"wrap content\">".$result["formulaire"]->getForm()."</div>";
    }

}