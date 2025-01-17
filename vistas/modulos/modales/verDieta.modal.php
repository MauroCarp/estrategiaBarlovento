<div id="modalEstrategiaDietas" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width:800px">

      <form role="form" method="post" id="formDietas">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="">Dietas</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

                <div class="col-lg-8">

                    <div class="row">

                        <div class="col-lg-6">
        
                            <div class="form-group">
                                <label for="nombreDieta">Nombre:</label>
                                <input type="text" class="form-control" id="nombreDieta" placeholder="Ingreso">
                            </div>

                        </div>
                        
                    </div>

                    <div class="row">

                        <div class="col-lg-6">Insumo</div>
                        <div class="col-lg-3">%</div>
                        <div class="col-lg-3">% MS</div>
                        
                    </div>
 
                    <div class="row" id="primerInsumo">

                        <div class="col-lg-6">

                            <select class="form-control selectInsumos" name="insumo[]">
                                <?php
                                    $insumos = ControladorEstrategia::ctrMostrarInsumos();

                                    foreach ($insumos as $key => $insumo) {

                                        echo "<option value='" . $insumo['id'] . "' ms='" . $insumo['porceMS'] . "'>" . $insumo['insumo'] . "</option>";

                                    }

                                ?>
                            </select>

                        </div>
                        <div class="col-lg-3"><input class="form-control input-sm" type="number" name="porcentajeInsumo[]"></div>
                        <div class="col-lg-3"><input class="form-control input-sm" type="text" id="porcentMS" readonly></div>

                    </div>
                    <br>
                    <div class="row">

                        <div class="col-lg-1">

                            <button class="btn btn-info"><i class="fa fa-plus"></i></button>

                        </div>

                    </div>

                </div>
                
                <div class="col-lg-4">
                    
                    <table class="table table-striped">

                        <tbody>

                            <?php

                                foreach ($dietas as $key => $dieta) { ?>

                                <tr>
                                    <td style="line-height:2.2em;"><b><?=$dieta['nombre']?></b></td>
                                    <td><button class="btn btn-info verDieta"><i class="fa fa-eye"></i></button>
                                        <button class="btn btn-danger eliminarDieta"><i class="fa fa-times"></i></button></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>

                </div>

            </div>
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

