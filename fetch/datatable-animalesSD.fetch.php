<?php

require_once "../controladores/animales.controlador.php";
require_once "../modelos/animales.modelo.php";

require_once "../controladores/carpetas.controlador.php";
require_once "../modelos/carpetas.modelo.php";

class TablaAnimalesSD{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaAnimales(){

		$item = 'clasificacion';

		$valor = null;

		$animales = ControladorAnimales::ctrMostrarAnimales($item, $valor);

        if(count($animales) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
		$item = 'activa';
		
		$valor = 1;

		$orden = 'fecha';

		$carpetas = ControladorCarpetas::ctrMostrarCarpetas($item,$valor,$orden,'ASC');

		$options = '';

		foreach ($carpetas as $key => $carpeta) {
			
			$idCarpeta = $carpeta['idCarpeta'];
			
			$descripcion = $carpeta['descripcion'];

			$options .= "<option value='$idCarpeta'>$descripcion</option>";

		}
		
		$datosJson = '{
			"data": [';
			
			foreach ($animales as $key => $animal) {
						
				$sexo = ($animal['sexo'] == 'M') ? 'Macho' : 'Hembra';

				$clasificacion = 
				// $selectDestino = '<select name="perfilSD'.$animal['idAnimal'].'" class="form-control">'.$options.'</select>';
				$selectDestino = '<select></select>';

				// $selectDestino = '-';

				// $selectDestino = "<input type='text' class='form-control'>";

				$deleteBtn = "<div class='btn-group'><button class='btn btn-danger btnEliminarAnimal' idAnimal='".$animal['idAnimal']."'><i class='fa fa-times'></i></button></div>";
				
				$clasificacion = '-';

				$datosJson .='[
					"'.$key.'",
					"'.$animal["RFID"].'",
					"'.$animal["mmGrasa"].'",
					"'.$animal["peso"].'",
					"'.$sexo.'",
					"'.$clasificacion.'",
					"'.$selectDestino.'",
					"'.$deleteBtn.'"
					],';

			}

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
TABLA DE ANIMALES
=============================================*/ 
$activarTablaAnimales = new TablaAnimalesSD();
$activarTablaAnimales -> mostrarTablaAnimales();

