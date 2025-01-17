<?php
echo '<div class="wrapper">';

/*=============================================
CABEZOTE
=============================================*/

include "modulos/cabezote.php";

/*=============================================
MENU
=============================================*/

include "modulos/menu.php";

/*=============================================
CONTENIDO
=============================================*/

if(isset($_GET["ruta"])){

  if($_GET["ruta"] == "inicio" ||
     $_GET["ruta"] == "404" ||
     $_GET["ruta"] == "index" ||
     $_GET["ruta"] == "usuarios" ||
     $_GET["ruta"] == "salir"){

    include "modulos/".$_GET["ruta"].".php";

  }else{

    include "modulos/404.php";

  }

}else{

  include "modulos/inicio.php";

}

/*=============================================
FOOTER
=============================================*/

include "modulos/footer.php";

echo '</div>';

?>