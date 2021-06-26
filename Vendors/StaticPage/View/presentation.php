<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();
?>
<main class="fc fw wrap jc-sb presentation">
    <p class="accroche">Toutes vos photos conservées dans une capsule temporelle à partager avec vos proches !</p>
    <section class="xlg-4 mg-6 s-12 blok-presentation">
        <h2>Application web</h2>
        <p>Ultra simple pour sauvegarder, partager vos propres souvenirs.</p>
        <p>Invitez vos amis, ils pourront consulter vos albums de souvenirs en ligne.</p>
    </section>
    <section class="xlg-4 mg-6 s-12 blok-presentation">
        <h2>Créez votre tribu</h2>
        <p>Associez le deuxième parent à votre tribu</p>
        <p>Il pourra lui aussi confectionner les souvenirs de vos enfants</p>
        <p>Vous avez un nouveau départ ? C'est très simple, ajoutez une nouvelle tribu et associez le nouveau parent</p>
    </section>
    <section class="xlg-4 m-12 blok-presentation">
        <h2>Sauvegardez vos souvenirs</h2>
        <p>Confectionnez l'histoire de vos enfants</p>
        <p>Les photos sont le meilleur moyen d'apporter une richesse aux moments importants d’une vie. </p>
        <p>Ils seront enregistrés dans un environnement sécurisé.</p>

    </section>

</main>


<div id="video" class="wrap">
    <video controls>
        <source src="<?php echo DOMAINE; ?>templates/front/images/picmento.mp4"
                type="video/mp4">        
    </video>
    
</div>


      

        
        

<!-- <p class="btn-inscription"><a href="<?php echo DOMAINE; ?>inscription" title="Inscription Picmento">Inscription</a></p> -->


<script src="templates/front/js/visuFeedback.js" defer></script>
<script src="templates/front/js/downImgBandeau.js" defer></script>

  



