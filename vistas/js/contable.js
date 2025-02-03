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

            $(`#insumo${idInsumo}${month}Contable`).html(cantInsumo * precio)

        } else {

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

            $(`#insumo${idInsumo}${month}Contable`).html(cantInsumo * precio)

        } else {

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
    

}

let calcularAnimalesContable = ()=>{

    let objAnimalesCosto = {}

    $('.contable').html('0')

    $('.ingreso').each(function(){

        let realMonth = $(this).attr('id').replace(`ingreso`,'')
        
        let ingresos = Number($(this).val())

        let kgIngreso = Number($(this).parent().next().children().val())
        
        let ventas = Number($(this).parent().next().next().children().val())
        
        let kgVenta = Number($(this).parent().next().next().next().children().val())

        let precioIngreso = Number($(this).parent().next().next().next().next().children().children().first().val())
        let precioVenta = Number($(this).parent().next().next().next().next().children().children().eq(1).val())

        let aPagarIngreso = $(this).parent().next().next().next().next().next().children().children().first().val()
        let aPagarVenta = $(this).parent().next().next().next().next().next().children().children().eq(1).val()

        const updateContable = (selector, total) => {
            if ($(selector).html() == '' || $(selector).html() == '0') {
            $(selector).html($(`<span style="color:green">${total.toLocaleString('de-DE')}</span>`));
            } else {
            let prevNumber = Number($(selector + ' span').text().replace(/\./g, ''));
            $(selector).html($(`<span style="color:green">${(prevNumber + total).toLocaleString('de-DE')}</span>`));
            }
        };

        if (ingresos != 0) {

            let month = Number(realMonth) + Number(aPagarIngreso);
            
            let total = (ingresos * kgIngreso) * precioIngreso;

            updateContable(`#ingresoPlanContable${month}`, total);

        }

        if (ventas != 0) {
            let month = Number(realMonth) + Number(aPagarVenta);
            let total = (ventas * kgVenta) * precioVenta;
            updateContable(`#ventaPlanContable${month}`, total);
        }

    })

    

}

