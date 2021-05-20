<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

// if(isset($result)){
// echo "<section class=\"baby\">";
//     foreach ($result as $obj) {
//         echo "<div class=\"photo-carre-tribu\">
//                  <div class=\"cassbonbon\">
//                     <img class=\"id-baby\" src=\"".DOMAINE."medias/photo-baby/".$obj->getPhotoBaby()."\" alt=\"Photo de ".$obj->getNomBaby()."\">
//                 </div>
//                 <h2 class=\"id-baby nom-baby\">".$obj->getNomBaby()."</h2>
//             </div>
//                <ul>
//                <li><a href=\"ami-afficher-souvenirs-".$obj->getIdBaby()."\" title=\"Voir les souvenirs de ".$obj->getNomBaby()."\">Souvenirs</a></li>
//                <li><a href=\"ami-afficher-naissance-".$obj->getIdBaby()."\" title=\"Naissance de ".$obj->getNomBaby()."\">Naissance</a></li>
//                <li><a href=\"ami-afficher-timeline-".$obj->getIdBaby()."\" title=\"Afficher timeline de ".$obj->getNomBaby()."\">Timeline</a></li>
//                </ul>";
//             }
//    echo "</section>";
  
// }

///////////////////////////////////////////////////////////////////////////////////////////////


if(isset($result)){
    // var_dump($result);die();
    foreach($result as $obj) {
        if(($obj->getUserIdParent1() != $_SESSION["auth"]["id"]) && ($obj->getUserIdParent2() != $_SESSION["auth"]["id"])){
          
            echo "<div class=\"tribubaby fc fw wrap\">
            <div class=\"colG\">";
            $ids = explode("/",$obj->liste_id);
            $noms = explode("/",$obj->liste_nom);
            $photos = explode("/",$obj->liste_photo);
            echo "<h2> Sa tribu : ".$obj->getNomTribu()."</h2>
            <div class=\"fc fw jc-c\">";
    
    
            
            for ($i=0; $i < count($ids); $i++) { 
                if(!is_null($obj->liste_id)){
                    // <a class=\"t-n-baby\"href=\"toto?id=".$ids[$i]."\"><img src=\"".DOMAINE."medias/photo-baby/".$photos[$i]."\" alt=\"Photo de ".$noms[$i]."\"></a>
                    //             <a class=\"t-n-baby\"href=\"toto?id=".$ids[$i]."\">".$noms[$i]."</a>
                    //         <p><a href=\"ajouter-souvenir-".$ids[$i]."\" title=\"Ajouter un souvenir à ".$noms[$i]."\">Ajouter un souvenir</a></p>
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
    
            echo "  <p class=\"btn-add-souvenir-amis\">
                        <a href=\"ajouter-souvenir-tribu-ami-".$obj->getIdTribu()."\" title=\"Ajouter un souvenir à la tribu de mon ami\">
                            <i class=\"ico icofont-memorial\"></i>
                        </a>
                    </p>
                    </div>
                </div>
    
    
    
        </div>";                
        }else{
            echo"<p> Votre amis a une tribu en commun avec vous !</p>";
        }
    
    }//fin du foreach

    
    
    
    
}
?>
<script type="text/javascript" src="templates/back/js/confirmation.js"></script>
<script type="text/javascript" src="templates/back/js/yup.js" defer></script>
