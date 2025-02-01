<div id="modalEstrategiaIngEgr" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width:900px;margin-left:-150px">

      <form role="form" method="post" enctype="multipart/form-data" id="formCarga">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="">Carga de Ingresos y Ventas</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <table class="table table-bordered ingEgrTable">

              <thead>
                <tr>
                  <th></th>
                  <th>Ingreso</th>
                  <th>Kg Ingreso</th>
                  <th>Venta</th>
                  <th>Kg Venta</th>
                  <th>$ Kg</th>
                  <th>A Pagar</th>
                  <th>Stock</th>
                  <th>Dif.</th>

                </tr>
              </thead>

              <tbody>

              <?php if(!$data['estrategia']['seteado']){ ?>
                <?php 
                $months = [
                  1 => 'Mayo', 2 => 'Junio', 3 => 'Julio', 4 => 'Agosto', 
                  5 => 'Septiembre', 6 => 'Octubre', 7 => 'Noviembre', 8 => 'Diciembre',
                  9 => 'Enero', 10 => 'Febrero', 11 => 'Marzo', 12 => 'Abril'
                ];

                foreach ($months as $index => $month): ?>
                  <tr class="monthRow">
                    <td><?= $month ?></td>
                    <td><input class="form-control ingEgr ingreso" type="number" id="ingreso<?= $index ?>" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                    <td><input class="form-control kgIngreso" type="number" id="kgIngreso<?= $index ?>" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                    <td><input class="form-control ingEgr venta" type="number" id="venta<?= $index ?>" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                    <td><input class="form-control kgVenta" type="number" id="kgVenta<?= $index ?>" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                    <td><input class="form-control precioKg" type="number" id="precioKg<?= $index ?>" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                    <td><input class="form-control aPagar" type="number" id="aPagar<?= $index ?>" min="0" max="24" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                    <td><input class="form-control stock" type="text" id="stock<?= $index ?>" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>
                  </tr>
                <?php endforeach; ?>
               

                <tr style="font-weight:bolder;">
                  <td><b>Total</b></td>
                  <td><input class="form-control total" type="text" name="" id="totalIngreso" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control total" type="text" name="" id="totalKgIngreso" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></tdkgIngreso1>
                  <td><input class="form-control total" type="text" name="" id="totalVenta" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control total" type="text" name="" id="totalKgVenta" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td></td>
                  <td><input class="form-control total" type="text" name="" id="totalStock" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                </tr>
                <tr>
                  <td style="font-weight:bolder;"><b>Promedio</b></td>
                  <td><input class="form-control" type="text" name="" id="avgIngreso" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control" type="text" name="" id="avgKgIngreso" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></tdkgIngreso1>
                  <td><input class="form-control" type="text" name="" id="avgVenta" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control" type="text" name="" id="avgKgVenta" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                </tr>

              <?php } else { 

                $months = [
                  1 => 'Mayo', 2 => 'Junio', 3 => 'Julio', 4 => 'Agosto', 
                  5 => 'Septiembre', 6 => 'Octubre', 7 => 'Noviembre', 8 => 'Diciembre',
                  9 => 'Enero', 10 => 'Febrero', 11 => 'Marzo', 12 => 'Abril'
                ];
                
                $kgIngresosPlan = json_decode($data['estrategia']['kgIngresosPlan'],true);
                $kgEgresosPlan = json_decode($data['estrategia']['kgEgresosPlan'],true);
                $kgIngresosReal = json_decode($data['estrategia']['kgIngresosReal'],true);
                $kgEgresosReal = json_decode($data['estrategia']['kgVentasReal'],true);
                $egresosReal = json_decode($data['estrategia']['ventasReal'],true);


                foreach ($months as $index => $month): ?>
                  <tr class="monthRow">
                      <td><?= $month ?></td>
                      <td><span class="ingEgr planificado ingreso" id="ingreso<?= $index ?>"><?=$ingresosPlan[$index] ?></span><span id="ingresoReal<?= $index ?>" class="real"><?=(isset($ingresosReal[$index])) ? ' | ' . $ingresosReal[$index] : '' ?></span></td>
                      <td><span class="kgIngreso planificado" id="kgIngreso<?= $index ?>"><?=$kgIngresosPlan[$index] ?></span><span id="kgIngresoReal<?= $index ?>" class="real"><?=(isset($kgIngresosReal[$index])) ? ' | ' . $kgIngresosReal[$index] : '' ?></span></td>
                      <td><span class="ingEgr planificado venta" id="venta<?= $index ?>"><?=$egresosPlan[$index] ?></span><span id="ventaReal<?= $index ?>" class="real"><?=(isset($egresosReal[$index])) ? ' | ' . $egresosReal[$index] : '' ?></span></td>
                      <td><span class="kgVenta planificado" id="kgVenta<?= $index ?>"><?=$kgEgresosPlan[$index] ?></span><span id="kgVentaReal<?= $index ?>" class="real"><?=(isset($kgEgresosReal[$index])) ? ' | ' . $kgEgresosReal[$index] : '' ?></span></td>
                      <td><span class="stock planificado" id="stockPlanIngEgr<?= $index?>">Plan</span><span id="stockRealIngEgr<?= $index?>" class="real"></span></td>
                      <td class="real" id="stockDif<?= $index?>"></td>
                  </tr>
                  
                  <?php endforeach; ?>

              <tr style="font-weight:bolder;">
                  <td><b>Total</b></td>
                  <td class="total" id="totalIngreso"></td>
                  <td class="total" id="totalKgIngreso"></td>
                  <td class="total" id="totalVenta"></td>
                  <td class="total" id="totalKgVenta"></td>
                  <td class="total" id="totalStock"></td>
              </tr>
              <tr>
                  <td style="font-weight:bolder;"><b>Promedio</b></td>
                  <td id="avgIngreso"></td>
                  <td id="avgKgIngreso"></td>
                  <td id="avgVenta"></td>
                  <td id="avgKgVenta"></td>
              </tr>

              <?php } ?>
                
              </tbody>

            </table>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

      </form>

    </div>

  </div>

</div>

<?php

// $cargarArchivo = new ControladorEstrategia();

// $cargarArchivo->ctrCargarArchivo();


?>

