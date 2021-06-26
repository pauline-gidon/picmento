<?php
use Vendors\Flash\Flash;
?>

<div class="wrap fc fw jc-c">
<?php
$flash = new FLash();
echo $flash->getFlash();
?>
<div class="supp">
    <img src="<?php echo DOMAINE; ?>templates/back/images/supprimer2.jpg" alt="">
    
</div>
<div class="wrap containterSupprimer">
    <h2>Souhaitez-vous réellement supprimer votre compte ?</h2>
    <ul>
        <li>La suppression de votre compte sera définitive.</li>
        <li>Elle s'accompagnera de la suppression de tous vos contenus.</li>
        <li>Ainsi que votre espace personnel.</li>
        <li>Si, dans le futur, vous souhaitiez vous réinscrire, cela serait possible.</li>
        <li>Mais vous ne pourriez pas retrouver d'informations concernant votre ancien compte.</li>
        <li>Ni de restaurer le compte supprimer.</li>
    </ul>
    <p class="fc fw jc-c">
        <a href="suppression-compte" title="Je souhaite supprimer définitivement mon compte et toutes les informations le concernant" class="btn slide-hover-left">Confirmer la suppression</a>
         
        <a href="espace-perso" title="Je ne souhaite pas supprimer mon compte pour le moment" class="btn ">Annuler la suppression</a>
    </p>
</div>
</div>