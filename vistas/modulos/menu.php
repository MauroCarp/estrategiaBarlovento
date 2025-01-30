<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">
	
				
<?php

	
	if($_SESSION["usuario"] == "Tecnico"){
	
				echo '<li>
	
					<a href="usuarios">
	
						<i class="fa fa-user"></i>
						<span>Usuarios</span>
	
					</a>
	
				</li>';
	
	}

?>

		</ul>

	 </section>

</aside>

<?php

if($_SESSION["usuario"] != "tecnicoEstrategia"){

	if($_SESSION["perfil"] == "Administrador"){

	include 'modales/perfiles.php';

	sleep(3);

	if($_COOKIE['mobile'] == 'false'){
		include 'modales/carpetas.php';
	}else{
		include 'modales/carpetaMobile.php';
	}

	include 'modales/verCarpeta.php';

	}
	
}


?>