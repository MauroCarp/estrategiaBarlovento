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

    $('.compraInsumos').each(function(){

        let id = $(this).attr('id')

        let idInsumo = $(this).attr('id').replace('insumoPlan','').replace('Contable','')

        let month = idInsumo.split('_');

        month = month[1];
        
        idInsumo = idInsumo.replace(`_${month}`,'')

        let cantidad = Number($(this).text().replace(/\./g, ''))
        
        let precio = $(`#insumoPrecioPlan${idInsumo}_${month}`).html()

        if($(`#insumo${idInsumo}PlanContable_${month}`).html() == '' || $(`#insumo${idInsumo}${month}Contable`).html() == '0'){

            $(`#insumo${idInsumo}PlanContable_${month}`).html((cantidad * precio).toLocaleString('de-DE'))

        } 

        let isReal = ($(`#ingReal${month}`).html()) ? true : false
        
        let cantidadReal = Number($(`#insumoReal${idInsumo}_${month}`).text().replace(/\./g, '').replace('| ',''))
        let precioReal = Number($(`#insumoPrecioReal${idInsumo}_${month}`).text().replace(/\./g, '').replace('| ',''))

        if(isReal){
            $(`#insumo${idInsumo}RealContable_${month}`).html(` | ${(cantidadReal * precioReal).toLocaleString('de-DE')}`)
        }

        if (!total[idInsumo])
            total[idInsumo] = 0;
        
        total[idInsumo] += cantidad * precio;
       
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

    let updateContable = (selector, total, color,real = false) => {

        if ($(selector).html() == '0' || $(selector).html() == '') {

          $(selector).html($(`<span style="color:${color}">${(real) ? ' | ' : ''}${total.toLocaleString('de-DE')}</span>`));

        } else {

            let prevNumber = Number($(selector + ' span').text().replace(/\./g, '').replace('| ',''));
            $(selector).html($(`<span style="color:${color}">${(real) ? ' | ' : ''}${(prevNumber + total).toLocaleString('de-DE')}</span>`));

        }

    };
    
    const processPayment = (importe, aPagar, prefix, index,color = 'red',real = false) => {
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

    let totales = {}  

    let index = 1

    $('.contableReal').html('')

    $('.ingreso').each(function(){
        
        let isReal = ($(`#ingReal${index}`).html()) ? true : false

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
  
        let precioIngreso = Number($(this).parent().next().next().next().next().children().first().children().first().text().replace(/\./g, ''))
        let precioIngresoReal = Number($(this).parent().next().next().next().next().children().children().eq(1).text().replace(/\./g, '').replace('| ',''))

        let precioVenta = Number($(this).parent().next().next().next().next().children().first().text().replace(/\./g, ''))
        let precioVentaReal = Number($(this).parent().next().next().next().next().children().eq(1).children().eq(1).text().replace(/\./g, '').replace('| ',''))
  
        let aPagarIngreso = $(this).parent().next().next().next().next().next().children().first().children().first().children().first().text().replace(/\s+/g, '')
        let aPagarIngresoReal = $(this).parent().next().next().next().next().next().children().children().eq(1).children().first().text().replace(/\./g, '').replace('| ','').replace(/\s+/g, '')
        
        let aPagarVenta = $(this).parent().next().next().next().next().next().children().first().children().first().text().replace(/\s+/g, '')
        let aPagarVentaReal = $(this).parent().next().next().next().next().next().children().children().eq(1).children().eq(1).text().replace(/\./g, '').replace('| ','').replace(/\s+/g, '')
      
        index ++

        if ($(`#ingresoPlanContable${realMonth}`).html() == '')
            $(`#ingresoPlanContable${realMonth}`).html('0')

        if ($(`#ventaPlanContable${realMonth}`).html() == '')
            $(`#ventaPlanContable${realMonth}`).html('0')

        if(ingresos != 0){
            let total = (ingresos * kgIngreso) * precioIngreso
            processPayment(total,aPagarIngreso,`${tipo}Plan`,realMonth);
            
            if(!totales['Ingresos'])
                totales['Ingresos'] = 0
            
            totales['Ingresos'] += total
        }

        if(isReal){

            let total = (ingresosReal * kgIngresoReal) * precioIngresoReal

            if(!totales['ingresosReal'])
                totales['ingresosReal'] = 0

            totales['ingresosReal'] += total

            processPayment(total,aPagarIngresoReal, 'ingresoReal', realMonth, true , true);
            
        }

        if(ventas != 0){
            tipo = 'venta'
            let total = (ventas * kgVentas) * precioVenta
            processPayment(total,aPagarVenta,`${tipo}Plan`,realMonth,'green');

            if(!totales['Egresos'])
                totales['Egresos'] = 0
            
            totales['Egresos'] += total
        } 

        if(isReal){

            let total = (ventasReal * kgVentasReal) * precioVentaReal

            if(!totales['ventasReal'])
                totales['ventasReal'] = 0

            totales['ventasReal'] += total
            processPayment(total,aPagarVentaReal, 'ventaReal', realMonth, true , true);
            
        }
        
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

        if(importeIndirectoPlan != 0){

            if(!totales['EstructuraIndirecta'])
            totales['EstructuraIndirecta'] = 0

            totales['EstructuraIndirecta'] += importeIndirectoPlan

            processPayment(importeIndirectoPlan,aPagarIndirectoPlan, 'estructuraIndirecta', index);
        }

        if(importeGastosPlan != 0){

            if(!totales['GastosVarios'])
                totales['GastosVarios'] = 0

            totales['GastosVarios'] += importeGastosPlan

            processPayment(importeGastosPlan,aPagarGastosPlan, 'gastosVarios', index);
            
        }

        if(importeIngresosPlan != 0){

            if(!totales['IngresosExtraordinarios'])1
                totales['IngresosExtraordinarios'] = 0

            totales['IngresosExtraordinarios'] += importeIngresosPlan

            processPayment(importeIngresosPlan,aPagarIngresosPlan, 'ingresosExtra', index,'green');
    
        }

        if(isReal){
            if(!totales['EstructuraDirectaReal'])
                totales['EstructuraDirectaReal'] = 0

            totales['EstructuraDirectaReal'] += importeDirectoReal

            processPayment(importeDirectoReal,aPagarDirectoReal, 'estructuraDirectaReal', index, true , true);
            
    
            if(!totales['EstructuraIndirectaReal'])
            totales['EstructuraIndirectaReal'] = 0

            totales['EstructuraIndirectaReal'] += importeIndirectoReal
            processPayment(importeIndirectoReal,aPagarIndirectoReal, 'estructuraIndirectaReal', index, true, true);
     
            if(!totales['GastosVarios'])
                totales['GastosVarios'] = 0

            totales['GastosVarios'] += importeGastosReal

            processPayment(importeGastosReal,aPagarGastosReal, 'gastosVariosReal', index, true, true);
  
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
    let totalesFlujoReal = {}

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


    $('.flujoReal').each(function(){

        let value = Number($(this).text().replace(/\./g, '').replace('| ',''))

        let id = $(this).attr('id')

        let month = id.replace('ingresoRealContable','').replace('ventaRealContable','')

        if(!id.includes('ingresoRealContable') && !id.includes('ventaRealContable')){
            month = id.split('_')
            month = month[1]
        } 

        let isReal = ($(`#ingReal${month}`).html()) ? true : false

        if(month !== undefined){
        
            if (id.includes('ventaRealContable')) {
                if (!totalesFlujoReal[month]) {
                    totalesFlujoReal[month] = {};
                }
    
                if (!totalesFlujoReal[month]['positivo']) {
                    totalesFlujoReal[month]['positivo'] = 0;
                }
    
                totalesFlujoReal[month]['positivo'] += value;
                
            } else {
    
                if (!totalesFlujoReal[month]) {
                    totalesFlujoReal[month] = {};
                }
    
                if (!totalesFlujoReal[month]['negativo']) {
                    totalesFlujoReal[month]['negativo'] = 0;
                }
    
                totalesFlujoReal[month]['negativo'] += value;
    
            }

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
    
    let totalAccumReal = 0

    if(isReal){
        
        for (const key in totalesFlujoReal) {

            let resultado = totalesFlujoReal[key].positivo - totalesFlujoReal[key].negativo;
            totalAccumReal += resultado
    
            let color = (resultado < 0) ? 'red' : 'green'

            flujoMensualAcumRealContable1
            $(`#flujoMensualRealContable${key}`).text(` | ${resultado.toLocaleString('de-DE')}`)
            
            $(`#flujoMensualRealContable${key}`).css('color',color)
            $(`#flujoMensualRealContable${key}`).css('background-color','rgb(175, 206, 238,.25)')
            $(`#flujoMensualRealContable${key}`).css('padding','2px')


            color = (totalAccumReal < 0) ? 'red' : 'green'
            $(`#flujoMensualAcumRealContable${key}`).text(` | ${totalAccumReal.toLocaleString('de-DE')}`)
            $(`#flujoMensualAcumRealContable${key}`).css('color',color)
            $(`#flujoMensualAcumRealContable${key}`).css('background-color','rgba(175, 206, 238,.25)')
            $(`#flujoMensualAcumRealContable${key}`).css('padding','2px')

            
        }

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
    let totalesNetoReal = {}

    for (let index = 1; index <= 12; index++) {

        let directa = Number($(`#estructuraDirectaContable${index}`).text().replace(/\./g, ''))
        let indirecta = Number($(`#estructuraIndirectaContable${index}`).text().replace(/\./g, ''))
        let gastos = Number($(`#gastosVariosContable${index}`).text().replace(/\./g, ''))
        let ingresos = Number($(`#ingresosExtraContable${index}`).text().replace(/\./g, ''))
        let flujoMensual = Number($(`#flujoMensualContable${index}`).text().replace(/\./g, ''))
        
        let directaReal = Number($(`#estructuraDirectaRealContable${index}`).text().replace(/\./g, '').replace(' | ',''))
        let indirectaReal = Number($(`#estructuraIndirectaRealContable${index}`).text().replace(/\./g, '').replace(' | ',''))
        let gastosReal = Number($(`#gastosVariosRealContable${index}`).text().replace(/\./g, '').replace(' | ',''))
        let ingresosReal = Number($(`#ingresosExtraRealContable${index}`).text().replace(/\./g, '').replace(' | ',''))
        let flujoMensualReal = Number($(`#flujoMensualRealContable${index}`).text().replace(/\./g, '').replace(' | ',''))

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

        if(!totalesNetoReal[index])
            totalesNetoReal[index] = {}

        if(!totalesNetoReal[index]['positivo'])
            totalesNetoReal[index]['positivo'] = 0 

        if(!totalesNetoReal[index]['negativo'])
            totalesNetoReal[index]['negativo'] = 0 

        totalesNetoReal[index]['positivo'] += ingresosReal
        totalesNetoReal[index]['negativo'] += directaReal
        totalesNetoReal[index]['negativo'] += indirectaReal
        totalesNetoReal[index]['negativo'] += gastosReal

        totalesNetoReal[index]['flujoMensual'] = flujoMensualReal

    }

    for (const month in totalesNeto) {

        let resultado = (Number(totalesNeto[month]['positivo']) - Number(totalesNeto[month]['negativo'])) + totalesNeto[month]['flujoMensual']
        
        let resultadoReal = ((Number(totalesNetoReal[month]['flujoMensual']) + Number(totalesNetoReal[month]['positivo'])) - (Number(totalesNetoReal[month]['negativo'])))

        let color = (resultado < 0) ? 'red' : 'green'

        $(`#flujoNetoContable${month}`).text(resultado.toLocaleString('de-DE'))
        $(`#flujoNetoContable${month}`).css('color',color)
        
        color = (resultadoReal < 0) ? 'red' : 'green'

        $(`#flujoNetoRealContable${month}`).text(` | ${resultadoReal.toLocaleString('de-DE')}`)
        $(`#flujoNetoRealContable${month}`).css('color',color)
        $(`#flujoNetoRealContable${month}`).css('background-color','rgba(175, 206, 238,.25)')
        $(`#flujoNetoRealContable${month}`).css('padding','2px')


       
    }
}

// TODO: CALCULAR CONSUMO NECESARIO REAL
