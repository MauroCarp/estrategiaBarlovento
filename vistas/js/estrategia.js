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

function guardarDatos() {

     if($('#dieta').val() == '')
        return

    const form = document.getElementById("formularioEstrategia");
    const formData = new FormData(form);
    
    let adpv = []
    let porceMs = []

    for (let index = 1; index <= 12; index++) {
      
        adpv.push($(`#adpv${index}`).val())
        porceMs.push($(`#porcentMS${index}`).val())
    }

    formData.append("accion", 'guardar');
    formData.append("adpv", JSON.stringify(adpv));
    formData.append("porceMS", JSON.stringify(porceMs));

    const data = Object.fromEntries(formData.entries());

    $.ajax({
        
        method: "POST",
        url:"ajax/estrategia.ajax.php",
        data: data,
        success:function(response){

            if(response == '"ok"'){
                console.log('Guardado Automatico Correctamente')
            } else{
                console.log('Error al guardar') 
            }

        }

    })

}

if($('#dieta').length == 1)
    setInterval(guardarDatos, 10000);


$('.stockInicial').each(function(){

    
    $(this).on('change',function(){
        
        let id = $(this).attr('id')
        let val = $(this).val()
    
        $(`input[name='${id}']`).val(val)

    })

})

$('#dieta').on('change',function(){

    cargarInsumos()

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

let year = ''

if(select.options[0] == undefined){

    year = new Date().getFullYear()
    year--
}else{

    year = select.options[0].value.split('/') 
    year = Number(year[0])

} 

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
    $('input[name="stockAnimales"]').val(stock)

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





