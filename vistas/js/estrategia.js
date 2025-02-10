let setearStockInsumos = ()=>{


    let stockInsumos = []
     
    $('.stockInsumosModal').each(function(){

        let idInsumo = $(this).attr('idInsumo')

        stockInsumos.push(`{"${idInsumo}":${$(this).val()}}`)
    })

    $('input[name="stockInsumos"]').val(`[${stockInsumos}]`)

}

let generarOptionInsumos = (idSelect)=>{

    $.ajax({

        method:'post',
        url:'ajax/estrategia.ajax.php',
        data:{accion:'getInsumos'},
        success:function(resp){

            resp = JSON.parse(resp)

            let options = [{id:'',text:'Seleccionar Insumo'}]

            resp.forEach(element => {
                options.push({id:element.id,text:element.insumo})
            });

            $(`#${idSelect}`).select2({
                width:'100%',
                data:options
            })

        }

    })
}

let sumarPorcentajes = ()=>{

    let total = 0

    $('.porcentajeInsumo').each(function(){

        if($(this).val() != '')
            total += parseFloat($(this).val())

    })

    if(total > 100){
        
        new swal({
            icon: "error",
            title: "La compocision de la dieta supera el 100%",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            })

        $('#btnNuevaDieta').attr('disabled','disabled')

    } else {

        $('#btnNuevaDieta').removeAttr('disabled')

    }

    $('#totalPorcentaje').html(total)

    return total

}

let calcularStockReal = ()=>{

    let stockInicial = $('#stockAnimales').val()

    let stock = Number(stockInicial)

    let i = 1;

    while (true) {

        // let ing = ($(`#ingReal${i}`).html() != '') ?'per' : 0
        let ing = ($(`#ingReal${i}`).html() != '') ? Number($(`#ingReal${i}`).html().replace('|','').replace(/\s+/g,'')) : 0
        let egr = ($(`#egrReal${i}`).html() != '') ? Number($(`#egrReal${i}`).html().replace('|','').replace(/\s+/g,'')) : 0

        stock += ing
        stock -= egr

        if($(`#ingReal${i}`).html() != ''){

            $(`#stockReal${i}`).html(` | ${stock}`)
            if(stock < Number($(`#stockPlanIngEgr${i}`).html())) $(`#stockReal${i}`).css('color','red')

        }
        
        i++

    }
}

const validarPorcentajesDieta = ()=>{
    
    let total = 0

    $('.dietaReal').each(function(){

        let valor = $(this).val() 
        total += Number(valor)

    })

    if(total < 100){
        $('#btnCargaReal').attr('disabled','disabled')

        $('#alertaDietaReal').remove()

        $('#cargaRealModal').append($('<small id="alertaDietaReal"><b style="color:red">El total de la dieta no puede ser menor a 100%</small>'))

    } else if(total > 100) {

        $('#btnCargaReal').attr('disabled','disabled')

        $('#alertaDietaReal').remove()

        $('#cargaRealModal').append($('<small id="alertaDietaReal"><b style="color:red">El total de la dieta no puede ser mayor a 100%</small>'))

    } else {

        $('#btnCargaReal').removeAttr('disabled')

        $('#alertaDietaReal').remove()

    }
}
  
$('.stockInicial').each(function(){

    
    $(this).on('change',function(){
        
        let id = $(this).attr('id')
        let val = $(this).val()
    
        $(`input[name='${id}']`).val(val)

    })

})

$('#dieta').on('change',function(){

    let dieta = $(this).find("option:selected").text();
    
    $('#inputsInsumos').html('')

    $('.dietaSeleccionada').each(function(){
        
        if(dieta != 'Seleccionar Dieta')
            $(this).html(dieta)
        else
            $(this).html('-')
    
    })

    let idDieta = $(this).val()

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
                            //TODO RESTRUCTURAR TABLA DE INSUMOS EN MODAL
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

})

$('.btnCargaReal').on('click',function(){

    let month = $(this).attr('data-month')

    $('.real').each(function(){
        $(this).val('0')
    })

    $('#monthReal').val(month)

})

$('select[name="insumo[]"]').select2({
    width:'100%'
})

$('.selectCampania').select2({
    width:'auto'
})

$('#selectCampania').on('change',function(){

    let campania = $(this).val()
    window.location = `index.php?ruta=inicio&campania=${campania}`

})


let select = document.getElementById('selectCampania');

let year = select.options[0]

year = year.value.split('/')

year = Number(year[0])

let nextYear = year + 2;
      
let options = []

for (let index = 0; index < 5; index++) {

    options.push(`<option value='${year + 1}'>${year + 1}</option>`)
    year++

}

$('#campania').append(options.join(''))
$('#campania2').val(nextYear)

$(".ingEgrTable tbody input[type='number']").on("change", function() {
    calculateStockAndTotals();
});


$('#stockAnimales').on('change',function(){

    calculateStockAndTotals()
    $('input[name="stockAnimales"]').val($(this).val())

})

let insumoIndex = 1

$('#btnAgregarInsumo').on('click',function(){

    let nuevoInsumo = $(`<div class="row" style="margin-top:10px;">

                            <div class="col-lg-7    ">

                                <select class="selectInsumos" id="insumo${insumoIndex}" name="insumo[]">
                                
                                </select>

                            </div>

                            <div class="col-lg-3"><input class="form-control input-sm porcentajeInsumo" onchange="sumarPorcentajes()" type="number" name="porcentajeInsumo[]"></div>

                            <div class="col-lg-2"><button class="btn btn-danger" onclick="$(this).closest('.row').remove();sumarPorcentajes()"><i class="fa fa-trash"></i></button></div>


                        </div>`)

    $("#insumos").append(nuevoInsumo);

    generarOptionInsumos(`insumo${insumoIndex}`)

    insumoIndex++
})

$('.table').on('click','.verDieta',function(){

    $('#composicionDieta').show(200)

    let idDieta = $(this).attr('idDieta')
    
    $.ajax({
        method:'post',
        url:'ajax/estrategia.ajax.php',
        data:{accion:'verDieta',idDieta},
        success:function(resp){

            resp = JSON.parse(resp)

            let tr = []

            resp.forEach(element => {
                
                tr.push(`<tr><td>${element['insumo']}</td><td>${element['porcentaje']}</td>`)

            });

            $('#insumosDieta').empty().append(tr.join(','))
            

        }
    })

})

$('.table').on('click','.eliminarDieta',function(){

    let idDieta = $(this).attr('idDieta')

    let rowDieta = $(this).closest('tr')
    $('#composicionDieta').hide(200)

    $.ajax({

        method:'post',
        url:'ajax/estrategia.ajax.php',
        data:{accion:'eliminarDieta',idDieta},
        success:function(resp){

          if(resp == 'ok'){

                Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Dieta eliminada correctamente",
                showConfirmButton: false,
                timer: 2000
                })

                rowDieta.remove()

            }else{

                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Se produjo un error al eliminar la Dieta",
                    showConfirmButton: false,
                    timer: 2000
                })
    
            }

        }

    })

})
 
$('#campania').on('change',function(){

    let campania = $(this).val()

    let campania2 = Number(campania) + 1

    $('#campania2').val(campania2)

})

$('.ingEgr').each(function(){

    $(this).on('change',function(){
        
        let val = $(this).val()
        
        let tipo = $(this).attr('class')
        
        let index

        if (tipo.includes('ingreso')) {

            index = $(this).attr('id').replace('ingreso','')
            
            $(`#ingresoPlan${index}`).html(val)

        } else { 

            index = $(this).attr('id').replace('venta','')
            
            $(`#ventaPlan${index}`).html(val)


        }

    })

})


$('#graficosTab').on('click',function(){

    if($('#adpv1').val() != undefined)
        calcularConsumos()

})

$('#graficosTab2').on('click',function(){

    if($('#adpv1').val() != undefined)
        calcularConsumos()

})

$('#btnSetear').on('click',function(e){

    e.preventDefault()

    let input = document.createElement('INPUT')
    input.setAttribute('type','hidden')
    input.setAttribute('name','btnSetear')
    input.setAttribute('id','btnSetearHidden')
    $('#formularioEstrategia').append(input)

    Swal.fire({
        title: '¿Estás seguro de setear la planificacion?',
        text: 'Asegurate de que los datos ingresados sean correctos.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, Setear',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $('#formularioEstrategia').submit()
        } else {
            $('#btnSetearHidden').remove()
        }
      });

})

let teclaPresionada = false;

document.addEventListener('keydown', function(event) {

    if (event.key === 'F2') {

     if (!teclaPresionada) {

        teclaPresionada = true;
        
        $('#graficosTab').click()

     }

    }

    if (event.key === 'F1') {

     if (!teclaPresionada) {

        teclaPresionada = true;
        
        $('#graficosTab2').click()

     }

    }

  });


document.addEventListener('keyup', function(event) {

if (event.key === 'F2') {

    teclaPresionada = false;

    $('a[href="#estrategia"]').click()

}

if (event.key === 'F1') {
    teclaPresionada = false;

    $('a[href="#estrategia"]').click()

}

});





