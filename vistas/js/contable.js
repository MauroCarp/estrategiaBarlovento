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

});

$('#modalEstrategiaEstructura').on('hidden.bs.modal', function () {

    calcularEstructuraContable();

    $('.estructura').each(function(){

        let id = $(this).attr('id')

        let idExplode = id.split('_')
        
        $(`input[name=${id}]`).val($(this).val())
        $(`input[name=${idExplode[0]}_aPagar_${idExplode[2]}]`).val($(`#${idExplode[0]}_aPagar_${idExplode[2]}`).val())


    })

});

$('#modalEstrategiaIngEgr').on('hidden.bs.modal', function () {
    calcularAnimalesContable();
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

        const updateContable = (selector, total,color = 'green') => {
            if ($(selector).html() == '' || $(selector).html() == '0') {
            $(selector).html($(`<span style="color:${color}">${total.toLocaleString('de-DE')}</span>`));
            } else {
            let prevNumber = Number($(selector + ' span').text().replace(/\./g, ''));
            $(selector).html($(`<span style="color:${color}">${(prevNumber + total).toLocaleString('de-DE')}</span>`));
            }
        };


        if (ingresos != 0) {

            let month = (Number(realMonth) + Number(aPagarIngreso) - 1) % 12 + 1;
            
            let total = (ingresos * kgIngreso) * precioIngreso;

            updateContable(`#ingresoPlanContable${month}`, total,'red');

            if(!totales['Ingresos']){
                totales['Ingresos'] = 0
            }

            totales['Ingresos'] += total

        }

        if (ventas != 0) {

            let month = (Number(realMonth) + Number(aPagarVenta) - 1) % 12 + 1;

            let total = (ventas * kgVenta) * precioVenta;

            updateContable(`#ventaPlanContable${month}`, total);

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

function calcularFlujoDeFondoMensual() {
    // Obtener la tabla
    let tabla = document.getElementById('tablaContable');
    let filas = tabla.getElementsByTagName('tr');

    // Variables para almacenar las filas específicas
    let filaIngresosPorVentas;
    let filaFlujoDeFondoMensual;

    // Buscar las filas específicas
    for (let i = 0; i < filas.length; i++) {
        let primeraCelda = filas[i].getElementsByTagName('td')[0];
        if (primeraCelda) {
            if (primeraCelda.innerText === 'Ingresos por Ventas') {
                filaIngresosPorVentas = filas[i];
            } else if (primeraCelda.innerText === 'Flujo de Fondo Mensual') {
                filaFlujoDeFondoMensual = filas[i];
            }
        }
    }

    // Asegurarse de que ambas filas se encontraron
    if (!filaIngresosPorVentas || !filaFlujoDeFondoMensual) {
        console.error('No se encontraron las filas necesarias.');
        return;
    }

    // Obtener las celdas de la fila de 'Ingresos por Ventas' y 'Flujo de Fondo Mensual'
    let celdasIngresosPorVentas = filaIngresosPorVentas.getElementsByTagName('td');
    let celdasFlujoDeFondoMensual = filaFlujoDeFondoMensual.getElementsByTagName('td');

    // Recorrer cada columna (empezando desde la segunda celda)
    for (let col = 1; col < celdasFlujoDeFondoMensual.length; col++) {
        let suma = 0;

        // Recorrer las filas hacia arriba desde 'Flujo de Fondo Mensual' hasta 'Ingresos por Ventas'
        for (let fila = filaFlujoDeFondoMensual.rowIndex - 1; fila > filaIngresosPorVentas.rowIndex; fila--) {
            let celda = filas[fila].getElementsByTagName('td')[col];
            if (celda) {
                let valor = parseFloat(celda.innerText.replace(/\./g, '').replace(',', '.'));
                if (!isNaN(valor)) {
                    suma += valor;
                }
            }
        }

        // Obtener el valor de 'Ingresos por Ventas' para esta columna
        let valorIngresosPorVentas = parseFloat(celdasIngresosPorVentas[col].innerText.replace(/\./g, '').replace(',', '.'));
        if (isNaN(valorIngresosPorVentas)) {
            valorIngresosPorVentas = 0;
        }

        // Calcular el flujo de fondo mensual
        let flujoDeFondoMensual = valorIngresosPorVentas - suma;

        // Colocar el resultado en la celda correspondiente de 'Flujo de Fondo Mensual'
        celdasFlujoDeFondoMensual[col].innerText = flujoDeFondoMensual.toLocaleString('de-DE');
    }
}

