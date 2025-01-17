<?php

require_once "../controladores/perfiles.controlador.php";
require_once "../modelos/perfiles.modelo.php";

require_once "../controladores/carpetas.controlador.php";
require_once "../modelos/carpetas.modelo.php";


class FetchSelects{
	
    public function fetchSelectPerfiles($data){

        $item = null;
        
        $valor = null;

		$respuesta = ControladorPerfiles::ctrMostrarPerfiles($item,$valor);

        echo json_encode($respuesta);
      
    }
	
    public function fetchPrioridad(){

        $orden = 'prioridad';
        
		$respuesta = ControladorCarpetas::ctrPrioridadCarpetas($orden);

        echo json_encode($respuesta);
      
    }

}

if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'perfiles'){

        $cargarSelect = new FetchSelects();
		$cargarSelect -> fetchSelectPerfiles($_POST);

    }

	if($accion == 'prioridad'){

        $prioridad = new FetchSelects();
		$prioridad -> fetchPrioridad();

    }

}