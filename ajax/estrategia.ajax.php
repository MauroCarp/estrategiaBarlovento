<?php

require_once "../controladores/estrategia.controlador.php";
require_once "../modelos/estrategia.modelo.php";

class AjaxEstrategia{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

    public $idDieta;
    public $campania;
	public $data;

	public function ajaxGenerarOptionInsumos(){

		$data = ControladorEstrategia::ctrMostrarInsumos();

		echo json_encode($data);

	}

    public function ajaxMostrarDieta(){

        $idDieta = $this->idDieta;

		$data = ControladorEstrategia::ctrMostrarDieta($idDieta);

		echo json_encode($data);

	}

    public function ajaxEliminarDieta(){

        $idDieta = $this->idDieta;

		$respuesta = ControladorEstrategia::ctrEliminarDieta($idDieta);

		echo $respuesta;

	}

	public function ajaxMostrarEstrategia(){

        $campania = $this->campania;

		$respuesta = ControladorEstrategia::ctrMostrarEstrategia($campania);

		echo json_encode($respuesta);

	}

	public function ajaxGuardarEstrategia(){

		$data = $this->data;

		$respuesta = ControladorEstrategia::ctrGuardarEstrategia($data);
		echo json_encode($respuesta);

		// header('Content-Type: application/json');

		// echo json_encode(['message' => 'ok']);

	}
    

}


/*=============================================
EDITAR USUARIO
=============================================*/

if(isset($_POST["accion"])){

	$accion = $_POST['accion'];
	
	if($accion == 'getInsumos'){

		$mostrarData = new AjaxEstrategia();
        $mostrarData -> ajaxGenerarOptionInsumos();

    }
	
	if($accion == 'verDieta'){

		$mostrarDieta = new AjaxEstrategia();
        $mostrarDieta ->idDieta = $_POST['idDieta'];
        $mostrarDieta ->ajaxMostrarDieta();

    }
	
	if($accion == 'eliminarDieta'){

		$eliminarDieta = new AjaxEstrategia();
        $eliminarDieta ->idDieta = $_POST['idDieta'];
        $eliminarDieta ->ajaxEliminarDieta();

    }
	
	if($accion == 'mostrarEstrategia'){

		$mostrarEstrategia = new AjaxEstrategia();
        $mostrarEstrategia ->campania = $_POST['campania'];
        $mostrarEstrategia ->ajaxMostrarEstrategia();

    }

	if($accion == 'guardar'){

		$guardarEstrategia = new AjaxEstrategia();
		$guardarEstrategia ->data = $_POST;
		$guardarEstrategia ->ajaxGuardarEstrategia();


	}



}

