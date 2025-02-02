
<div class="row"> 

  <div class="col-md-12">

    <div class="card">

      <div class="card-body">

        <table class="table table-bordered tablaContable">

          <thead>

            <tr>

              <th style="width:100px;"></th>
                        
              <?php foreach ($meses as $key => $mes) { ?>
                
                <th><?=$mes?></th>

              <?php } ?> 

            </tr>

          </thead>

          <tbody id="tbodyContable">
          <?php
          $rows = [
            'Ingresos' => ['plan' => 'ingresoPlanContable', 'real' => 'ingresoRealContable'],
            'Kg Prom Ing' => ['plan' => 'kgPromIngresoPlanContable', 'real' => 'kgPromIngresoRealContable'],
            'Egresos' => ['plan' => 'ventaPlanContable', 'real' => 'ventaRealContable'],
            'Kg Prom Egr' => ['plan' => 'kgVentaPlanContable', 'real' => 'kgVentaRealContable']
          ];

          foreach ($rows as $label => $idPrefixes) { ?>
            <tr>
              <td><?= $label ?></td>
              <?php
                foreach ($meses as $key => $mes) {
                  if (!$data['estrategia']['seteado']) { ?>
                    <td class="contable" id="<?= $idPrefixes['plan'] . $key ?>">0</td>
                  <?php } else { ?>
                    <td>
                      <span class="planificado" id="<?= $idPrefixes['plan'] . $key ?>">Plan</span>
                      <span id="<?= $idPrefixes['real'] . $key ?>" class="real">Real</span>
                    </td>
                  <?php }
                }
              ?>
            </tr>
          <?php }
              ?>
            </tr>

          </tbody>

        </table>

      </div>

    </div>

  </div>

</div>

<script>



</script>

