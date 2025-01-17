<?php
require_once "../../controladores/carpetas.controlador.php";
require_once " ../../../../modelos/carpetas.modelo.php";

require_once "../../controladores/animales.controlador.php";
require_once " ../../../../modelos/animales.modelo.php";

function formatearFecha($fecha){
    
    $fechaExplode = explode('-',$fecha);
    
    $fechaFormateada = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];
    
    return $fechaFormateada;
    
}

function desvioEstandar($arr){

    $media = array_sum($arr) / count($arr);

    // Calcula la suma de los cuadrados de las diferencias con la media
    $sumatoriaCuadrados = 0;
    foreach ($arr as $valor) {
        $diferencia = $valor - $media;
        $sumatoriaCuadrados += $diferencia * $diferencia;
    }

    // Calcula la desviación estándar
    return sqrt($sumatoriaCuadrados / (count($arr) - 1));
}

$informe = (isset($_GET['informe'])) ?  $_GET['informe'] : false;

class informePDF{

    public $idCarpeta;
    public $accion;
    
    public function informeCarpeta(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------
        $item = 'idCarpeta';
        
        $valor = $this->idCarpeta;
    
        $accion = $this->accion;

        $orden = 'fecha';

        $carpeta = ControladorCarpetas::ctrMostrarCarpetas($item,$valor,$orden,'ASC');

        if($accion == 'false'){

            if($carpeta[0]['activa']){
                
                $item = 'idCarpeta';
                
                $datos = 'desactivar';

                $desactivarCarpeta = ControladorCarpetas::ctrEditarCarpeta($item, $carpeta[0]['idCarpeta'],$datos);

                $priorizarCarpetas = ControladorCarpetas::ctrPriorizar($carpeta[0]['prioridad']);
                
            }

        }

        $today = date('d/m/Y');

        $destino = $carpeta[0]['destino'];

        $descripcion = $carpeta[0]['descripcion'];

        $cabezera = "Informe de Carpeta";
        

        $perfilTmp = ($destino == 'Jorge Cornale') ? 'Barlovento SRL' : $destino;

        $perfil = "Perfil: " . $perfilTmp;

        $destino = "Destino: $descripcion";
        

        $fecha = "Fecha: " . date('d-m-Y',strtotime($carpeta[0]['fecha']));

        include 'cabezera.php'; 

        $pdf->SetFont('helvetica','B',12);
        
        $pdf->Cell(35,7,'Total Animales',0,0,'L',0);
        $pdf->Cell(40,7,utf8_decode('Clasificación'),0,0,'C',0);
        $pdf->Cell(25,7,'Peso Min.',0,0,'L',0);
        $pdf->Cell(20,7,'Peso Max.',0,1,'L',0);
        
        $pdf->SetFont('helvetica','',12);

        $cantidad = ($carpeta[0]['cantidad'] == 0) ? "Libre" : $carpeta[0]['cantidad'];

        $pdf->Cell(35,7,$cantidad,0,0,'C',0);

        $clasificacion = ($carpeta[0]['clasificacion'] != '') ? $carpeta[0]['clasificacion'] : $carpeta[0]['minGrasa']." mm / ".$carpeta[0]['maxGrasa']." mm"; 

        $pdf->Cell(40,7,$clasificacion,0,0,'C',0);

        $pesoMin = $carpeta[0]['pesoMin'];
        $pesoMax = $carpeta[0]['pesoMax'];

        if($carpeta[0]['pesoMax'] == 10000){
        
            $pesoMin = 'Libre';
            $pesoMax = 'Libre';

        } 

        $pdf->Cell(25,7,$pesoMin,0,0,'C',0);
        $pdf->Cell(20,7,$pesoMax,0,1,'C',0);

        $item = 'idCarpeta';

        $animales = ControladorAnimales::ctrMostrarAnimales($item, $valor);

        $pdf->Ln(5);


        $pdf->SetFillColor(220,220,220);

        $valido = true;

        $data = array('pesoMax'=>0,'pesoMin'=>($carpeta[0]['animales'] != 0) ? 9999 : 0,'pesos'=>array(),'pesoTotal'=>0, 'mmMax'=>0,'mmMin'=>($carpeta[0]['animales'] != 0) ? 9999 : 0,'mmTotal'=>0,'mm'=>array(),'totalAnimales'=>0);

        $animalesPorClasificacion = array('F'=>array(),'B'=>array(),'B+'=>array(),'MB'=>array(),'AP'=>array(),'G'=>array());

        foreach ($animales as $animal){
            $animalesPorClasificacion[$animal['clasificacion']][] = $animal; 
        }

        foreach ($animalesPorClasificacion as $clasificacion => $animales) {
        
            foreach ($animales as $key => $animal) {
                $data['pesos'][] = $animal['peso'];
                $data['pesoTotal'] += $animal['peso'];
                $data['totalAnimales']++;
                $data['pesoMin'] = ($animal['peso'] < $data['pesoMin']) ? $animal['peso'] : $data['pesoMin'];
                $data['pesoMax'] = ($animal['peso'] > $data['pesoMax']) ? $animal['peso'] : $data['pesoMax'];
                $data['mmMin'] = ($animal['mmGrasa'] < $data['mmMin']) ? $animal['mmGrasa'] : $data['mmMin'];
                $data['mmMax'] = ($animal['mmGrasa'] > $data['mmMax']) ? $animal['mmGrasa'] : $data['mmMax'];
                $data['mmTotal'] += $animal['mmGrasa'];
                $data['mm'][] = $animal['mmGrasa'];

            }
        }

        $pesoPromedio = $data['pesoTotal'] / $data['totalAnimales'];
        $mmPromedio = $data['mmTotal'] / $data['totalAnimales'];

        $desvioPeso = desvioEstandar($data['pesos']);
        $desvioMm = desvioEstandar($data['mm']);

        $pdf->Cell(20,7,'Peso',1,0,'L',1);
        $pdf->Cell(15,7,'Kg',1,0,'L',1);
        $pdf->Cell(10,7,'',0,0,'L',0);
        $pdf->Cell(20,7,'Grasa',1,0,'L',1);
        $pdf->Cell(15,7,'mm',1,0,'L',1);
        $pdf->Cell(10,7,'',0,0,'L',0);
        $pdf->Cell(43,7,'Total Cab',1,0,'L',1);
        $pdf->Cell(15,7,$data['totalAnimales'],1,0,'L',0);
        $pdf->Cell(15,7,'%',1,1,'L',0);

        $pdf->Cell(20,7,'MIN',1,0,'L',0);
        $pdf->Cell(15,7,$data['pesoMin'],1,0,'L',0);
        $pdf->Cell(10,7,'',0,0,'L',0);
        $pdf->Cell(20,7,'MIN',1,0,'L',0);
        $pdf->Cell(15,7,$data['mmMin'],1,0,'L',0);
        $pdf->Cell(10,7,'',0,0,'L',0);
        $pdf->Cell(43,7,'FLACAS',1,0,'L',0);
        $pdf->Cell(15,7,count($animalesPorClasificacion['F']),1,0,'L',0);
        $pdf->Cell(15,7,number_format((count($animalesPorClasificacion['F']) * 100) / $data['totalAnimales'],2),1,1,'L',0);

        $pdf->Cell(20,7,'MAX',1,0,'L',0);
        $pdf->Cell(15,7,$data['pesoMax'],1,0,'L',0);
        $pdf->Cell(10,7,'',0,0,'L',0);
        $pdf->Cell(20,7,'MAX',1,0,'L',0);
        $pdf->Cell(15,7,$data['mmMax'],1,0,'L',0);
        $pdf->Cell(10,7,'',0,0,'L',0);
        $pdf->Cell(43,7,'BUENA',1,0,'L',0);
        $pdf->Cell(15,7,count($animalesPorClasificacion['B']),1,0,'L',0);
        $pdf->Cell(15,7,number_format((count($animalesPorClasificacion['B']) * 100) / $data['totalAnimales'],2),1,1,'L',0);

        $pdf->Cell(20,7,'PROM',1,0,'L',0);
        $pdf->Cell(15,7,number_format($pesoPromedio,0),1,0,'L',0);
        $pdf->Cell(10,7,'',0,0,'L',0);
        $pdf->Cell(20,7,'PROM',1,0,'L',0);
        $pdf->Cell(15,7,number_format($mmPromedio,0),1,0,'L',0);
        $pdf->Cell(10,7,'',0,0,'L',0);
        $pdf->Cell(43,7,'BUENA+',1,0,'L',0);
        $pdf->Cell(15,7,count($animalesPorClasificacion['B+']),1,0,'L',0);
        $pdf->Cell(15,7,number_format((count($animalesPorClasificacion['B+']) * 100) / $data['totalAnimales'],2),1,1,'L',0);

        $pdf->Cell(20,7,'DESVIO',1,0,'L',0);
        $pdf->Cell(15,7,number_format($desvioPeso,2),1,0,'L',0);
        $pdf->Cell(10,7,'',0,0,'L',0);
        $pdf->Cell(20,7,'DESVIO',1,0,'L',0);
        $pdf->Cell(15,7,number_format($desvioMm,2),1,0,'L',0);
        $pdf->Cell(10,7,'',0,0,'L',0);
        $pdf->Cell(43,7,'MUY BUENAS',1,0,'L',0);
        $pdf->Cell(15,7,count($animalesPorClasificacion['MB']),1,0,'L',0);
        $pdf->Cell(15,7,number_format((count($animalesPorClasificacion['MB']) * 100) / $data['totalAnimales'],2),1,1,'L',0);

        $pdf->Cell(20,7,'TOTAL',1,0,'L',0);
        $pdf->Cell(15,7,$data['pesoTotal'],1,0,'L',0);
        $pdf->Cell(55,7,'',0,0,'L',0);
        $pdf->Cell(43,7,'APENAS GORDAS',1,0,'L',0);
        $pdf->Cell(15,7,count($animalesPorClasificacion['AP']),1,0,'L',0);
        $pdf->Cell(15,7,number_format((count($animalesPorClasificacion['AP']) * 100) / $data['totalAnimales'],2),1,1,'L',0);

        $pdf->Cell(90,7,'',0,0,'L',0);
        $pdf->Cell(43,7,'GORDAS',1,0,'L',0);
        $pdf->Cell(15,7,count($animalesPorClasificacion['G']),1,0,'L',0);
        $pdf->Cell(15,7,number_format((count($animalesPorClasificacion['G']) * 100) / $data['totalAnimales'],2),1,1,'L',0);
   
        $pdf->Ln(2);

        $pdf->Cell(25,7,'RFID',1,0,'L',1);
        $pdf->Cell(25,7,'mm Grasa',1,0,'C',1);
        $pdf->Cell(20,7,'Peso',1,0,'C',1);
        $pdf->Cell(20,7,'Sexo',1,0,'C',1);
        $pdf->Cell(40,7,utf8_decode('Clasificación'),1,1,'C',1);
        
        foreach ($animalesPorClasificacion as $clasificacion => $animales) {
        
            foreach ($animales as $key => $animal) {

                $data['mm'][] = $animal['mmGrasa'];

                if($valido){
                    $pdf->SetFillColor(250,250,250);
                    $valido = false;
                }else{
                    $pdf->SetFillColor(240,240,240);
                    $valido = true;
                }

                if($animal['sexo'] == 'M')
                    $sexo = 'Macho';
                else
                    $sexo = 'Hembra';
                
                switch ($animal['clasificacion']) {
                    case 'F':
                        $clasificacion = 'Flaca';
                        break;

                    case 'B':
                        $clasificacion = 'Buena';
                        break;

                    case 'B+':
                        $clasificacion = 'Buena +';
                        break;

                    case 'MB':
                        $clasificacion = 'Muy Buena';
                        break;

                    case 'AP':
                        $clasificacion = 'Apenas Gorda';
                        break;

                    case 'G':
                        $clasificacion = 'Gorda';
                        break;
                    
                    default:
                        # code...
                        break;
                }
                                
                $pdf->Cell(25,7,$animal['RFID'],0,0,'L',1);
                $pdf->Cell(25,7,$animal['mmGrasa']." mm",0,0,'C',1);
                $pdf->Cell(20,7,$animal['peso'],0,0,'C',1);
                $pdf->Cell(20,7,$sexo,0,0,'C',1);
                $pdf->Cell(40,7,$clasificacion,0,1,'C',1);

            }

        }

        $pdf->Output();
        

    }

}


if($informe){

    $informeCarpeta = new informePDF();
    $informeCarpeta -> idCarpeta = $_GET['idCarpeta'];
    $informeCarpeta -> accion = $_GET['verInforme'];
    $informeCarpeta -> informeCarpeta();

}



?>