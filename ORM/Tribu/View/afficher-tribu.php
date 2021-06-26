<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();
// var_dump($_SESSION);die();

if(isset($result)){

    foreach($result as $obj) {
        echo "<div class=\"tribubaby fc fw wrap\">
        <div class=\"colG\">";
        $ids = explode("/",$obj->liste_id);
        $noms = explode("/",$obj->liste_nom);
        $photos = explode("/",$obj->liste_photo);
        echo "<h2> Ma tribu : ".$obj->getNomTribu()."</h2>
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
                                        <p><a href=\"afficher-souvenirs-".$ids[$i]."\" title=\"Voir les souvenirs de ".$noms[$i]."\">Souvenirs</a></p>
                                        <p><a href=\"afficher-naissance-".$ids[$i]."\" title=\"Naissance de ".$noms[$i]."\">Naissance</a></p>
                                        <p class=\"double-border-bottom\"><a href=\"afficher-timeline-".$ids[$i]."\" title=\"Afficher timeline de ".$noms[$i]."\">Timeline</a></p>
                               
                                        <p class=\"fc\"><a href=\"modifier-baby-".$ids[$i]."\" title=\"Modifier le profil de ".$noms[$i]."\"><i class=\"fas fa-user-edit\"></i></a>
                                        <a href=\"modifier-photo-baby-".$ids[$i]."\" title=\"Modifier la photo de ".$noms[$i]."\"><i class=\"fas fa-camera\"></i></a>
                                        <a href=\"supprimer-baby-".$ids[$i]."\" title=\"Supprimer le profil de ".$noms[$i]."\"class=\"gogo\" data-gogo=\"".$noms[$i]."\"><i class=\"fas fa-trash\"></i></a></p>
                                    </div> 
                            <h2 class=\"id-baby nom-baby\" data-id=\"".$ids[$i]."\">".$noms[$i]."</h2>
                        </div>
                    </section>";
                }
        }
        
        echo "</div></div>


        <div class=\"nav-tribu\">
            <ul>
                <li>
                    <a href=\"ajouter-souvenir-tribu-".$obj->getIdTribu()."\" title=\"Ajoutez un nouveau souvenir à la tribu ".$obj->getNomTribu()."\">
                    <i class=\"ico icofont-memorial\"></i>
                    </a>
                </li>

                <li>
                    <a href=\"ajouter-baby-tribu-".$obj->getIdTribu()."\" title=\"Ajoutez un enfant à la tribu ".$obj->getNomTribu()."\">
                    <i class=\"ico icofont-baby\"></i>
                    </a>
                    </li>

                <li>
                    <a href=\"editer-tribu-".$obj->getIdTribu()."\" title=\"Modifier le nom de la tribu ".$obj->getNomTribu()."\">
                    <i class=\"fas fa-edit\"></i>
                    </a>
                    </li>
                    
                <li>
                    <a href=\"associer-parent-tribu-".$obj->getIdTribu()."\" title=\"Associer un parent à la tribu ".$obj->getNomTribu()."\">
                    <i class=\"fas fa-user-cog\"></i>
                    </a>
                </li>
                    

                <li>
                    <a href=\"supprimer-tribu-".$obj->getIdTribu()."\" title=\"Suppression de la tribu ".$obj->getNomTribu()."\" class=\"gogo\" data-gogo=\"".$obj->getNomTribu()."\">
                    <i class=\"fas fa-trash\"></i>
                    </a>
                </li>





            </ul>
        </div>           
    </div>";                
    }//fin du foreach

    
    
    
    
}
echo "<p class=\"btnaddtribu fc fw ai-c jc-c\">
<a href=\"ajouter-tribu\" title=\"Ajoutez une tribu\" class=\"fc fw ai-c jc-c\"><i class=\"fas fa-plus\"></i><span>Ajouter tribu</span></a>
</p>";
?>
<script src="templates/back/js/confirmation.js" defer></script>
<script src="templates/back/js/yup.js" defer></script>
<script src="templates/front/js/visuFeedback.js" defer></script>
