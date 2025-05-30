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

$meses = array(1=>'Jun',2=>'Jul',3=>'Ago',4=>'Sep',5=>'Oct',6=>'Nov',7=>'Dic',8=>'Ene',9=>'Feb',10=>'Mar',11=>'Abr',12=>'May');
?>
  
<style>
    .celda-doble {
    display: flex; /* Utilizamos flexbox para dividir la celda */
    text-align: center;
    }

    .celda-izquierda {
    flex: 1; /* Ocupa la mitad del espacio */
    border-right: 1px solid black; /* Borde para simular la división */
    padding: 5px;
    }

    .celda-derecha {
    flex: 1; /* Ocupa la mitad del espacio */
    padding: 5px;
    }
</style>

<div class="content-wrapper">

  <div class="tabCollapse v-tabs">

      <ul class="nav nav-tabs" role="tablist" style="position:fixed;z-index:3;top:50px;right:10px;font-size:1.2em">
          <li role="presentation" class="active"><a href="#inicioEstrategia" class="nav-link vertical-text"  style="border:solid 1px rgb(220,220,220);border-top-right-radius:5px;line-height:2em;padding:5px;" aria-controls="inicioEstrategia" role="tab" data-toggle="tab"><b><i class="fa fa-calendar"></i> Estrategia</b></a></li>
          <li role="presentation"><a href="#inicioContable" class="nav-link vertical-text" style="border:solid 1px rgb(220,220,220);border-bottom-right-radius:5px;line-height:2em;padding:5px;" aria-controls="inicioContable" role="tab" data-toggle="tab"><b><i class="fa fa-dollar"></i> Contable</b></a></li>
      </ul>

      <div class="tab-content">

          <div role="tabpanel" class="tab-pane active" id="inicioEstrategia">

              <?php

                  include 'inicioEstrategia.php';

              ?>

          </div>

          <div role="tabpanel" class="tab-pane" id="inicioContable">
                          
              <?php

                  include 'contable.php';

              ?>

          </div>

      </div>

  </div>

</div>

<?php

include 'vistas/modulos/modales/ingEgr.modal.php';
include 'vistas/modulos/modales/ingresosInsumos.modal.php';
include 'vistas/modulos/modales/ingresosEstructura.modal.php';
include 'vistas/modulos/modales/stock.modal.php';
include 'vistas/modulos/modales/graficoSaldoStock.modal.php';
include 'vistas/modulos/modales/cargaCampania.modal.php';
include 'vistas/modulos/modales/cargaReal.modal.php';

?>
