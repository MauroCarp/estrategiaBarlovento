<?php

require_once "../controladores/analisis.controlador.php";
require_once "../modelos/analisis.modelo.php";

class FetchAnalisis{
	
    public function fetchMostrarAnimales(){

        $animales = ControladorAnalisis::ctrMostrarAnimales();

        echo json_encode($animales);
            
    }

    public function fetchElimiarRfid(){

        $rfid = $this->rfid;
      
        $respuesta = ControladorAnalisis::ctrEliminarRfid($rfid);

        echo json_encode($respuesta);
            
    }

    public function fetchCheckRfid(){

        $rfid = $this->rfid;
        $check = $this->check;

        $respuesta = ControladorAnalisis::ctrRfidCheck($rfid,$check);
       
        echo $respuesta;
            
    }

}



if(isset($_POST['accion'])){
    
    if($_POST['accion'] == 'eliminarAnimal'){

        $eliminarRfid = new FetchAnalisis();
        $eliminarRfid->rfid = $_POST['idAnimal'];

        $eliminarRfid -> fetchElimiarRfid();
        
    }

    if($_POST['accion'] == 'check'){
        $checkRfid = new FetchAnalisis();
        $checkRfid->rfid = $_POST['rfid'];
        $checkRfid->check = $_POST['check'];
       
        $checkRfid-> fetchCheckRfid();
    }

} else {
    
    $mostrarAnimales = new FetchAnalisis();
    $mostrarAnimales -> fetchMostrarAnimales();
}