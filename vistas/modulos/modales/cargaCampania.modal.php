<div id="modalNuevaCampaniaEstrategia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="formCampania">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="">Nueva Campa&ntilde;a</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <div class="row">

            <div class="col-lg-5">

              <select class="form-control" name="campania" id="campania">

                <?php

                  // $anioActual = date('Y');
                  // $anioSiguiente = $anioActual + 1;
                  // $anioActual--;
                                    
                  // for ($i=0; $i < 5; $i++) { 

                  //   echo "<option value='" . ($anioActual + 1) . "'>" . ($anioActual + 1) . "</option>";
                  //   $anioActual++;

                  // }

                ?>

              </select>

            </div>

            <div class="col-lg-5">
              <input type="text" id="campania2"  class="form-control" readOnly>
            </div>
            
          </div>
                      
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" name="btnNuevaCampania" class="btn btn-primary pull-right">Cargar</button>

        </div>

      </form>

    </div>

  </div>

</div>

<?php

$nuevaCampania = new ControladorEstrategia();

$nuevaCampania->ctrNuevaCampania();


?>

