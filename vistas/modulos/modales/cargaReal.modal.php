<div id="modalCargarEstrategiaReal" class="modal fade" role="dialog">

  <form role="form" method="post" id="formCarga">
  
    <div class="modal-dialog" style="max-width:1100px; margin: 30px auto;">

        
        <div class="modal-content" style="width:1100px;margin-left:-25%;max-height:80vh;overflow-y: auto;">


          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->

          <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title" id="">Carga Real</h4>

          </div>

          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->

          <div class="modal-body">

            <div class="box-body" id="cargaRealModal">
  
              <input type="hidden" class="form-control real" id="monthReal" name="month">
              <input type="hidden" class="form-control" name="campaniaReal" value="<?=(isset($data['estrategia']['campania'])) ? $data['estrategia']['campania'] : ''?>">

              <div class="row">

                <div class="col-lg-12">

                  <div class="row">

                    <div class="col-sm-4">
  
                      <div class="form-group">
    
                        <label>ADP</label>
    
                        <input type="number" min="0" step="0.1" class="form-control real" name="adpReal" value="0">
    
                      </div>
                      
                    </div>

                    <div class="col-sm-4">

                      <div class="form-group">

                        <label>% Cons. MS</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="msReal" value="0">

                      </div>

                    </div>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-lg-12">

                  <h4>Animales</h4>

                  <div class="row">

                    <div class="col-sm-3">

                      <div class="form-group">

                        <label>Cantidad Ing.</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="ingresosReal" value="0">

                      </div>

                    </div>

                    <div class="col-sm-3">

                      <div class="form-group">

                        <label>Kg Ing.</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="kgIngresosReal" value="0">

                      </div>

                    </div>

                    <div class="col-sm-3">

                      <div class="form-group">

                        <label>Precio Kg Ing.</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="precioKgIngresoReal" value="0">

                      </div>

                    </div>

                    <div class="col-sm-3">

                      <div class="form-group">

                        <label>A Pagar</label>

                        <select class="form-control" name="aPagarIngresoReal" style="font-weight:bold;color:green" >
                          <option value="A" style="font-weight:bold;color:green">A</option>
                          <option value="B" style="font-weight:bold;color:blue">B</option>
                          <option value="C" style="font-weight:bold;color:rgb(227,216,0)">C</option>
                          <option value="D" style="font-weight:bold;color:red">D</option>
                        </select>

                      </div>

                    </div>
                      
                  </div>

                  <div class="row">

                    <div class="col-sm-3">

                      <div class="form-group">

                        <label>Cantidad Egr.</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="ventasReal" value="0">

                      </div>

                    </div>

                    <div class="col-sm-3">

                      <div class="form-group">

                        <label>Kg Egr.</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="kgVentasReal" value="0">

                      </div>

                    </div>

                    <div class="col-sm-3">

                      <div class="form-group">

                        <label>Precio Kg Egr.</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="precioKgVentaReal" value="0">

                      </div>

                      </div>

                      <div class="col-sm-3">

                      <div class="form-group">

                        <label>A Pagar</label>

                        <select class="form-control" name="aPagarVentaReal" style="font-weight:bold;color:green" >
                          <option value="A" style="font-weight:bold;color:green">A</option>
                          <option value="B" style="font-weight:bold;color:blue">B</option>
                          <option value="C" style="font-weight:bold;color:rgb(227,216,0)">C</option>
                          <option value="D" style="font-weight:bold;color:red">D</option>
                        </select>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-lg-12" id="insumosReal">

                  <h4>Insumos</h4>
                      
                </div>

              </div>

              <div class="row">
                
                <div class="col-lg-12">

                  <h4>Dieta</h4>

                  <div class="row" id="dietaReal"></div>
              
                  <small id="alertaDietaReal"><b style="color:red">El total de la dieta no puede ser menor a 100%</b></small>

                </div>

              </div>

              <div class="row" style="padding-left:15px;">

                <div class="col-lg-3" style="padding-left:0px;">
                  
                  <h4>Estructura Directa</h4>

                  <div class="row">

                    <div class="col-sm-6" style="padding-right:0px">

                      <div class="form-group">

                        <label>Importe</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="estructuraDirectaImporteReal" value="0">

                      </div>

                    </div>

                    <div class="col-sm-6" style="padding-left:0px;">

                      <div class="form-group">

                        <label>A Pagar</label>

                        <select class="form-control" name="estructuraDirectaAPagarReal" style="font-weight:bold;color:green" >
                          <option value="A" style="font-weight:bold;color:green">A</option>
                          <option value="B" style="font-weight:bold;color:blue">B</option>
                          <option value="C" style="font-weight:bold;color:rgb(227,216,0)">C</option>
                          <option value="D" style="font-weight:bold;color:red">D</option>
                        </select>

                      </div>

                    </div>

                  </div>

                </div>

                <div class="col-lg-3" style="padding-left:0px;">
                  
                  <h4>Estructura Indirecta</h4>

                  <div class="row">

                    <div class="col-sm-6" style="padding-right:0px">

                      <div class="form-group">

                        <label>Importe</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="estructuraIndirectaImporteReal" value="0">

                      </div>

                    </div>

                    <div class="col-sm-6" style="padding-left:0px;">

                      <div class="form-group">

                        <label>A Pagar</label>

                        <select class="form-control" name="estructuraIndirectaAPagarReal" style="font-weight:bold;color:green" >
                          <option value="A" style="font-weight:bold;color:green">A</option>
                          <option value="B" style="font-weight:bold;color:blue">B</option>
                          <option value="C" style="font-weight:bold;color:rgb(227,216,0)">C</option>
                          <option value="D" style="font-weight:bold;color:red">D</option>
                        </select>

                      </div>

                    </div>

                  </div>

                </div>

                <div class="col-lg-3" style="padding-left:0px;">
                  
                  <h4>Gastos Varios</h4>

                  <div class="row">

                    <div class="col-sm-6" style="padding-right:0px">

                      <div class="form-group">

                        <label>Importe</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="gastosVariosImporteReal" value="0">

                      </div>

                    </div>

                    <div class="col-sm-6" style="padding-left:0px;">

                      <div class="form-group">

                        <label>A Pagar</label>

                        <select class="form-control" name="gastosVariosPagarReal" style="font-weight:bold;color:green" >
                          <option value="A" style="font-weight:bold;color:green">A</option>
                          <option value="B" style="font-weight:bold;color:blue">B</option>
                          <option value="C" style="font-weight:bold;color:rgb(227,216,0)">C</option>
                          <option value="D" style="font-weight:bold;color:red">D</option>
                        </select>

                      </div>

                    </div>

                  </div>

                </div>

                <div class="col-lg-3" style="padding-left:0px;">
                  
                  <h4>Ingreso Extraordinario</h4>

                  <div class="row">

                    <div class="col-sm-6" style="padding-right:0px">

                      <div class="form-group">

                        <label>Importe</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="ingresoExtraImporteReal" value="0">

                      </div>

                    </div>

                    <div class="col-sm-6" style="padding-left:0px;">

                      <div class="form-group">

                        <label>A Pagar</label>

                        <select class="form-control" name="ingresoExtraAPagarReal" style="font-weight:bold;color:green" >
                          <option value="A" style="font-weight:bold;color:green">A</option>
                          <option value="B" style="font-weight:bold;color:blue">B</option>
                          <option value="C" style="font-weight:bold;color:rgb(227,216,0)">C</option>
                          <option value="D" style="font-weight:bold;color:red">D</option>
                        </select>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <!--=====================================
          PIE DEL MODAL
          ======================================-->
    
          <div class="modal-footer">

            <div class="pull-right">

              <small><span style="color:green"><b>A</b></span> - 30 d&iacute;as | </small>
              <small><span style="color:blue"><b>B</b> - </span>30/60 d&iacute;as | </small>
              <small><span style="color:rgb(227,216,0)"><b>C</b></span> - 60 d&iacute;as | </small>
              <small><span style="color:red"><b>D</b></span> - 90 d&iacute;as</small>
              
            </div>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="margin-bottom:10px">Cerrar</button>

            <button type="submit" class="btn btn-primary btn-block pull-right" id="btnCargaReal" name="btnCargaReal" disabled>Cargar</button>
    
          </div>
        </div>


        
    </div>
    
  </form>
</div>

<?php

$cargarReal = new ControladorEstrategia();

$cargarReal->ctrCargaReal();


?>

