
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
            'Ingresos' => 'ingresoPlanContable',
            'Kg Prom Ing' => 'kgPromIngresoPlanContable',
            'Egresos' => 'ventaPlanContable',
            'Kg Prom Egr' => 'kgVentaPlanContable'
          ];

          foreach ($rows as $label => $idPrefix) { ?>
            <tr>
              <td><?= $label ?></td>
              <?php
              if (!$data['estrategia']['seteado']) {
                foreach ($meses as $key => $mes) { ?>
                  <td class="contable" id="<?= $idPrefix . $key ?>">0</td>
                <?php }
              } else {
                // Add your logic here for when $data['estrategia']['seteado'] is true
              }
              ?>
            </tr>
          <?php } ?>

          </tbody>

        </table>

      </div>

    </div>

  </div>

</div>

<script>



</script>

