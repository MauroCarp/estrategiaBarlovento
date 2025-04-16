<div id="modalEstrategiaEstructura" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width:600px; margin-left:-100px;">

      <form role="form" method="post" enctype="multipart/form-data" id="formCarga">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="">Estructura</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="col-sm-3" style="padding-left:0;">
              <!-- Lista de pestañas -->
              <ul class="nav nav-insumos nav-pills nav-stacked" id="tabsEstructura">
              
                <li class="active"><a href="#estructuraDirecto" data-toggle="pill">Gastos de Estructura Directo</a></li>
                <li><a href="#estructuraIndirecto" data-toggle="pill">Gastos de Estructura Indirecto</a></li>
                <li><a href="#gastosVarios" data-toggle="pill">Gastos Varios</a></li>
                <li><a href="#ingresosExtraordinarios" data-toggle="pill">Ingresos Extraordinarios</a></li>

              </ul>
            </div>

            <div class="col-sm-9">
                <!-- Contenido de las pestañas -->
                <div class="tab-content tab-insumos" id="tab-estructura">

                <?php 
                $months = [
                  1 => 'Mayo', 2 => 'Junio', 3 => 'Julio', 4 => 'Agosto', 
                  5 => 'Septiembre', 6 => 'Octubre', 7 => 'Noviembre', 8 => 'Diciembre',
                  9 => 'Enero', 10 => 'Febrero', 11 => 'Marzo', 12 => 'Abril'
                ];
                $estructuraIndex = ['estructuraDirecto', 'estructuraIndirecto', 'gastosVarios', 'ingresosExtraordinarios'];

                $estructuraIds = ['directa','indirecta','gastos','ingresos'];

                $estructuraDirecta = (isset($data['estrategia']['directaImportePlan'])) ? json_decode($data['estrategia']['directaImportePlan'],true) : [];
                $estructuraIndirecta = (isset($data['estrategia']['indirectaImportePlan'])) ? json_decode($data['estrategia']['indirectaImportePlan'],true) : [];
                $estructuraGastos = (isset($data['estrategia']['gastosImportePlan'])) ? json_decode($data['estrategia']['gastosImportePlan'],true) : [];
                $estructuraIngresos = (isset($data['estrategia']['ingresosImportePlan'])) ? json_decode($data['estrategia']['ingresosImportePlan'],true) : [];
                $estructuraDirectaAP = (isset($data['estrategia']['directaApagarPlan'])) ? json_decode($data['estrategia']['directaApagarPlan'],true) : [];
                $estructuraIndirectaAP = (isset($data['estrategia']['indirectaApagarPlan'])) ? json_decode($data['estrategia']['indirectaApagarPlan'],true) : [];
                $estructuraGastosAP = (isset($data['estrategia']['gastosApagarPlan'])) ? json_decode($data['estrategia']['gastosApagarPlan'],true) : [];
                $estructuraIngresosAP = (isset($data['estrategia']['ingresosApagarPlan'])) ? json_decode($data['estrategia']['ingresosApagarPlan'],true) : [];

                $estructuraDirectaReal = (isset($data['estrategia']['directaImporteReal'])) ? json_decode($data['estrategia']['directaImporteReal'],true) : [];
                $estructuraIndirectaReal = (isset($data['estrategia']['indirectaImporteReal'])) ? json_decode($data['estrategia']['indirectaImporteReal'],true) : [];
                $estructuraGastosReal = (isset($data['estrategia']['gastosImporteReal'])) ? json_decode($data['estrategia']['gastosImporteReal'],true) : [];
                $estructuraIngresosReal = (isset($data['estrategia']['ingresosImporteReal'])) ? json_decode($data['estrategia']['ingresosImporteReal'],true) : [];
                $estructuraDirectaAPReal = (isset($data['estrategia']['directaApagarReal'])) ? json_decode($data['estrategia']['directaApagarReal'],true) : [];
                $estructuraIndirectaAPReal = (isset($data['estrategia']['indirectaApagarReal'])) ? json_decode($data['estrategia']['indirectaApagarReal'],true) : [];
                $estructuraGastosAPReal = (isset($data['estrategia']['gastosApagarReal'])) ? json_decode($data['estrategia']['gastosApagarReal'],true) : [];
                $estructuraIngresosAPReal = (isset($data['estrategia']['ingresosApagarReal'])) ? json_decode($data['estrategia']['ingresosApagarReal'],true) : [];

                foreach ($estructuraIndex as $index => $estructura): 

                  ?>
                    <div class="tab-pane <?=($index == 0) ? 'active' : ''?>" id="<?=$estructura?>">

                        <table class="table table-bordered">

                            <thead>
                                <th></th>
                                <th>Importe</th>
                                <th>A Pagar</th>
                            </thead>

                            <tbody>
                                
                            <?php foreach ($months as $i => $month): 
                              
                              if(empty($data['estrategia']) || !$data['estrategia']['seteado']){
                                $val = false;
                                if($estructura == 'estructuraDirecto'){
                                  $val = $estructuraDirecta;
                                  $ap = $estructuraDirectaAP;
                                }else if($estructura == 'estructuraIndirecto'){
                                  $val = $estructuraIndirecta;
                                  $ap = $estructuraIndirectaAP;
                                }else if($estructura == 'gastosVarios'){  
                                  $val = $estructuraGastos; 
                                  $ap = $estructuraGastosAP;
                                }else{
                                  $val = $estructuraIngresos;
                                  $ap = $estructuraIngresosAP;
                                }

                                ?>                                

                                <tr class="monthRow">
                                    <td><?= $month ?></td>
                                    <td><input class="form-control sm-input estructura" type="number" id="<?=$estructura?>_importe_<?= $i ?>" value="<?=($val) ? $val[$i] : 0?>"></td>
                                    <td>
                                        <select class="form-control aPagar" onChange="cambiarColorApagar($(this))" id="<?=$estructura?>_aPagar_<?= $i ?>" style="font-weight:bold;color:green">
                                            <option value="A" <?=($data['estrategia']) ? (($ap[$i] == 'A') ? 'selected' : ''): '' ?> style="font-weight:bold;color:green">A</option>
                                            <option value="B" <?=($data['estrategia']) ? (($ap[$i] == 'B') ? 'selected' : ''): '' ?> style="font-weight:bold;color:blue">B</option>
                                            <option value="C" <?=($data['estrategia']) ? (($ap[$i] == 'C') ? 'selected' : ''): '' ?> style="font-weight:bold;color:rgb(227,216,0)">C</option>
                                            <option value="D" <?=($data['estrategia']) ? (($ap[$i] == 'D') ? 'selected' : ''): '' ?> style="font-weight:bold;color:red">D</option>
                                        </select>
                                    </td>
                                </tr>
                             
                              <?php } else { 
                                $importe = 0;
                                $aPagar = '';
                                $importeReal = 0;
                                $aPagarReal = '';

                                if ($estructuraIds[$index] == 'directa'){
                                  $importe = $estructuraDirecta[$i];
                                  $aPagar = $estructuraDirectaAP[$i];
                                  $importeReal = (isset($estructuraDirectaReal[$i])) ? $estructuraDirectaReal[$i] : 0;
                                  $aPagarReal = (isset($estructuraDirectaAPReal[$i])) ? $estructuraDirectaAPReal[$i] : '';
                                } else if($estructuraIds[$index] == 'indirecta'){
                                  $importe = $estructuraIndirecta[$i];
                                  $aPagar = $estructuraIndirectaAP[$i];
                                  $importeReal = isset($estructuraIndirectaReal[$i]) ? $estructuraIndirectaReal[$i] : 0;
                                  $aPagarReal = isset($estructuraIndirectaAPReal[$i]) ? $estructuraIndirectaAPReal[$i] : '';
                                } else if($estructuraIds[$index] == 'gastos'){
                                  $importe = $estructuraGastos[$i];
                                  $aPagar = $estructuraGastosAP[$i];
                                  $importeReal = isset($estructuraGastosReal[$i]) ? $estructuraGastosReal[$i] : 0;
                                  $aPagarReal = isset($estructuraGastosAPReal[$i]) ? $estructuraGastosAPReal[$i] : '';
                                } else { 
                                  $importe = $estructuraIngresos[$i];
                                  $aPagar = $estructuraIngresosAP[$i];
                                  $importeReal = isset($estructuraIngresosReal[$i]) ? $estructuraIngresosReal[$i] : 0;
                                  $aPagarReal = isset($estructuraIngresosAPReal[$i]) ? $estructuraIngresosAPReal[$i] : '';
                                }
                              
                                ?>
                              
                                <tr class="monthRow">
                                    <td><?= $month ?></td>
                                    <td>
                                      <span class="planificado contableEstructura" id="<?=$estructuraIds[$index]?>Importe<?=$i?>"><?=number_format($importe, 0, ',', '.')?></span>
                                      <span id="<?=$estructuraIds[$index]?>ImporteReal<?=$i?>" class="real"><?=($importeReal) ? ' | ' . number_format($importeReal,0,',','.') : '' ?></span>
                                    </td>
                                    <td>
                                      <span class="planificado" id="<?=$estructuraIds[$index]?>Apagar<?=$i?>" style="font-weight:bold;color:<?=($aPagar == 'A') ? 
                                      'green' 
                                      : 
                                      (($aPagar == 'B') ? 'blue' : (($aPagar == 'D') ? 'red' : 'rgb(277,215,0)'))?>"><?=$aPagar?></span>
                                      <span id="<?=$estructuraIds[$index]?>ApagarReal<?=$i?>" class="real"><?=($aPagarReal) ? ' | ' . $aPagarReal : '' ?></span>
                                    </td>
                                </tr>

                            <?php }
                           endforeach; ?> 

                            </tbody>
                        </table>
                    </div>

                <?php endforeach; ?>
                  
                </div>
            </div>
            
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

