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
  
<!-- <style>

  .v-tabs {
      display: -ms-flexbox !important;
      display: flex !important;
      .nav-tabs > li {
          display: block;
          float: none;
          &,
          &.active {
              > a {
                  &,
                  &:hover,
                  &:focus {
                      border-radius: 0;
                  }
              }
          }
          &.active > a,
          & > a:focus,
          & > a:hover {
              z-index: 1;
              position: relative;
          }
      }
      .tab-content {
          flex: 1;
      }
  }

  .vertical-text {
      writing-mode: vertical-rl; /* Establece el modo de escritura vertical */
      text-orientation: upright; /* Asegura que el texto se visualice verticalmente */
      white-space: nowrap; /* Evita que el texto se divida en varias líneas */
      background-color:white;
  }

</style> -->

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
include 'vistas/modulos/modales/stock.modal.php';
include 'vistas/modulos/modales/graficoSaldoStock.modal.php';
include 'vistas/modulos/modales/cargaCampania.modal.php';
include 'vistas/modulos/modales/cargaReal.modal.php';

?>
