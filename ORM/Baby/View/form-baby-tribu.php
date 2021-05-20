<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){

	echo "<div>
            <div id=\"zone-form\" class=\"wrap content\">".$result->getForm()."</div>";
            if(isset($_SESSION["photo"])){
                var_dump($_FILES["photo_baby"]);
                echo "<img src=\"".$_SESSION["photo"]."\"/>";
            }
        echo"</div>";

}
?>
<script type="text/javascript">
	$(function(){
		$('.flatpickr').flatpickr({
			dateFormat: 'Y-m-d',
			enableTime: true,
			time_24hr: true
		});
		$('.flatpickr2').flatpickr({
			dateFormat: 'H:i:00',
			enableTime: true,
			time_24hr: true
		});
	});
</script>