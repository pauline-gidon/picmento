<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();
if(isset($result)){

	echo "<div id=\"zone-form\" class=\"wrap content\">".$result->getForm()."</div>";

}
?>
<script src="<?php echo DOMAINE; ?>templates/front/js/visuMdp.js"defer></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/creaMdp.js"defer></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/alerte.js"defer></script>