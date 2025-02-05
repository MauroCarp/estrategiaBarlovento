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

                foreach ($estructuraIndex as $index => $estructura): ?>
                    
                    <div class="tab-pane <?=($index == 0) ? 'active' : ''?>" id="<?=$estructura?>">

                        <table class="table table-bordered">

                            <thead>
                                <th></th>
                                <th>Importe</th>
                                <th>A Pagar</th>
                            </thead>

                            <tbody>
                                
                            <?php foreach ($months as $i => $month): ?>
                                <tr class="monthRow">
                                    <td><?= $month ?></td>
                                    <td><input class="form-control sm-input estructura" type="number" id="<?=$estructura?>_importe_<?= $i ?>" value="0"></td>
                                    <td>
                                        <select class="form-control aPagar" onChange="cambiarColorApagar($(this))" id="<?=$estructura?>_aPagar_<?= $i ?>" style="font-weight:bold;color:green">
                                            <option value="A" style="font-weight:bold;color:green">A</option>
                                            <option value="B" style="font-weight:bold;color:blue">B</option>
                                            <option value="C" style="font-weight:bold;color:rgb(227,216,0)">C</option>
                                            <option value="D" style="font-weight:bold;color:red">D</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endforeach; ?> 
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

