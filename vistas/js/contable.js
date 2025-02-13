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
        // let aPagar = $(this).parent().next().next().children().val();
        let cantInsumo = Number($(this).val());

        if (!total[idInsumo])
            total[idInsumo] = 0;
        
        total[idInsumo] += cantInsumo * precio;

        if (cantInsumo !== 0) {

            let month = realMonth

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

    let total = {}

    let isReal = $('#ingReal1').html()

    $('.compraInsumos').each(function(){

        let id = $(this).attr('id')

        let idInsumo = $(this).attr('id').replace('insumoPlan','').replace('Contable','')

        let month = idInsumo.split('_');

        month = month[1];
        
        idInsumo = idInsumo.replace(`_${month}`,'')

        let cantidad = Number($(this).text().replace(/\./g, ''))

        // let cantidadReal = (isReal) ? $(`#`).html() : null
        
        let precio = $(`#insumoPrecioPlan${idInsumo}_${month}`).html()

        // let precioReal = (isReal) ? $(`#`).html() : null

        if($(`#insumo${idInsumo}PlanContable_${month}`).html() == '' || $(`#insumo${idInsumo}${month}Contable`).html() == '0'){

            $(`#insumo${idInsumo}PlanContable_${month}`).html((cantidad * precio).toLocaleString('de-DE'))

        } 

        if (!total[idInsumo])
            total[idInsumo] = 0;
        
        total[idInsumo] += cantidad * precio;

        // else {

        //     let prevNumber = Number($(`#insumo${idInsumo}${month}Contable`).html())
            
        //     $(`#insumo${idInsumo}${month}Contable`).html(prevNumber + (cantInsumo * precio))

        // }

    })

    for (const idInsumo in total) {
        $(`#totalInsumo${idInsumo}`).text(total[idInsumo].toLocaleString('de-DE'));
     }
    

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

let calcularAnimalesContableSeteado = ()=>{

    let totales = {}  
    $('.ingreso').each(function(){
        
        let tipo = 'ingreso'
  
        let realMonth = Number($(this).attr('id').replace(`ingreso`,''))
        
        let ingresos = Number($(this).text().replace(/\./g, ''))
        let ingresosReal = Number($(this).next().text().replace(/\./g, '').replace('| ',''))
  
        let kgIngreso = Number($(this).parent().next().children().first().text().replace(/\./g, ''))
        let kgIngresoReal = Number($(this).parent().next().children().eq(1).text().replace(/\./g, '').replace('| ',''))
            
        let ventas = Number($(this).parent().next().next().children().first().text().replace(/\./g, ''))
        let ventasReal = Number($(this).parent().next().next().children().eq(1).text().replace(/\./g, '').replace('| ',''))
            
        let kgVentas = Number($(this).parent().next().next().next().children().first().text().replace(/\./g, ''))
        let kgVentasReal = Number($(this).parent().next().next().next().children().eq(1).text().replace(/\./g, '').replace('| ',''))
  
        let precioIngreso = Number($(this).parent().next().next().next().next().children().first().text().replace(/\./g, ''))
        let precioIngresoReal = Number($(this).parent().next().next().next().next().children().eq(1).text().replace(/\./g, '').replace('| ',''))

        let precioVenta = Number($(this).parent().next().next().next().next().children().first().text().replace(/\./g, ''))
        let precioVentaReal = Number($(this).parent().next().next().next().next().children().eq(1).text().replace(/\./g, '').replace('| ',''))
  
        let aPagarIngreso = $(this).parent().next().next().next().next().next().children().first().children().first().text().replace(/\s+/g, '')
        let aPagarIngresoReal = $(this).parent().next().next().next().next().next().children().eq(1).text().replace(/\./g, '').replace('| ','').replace(/\s+/g, '')
        
        let aPagarVenta = $(this).parent().next().next().next().next().next().children().first().children().first().text().replace(/\s+/g, '')
        let aPagarVentaReal = $(this).parent().next().next().next().next().next().children().eq(1).text().replace(/\./g, '').replace('| ','').replace(/\s+/g, '')
        
        let updateContable = (selector, total) => {
  
            if ($(selector).html() == '0') {
  
              $(selector).html($(`<span style="color:green">${total.toLocaleString('de-DE')}</span>`));
  
            } else {
  
            let prevNumber = Number($(selector + ' span').text().replace(/\./g, ''));
  
              $(selector).html($(`<span style="color:green">${(prevNumber + total).toLocaleString('de-DE')}</span>`));
  
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

        if ($(`#ingresoPlanContable${realMonth}`).html() == '')
            $(`#ingresoPlanContable${realMonth}`).html('0')

        if ($(`#ventaPlanContable${realMonth}`).html() == '')
            $(`#ventaPlanContable${realMonth}`).html('0')

        if(ingresos != 0){
            let total = (ingresos * kgIngreso) * precioIngreso
            processPayment(total,aPagarIngreso,`${tipo}Plan`,realMonth,'green');
            
            if(!totales['Ingresos'])
                totales['Ingresos'] = 0
            
            totales['Ingresos'] += total
        }

        // processPayment(total,aPagarIngreso,`${tipo}Real`,realMonth,'green');

        if(ventas != 0){
            tipo = 'venta'
            let total = (ventas * kgVentas) * precioVenta
            processPayment(total,aPagarVenta,`${tipo}Plan`,realMonth);

            if(!totales['Egresos'])
                totales['Egresos'] = 0
            
            totales['Egresos'] += total
        } 

        // processPayment(total,aPagarVenta,`${tipo}Real`,realMonth);
        
    })
    
    for (const key in totales) {
       $(`#total${key}`).text(totales[key].toLocaleString('de-DE'));
    }
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

        let importeDirecto = Number($(`#estructuraDirecto_importe_${index}`).val())
        let aPagarDirecto = $(`#estructuraDirecto_aPagar_${index}`).val()
        let importeIndirecto = Number($(`#estructuraIndirecto_importe_${index}`).val())
        let aPagarIndirecto = $(`#estructuraIndirecto_aPagar_${index}`).val()
        let importeGastos = Number($(`#gastosVarios_importe_${index}`).val())
        let aPagarGastos = $(`#gastosVarios_aPagar_${index}`).val()
        let importeIngresos = Number($(`#ingresosExtraordinarios_importe_${index}`).val())
        let aPagarIngresos = $(`#ingresosExtraordinarios_aPagar_${index}`).val()

        if(importeDirecto != 0){
            if(!totales['EstructuraDirecta'])
                totales['EstructuraDirecta'] = 0

            totales['EstructuraDirecta'] += importeDirecto

            processPayment(importeDirecto,aPagarDirecto, 'estructuraDirecta', index);
        }

        if(importeIndirecto != 0){

            if(!totales['EstructuraIndirecta'])
                totales['EstructuraIndirecta'] = 0

            totales['EstructuraIndirecta'] += importeIndirecto

            processPayment(importeIndirecto,aPagarIndirecto, 'estructuraIndirecta', index);
        }

        if(importeGastos != 0){

            if(!totales['GastosVarios'])
                totales['GastosVarios'] = 0

            totales['GastosVarios'] += importeGastos

            processPayment(importeGastos,aPagarGastos, 'gastosVarios', index);
        }

        if(importeIngresos != 0){

            if(!totales['IngresosExtraordinarios'])
                totales['IngresosExtraordinarios'] = 0

            totales['IngresosExtraordinarios'] += importeIngresos

            processPayment(importeIngresos,aPagarIngresos, 'ingresosExtra', index,'green');
        }
    }

    
    for (const tipo in totales) {
        $(`#total${tipo}`).text(totales[tipo].toLocaleString('de-DE'));
    }  

}

let calcularEstructuraContableSeteado = ()=>{

    let totales = {}


    const updateContable = (selector, total,color,real = false) => {

        // console.log(selector)
        if(real){
            console.log(selector)
        }
        if ($(selector).html() == '' || $(selector).html() == '0') {
            $(selector).html($(`<span style="color:${color}">${(real) ? ' | ' : ''}${total.toLocaleString('de-DE')}</span>`));
        } else {
            let prevNumber = Number($(selector + ' span').text().replace(/\./g, ''));
            $(selector).html($(`<span style="color:${color}">${(real) ? ' | ' : ''}${(prevNumber + total).toLocaleString('de-DE')}</span>`));
        }
    };

    const processPayment = (importe, aPagar, prefix, index,color = 'red', real = false) => {

        let month;
        if (aPagar === 'A') {
            month = ((index + 1) - 1) % 12 + 1;
            updateContable(`#${prefix}Contable${month}`, Number(importe), color,real);

        } else if (aPagar === 'B') {
            month1 = ((index + 1) - 1) % 12 + 1;
            month2 = ((index + 2) - 1) % 12 + 1;

            updateContable(`#${prefix}Contable${month1}`, Number(importe / 2), color,real);
            updateContable(`#${prefix}Contable${month2}`, Number(importe / 2), color,real);
        } else if (aPagar === 'C') {
            month = ((index + 2) - 1) % 12 + 1;
            updateContable(`#${prefix}Contable${month}`, Number(importe), color,real);
        } else if (aPagar === 'D') {
            month = ((index + 3) - 1) % 12 + 1;
            updateContable(`#${prefix}Contable${month}`, Number(importe), color,real);
        }
        
    };
    

    for (let index = 1; index <= 12; index++) {

        let isReal = ($(`#ingReal${index}`).html()) ? true : false

        let importeDirectoPlan = Number($(`#directaImporte${index}`).text().replace(/\./g, ''))
        let aPagarDirectoPlan = $(`#directaApagar${index}`).text()
        let importeIndirectoPlan = Number($(`#indirectaImporte${index}`).text().replace(/\./g, ''))
        let aPagarIndirectoPlan = $(`#indirectaApagar${index}`).text()
        let importeGastosPlan = Number($(`#gastosImporte${index}`).text().replace(/\./g, ''))
        let aPagarGastosPlan = $(`#gastosApagar${index}`).text()
        let importeIngresosPlan = Number($(`#ingresosImporte${index}`).text().replace(/\./g, ''))
        let aPagarIngresosPlan = $(`#ingresosApagar${index}`).text()

        let importeDirectoReal = 0
        let aPagarDirectoReal = 0

        let importeIndirectoReal = 0
        let aPagarIndirectoReal = 0

        let importeGastosReal = 0
        let aPagarGastosReal = 0

        let importeIngresosReal = 0
        let aPagarIngresosReal = 0


        if(isReal){

            importeDirectoReal = Number($(`#directaImporteReal${index}`).text().replace('|','').replace(/\./g, ''))
            aPagarDirectoReal = $(`#directaApagarReal${index}`).text().replace('|','').replace(/\s+/g, '')
            importeIndirectoReal = Number($(`#indirectaImporteReal${index}`).text().replace('|','').replace(/\./g, ''))
            aPagarIndirectoReal = $(`#indirectaApagarReal${index}`).text().replace('|','').replace(/\s+/g, '')
            importeGastosReal = Number($(`#gastosImporteReal${index}`).text().replace('|','').replace(/\./g, ''))
            aPagarGastosReal = $(`#gastosApagarReal${index}`).text().replace('|','').replace(/\s+/g, '')
            importeIngresosReal = Number($(`#ingresosImporteReal${index}`).text().replace('|','').replace(/\./g, ''))
            aPagarIngresosReal = $(`#ingresosApagarReal${index}`).text().replace('|','').replace(/\s+/g, '')

        }

        if ($(`#estructuraDirectaContable${index}`).html() == '')
            $(`#estructuraDirectaContable${index}`).html('0')

        if ($(`#estructuraIndirectaContable${index}`).html() == '')
            $(`#estructuraIndirectaContable${index}`).html('0')

        if ($(`#gastosVariosContable${index}`).html() == '')
            $(`#gastosVariosContable${index}`).html('0')

        if ($(`#ingresosExtraContable${index}`).html() == '')
            $(`#ingresosExtraContable${index}`).html('0')

        if(importeDirectoPlan != 0){
            if(!totales['EstructuraDirecta'])
                totales['EstructuraDirecta'] = 0

            totales['EstructuraDirecta'] += importeDirectoPlan

            processPayment(importeDirectoPlan,aPagarDirectoPlan, 'estructuraDirecta', index);
            
        }

        if(isReal && importeDirectoReal != 0){
            if(!totales['EstructuraDirectaReal'])
                totales['EstructuraDirectaReal'] = 0

            totales['EstructuraDirectaReal'] += importeDirectoReal

            processPayment(importeDirectoReal,aPagarDirectoReal, 'estructuraDirectaReal', index, true , true);
            
        }

        if(importeIndirectoPlan != 0){

            if(!totales['EstructuraIndirecta'])
            totales['EstructuraIndirecta'] = 0

            totales['EstructuraIndirecta'] += importeIndirectoPlan

            processPayment(importeIndirectoPlan,aPagarIndirectoPlan, 'estructuraIndirecta', index);
        }

        if(isReal && importeIndirectoReal != 0){
            if(!totales['EstructuraIndirectaReal'])
            totales['EstructuraIndirectaReal'] = 0

            totales['EstructuraIndirectaReal'] += importeIndirectoReal
            processPayment(importeIndirectoReal,aPagarIndirectoReal, 'estructuraIndirectaReal', index, true, true);
        }

        if(importeGastosPlan != 0){

            if(!totales['GastosVarios'])
                totales['GastosVarios'] = 0

            totales['GastosVarios'] += importeGastosPlan

            processPayment(importeGastosPlan,aPagarGastosPlan, 'gastosVarios', index);
            
        }

        if(isReal && importeGastosReal != 0){
            if(!totales['GastosVarios'])
                totales['GastosVarios'] = 0

            totales['GastosVarios'] += importeGastosReal

            processPayment(importeGastosReal,aPagarGastosReal, 'gastosVariosReal', index, true, true);
        }

        if(importeIngresosPlan != 0){

            if(!totales['IngresosExtraordinarios'])1
                totales['IngresosExtraordinarios'] = 0

            totales['IngresosExtraordinarios'] += importeIngresosPlan

            processPayment(importeIngresosPlan,aPagarIngresosPlan, 'ingresosExtra', index,'green');
    
        }
        
        if(isReal && importeIngresosReal != 0){
            if(!totales['IngresosExtraordinariosReal'])
                totales['IngresosExtraordinariosReal'] = 0

            totales['IngresosExtraordinariosReal'] += importeIngresosReal

            processPayment(importeIngresosReal,aPagarIngresosReal, 'ingresosExtraReal', index, true, true);
        }

    }

    
    for (const tipo in totales) {
        $(`#total${tipo}`).text(totales[tipo].toLocaleString('de-DE'));
    }  

}

let calcularFlujoDeFondoMensual = ()=>{ 

    let totalesFlujo = {}

    $('.flujo').each(function(){

        let value = Number($(this).text().replace(/\./g, ''))

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
    
}

let calcularFlujoDeFondoMensualSeteado = ()=>{ 

    let totalesFlujo = {}

    $('.flujo').each(function(){

        let value = Number($(this).text().replace(/\./g, ''))

        let id = $(this).attr('id')

        let month = id.replace('ingresoPlanContable','').replace('ventaPlanContable','')

        if(!id.includes('ingresoPlanContable') && !id.includes('ventaPlanContable')){
            month = id.split('_')
            month = month[1]
        } 

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

        totalesNeto[index]['positivo'] += ingresos
        totalesNeto[index]['negativo'] += directa
        totalesNeto[index]['negativo'] += indirecta
        totalesNeto[index]['negativo'] += gastos

        totalesNeto[index]['flujoMensual'] = flujoMensual

    }

    for (const month in totalesNeto) {

        let resultado = (Number(totalesNeto[month]['positivo']) - Number(totalesNeto[month]['negativo'])) + totalesNeto[month]['flujoMensual']

        let color = (resultado < 0) ? 'red' : 'green'

       $(`#flujoNetoContable${month}`).text(resultado.toLocaleString('de-DE'))
       $(`#flujoNetoContable${month}`).css('color',color)

    }
}

let calcularFlujoNetoSeteado = ()=>{

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

        totalesNeto[index]['positivo'] += ingresos
        totalesNeto[index]['negativo'] += directa
        totalesNeto[index]['negativo'] += indirecta
        totalesNeto[index]['negativo'] += gastos

        totalesNeto[index]['flujoMensual'] = flujoMensual

    }

    for (const month in totalesNeto) {

        let resultado = (Number(totalesNeto[month]['positivo']) - Number(totalesNeto[month]['negativo'])) + totalesNeto[month]['flujoMensual']

        let color = (resultado < 0) ? 'red' : 'green'

       $(`#flujoNetoContable${month}`).text(resultado.toLocaleString('de-DE'))
       $(`#flujoNetoContable${month}`).css('color',color)

    }
}


