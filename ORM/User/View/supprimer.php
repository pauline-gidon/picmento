<?php
use Vendors\Flash\Flash;
?>

<div class="wrap">
<?php
$flash = new FLash();
echo $flash->getFlash();
?>
<h2>Souhaitez-vous réellement supprimer votre compte ?</h2>
<ul>
	<li>La suppression de votre compte sera définitive.</li>
	<li>Elle s'accompagnera de la suppression de toutes vos réservations.</li>
	<li>Qu'il s'agisse d'activités à venir ou d'activités passées.</li>
	<li>En supprimant votre compte, vous ne pourrez donc plus participer à nos activités.</li>
	<li>Si, dans le futur, vous souhaitiez vous réinscrire, cela serait possible.</li>
	<li>Mais vous ne pourriez pas retrouver d'informations concernant votre ancien compte.</li>
</ul>
<p>
	<a href="suppression-compte" title="Je souhaite supprimer définitivement mon compte et toutes les informations le concernant" class="btn">Confirmer la suppression</a>
	 
	<a href="admin" title="Je ne souhaite pas supprimer mon compte pour le moment" class="btn">Annuler la suppression</a>
</p>
</div>