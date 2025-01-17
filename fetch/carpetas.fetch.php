<?php

require_once "../controladores/carpetas.controlador.php";
require_once "../modelos/carpetas.modelo.php";

require_once "../controladores/animales.controlador.php";
require_once "../modelos/animales.modelo.php";


class FetchCarpetas{
	
    public $idCarpeta;

    public function fetchMostrarCarpetas(){

        $item = 'activa';
        
        $valor = 1;

        $orden = 'fecha';

        $fecha1 = date('Y-m-d');

        $fecha2 = date('Y-m-d',strtotime($fecha1."+ 1 days"));
        
		$respuesta = ControladorCarpetas::ctrMostrarCarpetasBetween($item,$valor,$fecha1,$fecha2,$orden);

        echo json_encode($respuesta);
      
    }
	
    public function fetchNuevaCarpeta($data){
        
        $respuesta = ControladorCarpetas::ctrNuevaCarpeta($data);

        echo json_encode($respuesta);
      
    }

    public function fetchEliminarCarpeta(){

        $valor = $this->idCarpeta;

        $item = 'idCarpeta';
        
        $respuesta = ControladorCarpetas::ctrEliminarCarpeta($item,$valor);

        echo json_encode($respuesta);

    }

    public function fetchVerCarpeta(){

        $item = 'idCarpeta';

        $valor = $this->idCarpeta;

        $respuesta = ControladorCarpetas::ctrMostrarCarpetas($item, $valor,'fecha','ASC');

        echo json_encode($respuesta);

    }


}

if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'mostrarActivas'){

        $mostrarCarpetasActivas = new FetchCarpetas();
		$mostrarCarpetasActivas -> fetchMostrarCarpetas();

    }

	if($accion == 'nuevaCarpeta'){

        $nuevaCarpeta = new FetchCarpetas();
		$nuevaCarpeta -> fetchNuevaCarpeta($_POST);

    }

	if($accion == 'verCarpeta'){

        $verCarpeta = new FetchCarpetas();
        $verCarpeta-> idCarpeta = $_POST['idCarpeta'];
		$verCarpeta -> fetchVerCarpeta();

    }

	if($accion == 'eliminarCarpeta'){

        $eliminarCarpeta = new FetchCarpetas();
        $eliminarCarpeta-> idCarpeta = $_POST['idCarpeta'];
		$eliminarCarpeta -> fetchEliminarCarpeta();

    }


}