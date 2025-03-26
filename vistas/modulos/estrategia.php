
<div class="row"> 

  <div class="col-md-12">

    <div class="card">

      <div class="card-body">

        <form id="formularioEstrategia" method="post">

          <div class="row">

            <?php 
            if(!$data['estrategia']['seteado']){ 

              ?>

              <div class="col-md-2"> 
      
                <div class="form-group">

                  <label>Dieta:</label>

                  <select class="form-control dietas" style="margin-top:5px;margin-bottom:5px;" name="dieta" id="dieta" required>
                  
                    <option value="">Seleccionar Dieta</option>

                    <?=$dietasOptions?>

                  </select>
                  <!-- <script>
                    $('#dieta').val(<?=$data['estrategia']['idDieta']?>)
                  </script> -->
                </div>
      
              </div>
              
            <?php } ?>
                  
            <div class="col-md-1"> 

              <div class="form-group">

                <label>&nbsp;</label>

                <button type="button" class="btn btn-primary btn-block" id="stock" data-toggle="modal" data-target="#modalEstrategiaStock">Stock Inicial</button>

              </div>
              
            </div>

            
              <div class="col-md-2"> 

                <div class="form-group">

                  <label>&nbsp;</label>

                  <button class="btn btn-primary btn-block" type="button" id="btnIngEgr" data-toggle="modal" data-target="#modalEstrategiaIngEgr">Ingresos/Egresos de Animales</button>

                </div>
                
              </div>

              <div class="col-md-1"> 

                <div class="form-group">

                  <label>&nbsp;</label>

                  <button class="btn btn-primary btn-block" type="button" id="btnIngEgrInsumo" data-toggle="modal" data-target="#modalEstrategiaIngresoInsumos">Insumos</button>

                </div>
                
              </div>

              <div class="col-md-1"> 

                <div class="form-group">

                  <label>&nbsp;</label>

                  <button class="btn btn-primary btn-block" type="button" id="btnEstructura" data-toggle="modal" data-target="#modalEstrategiaEstructura">Estructura</button>

                </div>
                
              </div>

            <?php if(!$data['estrategia']['seteado']){ ?>

              <div class="col-md-1"> 

                <div class="form-group">

                  <label>&nbsp;</label>

                  <button class="btn btn-success btn-block" type="submit" id="btnSetear" name="btnSetear"><b>SETEAR</b></button>

                </div>

              </div>

            <?php } ?>

            <div class="col-md-2"> 

              <div class="form-group" style="margin-bottom:0">

                  <label>Campa&ntilde;a</label>

                  <select class="form-control" name="selectCampania" id="selectCampania" required>

                  <?php
                      foreach ($data['campanias'] as $key => $campania) {
                        ?>
                      
                      <option value="<?=$campania['campania']?>" 
                      <?=(array_key_exists('campania',$_GET) && $campania['campania'] == $_GET['campania']) ? 'selected' : '' ?>><?=$campania['campania']?></option>

                      <?php }
                  ?>

                  </select>

              </div>

            </div>

            <div class="col-md-1">

              <div class="form-group">

                <label>&nbsp;</label>

                <button type="button" class="btn btn-primary btn-block" id="nuevaCampania" data-toggle="modal" data-target="#modalNuevaCampaniaEstrategia">Nueva</button>

              </div>

            </div>

          </div>

          <table class="table table-bordered table-hover table-striped tablaEstrategia" id="tablaEstrategia">

            <thead>

              <tr>
                <th style="width:100px;"></th>
                          
                <?php foreach ($meses as $key => $mes) { ?>
                  
                  <th><button type="button" class="btn btn-block btn-secondary btnCargaReal" data-toggle="modal" data-target="#modalCargarEstrategiaReal" data-month="<?=$key?>" <?=(!$data['estrategia']['seteado']) ? 'disabled' : ''?>><?=$mes?></button></th>

                <?php } ?> 

              </tr>

            </thead>
            
            <tbody id="tbodyEstrategia">

              <tr>
              
                <td>Ingresos</td>

                <?php

                  if(!$data['estrategia']['seteado']){

                    foreach ($meses as $key => $mes) { ?>

                      <?php
                      $ingresosPlan = false;

                      if($data['estrategia'])
                        $ingresosPlan = json_decode($data['estrategia']['ingresosPlan'],true);
                      
                      ?>

                      <td id="ingresoPlan<?=$key?>" ><?=($ingresosPlan) ?  $ingresosPlan[$key] : 0 ?></td>
    
                    <?php } 
                    
                  } else {
                    
                    $ingresosPlan = json_decode($data['estrategia']['ingresosPlan'],true);
                    $ingresosReal = json_decode($data['estrategia']['ingresosReal'],true);
                    
                    foreach ($ingresosPlan as $key => $value) { ?>

                    <td><span class="planificado"><?=$value?></span><span class="real" <?=(isset($ingresosReal[(string)$key]) && $ingresosReal[(string)$key] < $value) ? 'style="color:red"' : ''?> id='ingReal<?=$key?>'><?=(isset($ingresosReal[(string)$key])) ? " | " . $ingresosReal[(string)$key] : ''?></span></td>

                    <?php 
                    
                    } 

                  }

                ?>
                
              </tr>

              <tr>
              
                <td>Kg Prom Ing</td>

                <?php

                  if(!$data['estrategia']['seteado']){

                    foreach ($meses as $key => $mes) { ?>

                      <?php
                      $kgIngresosPlan = false;

                      if($data['estrategia'])
                        $kgIngresosPlan = json_decode($data['estrategia']['kgIngresosPlan'],true);
                      
                      ?>

                      <td id="kgIngresoPlan<?=$key?>" ><?=($kgIngresosPlan) ?  $kgIngresosPlan[$key] : 0 ?></td>
    
                    <?php } 
                    
                  } else {
                    
                    $kgIngresosPlan = json_decode($data['estrategia']['kgIngresosPlan'],true);
                    $kgIngresosReal = json_decode($data['estrategia']['kgIngresosReal'],true);

                    

                    foreach ($kgIngresosPlan as $key => $value) { ?>

                    <td><span class="planificado"><?=$value?></span><span class="real" <?=(isset($kgIngresosReal[(string)$key]) && $kgIngresosReal[(string)$key] < $value) ? 'style="color:red"' : ''?> id='ingReal<?=$key?>'><?=(isset($kgIngresosReal[(string)$key])) ? " | " . $kgIngresosReal[(string)$key] : ''?></span></td>

                    <?php 
                    
                    } 

                  }

                ?>
                
              </tr>

              <tr>

                <td>Egresos</td>

                <?php

                  if(!$data['estrategia']['seteado']){

                    foreach ($meses as $key => $mes) { ?>

                      <?php
                        $egresosPlan = false;

                        if($data['estrategia'])
                          $egresosPlan = json_decode($data['estrategia']['egresosPlan'],true);
                        
                        ?>

                        <td id="ventaPlan<?=$key?>" ><?=($egresosPlan) ?  $egresosPlan[$key] : 0 ?></td>
                      
                    <?php } 
                    
                  } else {

                    $egresosPlan = json_decode($data['estrategia']['egresosPlan'],true);
                    $ventasReal = json_decode($data['estrategia']['ventasReal'],true);

                    foreach ($egresosPlan as $key => $value) { ?>

                    <td><span class="planificado"><?=$value?></span><span class="real" <?=(isset($ventasReal[(string)$key]) && $ventasReal[(string)$key] < $value) ? 'style="color:red"' : ''?> id='egrReal<?=$key?>'><?=(isset($ventasReal[(string)$key])) ? " | " . $ventasReal[(string)$key] : ''?></span></td>

                    <?php 

                    } 

                  }

                ?>

              </tr>

              <tr>

                <td>Kg Prom Egr</td>

                <?php

                  if(!$data['estrategia']['seteado']){

                    foreach ($meses as $key => $mes) { ?>

                      <?php
                        $kgEgresosPlan = false;

                        if($data['estrategia'])
                          $kgEgresosPlan = json_decode($data['estrategia']['kgEgresosPlan'],true);
                        
                        ?>

                        <td id="kgVentaPlan<?=$key?>" ><?=($kgEgresosPlan) ?  $kgEgresosPlan[$key] : 0 ?></td>

                    <?php } 
                    
                  } else {

                    $kgEgresosPlan = json_decode($data['estrategia']['kgEgresosPlan'],true);
                    $kgVentasReal = json_decode($data['estrategia']['kgVentasReal'],true);

                    foreach ($kgEgresosPlan as $key => $value) { ?>

                    <td><span class="planificado"><?=$value?></span><span class="real" <?=(isset($kgVentasReal[(string)$key]) && $kgVentasReal[(string)$key] < $value) ? 'style="color:red"' : ''?> id='egrReal<?=$key?>'><?=(isset($kgVentasReal[(string)$key])) ? " | " . $kgVentasReal[(string)$key] : ''?></span></td>

                    <?php 

                    } 

                  }

                ?>

              </tr>
              <tr>
                <td>Cabezas</td>
                <?php for ($i = 1; $i <= 12; $i++) { ?>
                  <td><span class="planificado" id="stockPlan<?=$i?>"></span><span class="real" id="stockReal<?=$i?>"></span></td>
                <?php } ?>
              </tr>

              <tr>
                <td>Kg Prom.</td>
                <?php for ($i = 1; $i <= 12; $i++) { ?>
                  <td><span class="planificado kgPromPlan" id="kgPromPlan<?=$i?>"></span><span class="real kgPromReal" id="kgPromReal<?=$i?>"></span></td>
                <?php } ?>
              </tr>

              <tr>

                <td>ADP</td>

                <?php if(!$data['estrategia']['seteado']){

                  foreach ($meses as $key => $mes) { 

                    $value = 0;

                    if($data['estrategia'])
                      $adpv = json_decode($data['estrategia']['adpPlan'],true);
                      $value = $adpv[$key-1];
                    
                  ?>

                  <td><input class="form-control input-sm" onchange="calcularPesoPromedio()" type="text" name="adpv[]" id="adpv<?=$key?>" value="<?=$value?>"></td>

                  <?php } 

                } else {

                  $adpPlan = json_decode($data['estrategia']['adpPlan']);
                  $adpReal = json_decode($data['estrategia']['adpReal'],true);

                  foreach ($adpPlan as $key => $value) { ?>
                    <td><span class="planificado" id="adpPlan<?=$key + 1?>"><?=$value?></span><span class="real" <?=(isset($adpReal[(int)$key + 1]) && $adpReal[(int)$key + 1] < $value) ? 'style="color:red"' : ''?> ><?=(isset($adpReal[(int)$key + 1])) ? " | " . $adpReal[(int)$key + 1] : ''?></span></td>

                  <?php

                  }
              
                } ?>

              </tr>
          
              <tr>

                <td>% Cons. MS</td>

                <?php if(!$data['estrategia']['seteado']){

                  foreach ($meses as $key => $mes) {

                    $value = 0;

                    if($data['estrategia'])
                      $porceMS = json_decode($data['estrategia']['msPlan'],true);
                      $value = $porceMS[$key-1];

                  ?>
                  <td><input class="form-control input-sm" onchange="calcularPesoPromedio()" type="text" name="porcentMS[]" id="porcentMS<?=$key?>" value="<?=$value?>"></td>

                  <?php } 

                } else {

                  $msPlan = json_decode($data['estrategia']['msPlan']);
                  $msReal = json_decode($data['estrategia']['msReal'],true);

                  foreach ($msPlan as $key => $value) { 
                  ?>

                  <td><span class="planificado" id="msPlan<?=$key + 1?>"><?=$value?></span><span class="real" <?=(isset($msReal[(int)$key + 1]) && $msReal[(int)$key + 1] < $value) ? 'style="color:red"' : ''?> id="msReal<?=$key?>"><?=(isset($msReal[(string)$key + 1])) ? " | " . $msReal[(string)$key + 1] : ''?></span></td>

                    <?php

                  }


                } ?> 

              </tr>
              <tr>
                <td>Cons. MS</td>
                <?php for ($i = 1; $i <= 12; $i++) { ?>
                  <td><span class="planificado" id="consumoMSPlan<?=$i?>"></span><span class="real" id="consumoMSReal<?=$i?>"></span></td>
                <?php } ?>
              </tr>

              <!--  DIETA ---->
    
              <tr>

                <td>Dieta</td>

                <?php 

                  foreach ($meses as $key => $mes) { 

                    if($data['estrategia']['seteado']){ ?>

                      <td><?=$data['estrategia']['nombre']?></td>

                  <?php

                    } else { ?>

                      <td class="dietaSeleccionada"><?=($data['estrategia']) ? $data['estrategia']['nombre'] : ''?></td>
                  
                  <?php

                    }

                  } 
                  
                  ?>  

              </tr>

            </tbody>

          </table>
        
          <input type="hidden" name="stockInsumos" value="">
          <input type="hidden" name="stockAnimales" value="<?=($data['estrategia']['stockAnimales']) ? $data['estrategia']['stockAnimales'] : 0 ?>">
          <input type="hidden" name="stockKgProm" value="<?=($data['estrategia']['stockKgProm']) ? $data['estrategia']['stockKgProm'] : 0 ?>">

          <?php
          $ingreso = json_decode($data['estrategia']['ingresosPlan'],true);
          $kgIngreso = json_decode($data['estrategia']['kgIngresosPlan'],true);
          $venta = json_decode($data['estrategia']['egresosPlan'],true);
          $kgVenta = json_decode($data['estrategia']['kgEgresosPlan'],true);
          $precioKgIngreso = json_decode($data['estrategia']['precioKgIngresosPlan'],true);
          $precioKgVenta = json_decode($data['estrategia']['precioKgEgresosPlan'],true);
          $aPagarIngreso = json_decode($data['estrategia']['aPagarIngresosPlan'],true);
          $aPagarVenta = json_decode($data['estrategia']['aPagarEgresosPlan'],true);
          $directaImportePlan = json_decode($data['estrategia']['directaImportePlan'],true);
          $directaApagarPlan = json_decode($data['estrategia']['directaApagarPlan'],true);
          $indirectaImportePlan = json_decode($data['estrategia']['indirectaImportePlan'],true);
          $indirectaApagarPlan = json_decode($data['estrategia']['indirectaApagarPlan'],true);
          $gastosImportePlan = json_decode($data['estrategia']['gastosImportePlan'],true);
          $gastosApagarPlan = json_decode($data['estrategia']['gastosApagarPlan'],true);
          $ingresosImportePlan = json_decode($data['estrategia']['ingresosImportePlan'],true);
          $ingresosApagarPlan = json_decode($data['estrategia']['ingresosApagarPlan'],true);

          for ($i = 1; $i <= 12; $i++) { ?>

            <input type="hidden" name="ingreso<?=$i?>" value="<?=($ingreso != 'null' && $ingreso[$i]) ? $ingreso[$i] : 0?>">
            <input type="hidden" name="kgIngreso<?=$i?>" value="<?=($kgIngreso != 'null' && $kgIngreso[$i]) ? $kgIngreso[$i] : 0?>">
            <input type="hidden" name="venta<?=$i?>" value="<?=($venta != 'null' && $venta[$i]) ? $venta[$i] : 0?>">
            <input type="hidden" name="kgVenta<?=$i?>" value="<?=($kgVenta != 'null' && $kgVenta[$i]) ? $kgVenta[$i] : 0?>">
            <input type="hidden" name="precioKgIngreso<?=$i?>" value="<?=($precioKgIngreso != 'null' && $precioKgIngreso[$i]) ? $precioKgIngreso[$i] : 0?>">
            <input type="hidden" name="precioKgVenta<?=$i?>" value="<?=($precioKgVenta != 'null' && $precioKgVenta[$i]) ? $precioKgVenta[$i] : 0?>">
            <input type="hidden" name="aPagarIngreso<?=$i?>" value="<?=($aPagarIngreso != 'null' && $aPagarIngreso[$i]) ? $aPagarIngreso[$i] : 0?>">
            <input type="hidden" name="aPagarVenta<?=$i?>" value="<?=($aPagarVenta != 'null' && $aPagarVenta[$i]) ? $aPagarVenta[$i] : 0?>">
            <input type="hidden" name="estructuraDirecto_importe_<?=$i?>" value="<?=($directaImportePlan != 'null' && $directaImportePlan[$i]) ? $directaImportePlan[$i] : 0?>">
            <input type="hidden" name="estructuraDirecto_aPagar_<?=$i?>" value="<?=($directaApagarPlan != 'null' && $directaApagarPlan[$i]) ? $directaApagarPlan[$i] : 0?>">
            <input type="hidden" name="estructuraIndirecto_importe_<?=$i?>" value="<?=($indirectaImportePlan != 'null' && $indirectaImportePlan[$i]) ? $indirectaImportePlan[$i] : 0?>">
            <input type="hidden" name="estructuraIndirecto_aPagar_<?=$i?>" value="<?=($indirectaApagarPlan != 'null' && $indirectaApagarPlan[$i]) ? $indirectaApagarPlan[$i] : 0?>">
            <input type="hidden" name="gastosVarios_importe_<?=$i?>" value="<?=($gastosImportePlan != 'null' && $gastosImportePlan[$i]) ? $gastosImportePlan[$i] : 0?>">
            <input type="hidden" name="gastosVarios_aPagar_<?=$i?>" value="<?=($gastosApagarPlan != 'null' && $gastosApagarPlan[$i]) ? $gastosApagarPlan[$i] : 0?>">
            <input type="hidden" name="ingresosExtraordinarios_importe_<?=$i?>" value="<?=($ingresosImportePlan != 'null' && $ingresosImportePlan[$i]) ? $ingresosImportePlan[$i] : 0?>">
            <input type="hidden" name="ingresosExtraordinarios_aPagar_<?=$i?>" value="<?=($ingresosApagarPlan != 'null' && $ingresosApagarPlan[$i]) ? $ingresosApagarPlan[$i] : 0?>">
          <?php
          }
          ?>
          
          <div id="inputsInsumos">

          </div>
        </form>

      </div>

    </div>

  </div>

</div>

<script>

const cargarInsumos = ()=>{
    
    let dieta = $('#dieta').find("option:selected").text();
    
    $('#inputsInsumos').html('')

    $('.dietaSeleccionada').each(function(){
        
        if(dieta != 'Seleccionar Dieta')
            $(this).html(dieta)
        else
            $(this).html('-')
    
    })

    let idDieta = $('#dieta').val()

    if(idDieta != ''){

        let months = {
            5:'Mayo', 6:'Junio', 7:'Julio', 8:'Agosto', 
            9:'Septiembre', 10:'Octubre', 11:'Noviembre', 12:'Diciembre',
            1:'Enero', 2:'Febrero', 3:'Marzo', 4:'Abril'
        };

        $.ajax({
            method:'POST',
            url:'ajax/estrategia.ajax.php',
            data:{accion:'verDieta',idDieta},
            beforeSend:function(){
                // $('body').append($('<div id="overlay"><div class="overlay-content"><i class="fa fa-spinner fa-spin"></i> Cargando...</div></div>'))
            },
            success:function(resp){
                let data =  JSON.parse(resp)

                $('.insumosDieta').remove()
                $('.stockInsumos').remove()

                let stockInsumosValue = []
                $('#tabsInsumos').html('')
                $('#tab-insumos').html('')

                $('.insumosContable').remove()

                data.forEach((element,index) => {

                    let insumo = element.insumo
                    let idInsumo = element.idInsumo

                    $('#trStock').append($(`
                        <th class="stockInsumos">${insumo}</th>
                    `))

                    $('#trStockInicial').append($(`
                        <td class="stockInsumos"><input class="form-control stockInsumosModal" idInsumo="${element.idInsumo}" type="number" onChange="setearStockInsumos()"  value="0"></td>
                    `))


                    stockInsumosValue.push(`{"${element.idInsumo}":0}`)


                    /*------ CARGO DINAMICAMENTE LOS INSUMOS EN EL MODAL CON SU TABLA MENSUAL ---------*/
                  
                        let isActive = (index == 0) ? 'active' : ''
                        let isClassActive = (index == 0) ? 'fade in active' : ''

                        let tabInsumo = $(`<li class="${isActive}"><a href="#insumo${index}" data-toggle="pill">${insumo}</a></li>`)

                        $('#tabsInsumos').append(tabInsumo)

                        let divTab = document.createElement('DIV')
                        divTab.setAttribute('id',`insumo${index}`)
                        divTab.setAttribute('class',`tab-pane ${isClassActive}`)

                        let h3Insumo = document.createElement('H3')
                        h3Insumo.innerText = insumo 
                        
                        divTab.append(h3Insumo)

                        let tableInsumo = document.createElement('TABLE')
                        tableInsumo.setAttribute('class','table table-bordered insumosTable')

                        let thead = document.createElement('THEAD')
                        let tr = document.createElement('TR')
                        let th = document.createElement('TH')
                        let thNecesario = th.cloneNode(true)
                        let thIngreso = th.cloneNode(true)
                        let thPrecio = th.cloneNode(true)
                        // let thAPagar = th.cloneNode(true)  
                        thNecesario.innerText = 'Necesario' 
                        thIngreso.innerText = 'Ingreso'
                        thPrecio.innerText = 'Precio'   
                        // thAPagar.innerText = 'A Pagar'   
                        // tr.append(th,thNecesario,thIngreso,thPrecio,thAPagar)
                        tr.append(th,thNecesario,thIngreso,thPrecio)
                        thead.append(tr)    
                        tableInsumo.append(thead)


                        let input = document.createElement('INPUT')
                        input.setAttribute('class','form-control input-sm')
                        input.setAttribute('type','number')
                        input.setAttribute('id-insumo',idInsumo)
                        input.setAttribute('min','0')
                        input.setAttribute('value','0')

                        let i = 5;

                        while (true) {

                            let inputHidden = document.createElement('INPUT');
                            inputHidden.setAttribute('type', 'hidden');
                            inputHiddenIngreso = inputHidden.cloneNode(true);
                            inputHiddenIngreso.setAttribute('name', `insumoIngreso${idInsumo}${i}`);
                            
                            inputHiddenPrecio = inputHidden.cloneNode(true);
                            // inputHiddenAPagar = inputHidden.cloneNode(true);
                            inputHiddenPrecio.setAttribute('name', `insumoPrecio${idInsumo}${i}`);
                            // inputHiddenAPagar.setAttribute('name', `insumoAPagar${idInsumo}${i}`);


                            // $('#inputsInsumos').append(inputHiddenIngreso,inputHiddenPrecio,inputHiddenAPagar)
                            $('#inputsInsumos').append(inputHiddenIngreso,inputHiddenPrecio)
                            
                            let trInsumo = document.createElement('TR');
                            let tdMonth = document.createElement('TD');
                            tdMonth.setAttribute('style','font-weight:bold;padding:10px')

                            tdMonth.innerText = months[i];
                            trInsumo.append(tdMonth);

                            for (let j = 0; j < 3; j++) {

                                // let columnHeader = ['Necesario', 'Ingreso', 'Precio', 'APagar'][j];
                                let columnHeader = ['Necesario', 'Ingreso', 'Precio'][j];
                                let td = document.createElement('TD'); 
                                td.setAttribute('style','width:150px')

                                if(columnHeader == 'Necesario'){

                                    td.setAttribute('class','form-control input-sm')
                                    td.setAttribute('id', `insumo${columnHeader}${idInsumo}${i}`);
                                    td.setAttribute('style','font-weight:bold;margin:5px;width:100px')


                                }else{

                                    let inputInsumo = input.cloneNode(true);

                                    inputInsumo.setAttribute('id', `insumo${columnHeader}${idInsumo}${i}`);
                                    // inputInsumo.setAttribute('name', `insumo${columnHeader}${idInsumo}[]`);
        
                                    if(columnHeader == 'Ingreso')
                                        inputInsumo.classList.add('compraInsumos')
                                    
                                    // if(columnHeader == 'APagar')
                                    //     inputInsumo.setAttribute('max','24') 
                                    
                                    td.append(inputInsumo);

                                }

                                trInsumo.append(td);

                            }

                            tableInsumo.append(trInsumo);

                            

                            if (i === 12) {
                                i = 1;  // Reinicia el índice a 1 después de llegar a 12
                            } else if (i === 4) {
                                break;  // Termina el bucle después de llegar a 4
                            } else {
                                i++;
                            }

                            divTab.append(tableInsumo)
                            
                            $('#tab-insumos').append(divTab)

                        }
                    
                    //------ CARGO DINAMICAMENTE LOS INSUMOS EN LA TABLA CONTABLE ---------//

                    let tbodyContable = document.getElementById('tbodyContable');

                    let j = 5;
                    while (true) {
                        let trContable = document.createElement('TR');
                        trContable.setAttribute('class','insumosContable')
                        let tdInsumo = document.createElement('TD');
                        tdInsumo.innerText = insumo;
                        // tdInsumo.innerText = insumo;
                        trContable.append(tdInsumo);

                        for (let k = 0; k < 12; k++) {
                            let td = document.createElement('TD');
                            td.innerText = '0';
                            td.setAttribute('class', `contableInsumo flujo`);
                            td.setAttribute('month-data', (k + 1));
                            td.setAttribute('id', `insumo${idInsumo}${j}Contable`);
                            trContable.append(td);

                            if (j === 12) {
                                j = 1;
                            } else if (j === 4) {
                                break;
                            } else {
                                j++;
                            }
                        }

                        let tdTotal = document.createElement('TD');
                        tdTotal.setAttribute('id',`totalInsumo${idInsumo}`)
                        tdTotal.innerText = 0
                        tdTotal.setAttribute('style','font-weight:bold')
                        trContable.append(tdTotal)
                        tbodyContable.prepend(trContable);

                        if (j === 4) {
                            break;
                        }
                    }
                    


                });

                $('input[name="stockInsumos"]').val(`[${stockInsumosValue}]`)
                
                // $('#overlay').remove()
            }
    
        })

    } else {
        $('.insumosDieta').remove()
    }
} 

let isSaved = '<?=$data['estrategia']?>'
let isSeted = '<?=$data['estrategia']['seteado']?>'

if(isSaved != '' && isSeted == '0'){

  $('#dieta').val('<?=$data['estrategia']['idDieta']?>')
  cargarInsumos()

  let months = {
      0:'Mayo', 1:'Junio', 2:'Julio', 3:'Agosto', 
      4:'Septiembre', 5:'Octubre', 6:'Noviembre', 7:'Diciembre',
      8:'Enero', 9:'Febrero', 10:'Marzo', 11:'Abril'
  };

  let correccionMeses = {
    5:1,6:2,7:3,8:4,9:5,10:6,11:7,12:8,1:9,2:10,3:11,4:12
    };



  let stockInsumos = '<?=json_encode($data['estrategia']['stockInsumos'])?>'
  let stockInsumosHidden = '<?=json_encode($data['estrategia']['stockInsumos'])?>'
  stockInsumos = JSON.parse(stockInsumos.slice(1,-1))
  // CARGA STOCK INSUMOS 
 

  let index = 0

  let compraInsumos = '<?=json_encode($data['estrategia']['compraInsumos'])?>'
  compraInsumos = JSON.parse(compraInsumos)

  let insumosName =  Object.keys(compraInsumos)

  let insumosNameId = {}

  let compraInsumosKey = '<?=json_encode($data['estrategia']['compraInsumosKey'])?>'
  compraInsumosKey = JSON.parse(compraInsumosKey)

  for (const key in compraInsumosKey) {

    insumosNameId[insumosName[index]] = key
    
    index++

  }

  let cerealesPlan = '<?=json_encode($data['estrategia']['cerealesPlan'])?>'
  cerealesPlan = JSON.parse(cerealesPlan.slice(1,-1))

  let precioInsumoPlan = '<?=json_encode($data['estrategia']['precioPlan'])?>'
  precioInsumoPlan = JSON.parse(precioInsumoPlan.slice(1,-1))

  index = 0
  let month = 1


  setTimeout(() => {
    
    for (const key in insumosNameId) {
    
          let obj = stockInsumos.find(item => item.hasOwnProperty(insumosNameId[key]));
          let value = obj ? obj[insumosNameId[key]] : undefined;

          $('input[idInsumo="'+insumosNameId[key]+'"]').val(value)
          $('input[name="stockInsumos"]').val(stockInsumosHidden.slice(1,-1))

          

      let correccionCerealesPlan = {}
      let correccionPrecioInsumoPlan = {}
  
      for (const key in cerealesPlan) {
        correccionCerealesPlan[key] = {}
        correccionPrecioInsumoPlan[key] = {}
  
        Object.values(cerealesPlan[key]).forEach((el,index)=>{
  
          let month = correccionMeses[index + 1]
  
          correccionCerealesPlan[key][month] = el
          correccionPrecioInsumoPlan[key][month] = precioInsumoPlan[key][index + 1]
  
        })
        
      }
  

      Object.values(correccionCerealesPlan[insumosNameId[key]]).forEach((element,index) => {
  
        let monthIndex = index + 1;
        let indexSinCorreccion = Object.keys(correccionMeses).find(key => correccionMeses[key] === monthIndex)
        $(`#insumoIngreso${insumosNameId[key]}${indexSinCorreccion}`).val(element)
        $(`#insumoPrecio${insumosNameId[key]}${indexSinCorreccion}`).val(correccionPrecioInsumoPlan[insumosNameId[key]][monthIndex])

        $(`input[name="insumoIngreso${insumosNameId[key]}${indexSinCorreccion}`).val(element)
        $(`input[name="insumoPrecio${insumosNameId[key]}${indexSinCorreccion}"]`).val(correccionPrecioInsumoPlan[insumosNameId[key]][monthIndex])


      });
  
      index++
        
  }
    
    calculateStockAndTotals()
  }, 2000);

} 

let calcularPesoPromedio = (dataEstrategia = false,tipo = 'plan',debug = false)=>{

  let ingresoAccum = 0
  let ventaAccum = 0

  let kgIngresoAccum = 0
  let kgVentaAccum = 0

  let totalkgVentaAccum = 0
  let totalkgIngresoAccum = 0

  let kgTotalAnterior = 0

  if(tipo == 'plan'){

    $('body').append($('<div id="overlay"><div class="overlay-content"><i class="fa fa-spinner fa-spin"></i> Cargando...</div></div>'))

    setTimeout(() => {

      for (let index = 1; index <= 12; index++) {


        /* Si esta seteada la estrategia */
        let adp = Number($(`#adpPlan${index}`).html())
        let ingreso = parseFloat($(`#ingreso${index}`).html())
        let kgIng = parseFloat($(`#kgIngreso${index}`).html())
        let venta = parseFloat($(`#venta${index}`).html())
        let kgVenta = parseFloat($(`#kgVenta${index}`).html())


        /* Si no esta seteada la estrategia tomo del input */

        ingreso = (isNaN(ingreso)) ? parseFloat($(`#ingreso${index}`).val()) : ingreso

        ingresoAccum += Number(ingreso)
  
        kgIng = (isNaN(kgIng)) ? parseFloat($(`#kgIngreso${index}`).val()) : kgIng

        kgIngresoAccum += Number(kgIng)
  
        let kgIngTotal = Number(ingreso) * Number(kgIng)

        totalkgIngresoAccum += Number(kgIngTotal)
  
        venta = (isNaN(venta)) ? parseFloat($(`#venta${index}`).val()) : venta

        ventaAccum += Number(venta)
  
        kgVenta = (isNaN(kgVenta)) ? parseFloat($(`#kgVenta${index}`).val()) : kgVenta

        kgVentaAccum += Number(kgVenta)
  
        let kgVentaTotal = Number(venta) * Number(kgVenta)

        totalkgVentaAccum += Number(kgVentaTotal)

        adp = (isNaN(adp)) ? Number($(`#adpv${index}`).val()) : adp

        let KgProm = Number($('#stockKgProm').val())

        let calc = 0

        let stockActual = Number($(`#stockPlan${index}`).html())

        let stockAnterior = Number($(`#stockPlan${index - 1}`).html())

        if(index == 1){

          stockAnterior = Number($('#stockAnimales').val())
          kgTotalAnterior = stockAnterior * KgProm

        }
        
        calc = kgTotalAnterior + kgIngTotal - kgVentaTotal + (adp * stockAnterior * 30)

        kgTotalAnterior = calc

        let pesoProm = (stockActual > 0) ? calc / stockActual : 0
  
        if(adp != 0){

          $(`#kgPromPlan${index}`).html(Math.round(pesoProm))

        } else {

          if(index == 1){

            $(`#kgPromPlan${index}`).html(Math.round(pesoProm))


          } else {

            $(`#kgPromPlan${index}`).html($(`#kgPromPlan${index - 1}`).html())

          }
        
        }

        
        /* Si esta seteada la estrategia */
        let porcentajeMS = Number($(`#msPlan${index}`).html())
  
        /* Si no esta seteada la estrategia tomo del input */
        porcentajeMS = (isNaN(porcentajeMS)) ? Number($(`#porcentMS${index}`).val()) : porcentajeMS
  
        let consumoMS = (pesoProm * porcentajeMS) / 100

        $(`#consumoMSPlan${index}`).html(consumoMS.toFixed(2))
 
      }

      let idDieta = (typeof dataEstrategia === "number") ? dataEstrategia : (dataEstrategia === false) ? Number($('#dieta').val()) : dataEstrategia.idDieta 


      $.ajax({
        method:'POST',
        url:'ajax/estrategia.ajax.php',
        data:{accion:'verDieta',idDieta: idDieta},
        success:function(resp){

          let respuesta = JSON.parse(resp)
          
          let objMonths = {1:5,2:6,3:7,4:8,5:9,6:10,7:11,8:12,9:1,10:2,11:3,12:4}

          for (const key in respuesta) {

            for (let index = 1; index <= 12; index++) {

              let stockMesPlan = Number($(`#stockPlan${index}`).html())

              let consMS = Number($(`#porcentMS${index}`).val())
              if(isNaN(consMS))
                consMS = Number($(`#msPlan${index}`).html())

              let consumoInsumo = (respuesta[key].porcentaje * consMS) / 100 

              let totalConsumoMensual = consumoInsumo * stockMesPlan * 30 //dias del mes

              if($(`#insumoNecesario${respuesta[key].idInsumo}${objMonths[index]}`).length == 0){

                $(`#insumoNecesarioPlan${respuesta[key].idInsumo}_${objMonths[index]}`).html(totalConsumoMensual.toLocaleString('de-DE'))

              } else {

                $(`#insumoNecesario${respuesta[key].idInsumo}${objMonths[index]}`).html(totalConsumoMensual.toLocaleString('de-DE'))

              }

            }

          }

        }

      })

      $('#overlay').remove()
      
    }, 1000);

  } else {
    
    setTimeout(() => {

      let ingresosReal = JSON.parse(dataEstrategia.ingresosReal)
      let kgIngresosReal = JSON.parse(dataEstrategia.kgIngresosReal)
      let ventasReal = JSON.parse(dataEstrategia.ventasReal)
      let kgVentasReal = JSON.parse(dataEstrategia.kgVentasReal)
      let adpReal = JSON.parse(dataEstrategia.adpReal)
      let msReal = JSON.parse(dataEstrategia.msReal)

      for (const key in ingresosReal) {

        ingresoAccum += Number(ingresosReal[key])
        kgIngresoAccum += Number(kgIngresosReal[key])
        let kgIngTotal = Number(ingresosReal[key]) * Number(kgIngresosReal[key])
        totalkgIngresoAccum += Number(kgIngTotal)
    
        ventaAccum += Number(ventasReal[key])
        kgVentaAccum += Number(kgVentasReal[key])
        let kgVentaTotal = Number(ventasReal[key]) * Number(kgVentasReal[key])
        totalkgVentaAccum += Number(kgVentaTotal)
    
        let adp = adpReal[key]
        
        let KgProm = 250
    
        let calc = 0
    
        let stockActual = Number($(`#stockPlan${key}`).html())

        let stockAnterior = Number($(`#stockPlan${key - 1}`).html())
    
        if(key == 1){

          stockAnterior = Number($('#stockAnimales').val())
          kgTotalAnterior = stockAnterior * KgProm

        }

        calc = kgTotalAnterior + kgIngTotal - kgVentaTotal + (adp * stockAnterior * 30)
        
        kgTotalAnterior = calc

        let pesoProm = (stockActual > 0) ? calc / stockActual : 0

        if(adp != 0){

          $(`#kgPromReal${key}`).html(` | ${Math.round(pesoProm)}`)

          if(Number($(`#kgPromPlan${key}`).html()) > Math.round(pesoProm)) $(`#kgPromReal${key}`).css('color','red')

        } else {

          if(key == 1){

            $(`#kgPromReal${key}`).html(` | ${Math.round(pesoProm)}`)

            if(Number($(`#kgPromPlan${key}`).html()) > Math.round(pesoProm)) $(`#kgPromReal${key}`).css('color','red')



          } else {

            $(`#kgPromReal${key}`).html(` | ${$(`#kgPromReal${key - 1}`).html()}`)

          }

        }


        /* Si esta seteada la estrategia */
        let porcentajeMS = Number(msReal[key])
  
        let consumoMS = (pesoProm * porcentajeMS) / 100

        $(`#consumoMSReal${key}`).html(` | ${consumoMS.toFixed(2)}`)  

        if(Number($(`#consumoMSPlan${key}`).html()) > consumoMS) $(`#consumoMSReal${key}`).css('color','red')

         // deshabilito el boton de cargar el mes*
        $(`button[data-month="${key}"]`).attr('disabled','disabled')
    
      }

    }, 1500);
   
   
  }

}

let calculateStockAndTotals = () => {

  return new Promise((resolve,reject)=>{


    let stock = parseFloat($('#stockAnimales').val())
    let stockKgProm = parseFloat($('#stockKgProm').val())
  
    let ingresoTotal = 0
    let kgIngresoTotal = 0
    let ventaTotal = 0
    let kgVentaTotal = 0
  
    let seteado = '<?=$data['estrategia']['seteado']?>'
    let idDieta = Number('<?=$data['estrategia']['idDieta']?>')

    let dataDietaReal = '<?=$data['estrategia']['dietaReal']?>'
    let porcentajesDietaReal = (dataDietaReal != '') ? JSON.parse(dataDietaReal) : null

    if(seteado == 0){

      idDieta = Number($('#dieta').val())

      for (let index = 1; index <= 12; index++) {
    
        let ingreso = parseFloat($(`#ingreso${index}`).val())
    
        let venta = parseFloat($(`#venta${index}`).val())
  
        let kgIngreso = parseFloat($(`#kgIngreso${index}`).val())
    
        let kgVenta = parseFloat($(`#kgVenta${index}`).val())
  
        stock += ingreso
    
        stock -= venta
    
        $(`#stock${index}`).val(stock)
        
        $(`#stockPlan${index}`).html(stock)
    
        ingresoTotal += ingreso
    
        ventaTotal += venta
    
        kgIngresoTotal += kgIngreso * ingreso
        kgVentaTotal += kgVenta * venta
        
        $(`#ingresoPlan${index}`).html(ingreso)
        $(`#ventaPlan${index}`).html(venta)
  
        $(`#kgIngresoPlan${index}`).html(kgIngreso)
        $(`#kgVentaPlan${index}`).html(kgVenta)
    
        $(`input[name='ingreso${index}']`).val(ingreso)
        $(`input[name='kgIngreso${index}']`).val($(`#kgIngreso${index}`).val())
        $(`input[name='venta${index}']`).val(venta)
        $(`input[name='kgVenta${index}']`).val($(`#kgVenta${index}`).val())
        $(`input[name='precioKgIngreso${index}']`).val($(`#precioKgIngreso${index}`).val())
        $(`input[name='precioKgVenta${index}']`).val($(`#precioKgVenta${index}`).val())
        $(`input[name='aPagarIngreso${index}']`).val($(`#aPagarIngreso${index}`).val())
        $(`input[name='aPagarVenta${index}']`).val($(`#aPagarVenta${index}`).val())
    
        $('#totalStock').val(stock)
        $('#totalIngreso').val(ingresoTotal)
        $('#totalKgIngreso').val(kgIngresoTotal)
        $('#totalVenta').val(ventaTotal)
        $('#totalKgVenta').val(kgVentaTotal)
        
        $('#avgIngreso').val((ingresoTotal / 12).toFixed(2))
        $('#avgVenta').val((ventaTotal / 12).toFixed(2))
  
        $('#avgKgIngreso').val((ingresoTotal > 0) ? (kgIngresoTotal / ingresoTotal).toFixed(2) : 0)
        $('#avgKgVenta').val((ventaTotal > 0) ? (kgVentaTotal / ventaTotal).toFixed(2) : 0)
        
      } 


    } else {
  
  
        let ingresoTotalReal = 0
        let kgIngresoTotalReal = 0
        let ventaTotalReal = 0
        let kgVentaTotalReal = 0
        let stockReal = 0

      for (let index = 1; index <= 12; index++) {
        
        let ingreso = parseFloat($(`#ingreso${index}`).html())
        let ingresoReal = parseFloat($(`#ingresoReal${index}`).html().replace('| ',''))

        if(!isNaN(ingresoReal)){

          if(index == 1)
            stockReal = parseFloat($('#stockAnimales').val())
          
        }

        let stockValido = ingresoReal
  
        if(isNaN(ingresoReal) || ingresoReal == '') ingresoReal = 0
  
        let venta = parseFloat($(`#venta${index}`).html())
        let ventaReal = parseFloat($(`#ventaReal${index}`).html().replace('| ',''))
        if(isNaN(ventaReal) || ventaReal == '') ventaReal = 0
  
  
        stock += ingreso
        stockReal += ingresoReal
  
        stock -= venta
        stockReal -= ventaReal
  
        $(`#stockPlanIngEgr${index}`).html(stock)
  
        $(`#stockPlan${index}`).html(stock)
            
        if(!isNaN(stockReal) && !isNaN(stockValido)){
  
          $(`#stockRealIngEgr${index}`).html(` | ${stockReal}`)
  
          if(stockReal < Number($(`#stockPlanIngEgr${index}`).html())) $(`#stockRealIngEgr${index}`).css('color','red')
          
          let diff = stockReal - Number($(`#stockPlanIngEgr${index}`).html()) 

          let posNeg = (diff > 0) ? 'blue' : (diff == 0) ? 'green' : 'red'

          $(`#stockDif${index}`).html(`<span style="color:${posNeg}">${diff}</span>`)

          $(`#stockReal${index}`).html(` | ${stockReal}`)

          if(stockReal < Number($(`#stockPlanIngEgr${index}`).html())) $(`#stockReal${index}`).css('color','red')
  
  
        }
  
        ingresoTotal += ingreso
        ingresoTotalReal += ingresoReal
        ventaTotal += venta
        ventaTotalReal += ventaReal
  
        kgIngresoTotal += parseFloat($(`#kgIngreso${index}`).html()) * ingreso
  
        let kgIngresoReal = $(`#kgIngresoReal${index}`).html().replace('| ','')
        if(isNaN(kgIngresoReal) || kgIngresoReal == '') kgIngresoReal = 0
  
        kgIngresoTotalReal += parseFloat(kgIngresoReal) * ingresoReal
        
        
        kgVentaTotal += parseFloat($(`#kgVenta${index}`).html()) * venta
  
        let kgVentaReal = $(`#kgVentaReal${index}`).html().replace('| ','')
        if(isNaN(kgVentaReal) || kgVentaReal == '') kgVentaReal = 0
  
        kgVentaTotalReal += parseFloat(kgVentaReal) * ventaReal
        
        $(`#ingresoPlan${index}`).html(ingreso)
        $(`#ventaPlan${index}`).html(venta)
  
        $('#totalStock').html(stock)
        $('#totalIngreso').html(ingresoTotal)
        $('#totalKgIngreso').html(kgIngresoTotal.toLocaleString('de-DE'))
        $('#totalVenta').html(ventaTotal)
        $('#totalKgVenta').html(kgVentaTotal.toLocaleString('de-DE'))
        
        $('#avgIngreso').html((ingresoTotal / 12).toFixed(2))
        $('#avgVenta').html((ventaTotal / 12).toFixed(2))
  
        $('#avgKgIngreso').html((kgIngresoTotal / ingresoTotal).toFixed(2))

        $('#avgKgVenta').html((kgVentaTotal / ventaTotal).toFixed(2))

        if(!isNaN(stockReal)){
  
          setTimeout(() => {
            $('#totalStock').html(`${stock}<br><span style="color:blue">${stockReal}</span>`)
            $('#totalIngreso').html(`${ingresoTotal}<br><span style="color:blue">${ingresoTotalReal}</span>`)
            $('#totalKgIngreso').html(`${kgIngresoTotal.toLocaleString('de-DE')}<br><span style="color:blue">${kgIngresoTotalReal.toLocaleString('de-DE')}</span>`)
            $('#totalVenta').html(`${ventaTotal}<br><span style="color:blue">${ventaTotalReal}</span>`)
            $('#totalKgVenta').html(`${kgVentaTotal.toLocaleString('de-DE')}<br><span style="color:blue">${kgVentaTotalReal.toLocaleString('de-DE')}</span>`)
            
            $('#avgIngreso').html(`${(ingresoTotal / 12).toFixed(2)} <br><span style="color:blue">${(ingresoTotalReal / 12).toFixed(2)}`)
            $('#avgVenta').html(`${(ventaTotal / 12).toFixed(2)} <br><span style="color:blue">${(ventaTotalReal / 12).toFixed(2)}`)
            $('#avgKgIngreso').html(`${(kgIngresoTotal / ingresoTotal).toFixed(2)} <br><span style="color:blue">${(ingresoTotalReal > 0) ? (kgIngresoTotalReal / ingresoTotalReal).toFixed(2) : 0}`)
            $('#avgKgVenta').html(`${(kgVentaTotal / ventaTotal).toFixed(2)} <br><span style="color:blue">${(ventaTotalReal > 0) ? (kgVentaTotalReal / ventaTotalReal).toFixed(2) : 0}`)

          }, 500);
        }

        
        let stockMesPlan = Number($(`#stockReal${index}`).html().replace('|',''))

        let consMS = Number($(`#porcentMS${index}`).val())

        if(isNaN(consMS))
          consMS = Number($(`#msReal${index}`).html())

        let consumoInsumo = ((porcentajesDietaReal == null || porcentajesDietaReal == undefined) || porcentajesDietaReal[index] == null) ? 0 : (porcentajesDietaReal[index].porcentaje * consMS) / 100 

        let totalConsumoMensual = consumoInsumo * stockMesPlan * 30 //dias del mes
  
  
  
      } 
        
    }

    calcularPesoPromedio(idDieta)
    
    resolve()
  })

}

let cambiarColorApagar = (el) => {

  let value = el.val()

  let id = el.attr('id')

  $('input[name="'+id+'"]').val(value)
  
  if(value == 'B'){

    el.css('color','blue')

  } else if(value == 'C') {

    el.css('color','rgb(227,216,0)')

  } else if(value == 'D'){
    
    el.css('color','red')
    
  } else {

    el.css('color','green')

  }



}

let seteado = '<?=$data['estrategia']['seteado']?>'

let data = '<?=json_encode($data)?>'

if(seteado != 0){

  let campania = '<?=$data['estrategia']['campania']?>'

  $.ajax({
    
    method:'post',
    url:'ajax/estrategia.ajax.php',
    data:{accion:'mostrarEstrategia',campania},
    success:function(resp){

      let data = JSON.parse(resp)

      let months = {
            0:'Mayo', 1:'Junio', 2:'Julio', 3:'Agosto', 
            4:'Septiembre', 5:'Octubre', 6:'Noviembre', 7:'Diciembre',
            8:'Enero', 9:'Febrero', 10:'Marzo', 11:'Abril'
        };
      
      let correccionMeses = {
        5:1,6:2,7:3,8:4,9:5,10:6,11:7,12:8,1:9,2:10,3:11,4:12
        };

      dataEstrategia = data.estrategia
      // CARGO STOCK ANIMALES
      
      $('#stockAnimales').val(data.estrategia.stockAnimales)

      let stockInsumos = JSON.parse(dataEstrategia.stockInsumos)

      // CARGA STOCK INSUMOS 

      let index = 0

      let insumosName =  Object.keys(dataEstrategia.compraInsumos)

      let insumosNameId = {}

      for (const key in dataEstrategia.compraInsumosKey) {

        insumosNameId[insumosName[index]] = key
        
        index++

      }

      let cerealesPlan = JSON.parse(dataEstrategia.cerealesPlan)
      let cerealesReal = (dataEstrategia.cerealesReal != null) ? JSON.parse(dataEstrategia.cerealesReal) : null

      let precioInsumoPlan = JSON.parse(dataEstrategia.precioPlan)
      let precioInsumoReal = (dataEstrategia.precioReal != null) ? JSON.parse(dataEstrategia.precioReal) : null

      // CREO Y FORMATEO LOS DATOS DE CEREALES REAL
      let insumosReal = {}

      for (const month in cerealesReal) {

        for (const insumo in cerealesReal[month]) {

          if (!(insumo in insumosReal)) {

            insumosReal[insumo] = [];

          }

          insumosReal[insumo].push(cerealesReal[month][insumo]);

        }
              
      }

      index = 0
      let month = 1

      for (const key in insumosNameId) {

        let trContable = document.createElement('TR');
        let tdKey = document.createElement('TD');
        tdKey.innerText = key
        tdKey.setAttribute('style', 'font-weight:600;padding:10px');
        trContable.append(tdKey)
        
        let obj = stockInsumos.find(item => item.hasOwnProperty(insumosNameId[key]));
        let value = obj ? obj[insumosNameId[key]] : undefined;

        $('#trStock').append($(`<th>${key}</th>`))

        $('#trStockInicial').append($(`<td><input class="form-control stockInicial" type="number" min="0" value="${value}" readOnly></td>`))

        $('#insumosReal').append($(`
                  <div class="row" style="padding-left:15px;">
                  <b>${key}</b>
                  </div>
                  
                  <div class="row">
                    
                    <div class="col-sm-4">

                      <div class="form-group">

                        <label>Ingreso</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="insumoReal${insumosNameId[key]}" value="0">

                      </div>

                    </div>

                    <div class="col-sm-4">

                      <div class="form-group">

                        <label>Precio</label>

                        <input type="number" min="0" step="0.1" class="form-control real" name="precioInsumoReal${insumosNameId[key]}" value="0">

                      </div>

                    </div>
                    
                  </div>`))

        $('#dietaReal').append($(`<div class="col-sm-4">

                                      <div class="form-group">
                                        <label>% ${key}</label>
                                        <input type="number" min="0" class="form-control real dietaReal" onchange="validarPorcentajesDieta()" name="dietaReal${insumosNameId[key]}" value="0">
                                      </div>

                                    </div>`))


        let isActive = (index == 0) ? 'active' : '';
        let isClassActive = (index == 0) ? 'fade in active' : '';

        let tabInsumo = $(`<li class="${isActive}"><a href="#insumo${index}" data-toggle="pill">${key}</a></li>`);
        $('#tabsInsumos').append(tabInsumo);

        let divTab = document.createElement('DIV');
        divTab.setAttribute('id', `insumo${index}`);
        divTab.setAttribute('class', `tab-pane ${isClassActive}`);

        let h3Insumo = document.createElement('H3');
        h3Insumo.innerText = key;
        divTab.append(h3Insumo);

        let tableInsumo = document.createElement('TABLE');
        tableInsumo.setAttribute('class', 'table table-bordered insumosTable');

        let thead = document.createElement('THEAD');
        let tr = document.createElement('TR');
        let th = document.createElement('TH');
        let thNecesario = th.cloneNode(true);
        let thIngreso = th.cloneNode(true);
        let thPrecio = th.cloneNode(true);
        let thAPagar = th.cloneNode(true);
        thNecesario.innerText = 'Necesario';
        thIngreso.innerText = 'Ingreso';
        thPrecio.innerText = 'Precio';
        // thAPagar.innerText = 'A Pagar';
        tr.append(th, thNecesario, thIngreso, thPrecio);
        thead.append(tr);
        tableInsumo.append(thead);
        

        let correccionCerealesPlan = {}
        let correccionPrecioInsumoPlan = {}

        for (const key in cerealesPlan) {

          correccionCerealesPlan[key] = {}
          correccionPrecioInsumoPlan[key] = {}

          Object.values(cerealesPlan[key]).forEach((el,index)=>{

            let month = correccionMeses[index + 1]

            correccionCerealesPlan[key][month] = el
            correccionPrecioInsumoPlan[key][month] = precioInsumoPlan[key][index + 1]

          })
          
        }

        Object.values(correccionCerealesPlan[insumosNameId[key]]).forEach((element,index) => {

          let monthIndex = index + 1;

          let trInsumo = document.createElement('TR');
          let tdMonth = document.createElement('TD');
          tdMonth.setAttribute('style', 'font-weight:bold;padding:10px');
          tdMonth.innerText = months[index];
          trInsumo.append(tdMonth);
            
          for (let j = 0; j < 3; j++) {
              let columnHeader = ['Necesario', 'Ingreso', 'Precio'][j];
              let td = document.createElement('TD');

              let spanPlanificado = document.createElement('SPAN');
              spanPlanificado.setAttribute('class', 'planificado');


              let spanReal = document.createElement('SPAN');
              spanReal.setAttribute('class', 'real');

              if(columnHeader == 'Necesario'){
                spanPlanificado.setAttribute('id', `insumoNecesarioPlan${insumosNameId[key]}_${monthIndex}`);
                spanReal.setAttribute('id', `insumoNecesarioReal${insumosNameId[key]}_${monthIndex}`);
              }

              if(columnHeader == 'Ingreso'){

                spanPlanificado.setAttribute('id', `insumoPlan${insumosNameId[key]}_${monthIndex}`);
                spanReal.setAttribute('id', `insumoReal${insumosNameId[key]}_${monthIndex}`);
                spanPlanificado.classList.add('compraInsumos');
                spanPlanificado.innerText = Number(element).toLocaleString('de-DE');
                spanReal.innerText = (cerealesReal != null) ? (cerealesReal[monthIndex] != undefined) ? ' | ' + Number(cerealesReal[monthIndex][insumosNameId[key]]).toLocaleString('de-DE') : '' : '';


              }
                
              if(columnHeader == 'Precio'){
                spanPlanificado.setAttribute('id', `insumoPrecioPlan${insumosNameId[key]}_${monthIndex}`);
                spanReal.setAttribute('id', `insumoPrecioReal${insumosNameId[key]}_${monthIndex}`);
                spanPlanificado.innerText = correccionPrecioInsumoPlan[insumosNameId[key]][monthIndex].toLocaleString('de-DE');
                spanReal.innerText = (precioInsumoReal != null) ? (precioInsumoReal[monthIndex] != undefined) ? ' | ' + Number(precioInsumoReal[monthIndex][insumosNameId[key]]).toLocaleString('de-DE') : '' : '';
              }
                
              // if(columnHeader == 'APagar'){
              //   spanPlanificado.setAttribute('id', `insumoAPagarPlan${insumosNameId[key]}_${index + 1}`);
              //   spanReal.setAttribute('id', `insumoAPagarReal${insumosNameId[key]}_${index + 1}`);
              //   // spanPlanificado.innerText = aPagarInsumoPlan[index + 1][insumosNameId[key]];
              //   spanPlanificado.innerText = 0;
              //   spanReal.innerText = (aPagarInsumoReal != null) ? (aPagarInsumoReal[index + 1] != undefined) ? ' | ' + aPagarInsumoReal[index + 1][insumosNameId[key]] : '' : '';

              // }
                
                

              td.append(spanPlanificado, spanReal);
              trInsumo.append(td);
          }

          tableInsumo.append(trInsumo);

          divTab.append(tableInsumo);
          $('#tab-insumos').append(divTab);

          // CARGO LOS SPAN DE PLAN Y REAL EN EL CONTABLE

          let tdSPan = document.createElement('TD');
          let spanPlanificado = document.createElement('SPAN');
          let spanReal = spanPlanificado.cloneNode(true)
  
          spanPlanificado.setAttribute('class', 'planificado flujo');
          spanPlanificado.setAttribute('id', `insumo${insumosNameId[key]}PlanContable_${monthIndex}`);
          
          spanReal.setAttribute('class', 'real flujoReal');
          spanReal.setAttribute('id', `insumo${insumosNameId[key]}RealContable_${monthIndex}`);
  
          // spanPlanificado.innerText = element;
          // spanReal.innerText = (insumosReal[insumosNameId[key]][index] != undefined) ? ` | ${insumosReal[insumosNameId[key]][index]}` : ' | '
          tdSPan.append(spanPlanificado,spanReal);
          trContable.append(tdSPan);

          
          
          
        });

        let tdTotales = document.createElement('TD');
        tdTotales.setAttribute('id',`totalInsumo${insumosNameId[key]}`)
        tdTotales.setAttribute('style',`font-weight:bold`)
        trContable.append(tdTotales); 

        $('#tbodyContable').prepend(trContable);

        index++
          
      } 
     
      setTimeout(() => {

        let isReal = $('#stockReal1').html()

        if(isReal != ''){
          calcularPesoPromedio(dataEstrategia,'real')
        }
        
      }, 700);

    }

    
    
  })

  setTimeout(() => {

    calculateStockAndTotals()
    calcularInsumosContableSeteado()
    calcularAnimalesContableSeteado()
    calcularEstructuraContableSeteado()
    calcularFlujoDeFondoMensualSeteado()
    calcularFlujoNetoSeteado()
  }, 500);
  
  setTimeout(() => {
    calcularConsumos()
  }, 5000);
  
}
  
let isReal = '<?=$data['estrategia']['seteado']?>'
</script>

<?php

  $setear = new ControladorEstrategia();
  $setear->ctrSetearEstrategia();

?>
