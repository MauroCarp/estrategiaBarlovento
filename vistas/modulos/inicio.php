<?php    

function selectDietas($dietas){

  $arr = array();
  foreach ($dietas as $key => $dieta) {

    $arr[] = '<option value="' . $dieta['id'] . '">' . $dieta['nombre']. '</option>';
  }

  return implode(' ',$arr);
}

$dietas = ControladorEstrategia::ctrMostrarDietas();

$dietasOptions = selectDietas($dietas);

$campania = (isset($_GET['campania'])) ? $_GET['campania'] : null;

$data = ControladorEstrategia::ctrMostrarEstrategia($campania);

$meses = array(1=>'May',2=>'Jun',3=>'Jul',4=>'Ago',5=>'Sep',6=>'Oct',7=>'Nov',8=>'Dic',9=>'Ene',10=>'Feb',11=>'Mar',12=>'Abr');

?>

<div class="content-wrapper">
  
    <div class="box">
    
        <section class="content" style="padding-top:5px;">

        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#estrategia" aria-controls="estrategia" role="tab" data-toggle="tab">Estrategia</a></li>
          <li role="presentation"><a href="#dietas" aria-controls="dietas" role="tab" data-toggle="tab">Dietas</a></li>
          <li role="presentation"><a href="#graficos2" id="graficosTab2" aria-controls="graficos2" role="tab" data-toggle="tab">Ingresos - Egresos</a></li>
          <li role="presentation"><a href="#graficos" id="graficosTab" aria-controls="graficos" role="tab" data-toggle="tab">Stock/Saldos - Kg. Prom</a></li>
        </ul>

        <div class="tab-content">

          <div role="tabpanel" class="tab-pane active" id="estrategia">
            <?php include('estrategia.php'); ?>
          </div>

          <div role="tabpanel" class="tab-pane" id="dietas">
          <?php include('dietas.php'); ?>

          </div>

          <div role="tabpanel" class="tab-pane" id="graficos">
          <?php include('graficos.php'); ?>
          </div>

          <div role="tabpanel" class="tab-pane" id="graficos2">
          <?php include('graficos2.php'); ?>

          </div>

        </div>

        

        </section>

    </div>

</div>

<?php

include 'vistas/modulos/modales/ingEgr.modal.php';
include 'vistas/modulos/modales/stock.modal.php';
include 'vistas/modulos/modales/graficoSaldoStock.modal.php';
include 'vistas/modulos/modales/cargaCampania.modal.php';
include 'vistas/modulos/modales/cargaReal.modal.php';

?>
