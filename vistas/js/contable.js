$('#modalEstrategiaIngresoInsumos').on('hidden.bs.modal', function () {
    calcularInsumosContable();
});

$('#modalEstrategiaIngEgr').on('hidden.bs.modal', function () {
    calcularAnimalesContable();
});

let calcularInsumosContable = ()=>{

    let objInsumoCosto = {}

    $('.compraInsumos').each(function(){

        let idInsumo = $(this).attr('id-insumo')

        let realMonth = $(this).attr('id').replace(`insumoIngreso${idInsumo}`,'')

        let precio = Number($(this).parent().next().children().val())
        
        let aPagar = $(this).parent().next().next().children().val()

        let cantInsumo = Number($(this).val())

        month = Number(realMonth) + Number(aPagar)

        if($(`#insumo${idInsumo}${month}Contable`).html() == '' || $(`#insumo${idInsumo}${month}Contable`).html() == '0'){

            if(cantInsumo * precio != 0){

                console.log('ACA ESTOY')
                console.log(realMonth)
                console.log(month)

            }

            $(`#insumo${idInsumo}${month}Contable`).html(cantInsumo * precio)

        } else {

            if(cantInsumo * precio != 0){

                console.log('ACA ESTOY repitiendo')
                console.log(realMonth)
                console.log(month)

            }
            let prevNumber = Number($(`#insumo${idInsumo}${month}Contable`).html())
            
            $(`#insumo${idInsumo}${month}Contable`).html(prevNumber + (cantInsumo * precio))

        }

        if (!(idInsumo in objInsumoCosto)) {

            objInsumoCosto[idInsumo] = {};
            objInsumoCosto[idInsumo][month] = {};
            objInsumoCosto[idInsumo][month]['cantInsumo'] = $(this).val();
            objInsumoCosto[idInsumo][month]['precio'] = precio;
            objInsumoCosto[idInsumo][month]['aPagar'] = aPagar;

        }else{

            if (!(month in objInsumoCosto[idInsumo]))
                objInsumoCosto[idInsumo][month] = {};

            objInsumoCosto[idInsumo][month]['cantInsumo'] = $(this).val();
            objInsumoCosto[idInsumo][month]['precio'] = precio;
            objInsumoCosto[idInsumo][month]['aPagar'] = aPagar;

        }

    })

    console.log(objInsumoCosto)
    

}

let calcularInsumosContableSeteado = ()=>{

    let objInsumoCosto = {}

    $('.compraInsumos').each(function(){

        let idInsumo = $(this).attr('id-insumo')

        let realMonth = $(this).attr('id').replace(`insumoIngreso${idInsumo}`,'')

        let precio = Number($(this).parent().next().children().val())
        
        let aPagar = $(this).parent().next().next().children().val()

        let cantInsumo = Number($(this).val())

        month = Number(realMonth) + Number(aPagar)

        if($(`#insumo${idInsumo}${month}Contable`).html() == '' || $(`#insumo${idInsumo}${month}Contable`).html() == '0'){

            if(cantInsumo * precio != 0){

                console.log('ACA ESTOY')
                console.log(realMonth)
                console.log(month)

            }

            $(`#insumo${idInsumo}${month}Contable`).html(cantInsumo * precio)

        } else {

            if(cantInsumo * precio != 0){

                console.log('ACA ESTOY repitiendo')
                console.log(realMonth)
                console.log(month)

            }
            let prevNumber = Number($(`#insumo${idInsumo}${month}Contable`).html())
            
            $(`#insumo${idInsumo}${month}Contable`).html(prevNumber + (cantInsumo * precio))

        }

        if (!(idInsumo in objInsumoCosto)) {

            objInsumoCosto[idInsumo] = {};
            objInsumoCosto[idInsumo][month] = {};
            objInsumoCosto[idInsumo][month]['cantInsumo'] = $(this).val();
            objInsumoCosto[idInsumo][month]['precio'] = precio;
            objInsumoCosto[idInsumo][month]['aPagar'] = aPagar;

        }else{

            if (!(month in objInsumoCosto[idInsumo]))
                objInsumoCosto[idInsumo][month] = {};

            objInsumoCosto[idInsumo][month]['cantInsumo'] = $(this).val();
            objInsumoCosto[idInsumo][month]['precio'] = precio;
            objInsumoCosto[idInsumo][month]['aPagar'] = aPagar;

        }

    })

    console.log(objInsumoCosto)
    

}

let calcularAnimalesContable = ()=>{

    let objAnimalesCosto = {}

    $('.contable').html('0')

    $('.ingreso').each(function(){

        let tipo = 'ingreso'

        let realMonth = $(this).attr('id').replace(`ingreso`,'')
        
        let ingresos = Number($(this).val())

        let kgIngreso = Number($(this).parent().next().children().val())
        
        let ventas = Number($(this).parent().next().next().children().val())
        
        let kgVentas = Number($(this).parent().next().next().next().children().val())

        let precio = Number($(this).parent().next().next().next().next().children().val())

        let aPagar = $(this).parent().next().next().next().next().next().children().val()

        month = Number(realMonth) + Number(aPagar)

        let cantidad = ingresos
        let kilos = kgIngreso

        if(ventas != 0){
            tipo = 'venta'
            cantidad = ventas
            kilos = kgVentas
        }

        let total = (cantidad * kilos) * precio

        if($(`#${tipo}PlanContable${month}`).html() == '' || $(`#${tipo}PlanContable${month}`).html() == '0'){
            
            $(`#${tipo}PlanContable${month}`).html($(`<span style="color:green">${total.toLocaleString('de-DE')}</span>`))
            
        } else {
            
            let prevNumber = Number($(`#${tipo}PlanContable${month} span`).text().replace(/\./g, ''))
            $(`#${tipo}PlanContable${month}`).html($(`<span style="color:green">${(prevNumber + total).toLocaleString('de-DE')}</span>`))

        }

    })

    

}

