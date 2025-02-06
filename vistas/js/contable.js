$('#modalEstrategiaIngresoInsumos').on('hidden.bs.modal', function () {

    calcularInsumosContable();

    $('.compraInsumos').each(function(){

        let id = $(this).attr('id')

        let index = id.replace('insumoIngreso','')


        $(`input[name=${id}]`).val($(this).val())
        $(`input[name=insumoPrecio${index}]`).val($(`#insumoPrecio${index}`).val())
        $(`input[name=insumoAPagar${index}]`).val($(`#insumoAPagar${index}`).val())


    })

    calcularFlujoDeFondoMensual()

    calcularFlujoNeto()

});

$('#modalEstrategiaEstructura').on('hidden.bs.modal', function () {

    calcularEstructuraContable();

    $('.estructura').each(function(){

        let id = $(this).attr('id')

        let idExplode = id.split('_')
        
        $(`input[name=${id}]`).val($(this).val())
        $(`input[name=${idExplode[0]}_aPagar_${idExplode[2]}]`).val($(`#${idExplode[0]}_aPagar_${idExplode[2]}`).val())


    })

    calcularFlujoNeto()


});

$('#modalEstrategiaIngEgr').on('hidden.bs.modal', function () {

    calcularAnimalesContable();

    calcularFlujoDeFondoMensual();

    calcularFlujoNeto()

});

let calcularInsumosContable = ()=>{

    $('.contableInsumo').html('0')

    let total = {}

    $('.compraInsumos').each(function(){

        let idInsumo = $(this).attr('id-insumo');
        let realMonth = $(this).attr('id').replace(`insumoIngreso${idInsumo}`, '');
        let precio = Number($(this).parent().next().children().val());
        let aPagar = $(this).parent().next().next().children().val();
        let cantInsumo = Number($(this).val());

        if (!total[idInsumo]) {
            total[idInsumo] = 0;
        }
        total[idInsumo] += cantInsumo * precio;

        if (cantInsumo !== 0) {

            let month = (Number(realMonth) + Number(aPagar) - 1) % 12 + 1;


            if ($(`#insumo${idInsumo}${month}Contable`).html() == '' || $(`#insumo${idInsumo}${month}Contable`).html() == '0') {
            $(`#insumo${idInsumo}${month}Contable`).html($(`<span style="color:red">${(cantInsumo * precio).toLocaleString('de-DE')}</span>`));
            } else {
            let prevNumber = Number($(`#insumo${idInsumo}${month}Contable`).text().replace(/\./g, ''));
            $(`#insumo${idInsumo}${month}Contable`).html($(`<span style="color:red">${(prevNumber + (cantInsumo * precio)).toLocaleString('de-DE')}</span>`));
            }
        }

    })

    for (const idInsumo in total) {
       $(`#totalInsumo${idInsumo}`).text(total[idInsumo].toLocaleString('de-DE'));
    }
    

}

let calcularInsumosContableSeteado = ()=>{

    $('.compraInsumos').each(function(){

        let idInsumo = $(this).attr('id-insumo')

        let realMonth = $(this).attr('id').replace(`insumoIngreso${idInsumo}`,'')

        let precio = Number($(this).parent().next().children().val())
        
        let aPagar = $(this).parent().next().next().children().val()

        let cantInsumo = Number($(this).val())

        let month = (Number(realMonth) + Number(aPagar) - 1) % 12 + 1;

        if($(`#insumo${idInsumo}${month}Contable`).html() == '' || $(`#insumo${idInsumo}${month}Contable`).html() == '0'){

            $(`#insumo${idInsumo}${month}Contable`).html(cantInsumo * precio)

        } else {

            let prevNumber = Number($(`#insumo${idInsumo}${month}Contable`).html())
            
            $(`#insumo${idInsumo}${month}Contable`).html(prevNumber + (cantInsumo * precio))

        }

    })
    

}

let calcularAnimalesContable = ()=>{

    let totales = {}

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

        
        const updateContable = (selector, total,color) => {
            if ($(selector).html() == '' || $(selector).html() == '0') {
            $(selector).html($(`<span style="color:${color}">${total.toLocaleString('de-DE')}</span>`));
            } else {
            let prevNumber = Number($(selector + ' span').text().replace(/\./g, ''));
            $(selector).html($(`<span style="color:${color}">${(prevNumber + total).toLocaleString('de-DE')}</span>`));
            }
        };

        const processPayment = (importe, aPagar, prefix, index,color = 'red') => {
            let month;
            if (aPagar === 'A') {
                month = ((index + 1) - 1) % 12 + 1;
    
                updateContable(`#${prefix}Contable${month}`, Number(importe), color);
            } else if (aPagar === 'B') {
                month1 = ((index + 1) - 1) % 12 + 1;
                month2 = ((index + 2) - 1) % 12 + 1;
    
                updateContable(`#${prefix}Contable${month1}`, Number(importe / 2), color);
                updateContable(`#${prefix}Contable${month2}`, Number(importe / 2), color);
            } else if (aPagar === 'C') {
                month = ((index + 2) - 1) % 12 + 1;
                updateContable(`#${prefix}Contable${month}`, Number(importe), color);
            } else if (aPagar === 'D') {
                month = ((index + 3) - 1) % 12 + 1;
                updateContable(`#${prefix}Contable${month}`, Number(importe), color);
            }
        };

        if (ingresos != 0) {

            let total = (ingresos * kgIngreso) * precioIngreso;

            processPayment(total,aPagarIngreso, 'ingresoPlan', Number(realMonth));          

            if(!totales['Ingresos']){
                totales['Ingresos'] = 0
            }

            totales['Ingresos'] += total

        }

        if (ventas != 0) {

            let total = (ventas * kgVenta) * precioVenta;

            processPayment(total,aPagarVenta, 'ventaPlan', Number(realMonth),'green');          

            if(!totales['Egresos']){
                totales['Egresos'] = 0
            }
            
            totales['Egresos'] += total

        }


        for (const tipo in totales) {
            $(`#total${tipo}`).text(totales[tipo].toLocaleString('de-DE'));
         }

    })

    

}

let calcularEstructuraContable = ()=>{

    let totales = {}

    $('.contableEstructura').html('0')

    const updateContable = (selector, total,color) => {
        if ($(selector).html() == '' || $(selector).html() == '0') {
            $(selector).html($(`<span style="color:${color}">${total.toLocaleString('de-DE')}</span>`));
        } else {
            let prevNumber = Number($(selector + ' span').text().replace(/\./g, ''));
            $(selector).html($(`<span style="color:${color}">${(prevNumber + total).toLocaleString('de-DE')}</span>`));
        }
    };

    const processPayment = (importe, aPagar, prefix, index,color = 'red') => {
        let month;
        if (aPagar === 'A') {
            month = ((index + 1) - 1) % 12 + 1;

            updateContable(`#${prefix}Contable${month}`, Number(importe), color);
        } else if (aPagar === 'B') {
            month1 = ((index + 1) - 1) % 12 + 1;
            month2 = ((index + 2) - 1) % 12 + 1;

            updateContable(`#${prefix}Contable${month1}`, Number(importe / 2), color);
            updateContable(`#${prefix}Contable${month2}`, Number(importe / 2), color);
        } else if (aPagar === 'C') {
            month = ((index + 2) - 1) % 12 + 1;
            updateContable(`#${prefix}Contable${month}`, Number(importe), color);
        } else if (aPagar === 'D') {
            month = ((index + 3) - 1) % 12 + 1;
            updateContable(`#${prefix}Contable${month}`, Number(importe), color);
        }
    };

    for (let index = 1; index <= 12; index++) {

        let importeDirecto = $(`#estructuraDirecto_importe_${index}`).val()
        let aPagarDirecto = $(`#estructuraDirecto_aPagar_${index}`).val()
        let importeIndirecto = $(`#estructuraIndirecto_importe_${index}`).val()
        let aPagarIndirecto = $(`#estructuraIndirecto_aPagar_${index}`).val()
        let importeGastos = $(`#gastosVarios_importe_${index}`).val()
        let aPagarGastos = $(`#gastosVarios_aPagar_${index}`).val()
        let importeIngresos = $(`#ingresosExtraordinarios_importe_${index}`).val()
        let aPagarIngresos = $(`#ingresosExtraordinarios_aPagar_${index}`).val()

        if(importeDirecto != 0)
            processPayment(importeDirecto,aPagarDirecto, 'estructuraDirecta', index);
        if(importeIndirecto != 0)
            processPayment(importeIndirecto,aPagarIndirecto, 'estructuraIndirecta', index);
        if(importeGastos != 0)
            processPayment(importeGastos,aPagarGastos, 'gastosVarios', index);
        if(importeIngresos != 0)
            processPayment(importeIngresos,aPagarIngresos, 'ingresosExtra', index,'green');
    }


    // for (const tipo in totales) {
    //     $(`#total${tipo}`).text(totales[tipo].toLocaleString('de-DE'));
    // }  

}

let calcularFlujoDeFondoMensual = ()=>{ 

    let totalesFlujo = {}

    $('.flujo').each(function(){

        let value = Number($(this).text().replace(/\./g, ''))
        console.log(value)
        let month = $(this).attr('month-data')

        let id = $(this).attr('id')

        if (id.includes('ventaPlanContable')) {
            if (!totalesFlujo[month]) {
                totalesFlujo[month] = {};
            }

            if (!totalesFlujo[month]['positivo']) {
                totalesFlujo[month]['positivo'] = 0;
            }

            totalesFlujo[month]['positivo'] += value;
            
        } else {

            if (!totalesFlujo[month]) {
                totalesFlujo[month] = {};
            }

            if (!totalesFlujo[month]['negativo']) {
                totalesFlujo[month]['negativo'] = 0;
            }

            totalesFlujo[month]['negativo'] += value;

        }
    })

    let totalAccum = 0

    for (const key in totalesFlujo) {

        let resultado = totalesFlujo[key].positivo - totalesFlujo[key].negativo;
        totalAccum += resultado

        let color = (resultado < 0) ? 'red' : 'green'
        
        $(`#flujoMensualContable${key}`).text(resultado.toLocaleString('de-DE'))
        $(`#flujoMensualContable${key}`).css('color',color)

        color = (totalAccum < 0) ? 'red' : 'green'
        $(`#flujoMensualAcumContable${key}`).text(totalAccum.toLocaleString('de-DE'))
        $(`#flujoMensualAcumContable${key}`).css('color',color)
        
    }
    
    console.log(totalesFlujo)

}

let calcularFlujoNeto = ()=>{

    let totalesNeto = {}

    for (let index = 1; index <= 12; index++) {

        let directa = Number($(`#estructuraDirectaContable${index}`).text().replace(/\./g, ''))
        let indirecta = Number($(`#estructuraIndirectaContable${index}`).text().replace(/\./g, ''))
        let gastos = Number($(`#gastosVariosContable${index}`).text().replace(/\./g, ''))
        let ingresos = Number($(`#ingresosExtraContable${index}`).text().replace(/\./g, ''))
        let flujoMensual = Number($(`#flujoMensualContable${index}`).text().replace(/\./g, ''))

        if(!totalesNeto[index])
            totalesNeto[index] = {}

        if(!totalesNeto[index]['positivo'])
            totalesNeto[index]['positivo'] = 0 

        if(!totalesNeto[index]['negativo'])
            totalesNeto[index]['negativo'] = 0 

        totalNeto[index]['positivo'] += ingresos
        totalNeto[index]['negativo'] += directa
        totalNeto[index]['negativo'] += indirecta
        totalNeto[index]['negativo'] += gastos

        totalNeto[index]['flujoMensual'] = flujoMensual

    }

    for (const month in totalNeto) {

        let resultado = (Number(totalNeto[month]['positivo']) - Number(totalNeto[month]['negativo'])) + totalNeto[month]['flujoMensual']

        let color = (resultado < 0) ? 'red' : 'green'

       $(`flujoNetoContable${month}`).text(resultado)
       $(`flujoNetoContable${month}`).css('color',color)

    }
}


