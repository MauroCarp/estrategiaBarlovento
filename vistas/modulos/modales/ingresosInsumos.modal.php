<div id="modalEstrategiaIngresoInsumos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width:1000px; margin-left:-150px;">

      <form role="form" method="post" enctype="multipart/form-data" id="formCarga">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="">Insumos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="col-sm-3">
              <!-- Lista de pestañas -->
              <ul class="nav nav-insumos nav-pills nav-stacked" id="tabsInsumos">

              </ul>
            </div>

            <div class="col-sm-9">
                <!-- Contenido de las pestañas -->
                <div class="tab-content tab-insumos" id="tab-insumos">

                  
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

