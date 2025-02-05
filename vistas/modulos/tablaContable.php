
<div class="row"> 

  <div class="col-md-12">

    <div class="card">

      <div class="card-body">
      <table class="table table-bordered table-striped table-hover tablaContable" id="tablaContable">

          <thead>

            <tr>

              <th style="width:100px;"></th>
                        
              <?php foreach ($meses as $key => $mes) { ?>
                
                <th><?=$mes?></th>

              <?php } ?> 

              <th style="width:100px;">TOTAL</th>


            </tr>

          </thead>

          <tbody id="tbodyContable">
          <?php
          $rows = [
            'Egresos por Compras' => ['plan' => 'ingresoPlanContable', 'real' => 'ingresoRealContable'],
            'Ingresos por Ventas' => ['plan' => 'ventaPlanContable', 'real' => 'ventaRealContable'],
            'Flujo de Fondo Mensual' => ['plan' => 'flujoMensualContable', 'real' => 'flujoMensualRealContable'],
            'Flujo de Fondo Mensual Acum.' => ['plan' => 'flujoMensualAcumContable', 'real' => 'flujoMensualAcumRealContable'],
            'Estructura Directa' => ['plan' => 'estructuraDirectaContable', 'real' => 'estructuraDirectaRealContable'],
            'Estructura Indirecta' => ['plan' => 'estructuraIndirectaContable', 'real' => 'estructuraIndirectaRealContable'],
            'Gastos Varios' => ['plan' => 'gastosVariosContable', 'real' => 'gastosVariosRealContable'],
            'Ingresos Extraordinarios' => ['plan' => 'ingresosExtraContable', 'real' => 'ingresosExtraRealContable'],
            'Flujo Neto' => ['plan' => 'flujoNetoContable', 'real' => 'flujoNetoRealContable'],
          ];

          $indexPrefixes = 0;
          foreach ($rows as $label => $idPrefixes) { ?>
            <tr>
              <td style="padding-top:2px;padding-bottom:2px;font-weight:600;line-height:1em"><?= $label ?></td>
              <?php
                foreach ($meses as $key => $mes) {

                  if (!$data['estrategia']['seteado']) { 

                    if($indexPrefixes == 2 || $indexPrefixes == 3){
                      $preFixes = 'Flujo';
                    } else if ($indexPrefixes == 4 || $indexPrefixes == 5 || $indexPrefixes == 6 || $indexPrefixes == 7 || $indexPrefixes == 8) {
                      $preFixes = 'Estructura';
                    } else {
                      $preFixes = '';     
                    }
                  ?>
                    
                    <td class="contable<?=$preFixes?>" id="<?= $idPrefixes['plan'] . $key ?>">0</td>

                  <?php } else { ?>
                    <td>
                      <span class="planificado" id="<?= $idPrefixes['plan'] . $key ?>">Plan</span>
                      <span id="<?= $idPrefixes['real'] . $key ?>" class="real">Real</span>
                    </td>
                  <?php }
                }
              ?>

              <td id="total<?=$label?>" style="font-weight:bold"></td>

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

