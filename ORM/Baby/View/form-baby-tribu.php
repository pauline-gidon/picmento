<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

if(isset($result)){

	echo "<div>
            <div id=\"zone-form\" class=\"wrap content\">".$result->getForm()."</div>";
            // var_dump($_FILES["photo_baby"]);
            // var_dump($_SESSION["photo"]);
            // if(isset($_SESSION["photo"])){
            //     var_dump($_FILES["photo_baby"]);
            //     echo "<img src=\"".$_SESSION["photo"]."\"/>";
            // }
        echo"</div>";

}
?>
<script>document.getElementById('dateOrder').value = "<?php echo date("Y-m-d"); ?>";</script>

