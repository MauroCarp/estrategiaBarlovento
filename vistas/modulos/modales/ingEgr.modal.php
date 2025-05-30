<div id="modalEstrategiaIngEgr" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width:1150px;margin-left:-150px">

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
                  <th style="width:150px"></th>
                  <th style="width:100px">Ingreso</th>
                  <th style="width:100px">Kg Ingreso</th>
                  <th style="width:100px">Venta</th>
                  <th style="width:100px">Kg Venta</th>
                  <th>$ Kg</th>
                  <th></th>
                  <th style="width:100px">Stock</th>
                  <th style="width:100px">Dif.</th>
                </tr>
                <tr>
                  <th style="width:100px"><th>
                  <th colspan='2'><th>
                  <th><span style="float:left">Ing</span><span style="float:right">Egr</span></th>
                  <th><span style="float:left">A Pagar Ing</span><span style="float:right">A Cobrar Egr</span></th>
                  <th colspan='2' style="width:100px"></th>
                </tr>
              </thead>

              <tbody>

              <?php
              
              if(empty($data['estrategia']) || !$data['estrategia']['seteado']){
                
                $months = [
                    1 => 'Junio', 2 => 'Julio', 3 => 'Agosto', 4 => 'Septiembre',
                    5 => 'Octubre', 6 => 'Noviembre', 7 => 'Diciembre', 8 => 'Enero',
                    9 => 'Febrero', 10 => 'Marzo', 11 => 'Abril', 12 => 'Mayo'
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
                    <?php
                        $year = explode('/',$data['estrategia']['campania'])[0];
                        $year = (in_array($month,['Enero','Febero','Marzo','Abril','Mayo'])) ? $year + 1 : $year;
                        $monthYear = $month . ' ' . substr($year,2);
                    ?>

                    <td><?= $monthYear ?></td>
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
                    <td><input class="form-control stock" type="text" id="stock<?= $index ?>" value="0" <?=(!empty($data['estrategia']) && $data['estrategia']['seteado']) ? 'readOnly' : ''?> readOnly></td>
                  </tr>
                <?php endforeach;?>
                  

                <tr style="font-weight:bolder;">
                  <td><b>Total</b></td>
                  <td><input class="form-control total" type="text" name="" id="totalIngreso" readOnly value="0" <?php (!empty($data['estrategia']) && $data['estrategia']['seteado']) ? 'readOnly' : '' ?>></td>
                  <td><input class="form-control total" type="text" name="" id="totalKgIngreso" readOnly value="0" <?=(!empty($data['estrategia']) && $data['estrategia']['seteado']) ? 'readOnly' : ''?>></tdkgIngreso1>
                  <td><input class="form-control total" type="text" name="" id="totalVenta" readOnly value="0" <?=(!empty($data['estrategia']) && $data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control total" type="text" name="" id="totalKgVenta" readOnly value="0" <?=(!empty($data['estrategia']) && $data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td></td>
                  <td></td>
                  <td><input class="form-control total" type="text" name="" id="totalStock" readOnly value="0" <?=(!empty($data['estrategia']) && $data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                </tr>
                <tr>
                  <td style="font-weight:bolder;"><b>Promedio</b></td>
                  <td><input class="form-control" type="text" name="" id="avgIngreso" readOnly value="0" <?=(!empty($data['estrategia']) && $data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control" type="text" name="" id="avgKgIngreso" readOnly value="0" <?=(!empty($data['estrategia']) && $data['estrategia']['seteado']) ? 'readOnly' : ''?>></tdkgIngreso1>
                  <td><input class="form-control" type="text" name="" id="avgVenta" readOnly value="0" <?=(!empty($data['estrategia']) && $data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                  <td><input class="form-control" type="text" name="" id="avgKgVenta" readOnly value="0" <?=(!empty($data['estrategia']) && $data['estrategia']['seteado']) ? 'readOnly' : ''?>></td>
                </tr>

              <?php } else { 

                $months = [
                    1 => 'Junio', 2 => 'Julio', 3 => 'Agosto', 4 => 'Septiembre',
                    5 => 'Octubre', 6 => 'Noviembre', 7 => 'Diciembre', 8 => 'Enero',
                    9 => 'Febrero', 10 => 'Marzo', 11 => 'Abril', 12 => 'Mayo'
                ];
                
                $kgIngresosPlan = (!empty($data['estrategia']) && isset($data['estrategia']['kgIngresosPlan'])) ? json_decode($data['estrategia']['kgIngresosPlan'], true) : [];
                $precioKgIngresoPlan = (!empty($data['estrategia']) && isset($data['estrategia']['precioKgIngresosPlan'])) ? json_decode($data['estrategia']['precioKgIngresosPlan'], true) : [];
                $aPagarIngresoPlan = (!empty($data['estrategia']) && isset($data['estrategia']['aPagarIngresosPlan'])) ? json_decode($data['estrategia']['aPagarIngresosPlan'], true) : [];
                $kgEgresosPlan = (!empty($data['estrategia']) && isset($data['estrategia']['kgEgresosPlan'])) ? json_decode($data['estrategia']['kgEgresosPlan'], true) : [];
                $precioKgEgresoPlan = (!empty($data['estrategia']) && isset($data['estrategia']['precioKgEgresosPlan'])) ? json_decode($data['estrategia']['precioKgEgresosPlan'], true) : [];
                $aPagarEgresoPlan = (!empty($data['estrategia']) && isset($data['estrategia']['aPagarEgresosPlan'])) ? json_decode($data['estrategia']['aPagarEgresosPlan'], true) : [];
                $kgIngresosReal = isset($data['estrategia']['kgIngresosReal']) ? json_decode($data['estrategia']['kgIngresosReal'],true) : [];
                $kgEgresosReal = isset($data['estrategia']['kgVentasReal']) ? json_decode($data['estrategia']['kgVentasReal'],true) : [];
                $egresosReal = isset($data['estrategia']['ventasReal']) ? json_decode($data['estrategia']['ventasReal'],true) : [];
                $precioKgIngresoReal = isset($data['estrategia']['precioKgIngresosReal']) ? json_decode($data['estrategia']['precioKgIngresosReal'],true) : [];
                $aPagarIngresoReal = isset($data['estrategia']['aPagarIngresosReal']) ? json_decode($data['estrategia']['aPagarIngresosReal'],true) : [];
                $precioKgEgresoReal = isset($data['estrategia']['precioKgEgresosReal']) ? json_decode($data['estrategia']['precioKgEgresosReal'],true) : [];
                $aPagarEgresoReal = isset($data['estrategia']['aPagarEgresosReal']) ? json_decode($data['estrategia']['aPagarEgresosReal'],true) : [];

                foreach ($months as $index => $month): ?>
                  <tr class="monthRow">

                      <?php
                        $year = explode('/',$data['estrategia']['campania'])[0];
                        $year = (in_array($month,['Enero','Febero','Marzo','Abril','Mayo'])) ? $year + 1 : $year;
                        $monthYear = $month . ' ' . substr($year,2);
                      ?>

                      <td><?= $monthYear ?></td>
                      <td><span class="ingEgr planificado ingreso" id="ingreso<?= $index ?>"><?=(isset($ingresosPlan[$index])) ? $ingresosPlan[$index] : 0 ?></span><span id="ingresoReal<?= $index ?>" class="real"><?=(isset($ingresosReal[$index])) ? ' | ' . $ingresosReal[$index] : '' ?></span></td>
                      <td><span class="planificado kgIngreso" id="kgIngreso<?= $index ?>"><?=(isset($kgIngresosPlan[$index])) ? $kgIngresosPlan[$index] : 0 ?></span><span id="kgIngresoReal<?= $index ?>" class="real"><?=(isset($kgIngresosReal[$index])) ? ' | ' . $kgIngresosReal[$index] : '' ?></span></td>
                      <td><span class="ingEgr planificado venta" id="venta<?= $index ?>"><?=(isset($egresosPlan[$index])) ? $egresosPlan[$index] : 0 ?></span><span id="ventaReal<?= $index ?>" class="real"><?=(isset($egresosReal[$index])) ? ' | ' . $egresosReal[$index] : '' ?></span></td>
                      <td><span class="planificado kgVenta" id="kgVenta<?= $index ?>"><?=(isset($kgEgresosPlan[$index])) ? $kgEgresosPlan[$index] : 0 ?></span><span id="kgVentaReal<?= $index ?>" class="real"><?=(isset($kgEgresosReal[$index])) ? ' | ' . $kgEgresosReal[$index] : '' ?></span></td>
                      <td class="celda-doble">  
                          <div class="celda-izquierda">
                            <span class="planificado precioKgIngreso" id="precioKgIngreso<?= $index ?>" style="float:left"><?=(isset($precioKgIngresoPlan[$index])) ? $precioKgIngresoPlan[$index] : 0?></span>
                            <span id="precioKgIngresoReal<?= $index ?>" class="real"><?=(isset($precioKgIngresoReal[$index])) ? ' | ' . $precioKgIngresoReal[$index] : '' ?></span>
                          </div>
                          <div class="celda-derecha">
                            <span class="planificado precioKgVenta" id="precioKgVenta<?= $index ?>" style="float:left"><?=(isset($precioKgEgresoPlan[$index])) ? $precioKgEgresoPlan[$index] : 0?></span>
                            <span id="precioKgVentaReal<?= $index ?>" class="real"><?=(isset($precioKgEgresoReal[$index])) ? ' | ' . $precioKgEgresoReal[$index] : '' ?></span>
                          </div>
                      </td>
                      <td>
                        <div class="celda-doble">

                          <div class="celda-izquierda">
                            <span class="planificado aPagar" id="aPagarIngreso<?= $index ?>" style="float:left;font-weight:bold;color:<?=
                            (isset($aPagarIngresoPlan[$index])) ? 
                              ($aPagarIngresoPlan[$index] == 'A') ? 
                                'green' 
                                : 
                                (($aPagarIngresoPlan[$index] == 'B') ? 'blue' : (($aPagarIngresoPlan[$index] == 'D') ? 'red' : 'rgb(277,215,0)'))
                                : 'green'
                              
                              ?>">
                              <?=(isset($aPagarIngresoPlan[$index])) ? $aPagarIngresoPlan[$index] : 'A'?></span>

                            <span id="aPagarIngresoReal<?= $index ?>" class="real" style="font-weight:bold;color:
                            <?=(isset($aPagarIngresoReal[$index]) && $aPagarIngresoReal[$index] == 'A') ? 
                              'green' 
                              : 
                              ((isset($aPagarIngresoReal[$index]) && $aPagarIngresoReal[$index] == 'B') ? 'blue' : ((isset($aPagarIngresoReal[$index]) && $aPagarIngresoReal[$index] == 'D') ? 'red' : 'rgb(277,215,0)'))?>"><?=(isset($aPagarIngresoReal[$index])) ? ' | ' . $aPagarIngresoReal[$index] : '' ?></span>

                          </div>
                          <div class="celda-derecha">
                            <span class="planificado aPagar" id="aPagarVenta<?= $index ?>" style="float:left;font-weight:bold;color:<?=
                              (isset($aPagarEgresoPlan[$index])) ? 
                                ($aPagarEgresoPlan[$index] == 'A') ? 
                                  'green'
                                  : 
                                  (($aPagarEgresoPlan[$index] == 'B') ? 'blue' : (($aPagarEgresoPlan[$index] == 'D') ? 'red' : 'rgb(277,215,0)'))
                                  : 'green'?>">
                                
                              <?=(isset($aPagarEgresoPlan[$index])) ? $aPagarEgresoPlan[$index] : 'A'?></span>
                              <span id="aPagarVentaReal<?= $index ?>" class="real" style="font-weight:bold;color:<?=
                              (isset($aPagarEgresoPlan[$index])) ? 
                              ($aPagarEgresoPlan[$index] == 'A') ? 
                              'green'
                              : 
                              (($aPagarEgresoPlan[$index] == 'B') ? 'blue' : (($aPagarEgresoPlan[$index] == 'D') ? 'red' : 'rgb(277,215,0)'))
                              : 'green'?>">
                              <?=(isset($aPagarEgresoReal[$index])) ? ' | ' . $aPagarEgresoReal[$index] : '' ?></span>
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

