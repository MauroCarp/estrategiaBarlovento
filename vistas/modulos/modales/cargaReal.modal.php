<div id="modalCargarEstrategiaReal" class="modal fade" role="dialog">
  <form role="form" method="post" id="formCarga">
  
  <div class="modal-dialog">

      
      <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="">Carga de Ingresos y Egresos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <input type="hidden" class="form-control real" id="monthReal" name="month">
            <input type="hidden" class="form-control" name="campaniaReal" value="<?=$data['estrategia']['campania']?>">

            <div class="row" id="insumosReal"></div>

            <div class="row">

              <div class="col-sm-4">

                <div class="form-group">

                  <label>Cantidad Ing.</label>

                  <input type="number" min="0" step="0.1" class="form-control real" name="ingresosReal" value="0">

                </div>

              </div>

              <div class="col-sm-4">

                <div class="form-group">

                  <label>Kg Ing.</label>

                  <input type="number" min="0" step="0.1" class="form-control real" name="kgIngresosReal" value="0">

                </div>

              </div>

              <div class="col-sm-4">

                <div class="form-group">

                  <label>ADP</label>

                  <input type="number" min="0" step="0.1" class="form-control real" name="adpReal" value="0">

                </div>

              </div>
                
            </div>

            <div class="row">

              <div class="col-sm-4">

                <div class="form-group">

                  <label>Cantidad Egr.</label>

                  <input type="number" min="0" step="0.1" class="form-control real" name="ventasReal" value="0">

                </div>

              </div>

              <div class="col-sm-4">

                <div class="form-group">

                  <label>Kg Egr.</label>

                  <input type="number" min="0" step="0.1" class="form-control real" name="kgVentasReal" value="0">

                </div>

              </div>

              <div class="col-sm-4">

                <div class="form-group">

                  <label>% Cons. MS</label>

                  <input type="number" min="0" step="0.1" class="form-control real" name="msReal" value="0">

                </div>

              </div>

            </div>
            
            <hr>

            <h3>Dieta</h3>

            <div class="row" id="dietaReal"></div>
          
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
  
        <div class="modal-footer">
  
          <button type="submit" class="btn btn-primary" id="btnCargaReal" name="btnCargaReal">Cargar</button>
  
        </div>
      </div>


      
  </div>
    
  </form>
</div>

<?php

$cargarReal = new ControladorEstrategia();

$cargarReal->ctrCargaReal();


?>

