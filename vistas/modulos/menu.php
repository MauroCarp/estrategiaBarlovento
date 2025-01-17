<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">
			
	<?php if($_SESSION['empresa'] != 'Estrategia' && $_COOKIE['empresa'] != 'Estrategia'){ ?>

			<li class="active">
				
				<a href="inicio">
					
					<i class="fa fa-home" style="font-size:1.2em;"></i>
					<span>Inicio</span>
					
				</a>
				
			</li>
				
<?php
 
	if($_SESSION["perfil"] == "Administrador" && ($_SESSION["empresa"] != "Estrategia" && $_COOKIE["empresa"] != "Estrategia")){
		
				echo '
					<li>
	
					<a href="#" data-toggle="modal" data-target="#ventanaModalCarpetas" id="menuCarpetas">
	
					<i class="fa fa-files-o" style="font-size:1.2em;padding-right:5px;"></i>
					<span>Carpetas </span>
	
					</a>
	
					</li>
	
					<li>
	
					<a href="#" data-toggle="modal" data-target="#	" id="menuPerfiles">
	
					<i class="fa fa-sliders" style="font-size:1.8em;"></i>
					<span>&nbsp;Perfiles</span>
	
					</a>
	
				</li>';
	}
	
	if($_SESSION["usuario"] == "Jorge" || $_SESSION["usuario"] == "Tecnico"){
	
				echo '<li>
	
					<a href="analisis">
	
						<i class="fa fa-line-chart"></i>
						<span>Analisis</span>
	
					</a>
	
				</li>
	
				<li>
	
					<a href="usuarios">
	
						<i class="fa fa-user"></i>
						<span>Usuarios</span>
	
					</a>
	
				</li>';
	
	}

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