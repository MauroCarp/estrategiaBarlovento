<?php

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario(){
		var_dump('entro aca');

		if(isset($_POST["ingUsuario"])){
			var_dump('POST USUARIO');

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])){

			   	$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";

				$item = "usuario";

				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
				var_dump($respuesta);

				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

					if($respuesta["estado"] == 1){

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];
						$_SESSION["empresa"] = $respuesta["empresa"];

						if( isset($_POST['rememberme']) ){
												
							// Set cookie variables
							$value =  encrypt_decrypt('encrypt', $respuesta["id"]);
			
							echo '<script>	

							document.cookie = `rememberme='.$value.';path=/;expires=Thu, 31 Dec 2025 23:59:59 UTC`

							</script>';
							
						}

							
						/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

						date_default_timezone_set('America/Argentina/Buenos_Aires');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
						var_dump('aparentemento logueo');
						if($ultimoLogin == "ok"){
							var_dump('voy a redireccionar');
							die;
								echo '<script>
								
								window.location = "index.php";
								
								</script>';

						}				
						
					}else{

						echo '<br>
							<div class="alert alert-danger">El usuario aún no está activado</div>';

					}		

				}else{
					var_dump('error al ingresar');
					die;
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

				}
				die;

			}	

		}

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario(){

		if(isset($_POST["nuevoUsuario"])){
			
		
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoEmpresa"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$empresa = ($_POST['nuevoEmpresa'] == 'otraEmpresa') ? $_POST['otraEmpresa'] : $_POST['nuevoEmpresa'];

				$datos = array("nombre" => $_POST["nuevoNombre"],
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $encriptar,
					           "empresa" => $empresa,
					           "perfil" => $_POST["nuevoPerfil"]);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					new swal({

						icon: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

					new swal({

						icon: "error",
						title: "¡Hay campos que no pueden ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';

			}


		}


	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR USUARIO DISTINCT
	=============================================*/

	static public function ctrMostrarUsuariosDistinct($distinct,$item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuariosDistinct($tabla, $distinct,$item, $valor);

		return $respuesta;
	}
	
	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				$tabla = "usuarios";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo'<script>

							new	swal({
									  icon: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result) {
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

						  	return;

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

				$datos = array("nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "empresa" => $_POST["editarEmpresa"],
							   "perfil" => $_POST["editarPerfil"]);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					new swal({
						  icon: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					new swal({
						  icon: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="usuarios";
			$datos = $_GET["idUsuario"];

			if($_GET["fotoUsuario"] != ""){

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				new swal({
					  icon: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}		

		}

	}

	/*=============================================
	CONTAR USUARIOS
	=============================================*/

	static public function ctrContarUsuarios($item,$valor){

		$tabla = 'usuarios';

		return $respuesta = ModeloUsuarios::mdlContarUsuarios($tabla, $item,$valor);

	}


}
	


