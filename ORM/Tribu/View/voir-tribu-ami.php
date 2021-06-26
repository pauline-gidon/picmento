<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();


if(isset($result)){
    // var_dump($result);
    if(!is_null($result["user"]->getPseudoUser())){
        $nom = $result["user"]->getPseudoUser();
    }else{
        $nom = $result["user"]->getPrenomUser();
    }
    echo"<h2 class='h2titre'>".$nom."</h2>";
    foreach($result["tribu"] as $obj) {
        // if(($obj->getUserIdParent1() != $_SESSION["auth"]["id"]) && ($obj->getUserIdParent2() != $_SESSION["auth"]["id"])){
          
            echo "<div class=\"tribubaby fc fw wrap\">
            <div class=\"colG\">";
            $ids = explode("/",$obj->liste_id);
            $noms = explode("/",$obj->liste_nom);
            $photos = explode("/",$obj->liste_photo);
            echo "<h2> Sa tribu : ".$obj->getNomTribu()."</h2>
            <div class=\"fc fw jc-c\">";
    
    
            
            for ($i=0; $i < count($ids); $i++) { 
                if(!is_null($obj->liste_id)){

                    echo "<section class=\"baby\">
                             <div class=\"photo-carre-tribu\">
                                <div class=\"cassbonbon\">
                                    <img class=\"id-baby\" data-id=\"".$ids[$i]."\" src=\"".DOMAINE."medias/photo-baby/".$photos[$i]."\" alt=\"Photo de ".$noms[$i]."\">
                                    
                                    </div>
                                    
                                        <div data-id=\"m-".$ids[$i]."\" class=\"modale\">
                                            <h3>".$noms[$i]."</h3>
                                            <p><a href=\"ami-afficher-souvenirs-".$ids[$i]."\" title=\"Voir les souvenirs de ".$noms[$i]."\">Souvenirs</a></p>
                                            <p><a href=\"ami-afficher-naissance-".$ids[$i]."\" title=\"Naissance de ".$noms[$i]."\">Naissance</a></p>
                                            <p><a href=\"ami-afficher-timeline-".$ids[$i]."\" title=\"Afficher timeline de ".$noms[$i]."\">Timeline</a></p>
                                           
                                   
                                            
                                        </div> 
                                <h2 class=\"id-baby nom-baby\" data-id=\"".$ids[$i]."\">".$noms[$i]."</h2>
                            </div>
                          
                        </section>";
                    }
            }
    
            echo "<div class=\"nav-tribu\">
                    <ul>
                        <li>
                            <a href=\"amis-ajouter-souvenir-tribu-".$obj->getIdTribu()."\" title=\"Ajouter un souvenir à la tribu de mon ami\">
                                <i class=\"ico icofont-memorial\"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    
    
    
        </div>";                
        // }else{
        //     echo"<p> Votre amis a une tribu en commun avec vous !</p>";
        // }
    
    }//fin du foreach

    
    
    
    
}
?>
<script type="text/javascript" src="templates/back/js/confirmation.js"></script>
<script type="text/javascript" src="templates/back/js/yup.js" defer></script>
