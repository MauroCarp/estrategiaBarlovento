<div id="modalEstrategiaIngEgr" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width:1100px;margin-left:-150px">

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

            <table class="table table-bordered ingEgrTable" style="table-layout: fixed;">

              <thead>
                <tr>
                  <th style="width:100px"></th>
                  <th style="width:100px">Ingreso</th>
                  <th style="width:100px">Kg Ingreso</th>
                  <th style="width:100px">Venta</th>
                  <th style="width:100px">Kg Venta</th>
                  <th>$ Kg</th>
                  <th>A Pagar</th>
                  <th style="width:100px">Stock</th>
                  <th style="width:100px">Dif.</th>
                </tr>
                <tr>
                  <th style="width:100px"><th>
                  <th colspan='2'><th>
                  <th><span style="float:left">Ing</span><span style="float:right">Egr</span></th>
                  <th><span style="float:left">Ing</span><span style="float:right">Egr</span></th>
                  <th colspan='2' style="width:100px"></th>
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

                if($data['estrategia']){
                  $ingresos = json_decode($data['estrategia']['ingresosPlan'],true);
                  $kgIngresosPlan = json_decode($data['estrategia']['kgIngresosPlan'],true);
                  $precioKgIngresosPlan = json_decode($data['estrategia']['precioKgIngresosPlan'],true);
                  $aPagarIngresosPlan = json_decode($data['estrategia']['aPagarIngresosPlan'],true);
                  $egresosPlan = json_decode($data['estrategia']['egresosPlan'],true);
                  $precioKgEgresosPlan = json_decode($data['estrategia']['precioKgEgresosPlan'],true);
                  $aPagarEgresosPlan = json_decode($data['estrategia']['aPagarEgresosPlan'],true);
                  $kgEgresosPlan = json_decode($data['estrategia']['kgEgresosPlan'],true);
                }

                foreach ($months as $index => $month): 
                  $ingresosVal = 0;
                  $kgIngresosPlanVal = 0;
                  $precioKgIngresosPlanVal = 0;
                  $aPagarIngresosPlanVal = 0;
                  $egresosPlanVal = 0;
                  $precioKgEgresosPlanVal = 0;
                  $aPagarEgresosPlanVal = 0;
                  $kgEgresosPlanVal = 0;

                  if($data['estrategia']){
                    $ingresosVal = $ingresos[$index];                    
                    $kgIngresosPlanVal = $kgIngresosPlan[$index];
                    $precioKgIngresosPlanVal = $precioKgIngresosPlan[$index];
                    $aPagarIngresosPlanVal = $aPagarIngresosPlan[$index];
                    $egresosPlanVal = $egresosPlan[$index];
                    $precioKgEgresosPlanVal = $precioKgEgresosPlan[$index];
                    $aPagarEgresosPlanVal = $aPagarEgresosPlan[$index];
                    $kgEgresosPlanVal = $kgEgresosPlan[$index];
                  }

                  ?>

                  <tr class="monthRow">
                    <td><?= $month ?></td>
                    <td><input class="form-control ingEgr ingreso" type="number" id="ingreso<?= $index ?>" min="0" value="<?=$ingresosVal?>"></td>
                    <td><input class="form-control kgIngreso" type="number" id="kgIngreso<?= $index ?>" min="0" value="<?=$kgIngresosPlanVal?>"></td>
                    <td><input class="form-control ingEgr venta" type="number" id="venta<?= $index ?>" min="0" value="<?=$egresosPlanVal?>"></td>
                    <td><input class="form-control kgVenta" type="number" id="kgVenta<?= $index ?>" min="0" value="<?=$kgEgresosPlanVal?>"></td>
                    <td>
                      <div style="display: flex; flex-direction: row;">
                        <input class="form-control precioKgIngreso" type="number" id="precioKgIngreso<?= $index ?>" min="0" value="<?=$precioKgIngresosPlanVal?>">
                        <input class="form-control precioKgVenta" type="number" id="precioKgVenta<?= $index ?>" min="0" value="<?=$precioKgEgresosPlanVal?>">
                      </div>
                    </td>
                    <td style="padding:0">
                      <div style="display: flex; flex-direction: row;">
                        <select class="form-control aPagarIngreso aPagar" onChange="cambiarColorApagar($(this))" id="aPagarIngreso<?= $index?>" style="font-weight:bold;color:green" >
                          <option value="A" <?=($data['estrategia']) ? (($aPagarIngresosPlanVal == 'A') ? 'selected' : ''): '' ?> style="font-weight:bold;color:green">A</option>
                          <option value="B" <?=($data['estrategia']) ? (($aPagarIngresosPlanVal == 'B') ? 'selected' : ''): '' ?> style="font-weight:bold;color:blue">B</option>
                          <option value="C" <?=($data['estrategia']) ? (($aPagarIngresosPlanVal == 'C') ? 'selected' : ''): '' ?> style="font-weight:bold;color:rgb(227,216,0)">C</option>
                          <option value="D" <?=($data['estrategia']) ? (($aPagarIngresosPlanVal == 'D') ? 'selected' : ''): '' ?> style="font-weight:bold;color:red">D</option>
                        </select>
                        <select class="form-control aPagarVenta aPagar" onChange="cambiarColorApagar($(this))" id="aPagarVenta<?= $index?>" style="font-weight:bold;color:green">
                          <option value="A" <?=($data['estrategia']) ? (($aPagarEgresosPlanVal == 'A') ? 'selected' : ''): '' ?> style="font-weight:bold;color:green">A</option>
                          <option value="B" <?=($data['estrategia']) ? (($aPagarEgresosPlanVal == 'B') ? 'selected' : ''): '' ?> style="font-weight:bold;color:blue">B</option>
                          <option value="C" <?=($data['estrategia']) ? (($aPagarEgresosPlanVal == 'C') ? 'selected' : ''): '' ?> style="font-weight:bold;color:rgb(227,216,0)">C</option>
                          <option value="D" <?=($data['estrategia']) ? (($aPagarEgresosPlanVal == 'D') ? 'selected' : ''): '' ?> style="font-weight:bold;color:red">D</option>
                        </select>
                      </div>
                    </td>
                    <td><input class="form-control stock" type="text" id="stock<?= $index ?>" value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>
                  </tr>
                <?php endforeach;?>
                  

                <tr style="font-weight:bolder;">
                  <td><b>Total</b></td>
                  <td><input class="form-control total" type="text" name="" id="totalIngreso" readOnly value="0" <?php ($data['estrategia']['seteado']) ? 'readOnly' : '' ?>></td>
                  <td><input class="form-control total" type="text" name="" id="totalKgIngreso" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></tdkgIngreso1>
                  <td><input class="form-control total" type="text" name="" id="totalVenta" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control total" type="text" name="" id="totalKgVenta" readOnly value="0" <?=($data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td></td>
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
                $precioKgIngresoPlan = json_decode($data['estrategia']['precioKgIngresosPlan'],true);
                $aPagarIngresoPlan = json_decode($data['estrategia']['aPagarIngresosPlan'],true);
                $kgEgresosPlan = json_decode($data['estrategia']['kgEgresosPlan'],true);
                $precioKgEgresoPlan = json_decode($data['estrategia']['precioKgEgresosPlan'],true);
                $aPagarEgresoPlan = json_decode($data['estrategia']['aPagarEgresosPlan'],true);
                $kgIngresosReal = json_decode($data['estrategia']['kgIngresosReal'],true);
                $kgEgresosReal = json_decode($data['estrategia']['kgVentasReal'],true);
                $egresosReal = json_decode($data['estrategia']['ventasReal'],true);
                $precioKgIngresoReal = json_decode($data['estrategia']['precioKgIngresosReal'],true);
                $aPagarIngresoReal = json_decode($data['estrategia']['aPagarIngresosReal'],true);
                $precioKgEgresoReal = json_decode($data['estrategia']['precioKgEgresosReal'],true);
                $aPagarEgresoReal = json_decode($data['estrategia']['aPagarEgresosReal'],true);

                foreach ($months as $index => $month): ?>
                  <tr class="monthRow">
                      <td><?= $month ?></td>
                      <td><span class="ingEgr planificado ingreso" id="ingreso<?= $index ?>"><?=$ingresosPlan[$index] ?></span><span id="ingresoReal<?= $index ?>" class="real"><?=(isset($ingresosReal[$index])) ? ' | ' . $ingresosReal[$index] : '' ?></span></td>
                      <td><span class="planificado kgIngreso" id="kgIngreso<?= $index ?>"><?=$kgIngresosPlan[$index] ?></span><span id="kgIngresoReal<?= $index ?>" class="real"><?=(isset($kgIngresosReal[$index])) ? ' | ' . $kgIngresosReal[$index] : '' ?></span></td>
                      <td><span class="ingEgr planificado venta" id="venta<?= $index ?>"><?=$egresosPlan[$index] ?></span><span id="ventaReal<?= $index ?>" class="real"><?=(isset($egresosReal[$index])) ? ' | ' . $egresosReal[$index] : '' ?></span></td>
                      <td><span class="planificado kgVenta" id="kgVenta<?= $index ?>"><?=$kgEgresosPlan[$index] ?></span><span id="kgVentaReal<?= $index ?>" class="real"><?=(isset($kgEgresosReal[$index])) ? ' | ' . $kgEgresosReal[$index] : '' ?></span></td>
                      <td class="celda-doble">  
                          <div class="celda-izquierda">
                            <span class="planificado precioKgIngreso" id="precioKgIngreso<?= $index ?>" style="float:left"><?=$precioKgIngresoPlan[$index]?></span>
                            <span id="precioKgIngresoReal<?= $index ?>" class="real"><?=(isset($precioKgIngresoReal[$index])) ? ' | ' . $precioKgIngresoReal[$index] : '' ?></span>
                          </div>
                          <div class="celda-derecha">
                            <span class="planificado precioKgVenta" id="precioKgVenta<?= $index ?>" style="float:left"><?=$precioKgEgresoPlan[$index]?></span>
                            <span id="precioKgVentaReal<?= $index ?>" class="real"><?=(isset($precioKgEgresoReal[$index])) ? ' | ' . $precioKgEgresoReal[$index] : '' ?></span>
                          </div>
                      </td>
                      <td>
                        <div class="celda-doble">

                          <div class="celda-izquierda">
                            <span class="planificado aPagar" id="aPagarIngreso<?= $index ?>" style="float:left;font-weight:bold;color:<?=($aPagarIngresoPlan[$index] == 'A') ? 
                              'green' 
                              : 
                              (($aPagarIngresoPlan[$index] == 'B') ? 'blue' : (($aPagarIngresoPlan[$index] == 'D') ? 'red' : 'rgb(277,215,0)'))?>"><?=$aPagarIngresoPlan[$index]?></span>

                            <span id="aPagarIngresoReal<?= $index ?>" class="real" style="font-weight:bold;color:<?=($aPagarIngresoReal[$index] == 'A') ? 
                              'green' 
                              : 
                              (($aPagarIngresoReal[$index] == 'B') ? 'blue' : (($aPagarIngresoReal[$index] == 'D') ? 'red' : 'rgb(277,215,0)'))?>"><?=(isset($aPagarIngresoReal[$index])) ? ' | ' . $aPagarIngresoReal[$index] : '' ?></span>

                          </div>
                          <div class="celda-derecha">
                            <span class="planificado aPagar" id="aPagarVenta<?= $index ?>" style="float:left;font-weight:bold;color:<?=($aPagarEgresoPlan[$index] == 'A') ? 
                              'green'
                              : 
                              (($aPagarEgresoPlan[$index] == 'B') ? 'blue' : (($aPagarEgresoPlan[$index] == 'D') ? 'red' : 'rgb(277,215,0)'))?>"><?=$aPagarEgresoPlan[$index]?></span>
                              <span id="aPagarVentaReal<?= $index ?>" class="real" style="font-weight:bold;color:<?=($aPagarEgresoPlan[$index] == 'A') ? 
                              'green'
                              : 
                              (($aPagarEgresoPlan[$index] == 'B') ? 'blue' : (($aPagarEgresoPlan[$index] == 'D') ? 'red' : 'rgb(277,215,0)'))?>"><?=(isset($aPagarEgresoReal[$index])) ? ' | ' . $aPagarEgresoReal[$index] : '' ?></span>
                          </div>
                          
                        </div>
                      </td>
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
                  <td></td>
                  <td></td>
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
          <small><span style="color:green"><b>A</b></span> - 30 d&iacute;as | </small>
          <small><span style="color:blue"><b>B</b> - </span>30/60 d&iacute;as | </small>
          <small><span style="color:rgb(227,216,0)"><b>C</b></span> - 60 d&iacute;as | </small>
          <small><span style="color:red"><b>D</b></span> - 90 d&iacute;as</small>
        </div>

      </form>

    </div>

  </div>

</div>

<?php

// $cargarArchivo = new ControladorEstrategia();

// $cargarArchivo->ctrCargarArchivo();


?>

