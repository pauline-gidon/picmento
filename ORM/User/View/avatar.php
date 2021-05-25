<?php
use Vendors\Flash\Flash;
$flash = new FLash();
echo $flash->getFlash();
?>

<div class="wrap">
<!-- <h2>Avatar</h2> -->


<div class="fc fw ai-c jc-c">
	<div class="xlg-3">
		<?php
		if(empty($_SESSION["auth"]["avatar"])){
			echo "<div class=\"avatar\" style=\"background-image: url(medias/avatar/avatar-picmento.png)\"></div>";

		}else{
			echo "
				<div class=\"avatar\" 
				style=\"background-image: url(medias/avatar/".$_SESSION["auth"]["avatar"].")\"></div>			
			";
		}
		?>
	</div>
    
 
	<div class="xlg-9">
		<?php
		if(isset($result)){
			echo $result->getForm();
		}
		?>
	</div>

</div>
</div>