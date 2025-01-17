<?php

require_once "../controladores/animales.controlador.php";
require_once "../modelos/animales.modelo.php";

require_once "../controladores/carpetas.controlador.php";
require_once "../modelos/carpetas.modelo.php";

class TablaIngresos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaAnimales(){


		$item = 'date';
  
		$today = date('Y-m-d');

		$tomorrow = date('Y-m-d',strtotime($today."+ 1 days"));

		$animales = ControladorAnimales::ctrMostrarAnimalesBetween($item, $today,$tomorrow);

        if(count($animales) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
				
		$datosJson = '{
			"data": [';
			
			foreach ($animales as $key => $animal) {
				
				$style="";
				
				switch ($animal['registroClas']) {

					case 'F':
						$text = 'Flaca';
						$color = 'danger';
						break;
					
					case 'G':
						$text = 'Gorda';
						$color = 'danger';
						break;
		
						
					case 'B':
						$color = 'success';
						$text = 'Buena';
						$style = 'background-color: rgb(137 221 113);';
						break;
						
					case 'B+':
						$color = 'success';
						$text = 'Buena+';
						break;
							
					case 'MB':
						$color = 'success';
						$text = 'Muy Buena';
						break;
		
					case 'AP':
						$text = 'Apenas Gorda';
						$color = 'warning';
						break;
					
					default:
						$style='';
						$color='default';
						$text='Sin Destino';
						break;
				}
		
				$label = "<span class='label label-$color' style='font-size:1.2em;width: 100%;$style'>$text</span>";

				$deleteBtn = "<div class='btn-group'><button class='btn btn-danger btnEliminar btnEliminarAnimal' idAnimal='".$animal['idAnimal']."'><i class='fa fa-times'></i></button></div>";

				$sexo = ($animal['sexo'] == 'M') ? 'Macho' : 'Hembra';

				$item = 'idCarpeta';

				$destino = 'Sin Destino';

				if($animal['idCarpeta'] != null){
			
					$carpeta = ControladorCarpetas::ctrMostrarCarpetas($item,$animal['idCarpeta'],'fecha','DESC');
				
					$destino = $carpeta[0]['descripcion'];

				}

				$datosJson .='[
					"'.$animal["RFID"].'",
					"'.$animal["mmGrasa"].'",
					"'.$animal["peso"].'",
					"'.$sexo.'",
					"'.$label.'",
					"'.$destino.'",
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
$activarTablaAnimales = new TablaIngresos();
$activarTablaAnimales -> mostrarTablaAnimales();

