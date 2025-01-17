<div class="row" style="margin-top:10px;" > 

    <div class="col-md-4">
                    
        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title">Confecci&oacute;n de Dieta</h3>

            </div>
            
            <div class="box-body">
                <form method='POST'>

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="form-group">
                                <label for="nombreDieta">Nombre:</label>
                                <input type="text" class="form-control" name="nombreDieta" id="nombreDieta" placeholder="Ingreso" required>
                            </div>

                            <div class="row">

                                <div class="col-lg-7"><b>Insumo</b></div>
                                <div class="col-lg-3" align='center'><b>%</b></div>
                                <div class="col-lg-2"></div>
                                
                            </div>

                            <div id="insumos">

                                <div class="row" id="primerInsumo">
                                    
                                    <div class="col-lg-7">
                                        
                                        <select class="selectInsumos" name="insumo[]">
                                            <?php
                                            $insumos = ControladorEstrategia::ctrMostrarInsumos();
                                            
                                            echo '<option value="">Seleccionar Insumo</option>';
                                            
                                            foreach ($insumos as $key => $insumo) {
                                                
                                                echo "<option value='" . $insumo['id'] . "' ms='" . $insumo['porceMS'] . "'>" . $insumo['insumo'] . "</option>";
                                                
                                            }
                                            
                                            ?>
                                        </select>
                                        
                                    </div>
                                    <div class="col-lg-3"><input class="form-control input-sm porcentajeInsumo" onchange="sumarPorcentajes()" type="number" name="porcentajeInsumo[]"></div>
                                
                                </div>
                                            
                            </div>
                            <div class="row" style="font-size:1.2em;">

                                <div class="col-lg-7" style="text-align:right">

                                    <b>TOTAL:</b>

                                </div>

                                <div class="col-lg-3" style="text-align:center">

                                    <span id="totalPorcentaje">0</span> % 

                                </div> 

                            </div>              

                            <br>
                            

                            <div class="row">

                                <div class="col-lg-6 pull-left">

                                    <button class="btn btn-info" id="btnAgregarInsumo" type="button"><i class="fa fa-plus"></i></button>

                                </div>

                                <div class="col-lg-6">

                                    <button class="btn btn-info pull-right" name="btnNuevaDieta" id="btnNuevaDieta" type="submit">Cargar Dieta</button>

                                </div>

                            </div>

                        </div>
                        
                    </div>

                </form>

            </div>

        </div>

    </div>

    <div class="col-md-3">
                    
        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title">Dietas</h3>

            </div>
            
            <div class="box-body">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card card-primary">

                            <table class="table table-striped">

                                <tbody>

                                    <?php

                                        foreach ($dietas as $key => $dieta) { ?>

                                        <tr>
                                            <td style="line-height:2.2em;"><b><?=$dieta['nombre']?></b></td>
                                            <td>
                                                <button class="btn btn-info verDieta" idDieta="<?=$dieta['id']?>"><i class="fa fa-eye"></i></button>
                                                <button class="btn btn-danger eliminarDieta" idDieta="<?=$dieta['id']?>"><i class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>

                            </table>

                        </div>

                    </div>
                    
                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3" id="composicionDieta" style="display:none">
                    
        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title">Composici&oacute;n de la Dieta</h3>

            </div>
            
            <div class="box-body">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card card-primary">

                            <table class="table table-striped table-hover">

                                <thead>
                                    <tr>

                                        <td><b>Insumo</b></td>
                                        <td><b>%</b></td>
                                    </tr>
                                </thead>

                                <tbody id="insumosDieta">

                                    
                                </tbody>

                            </table>

                        </div>

                    </div>
                    
                </div>

            </div>

        </div>

    </div>
</div>


<?php

$nuevaDieta = new ControladorEstrategia();
$nuevaDieta->ctrNuevaDieta();

?>