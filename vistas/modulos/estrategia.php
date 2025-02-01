
<div class="row"> 

  <div class="col-md-12">

    <div class="card">

      <div class="card-body">

        <form id="formularioEstrategia" method="post">

          <div class="row">

            <?php 
            if(!$data['estrategia']['seteado']){ 

              ?>

              <div class="col-md-1"> 
      
                <div class="form-group">

                  <label>Dieta:</label>

                  <select class="form-control dietas" style="margin-top:5px;margin-bottom:5px;" name="dieta" id="dieta" required>
                  
                    <option value="">Seleccionar Dieta</option>

                    <?=$dietasOptions?>

                  </select>

                </div>
      
              </div>
              
            <?php } ?>
                  
            <div class="col-md-2"> 

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

              <div class="col-md-2"> 

                <div class="form-group">

                  <label>&nbsp;</label>

                  <button class="btn btn-primary btn-block" type="button" id="btnIngEgr" data-toggle="modal" data-target="#modalEstrategiaIngresoInsumos">Insumos</button>

                </div>
                
              </div>

            <?php if(!$data['estrategia']['seteado']){ ?>

              <div class="col-md-2"> 

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

                <button type="button" class="btn btn-primary btn-block" id="nuevaCampania" data-toggle="modal" data-target="#modalNuevaCampaniaEstrategia">Nueva Campa&ntilde;a</button>

              </div>

            </div>

          </div>

          <table class="table table-bordered tablaEstrategia">

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

                      <td id="ingresoPlan<?=$key?>" >0</td>
    
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

                      <td id="kgIngresoPlan<?=$key?>" >0</td>
    
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

                      <td id="ventaPlan<?=$key?>" >0</td>

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

                      <td id="kgVentaPlan<?=$key?>" >0</td>

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
                <td><span class="planificado" id="stockPlan1"></span><span class="real" id="stockReal1"></span></td>
                <td><span class="planificado" id="stockPlan2"></span><span class="real" id="stockReal2"></span></td>
                <td><span class="planificado" id="stockPlan3"></span><span class="real" id="stockReal3"></span></td>
                <td><span class="planificado" id="stockPlan4"></span><span class="real" id="stockReal4"></span></td>
                <td><span class="planificado" id="stockPlan5"></span><span class="real" id="stockReal5"></span></td>
                <td><span class="planificado" id="stockPlan6"></span><span class="real" id="stockReal6"></span></td>
                <td><span class="planificado" id="stockPlan7"></span><span class="real" id="stockReal7"></span></td>
                <td><span class="planificado" id="stockPlan8"></span><span class="real" id="stockReal8"></span></td>
                <td><span class="planificado" id="stockPlan9"></span><span class="real" id="stockReal9"></span></td>
                <td><span class="planificado" id="stockPlan10"></span><span class="real" id="stockReal10"></span></td>
                <td><span class="planificado" id="stockPlan11"></span><span class="real" id="stockReal11"></span></td>
                <td><span class="planificado" id="stockPlan12"></span><span class="real" id="stockReal12"></span></td>



              </tr>
              
              <tr>

                <td>Kg Prom.</td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan1"></span><span class="real kgPromReal" id="kgPromReal1"></span></td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan2"></span><span class="real kgPromReal" id="kgPromReal2"></span></td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan3"></span><span class="real kgPromReal" id="kgPromReal3"></span></td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan4"></span><span class="real kgPromReal" id="kgPromReal4"></span></td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan5"></span><span class="real kgPromReal" id="kgPromReal5"></span></td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan6"></span><span class="real kgPromReal" id="kgPromReal6"></span></td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan7"></span><span class="real kgPromReal" id="kgPromReal7"></span></td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan8"></span><span class="real kgPromReal" id="kgPromReal8"></span></td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan9"></span><span class="real kgPromReal" id="kgPromReal9"></span></td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan10"></span><span class="real kgPromReal" id="kgPromReal10"></span></td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan11"></span><span class="real kgPromReal" id="kgPromReal11"></span></td>
                <td><span class="planificado kgPromPlan" id="kgPromPlan12"></span><span class="real kgPromReal" id="kgPromReal12"></span></td>

              </tr>

              <tr>

                <td>ADP</td>

                <?php if(!$data['estrategia']['seteado']){

                  foreach ($meses as $key => $mes) { ?>

                    <td><input class="form-control input-sm" onchange="calcularPesoPromedio()" type="text" name="adpv[]" id="adpv<?=$key?>" value="0"></td>

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

                  foreach ($meses as $key => $mes) { ?>

                  <td><input class="form-control input-sm" onchange="calcularPesoPromedio()" type="text" name="porcentMS[]" id="porcentMS<?=$key?>" value="0"></td>

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
                <td><span class="planificado" id="consumoMSPlan1"></span><span class="real" id="consumoMSReal1"></span></td>
                <td><span class="planificado" id="consumoMSPlan2"></span><span class="real" id="consumoMSReal2"></span></td>
                <td><span class="planificado" id="consumoMSPlan3"></span><span class="real" id="consumoMSReal3"></span></td>
                <td><span class="planificado" id="consumoMSPlan4"></span><span class="real" id="consumoMSReal4"></span></td>
                <td><span class="planificado" id="consumoMSPlan5"></span><span class="real" id="consumoMSReal5"></span></td>
                <td><span class="planificado" id="consumoMSPlan6"></span><span class="real" id="consumoMSReal6"></span></td>
                <td><span class="planificado" id="consumoMSPlan7"></span><span class="real" id="consumoMSReal7"></span></td>
                <td><span class="planificado" id="consumoMSPlan8"></span><span class="real" id="consumoMSReal8"></span></td>
                <td><span class="planificado" id="consumoMSPlan9"></span><span class="real" id="consumoMSReal9"></span></td>
                <td><span class="planificado" id="consumoMSPlan10"></span><span class="real" id="consumoMSPReal0"></span></td>
                <td><span class="planificado" id="consumoMSPlan11"></span><span class="real" id="consumoMSPReal1"></span></td>
                <td><span class="planificado" id="consumoMSPlan12"></span><span class="real" id="consumoMSPReal2"></span></td>

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

                      <td class="dietaSeleccionada"></td>
                  
                  <?php

                    }

                  } 
                  
                  ?>  

              </tr>

            </tbody>

          </table>

          <input type="hidden" name="stockInsumos">
          <input type="hidden" name="stockAnimales">
          <input type="hidden" name="stockKgProm">

          <input type="hidden" name="ingreso1">
          <input type="hidden" name="kgIngreso1">
          <input type="hidden" name="venta1">
          <input type="hidden" name="kgVenta1">

          <input type="hidden" name="ingreso2">
          <input type="hidden" name="kgIngreso2">
          <input type="hidden" name="venta2">
          <input type="hidden" name="kgVenta2">

          <input type="hidden" name="ingreso3">
          <input type="hidden" name="kgIngreso3">
          <input type="hidden" name="venta3">
          <input type="hidden" name="kgVenta3">

          <input type="hidden" name="ingreso4">
          <input type="hidden" name="kgIngreso4">
          <input type="hidden" name="venta4">
          <input type="hidden" name="kgVenta4">

          <input type="hidden" name="ingreso5">
          <input type="hidden" name="kgIngreso5">
          <input type="hidden" name="venta5">
          <input type="hidden" name="kgVenta5">

          <input type="hidden" name="ingreso6">
          <input type="hidden" name="kgIngreso6">
          <input type="hidden" name="venta6">
          <input type="hidden" name="kgVenta6">

          <input type="hidden" name="ingreso7">
          <input type="hidden" name="kgIngreso7">
          <input type="hidden" name="venta7">
          <input type="hidden" name="kgVenta7">

          <input type="hidden" name="ingreso8">
          <input type="hidden" name="kgIngreso8">
          <input type="hidden" name="venta8">
          <input type="hidden" name="kgVenta8">

          <input type="hidden" name="ingreso9">
          <input type="hidden" name="kgIngreso9">
          <input type="hidden" name="venta9">
          <input type="hidden" name="kgVenta9">

          <input type="hidden" name="ingreso10">
          <input type="hidden" name="kgIngreso10">
          <input type="hidden" name="venta10">
          <input type="hidden" name="kgVenta10">

          <input type="hidden" name="ingreso11">
          <input type="hidden" name="kgIngreso11">
          <input type="hidden" name="venta11">
          <input type="hidden" name="kgVenta11">
                
          <input type="hidden" name="ingreso12">
          <input type="hidden" name="kgIngreso12">
          <input type="hidden" name="venta12">
          <input type="hidden" name="kgVenta12">

        </form>

      </div>

    </div>

  </div>

</div>

<script>

let calcularPesoPromedio = (dataEstrategia = false,tipo = 'plan')=>{

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

      let idDieta = $('#dieta').val()

      $.ajax({
        method:'POST',
        url:'ajax/estrategia.ajax.php',
        data:{accion:'verDieta',idDieta},
        success:function(resp){

          let respuesta = JSON.parse(resp)

          let objMonths = {1:5,2:6,3:7,4:8,5:9,6:10,7:11,8:12,9:1,10:2,11:3,12:4}

          for (const key in respuesta) {

            for (let index = 1; index <= 12; index++) {

              let stockMesPlan = Number($(`#stockPlan${index}`).html())

              let consMS = Number($(`#porcentMS${index}`).val())
  
              let consumoInsumo = (respuesta[key].porcentaje * consMS) / 100 

              let totalConsumoMensual = consumoInsumo * stockMesPlan * 30 //dias del mes

              $(`#insumoNecesario${respuesta[key].idInsumo}${objMonths[index]}`).html(totalConsumoMensual.toLocaleString('de-DE'))

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

  return  new Promise((resolve)=>{

    let stock = parseFloat($('#stockAnimales').val())
    let stockKgProm = parseFloat($('#stockKgProm').val())
  
    let ingresoTotal = 0
    let kgIngresoTotal = 0
    let ventaTotal = 0
    let kgVentaTotal = 0
  
    let seteado = '<?=$data['estrategia']['seteado']?>'
  
    if(!seteado){
  
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
  
        let stockReal = parseFloat($('#stockAnimales').val())
  
        let ingresoTotalReal = 0
        let kgIngresoTotalReal = 0
        let ventaTotalReal = 0
        let kgVentaTotalReal = 0
  
      for (let index = 1; index <= 12; index++) {
        
        let ingreso = parseFloat($(`#ingreso${index}`).html())
        let ingresoReal = parseFloat($(`#ingresoReal${index}`).html().replace('| ',''))
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
          $(`#stockDif${index}`).html(diff)

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
  
  
  
  
      } 
  
    }
  
    calcularPesoPromedio()

    resolve()
  })

}

let seteado = '<?=$data['estrategia']['seteado']?>'

let data = '<?=json_encode($data)?>'

if(seteado){
  console.log('HolA  entro por aca')
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

      index = 0
      let month = 1

      for (const key in insumosNameId) {

          $('#trStock').append($(`<th>${key}</th>`))

          $('#trStockInicial').append($(`<td><input class="form-control stockInicial" type="number" min="0" value="${stockInsumos[index][insumosNameId[key]]}" readOnly></td>`))

          $('#insumosReal').append($(`<div class="col-sm-4">

                                        <div class="form-group">
                                          <label>Ingreso ${key}</label>
                                          <input type="number" min="0" class="form-control real" name="insumoReal${insumosNameId[key]}" value="0">
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
          thAPagar.innerText = 'A Pagar';
          tr.append(th, thNecesario, thIngreso, thPrecio, thAPagar);
          thead.append(tr);
          tableInsumo.append(thead);

          console.log(insumosNameId[key])
          console.log(key)
          console.log(cerealesPlan[insumosNameId[key]])

          
          cerealesPlan[insumosNameId[key]].forEach((element,index) => {
            
            let trInsumo = document.createElement('TR');
            let tdMonth = document.createElement('TD');
            tdMonth.setAttribute('style', 'font-weight:bold;padding:10px');
            tdMonth.innerText = months[index];
            trInsumo.append(tdMonth);

            for (let j = 0; j < 4; j++) {
                let columnHeader = ['Necesario', 'Ingreso', 'Precio', 'APagar'][j];
                let td = document.createElement('TD');

                let spanPlanificado = document.createElement('SPAN');
                spanPlanificado.setAttribute('class', 'planificado');

                let spanReal = document.createElement('SPAN');
                spanReal.setAttribute('class', 'real');
                spanReal.setAttribute('id', `insumo${insumosNameId[key]}_${index + 1}`);

                let precioInsumoReal = []
                let aPagarInsumoReal = []
                // let precioInsumoPlan = 0

                if(columnHeader == 'Ingreso'){

                  spanPlanificado.innerText = element;
                  spanReal.innerHTML = (cerealesReal != null) ? (cerealesReal[index + 1] != undefined) ? ' | ' + cerealesReal[index + 1][insumosNameId[key]] : '' : '';

                }
                  
                if(columnHeader == 'Precio'){

                  // spanPlanificado.innerText = precioInsumoPlan[index + 1][insumosNameId[key]];
                  spanPlanificado.innerText = 0;
                  spanReal.innerHTML = (precioInsumoReal != null) ? (precioInsumoReal[index + 1] != undefined) ? ' | ' + precioInsumoReal[index + 1][insumosNameId[key]] : '' : '';

                }
                  
                if(columnHeader == 'APagar'){

                  // spanPlanificado.innerText = aPagarInsumoPlan[index + 1][insumosNameId[key]];
                  spanPlanificado.innerText = 0;
                  spanReal.innerHTML = (aPagarInsumoReal != null) ? (aPagarInsumoReal[index + 1] != undefined) ? ' | ' + aPagarInsumoReal[index + 1][insumosNameId[key]] : '' : '';

                }
                  
                  

                td.append(spanPlanificado, spanReal);
                trInsumo.append(td);
            }

            tableInsumo.append(trInsumo);

            divTab.append(tableInsumo);
            $('#tab-insumos').append(divTab);
                  
          });

          //TODO RESTRUCTURAR TABLA DE INSUMOS EN MODAL

          // $('#tbodyEstrategia').prepend($(`<tr>${tds}</tr>`))

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
  }, 500);

  setTimeout(() => {
    calcularConsumos()
  }, 5000);
  
}
        
</script>

<?php

  $setear = new ControladorEstrategia();
  $setear->ctrSetearEstrategia();

?>
