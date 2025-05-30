
<div class="row"> 

  <div class="col-md-12">

    <div class="card">

      <div class="card-body">
      <table class="table table-bordered table-striped table-hover tablaContable" id="tablaContable">

          <thead>

            <tr>

              <th style="width:100px;"></th>
                        
              <?php foreach ($meses as $key => $mes) { 
                
                $year = explode('/',$data['estrategia']['campania'])[0];
                $year = (in_array($mes,['Ene','Feb','Mar','Abr','May'])) ? $year + 1 : $year;
                $monthYear = $mes . ' ' . substr($year,2);

              ?>
                
                <th><?=$monthYear?></th>

              <?php } ?> 

              <th style="width:100px;">TOTAL</th>


            </tr>

          </thead>

          <tbody id="tbodyContable">
          <?php
          $rows = [
            'Egresos por Compras' => ['plan' => 'ingresoPlanContable', 'real' => 'ingresoRealContable','class'=>'Ingresos'],
            'Ingresos por Ventas' => ['plan' => 'ventaPlanContable', 'real' => 'ventaRealContable','class'=>'Egresos'],
            'Flujo de Fondo Mensual' => ['plan' => 'flujoMensualContable', 'real' => 'flujoMensualRealContable','class'=>''],
            'Flujo de Fondo Mensual Acum.' => ['plan' => 'flujoMensualAcumContable', 'real' => 'flujoMensualAcumRealContable','class'=>''],
            'Estructura Directa' => ['plan' => 'estructuraDirectaContable', 'real' => 'estructuraDirectaRealContable','class'=>'EstructuraDirecta'],
            'Estructura Indirecta' => ['plan' => 'estructuraIndirectaContable', 'real' => 'estructuraIndirectaRealContable','class'=>'EstructuraIndirecta'],
            'Gastos Varios' => ['plan' => 'gastosVariosContable', 'real' => 'gastosVariosRealContable','class'=>'GastosVarios'],
            'Ingresos Extraordinarios' => ['plan' => 'ingresosExtraContable', 'real' => 'ingresosExtraRealContable','class'=>'IngresosExtraordinarios'],
            'Flujo Neto' => ['plan' => 'flujoNetoContable', 'real' => 'flujoNetoRealContable','class'=>'Anual'],
          ];

          $indexPrefixes = 0;

          foreach ($rows as $label => $idPrefixes) { ?>
            <tr>
              <td style="padding-top:2px;padding-bottom:2px;font-weight:600;line-height:1em;vertical-align:middle;"><?= $label ?></td>
              <?php
                foreach ($meses as $key => $mes) {

                  $class = '';

                  if($indexPrefixes == 0 || $indexPrefixes == 1)
                    $class = 'flujo';

                  if($indexPrefixes == 2 || $indexPrefixes == 3){
                    $preFixes = 'Flujo';
                  } else if ($indexPrefixes == 4 || $indexPrefixes == 5 || $indexPrefixes == 6 || $indexPrefixes == 7 || $indexPrefixes == 8) {
                    $preFixes = 'Estructura';
                  } else {
                    $preFixes = '';     
                  }

                  if (!empty($data['estrategia']) && !$data['estrategia']['seteado']) { 
                  ?>
                  
                  <td class="contable<?=$preFixes?> <?=$class?>" month-data="<?=$key?>" id="<?= $idPrefixes['plan'] . $key ?>">0</td>

                  <?php } else { ?>

                    <td month-data="<?=$key?>">
                      <span class="planificado <?=$class?>" id="<?= $idPrefixes['plan'] . $key ?>"></span>
                      <span id="<?= $idPrefixes['real'] . $key ?>" class="real <?=$class?>Real contableReal"></span>
                    </td>

                  <?php }
                }
              ?>

<?php
// var_dump($indexPrefixes);
// var_dump('total'.$idPrefixes['class']);
?>
              <td id="total<?=$idPrefixes['class']?>" style="font-weight:bold"></td>

            </tr>
          <?php $indexPrefixes++; } ?>
            </tr>

          </tbody>

        </table>

      </div>

    </div>

  </div>

</div>

<script>



</script>

