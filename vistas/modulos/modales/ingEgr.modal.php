<div id="modalEstrategiaIngEgr" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

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
                  <th>Stock</th>
                  <th>Dif.</th>

                </tr>
              </thead>

              <tbody>

              <?php if(!$data['estrategia']['seteado']){ ?>
                <tr class="monthRow">
                  <td>Mayo</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso1" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso1" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta1" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta1" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock1"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>
                </tr>
                <tr class="monthRow">
                  <td>Junio</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso2" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso2" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta2" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta2" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock2"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>

                </tr>
                <tr class="monthRow">
                  <td>Julio</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso3" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso3" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta3" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta3" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock3"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>

                </tr>
                <tr class="monthRow">
                  <td>Agosto</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso4" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso4" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta4" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta4" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock4"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>

                </tr>
                <tr class="monthRow">
                  <td>Septiembre</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso5" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso5" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta5" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta5" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock5"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>

                </tr>
                <tr class="monthRow">
                  <td>Octubre</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso6" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso6" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta6" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta6" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock6"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>

                </tr>
                <tr class="monthRow">
                  <td>Noviembre</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso7" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso7" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta7" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta7" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock7"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>

                </tr>
                <tr class="monthRow">
                  <td>Diciembre</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso8" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso8" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta8" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta8" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock8"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>

                </tr>
                <tr class="monthRow">
                  <td>Enero</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso9" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso9" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta9" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta9" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock9"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>

                </tr>
                <tr class="monthRow">
                  <td>Febrero</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso10" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso10" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta10" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta10" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock10"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>

                </tr>
                <tr class="monthRow">
                  <td>Marzo</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso11" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso11" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta11" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta11" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock11"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>

                </tr>
                <tr class="monthRow">
                  <td>Abril</td>
                  <td><input class="form-control ingEgr ingreso" type="number"  id="ingreso12" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgIngreso" type="number"  id="kgIngreso12" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control ingEgr venta" type="number"  id="venta12" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control kgVenta" type="number"  id="kgVenta12" min="0" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control stock" type="text" name="" id="stock12"  value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>

                </tr>
               

                <tr style="font-weight:bolder;">
                  <td><b>Total</b></td>
                  <td><input class="form-control total" type="text" name="" id="totalIngreso" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control total" type="text" name="" id="totalKgIngreso" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></tdkgIngreso1>
                  <td><input class="form-control total" type="text" name="" id="totalVenta" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control total" type="text" name="" id="totalKgVenta" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
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

