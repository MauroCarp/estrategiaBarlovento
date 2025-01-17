<?php

require_once "../controladores/carpetas.controlador.php";
require_once "../modelos/carpetas.modelo.php";

require_once "../controladores/animales.controlador.php";
require_once "../modelos/animales.modelo.php";

require_once "../controladores/perfiles.controlador.php";
require_once "../modelos/perfiles.modelo.php";

require_once "../controladores/analisis.controlador.php";
require_once "../modelos/analisis.modelo.php";


class FetchAnimales{
	
    public $idPerfil;

    public $idAnimal;

    public function fetchNuevoAnimal($data){

		$respuesta = ControladorAnimales::ctrNuevoAnimal($data);

        echo json_encode($respuesta);
      
    }

    public function fetchActualizarClasificacion(){
        
        $item = 'id';
        
        $valor = $this->idPerfil;

		$respuesta = ControladorPerfiles::ctrMostrarPerfiles($item,$valor);

        $flacas = $respuesta['flacas'];
        $buenas = $respuesta['buenas'];
        $buenasMas = $respuesta['buenasMas'];
        $muyBuenas = $respuesta['muyBuenas'];
        $apenasGordas = $respuesta['apenasGordas'];

        // TOTAL FLACAS
        
        $item = 'tas3';
        
        $item3 = 'tipo';

        $valor3 = 'Gordos';

        for ($i=0; $i < 2; $i++) { 
            
            if($i == 1)
                $valor3 = 'Corral';

            $valor = $flacas;
            
            $clas = 'flacas';

            $cantFlacas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,null,$clas,$item3,$valor3);
           
            $data[$valor3]['flacas'] = $cantFlacas['total'];

            // TOTAL BUENAS
                    
            $valor = $buenas;
            
            $valor2 = $flacas;

            $clas = 'buenas';

            $cantBuenas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,$valor2,$clas,$item3,$valor3);

            $data[$valor3]['buenas'] = $cantBuenas['total'];

            // TOTAL BUENAS+
            
            $valor = $buenasMas;
            
            $valor2 = $buenas;

            $clas = 'buenasMas';

            $cantBuenasMas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,$valor2,$clas,$item3,$valor3);

            $data[$valor3]['buenasMas'] = $cantBuenasMas['total'];

            // TOTAL MUY BUENAS
            
            $valor = $muyBuenas;
            
            $valor2 = $buenasMas;

            $clas = 'muyBuenas';

            $cantMuyBuenas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,$valor2,$clas,$item3,$valor3);

            $data[$valor3]['muyBuenas'] = $cantMuyBuenas['total'];

            // TOTAL AP
            
            $valor = $apenasGordas;
            
            $valor2 = $muyBuenas;

            $clas = 'apenasGordas';

            $cantApenasGordas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,$valor2,$clas,$item3,$valor3);
            
            $data[$valor3]['apenasGordas'] = $cantApenasGordas['total'];

            // TOTAL GORDAS

            $clas = 'gordas';

            $cantGordas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,null,$clas,$item3,$valor3);
            
            $data[$valor3]['gordas'] = $cantGordas['total'];

            
            // TOTAL ANIMALES
            $data[$valor3]['total'] = $data[$valor3]['flacas'] + $data[$valor3]['buenas'] + $data[$valor3]['buenasMas'] + $data[$valor3]['muyBuenas'] + $data[$valor3]['apenasGordas'] + $data[$valor3]['gordas'];
            
        }

        echo json_encode($data);
      
    }

    public function fetchEliminarAnimal($analisis = false){

        $item = 'idAnimal';
        
        $value = $this->idAnimal;
        
        if(!$analisis){

            $animal = ControladorAnimales::ctrMostrarAnimales($item,$value);
    
            $err = array();
            
            $err['eliminar'] = ControladorAnimales::ctrEliminarAnimal($item,$value);
    
            $datos = 'restar';
    
            $item = 'idCarpeta';
    
            $valor = $animal[0]['idCarpeta'];
            
            $err['restar'] = ControladorCarpetas::ctrEditarCarpeta($item,$valor,$datos);
    
            echo json_encode($err);

        } else {

            $respuesta = ControladorAnimales::ctrEliminarAnimal($item,$value,$analisis);

            echo $respuesta;
        }
      
    }

    public function fetchMostrarAnimalesSD(){

        $item = 'clasificacion';

        $valor = null;

        $animalesSD = ControladorAnimales::ctrMostrarAnimales($item, $valor);

        $perfil = $this->idPerfil;

        for ($i=0; $i < sizeof($animalesSD) ; $i++) { 
            
            $clasificacion = ControladorAnimales::ctrDeterminarClasificacion($perfil,$animalesSD[$i]['tas3'],$animalesSD[$i]['sexo']);

            $animalesSD[$i]['clasificacion'] = $clasificacion;
        }

        echo json_encode($animalesSD);
            
    }


}

if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'nuevo'){

        $nuevoAnimal = new FetchAnimales();
		$nuevoAnimal -> fetchNuevoAnimal($_POST);

    }

    if($accion == 'actualizarClasificacion'){

        $actualizarClasif = new FetchAnimales();
		$actualizarClasif -> idPerfil = $_POST['idPerfil'];
		$actualizarClasif -> fetchActualizarClasificacion();

    }

    if($accion == 'eliminarAnimal'){

        $eliminarAnimal = new FetchAnimales();
		$eliminarAnimal -> idAnimal = $_POST['idAnimal'];
        $analisis = ($_POST['analisis']) ? true : false;
		$eliminarAnimal -> fetchEliminarAnimal($analisis);

    }


    if($accion == 'animalesSD'){

        $animalesSD = new FetchAnimales();
        $animalesSD -> idPerfil = $_POST['perfil'];
		$animalesSD -> fetchMostrarAnimalesSD();

    }
}