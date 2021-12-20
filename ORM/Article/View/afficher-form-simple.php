<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();
if (isset($_SESSION["nom_photo1"])||isset($_SESSION["nom_photo2"])||isset($_SESSION["nom_photo3"])){

    echo"<div class=\"wrap fc fw jc-c containerUpload\">";

    if(isset($_SESSION["nom_photo1"])){
        
        echo"<div class=\"blockUploadCarre\">
                <div class=\"upload-carre\">
                    <img src=\"".DOMAINE."medias/souvenir/".$_SESSION["nom_photo1"]."\" alt=\"Photo\">
                </div>
                <p class=\"pUpload\">Photo 1</p>
            </div>
        ";

    }
    if(isset($_SESSION["nom_photo2"])){
        
        echo"<div class=\"blockUploadCarre\">
                <div class=\"upload-carre\">
                    <img src=\"".DOMAINE."medias/souvenir/".$_SESSION["nom_photo2"]."\" alt=\"Photo\">
                </div>
                <p class=\"pUpload\">Photo 2</p>
            </div>
        ";

    }
    if(isset($_SESSION["nom_photo3"])){
        
        echo"<div class=\"blockUploadCarre\">
                <div class=\"upload-carre\">
                    <img src=\"".DOMAINE."medias/souvenir/".$_SESSION["nom_photo3"]."\" alt=\"Photo\">
                </div>
                <p class=\"pUpload\">Photo 3</p>
            </div>
        ";

    }
    echo"</div>";
}
if(isset($result)){
	echo "<div id=\"zone-form\" class=\"wrap content\">".$result->getForm()."</div>";
    

}

?>
<script>CKEDITOR.replace('description_article');</script>
<script src="templates/back/js/styleCkeditor.js" defer></script>
<script>document.getElementById('dateOrder').value = "<?php echo date("Y-m-d"); ?>";</script>
