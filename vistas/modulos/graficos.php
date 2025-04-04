
<div class="row">

    <div class="col-lg-6">
        
        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Stock / Saldos</h3>

                <div class="box-tools pull-right" bis_skin_checked="1">
                    <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modalStockSaldos" data-widget="zoom"><i class="fa fa-search-plus"></i>
                </div>

            </div>


            <div class="box-body">

                <div class="chart">

                    <canvas id="stockSaldosChart"></canvas>

                </div>

            </div>
        
        </div>

    </div>

    <div class="col-lg-6">

    <div class="box box-success">

        <div class="box-header with-border">

            <h3 class="box-title">Kg Promedio</h3>

        </div>


        <div class="box-body">

            <div class="chart">

                <canvas id="kgPromChart"></canvas>

            </div>

        </div>

    </div>

    </div>

</div>

<script>

    const btnsZoomGrafico = document.querySelectorAll('.zoomGraficos')

    btnsZoomGrafico.forEach(element => {

            element.addEventListener('click',()=>{

            switch (element.attributes['data-modal'].value) {
                case `zGraficoVentas${campo}`:
                    $(`#graficoVentaModal${campo}`).modal('show')

                break;
                
                case `zGraficoVentas2${campo}`:
                    $(`#graficoVenta2Modal${campo}`).modal('show')

                break;

                case `zGraficoMargenVentas${campo}`:
                    $(`#graficoMargenVentaModal${campo}`).modal('show')

                break;

                case `zGraficoGanaderia${campo}`:
                    $(`#graficoGanaderiaModal${campo}`).modal('show')

                break;

                case `zGraficoEndeudamiento${campo}`:
                    $(`#graficoDeudaBancariaModal${campo}`).modal('show')

                break;

                case `zGraficoSaldoIva${campo}`:
                    $(`#graficoSaldoIvaModal${campo}`).modal('show')
                    break;

                case `zGraficoSueldos12${campo}`:
                    $(`#graficoSueldo12Modal${campo}`).modal('show')
                    break;

                case `zGraficoSueldos12Honorarios${campo}`:
                    $(`#graficoSueldo12HonorarioModal${campo}`).modal('show')
                    break;

                case `zGraficoBienesDeCambio${campo}`:
                    $(`#graficoBienesDeCambioModal${campo}`).modal('show')
                    break;

                case `zGraficoBienesDeUso${campo}`:
                    $(`#graficoBienesDeUsoModal${campo}`).modal('show')
                    break;

                case `zGraficoCargasSociales${campo}`:
                    $(`#graficoCargasSocialesModal${campo}`).modal('show')
                    break;
            
                default:
                break;
            }
            
            })

    });

    let generarGraficoBar = (idDiv,configuracion,opcion,update = false)=>{

        let barChart = document.getElementById(idDiv).getContext('2d');      


        let grafico;

        switch (opcion) {
        case null:

            grafico = new Chart(barChart, opciones(configuracion))
            
            break;
            
        case 'atZero':
            
            grafico = new Chart(barChart, opcionesAtZero(configuracion))
            
            break;
            
        case 'skipFalse':
            
            grafico = new Chart(barChart, opcionesSkipFalse(configuracion))
            
            break;
        
        case 'noOption':
            if(!update){
                grafico = new Chart(barChart, configuracion)
            } else {
                update.update(); 
            }
    
            break;
            
        default:
            
            grafico = new Chart(barChart, opciones(configuracion))
        
            break;

        }

        window[idDiv] = grafico

        return grafico;

    }

    let generarGraficoEstrategia = (plan,real,divId,labels,typeChart,format = true, update = false)=>{

        if(format){

            plan = plan.substring(1).slice(0,-1)
            plan = JSON.parse(plan)
    
            if(real == 'null'){

                real = [] 

            } else {

                real = real.substring(1).slice(0,-1)
                real = JSON.parse(real)
            
            } 

            dataPlan = []
            dataReal = []
        
            for (const key in plan) {
                dataPlan.push(plan[key])
            }
            for (const key in real) {
                dataReal.push(real[key])
            }

        } else {
            dataPlan = plan
            dataReal = real
        }

        let configIngresos = {}

        if(!update){
            
            configIngresos = {
                type: typeChart,
                data: {
                    labels: labels,
                    datasets: [
                    {
                        label: 'Planificado',
                        borderColor: 'rgba(0,255,0,.8)',
                        backgroundColor: 'rgb(0,255,0)',
                        data: dataPlan
                    }
                    ,
                    {
                        label: 'Real',
                        borderColor: 'rgba(0,0,255,.8)',
                        backgroundColor: 'rgb(0,0,255)',
                        data: dataReal,
                    }
                    ]
                },
                options: {
                    scaleShowValues: true,
                    plugins: {
                        legend: {
                            labels: {
                            
                                boxWidth: 5, 
                            }
                        }
                    }
                }
                
            }

        } else {
            update.data.datasets[0].data = plan
        }
            
        return generarGraficoBar(divId,configIngresos,'noOption',update)

    }


    let generarGraficoEstrategiaInsumos = (stockPlan,saldoPlan,stockReal,saldoReal,divId,labels,insumosName,update = false)=>{

        dataStockPlan = {}

        for (const mes in stockPlan) {
            
            for (const insumo in stockPlan[mes]) {

                if(dataStockPlan[insumo] == undefined){

                    dataStockPlan[insumo] = [stockPlan[mes][insumo]]

                } else {

                    dataStockPlan[insumo].push(stockPlan[mes][insumo])
                }


            }

        }
        
        dataSaldoPlan = {}

        for (const mes in saldoPlan) {
            
            for (const insumo in saldoPlan[mes]) {

                if(dataSaldoPlan[insumo] == undefined){

                    dataSaldoPlan[insumo] = [saldoPlan[mes][insumo]]

                } else {

                    dataSaldoPlan[insumo].push(saldoPlan[mes][insumo])
                }


            }

        }

        dataSaldoReal = {}

        if(Object.keys(saldoReal).length > 0){

            for (const mes in saldoReal) {
                
                for (const insumo in saldoReal[mes]) {
        
                    if(dataSaldoReal[insumo] == undefined){
        
                        dataSaldoReal[insumo] = [saldoReal[mes][insumo]]
        
                    } else {
        
                        dataSaldoReal[insumo].push(saldoReal[mes][insumo])
                    }
        
        
                }
        
            }

        }

        dataStockReal = {}

        if(Object.keys(stockReal).length > 0){

            for (const mes in stockReal) {

                for (const insumo in stockReal[mes]) {

                    if(dataStockReal[insumo] == undefined){

                        dataStockReal[insumo] = [stockReal[mes][insumo]]

                    } else {

                        dataStockReal[insumo].push(stockReal[mes][insumo])
                    }


                }

            }

        }

        dataa = ''

        i = 0
        let colors = ['255,0,0','0,255,0','0,0,255','255,255,0','255,0,255','0,255,255','50,255,200','255,50,250']

        for (const key in dataStockPlan) {
        
            dataa += `{"type": "line","label": "Stock ${insumosName[key]} Plan","borderColor": "rgb(${colors[i]})","backgroundColor": "rgb(0,255,0)","data": [${dataStockPlan[key]}],"hidden":true},`

            i++
            
        }  

        i = 0

        for (const key in dataSaldoPlan) {
        
            dataa += `{"type": "bar","label": "Saldo ${insumosName[key]} Plan","borderColor": "rgb(0,100,10)","backgroundColor": "rgba(${colors[i]},.8)","borderWidth": "2","data": [${dataSaldoPlan[key]}],"hidden":true},`

            i++
            
        }  

        i = 0

        for (const key in dataSaldoReal) {
        
            dataa += `{"type": "bar","label": "Saldo ${insumosName[key]} Real","borderColor": "rgb(0,0,255)","backgroundColor": "rgba(${colors[i]},.5)","borderWidth": "2","data": [${dataSaldoReal[key]}],"hidden":true},`

            i++
            
        }  

        i = 0

        for (const key in dataStockReal) {
        
            dataa += `{"type": "line","label": "Stock ${insumosName[key]} Real","borderColor": "rgb(${colors[i]})","backgroundColor": "rgb(0,0,255)","data": [${dataStockReal[key]}],"hidden":true},`

            i++
            
        }  


        dataa = JSON.parse('[' + dataa.slice(0,-1) + ']')

        let config = {}

        if(!update){
            config = {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: 
                        dataa,
                    },
                    options: {
                        scaleShowValues: true,
                        plugins: {
                            legend: {
                                labels: {
                                
                                    boxWidth: 5, 
                                }
                            }
                        }
                    }
                }
        } else {
            update.data.datasets[0].data = dataa
        }
    
            
        return generarGraficoBar(divId,config,'noOption',update)


    }

    let chartIngresosPrueba = false;

    let calcularConsumos = async ()=>{
        console.log('calcularConsumos')
        await calculateStockAndTotals()

        // setTimeout(() => {
            
            //OBTENER LOS DATOS DE LA DIETA
            let dataEstrategia = '<?php echo json_encode($data['estrategia']);?>'
            let dataEstrategiaSeteado = '<?php echo $data['estrategia']['seteado'];?>'
            
            let labels = ['Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre','Enero','Febrero','Marzo','Abril']
    
            console.log(dataEstrategiaSeteado)
            if(dataEstrategiaSeteado == '0'){
    
                let idDieta = $('#dieta').val()
                console.log('entro por aca')
                if(idDieta != ''){
            
                    $.ajax({
                        method:'POST',
                        url:'ajax/estrategia.ajax.php',
                        data:{
                            idDieta:idDieta,
                            accion:'verDieta'
                        },
                        beforeSend:function(){
                            $('body').append($('<div id="overlay"><div class="overlay-content"><i class="fa fa-spinner fa-spin"></i> Cargando...</div></div>'))
                        },
                        success:function(resp){
                            console.log('respuesta del ajax')
                            let insumos = JSON.parse(resp)
    
                            // INGRESOS
    
                                let dataIngresos = []
    
                                $('.ingreso').each(function(){
    
                                    dataIngresos.push($(this).val())
    
                                })
    
                                let divId = 'ingresosChart'
    
                                if(typeof window.chartIngresos !== undefined && !window.chartIngresos)
                                    window.chartIngresos = generarGraficoEstrategia(dataIngresos,[],divId,labels,'bar',false)
                                else
                                    generarGraficoEstrategia(dataIngresos,[],divId,labels,'bar',false,window.chartIngresos)
    
                                console.log('deberia haber generado los charts de ingresos')
                            // VENTAS
    
                                let dataVentas = []
    
                                $('.venta').each(function(){
    
                                    dataVentas.push($(this).val())
    
                                })
    
                                divId = 'egresosChart'
    
                                if(typeof window.chartEgresos !== undefined && !window.chartEgresos)
                                    window.chartEgresos = generarGraficoEstrategia(dataVentas,[],divId,labels,'bar',false)
                                else
                                    generarGraficoEstrategia(dataVentas,[],divId,labels,'bar',false,window.chartEgresos)
                                
                            
                            // KG PROM
                                let dataKgProm = []
    
                                $('.kgPromPlan').each(function(){
    
                                    dataKgProm.push(Number($(this).html()))
    
                                })
    
                                divId = 'kgPromChart'
    
                                if(typeof window.chartKgProm !== undefined && !window.chartKgProm)
                                    window.chartKgProm = generarGraficoEstrategia(dataKgProm,[],divId,labels,'line',false)
                                else
                                    generarGraficoEstrategia(dataKgProm,[],divId,labels,'line',false,window.chartKgProm)
                                
    
                            // SALDOS Y STOCK
    
                            let dataConsumos = {'planificado':[]}
    
                            let index = 1
    
                            $('.kgPromPlan').each(function(){
    
                                let kgProm = Number($(this).html()) 
                                let consMS = Number($(`#consumoMSPlan${index}`).html()) 
                                dataConsumos['planificado'].push({'kgProm':kgProm,'consMS':consMS})
                                index++
    
                            })
    
                            let consumoDeInsumos = {'planificado':{},'real':{}}
    
                            for (let index = 0; index <= 11; index++) {
                                // INDEX = MESES
                                let kgProm = dataConsumos['planificado'][index]['kgProm']
                                let consMS = dataConsumos['planificado'][index]['consMS']
    
                                let stockMesPlan = Number($(`#stockPlan${index + 1}`).html())
    
                                consumoDeInsumos['planificado'][index] = {}
    
                                for (const key in insumos) {
                                    
                                    let consumoInsumo = (insumos[key]['porcentaje'] * consMS) / 100 
    
    
                                    consumoDeInsumos['planificado'][index][insumos[key]['idInsumo']] = {
                                                                                    'consumo':consumoInsumo,
                                                                                    'consumoTotal': consumoInsumo * stockMesPlan * 30 //dias del mes
                                                                                }
    
                                }
    
                            }
    
    
                            let stockInicialInsumosData = [] 
    
                            $('.stockInsumosModal').each(function(){
    
                                let idInsumo = $(this).attr('idInsumo')
                                let cant = $(this).val()
    
                                stockInicialInsumosData.push({[idInsumo]:cant})
    
                            })
    
                            const stockInicialInsumos = stockInicialInsumosData.reduce((acc, obj) => {
                                const key = Object.keys(obj)[0]; // Obtener la clave del objeto
                                const value = obj[key]; // Obtener el valor asociado a esa clave
                                acc[key] = value; // Asignar al acumulador el nuevo par clave-valor
                                return acc; // Devolver el acumulador
                            }, {});
                            
                            let compraInsumos = {}
    
                            $('.compraInsumos').each(function(){
    
                                let masterId = $(this).attr('id').replace('insumo','').replace('[]','')
    
                                let id = $(this).attr('id-insumo')
    
                                let header = masterId.replace(/\d+/g, "")
    
                                if(typeof compraInsumos[id] === 'undefined'){
                                    compraInsumos[id] = {};
                                }
    
                                if(typeof compraInsumos[id][header] === 'undefined'){
                                    compraInsumos[id][header] = [];
                                }
    
                                compraInsumos[id][header].push($(this).val());
    
                            })
    
                            for (const key in compraInsumos) {
                                
                                if(key == 'Ingreso')
                                    compraInsumos[key][0] = Number(compraInsumos[key][0]) + Number(stockInicialInsumos[key])  
    
                            }
    
                            let stock = {'planificado':{}}
    
                            let saldo = {'planificado':{}}
    
                            for (const insumo in compraInsumos) {
                                
                                for (const header in compraInsumos[insumo]) {
    
                                    if(header == 'Ingreso'){
    
                                        for (const mes in compraInsumos[insumo][header]) {
    
                                            if(stock.planificado[mes] == undefined){
    
                                                stock.planificado[mes] = {}
                                                saldo.planificado[mes] = {}
    
    
                                                if(mes == 0){
    
                                                    stock.planificado[mes][insumo] = Number(stockInicialInsumos[insumo]) + Number(compraInsumos[insumo][header][mes])
                                                    saldo.planificado[mes][insumo] = Number(stock.planificado[mes][insumo]) - Number(consumoDeInsumos['planificado'][mes][insumo]['consumoTotal'])
    
                                                } else {
    
                                                    stock.planificado[mes][insumo] = Number(saldo.planificado[mes - 1][insumo]) + Number(compraInsumos[insumo][header][mes])
                                                    saldo.planificado[mes][insumo] = Number(stock.planificado[mes][insumo]) - Number(consumoDeInsumos['planificado'][mes][insumo]['consumoTotal'])
    
                                                }
    
                                            } else {
    
                                                if(mes == 0){
    
                                                    stock.planificado[mes][insumo] = Number(stockInicialInsumos[insumo]) + Number(compraInsumos[insumo][header][mes])
                                                    saldo.planificado[mes][insumo] = Number(stock.planificado[mes][insumo]) - Number(consumoDeInsumos['planificado'][mes][insumo]['consumoTotal'])
    
                                                } else {
    
                                                    stock.planificado[mes][insumo] = Number(saldo.planificado[mes - 1][insumo]) + Number(compraInsumos[insumo][header][mes])
                                                    saldo.planificado[mes][insumo] = Number(stock.planificado[mes][insumo]) - Number(consumoDeInsumos['planificado'][mes][insumo]['consumoTotal'])
    
                                                }
    
                                            }
    
                                        }
    
                                    }
    
                                }
    
                            }
    
                            let insumosNameId = {}
    
                            for (const key in insumos) {
    
                                insumosNameId[insumos[key]['idInsumo']] = insumos[key]['insumo']
                                
                            }
    
                            if(typeof window.chartSaldosStock == undefined || !window.chartSaldosStock){
    
                                divId = 'stockSaldosChart'  
                                window.chartSaldosStock = generarGraficoEstrategiaInsumos(stock['planificado'],saldo['planificado'],[],[],divId,labels,insumosNameId)
    
                                divId = 'stockSaldosZoomChart'
                                window.chartSaldosStockZoom = generarGraficoEstrategiaInsumos(stock['planificado'],saldo['planificado'],[],[],divId,labels,insumosNameId)
    
                            } else {
    
                                divId = 'stockSaldosChart'
    
                                window.chartSaldosStock.destroy()
    
                                window.chartSaldosStock = generarGraficoEstrategiaInsumos(stock['planificado'],saldo['planificado'],[],[],divId,labels,insumosNameId)
    
                                divId = 'stockSaldosZoomChart'
    
                                window.chartSaldosStockZoom.destroy()
    
                                window.chartSaldosStockZoom = generarGraficoEstrategiaInsumos(stock['planificado'],saldo['planificado'],[],[],divId,labels,insumosNameId)
    
                            }
        
                        }
                        
            
                    })
    
                    $('#overlay').remove()
    
                } else {
                    
                    new swal({
            
                        type: "error",
                        title: "Se debe seleccionar una Dieta",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
            
                    })
                    .then(()=>{
                        $('a[href="#estrategia"]').click()
                        $('#overlay').remove()
                    });
                }
    
            } else {
    
                // INGRESOS
                    let ingresosPlan = '<?php echo json_encode($data['estrategia']['ingresosPlan']);?>'
                    let ingresosReal = '<?php echo json_encode($data['estrategia']['ingresosReal']);?>'
                    let divId = 'ingresosChart'
    
                    generarGraficoEstrategia(ingresosPlan,ingresosReal,divId,labels,'bar')
    
                // EGRESOS
                
                    let egresosPlan = '<?php echo json_encode($data['estrategia']['egresosPlan']);?>'
                    let egresosReal = '<?php echo json_encode($data['estrategia']['ventasReal']);?>'
    
                    divId = 'egresosChart'
    
                    generarGraficoEstrategia(egresosPlan,egresosReal,divId,labels,'bar')
    
                // KG PROM
    
                    let kgPromPlan = []
                    let kgPromReal = []
                    
                    for (let index = 0; index <= 11; index++) {
    
                        kgPromPlan.push($(`#kgPromPlan${index + 1}`).html())
    
                        if($(`#kgPromReal${index + 1}`).html() != '')
                            kgPromReal.push($(`#kgPromReal${index + 1}`).html().replace(' | ',''))
                        
                    }
    
                    divId = 'kgPromChart'
    
                    generarGraficoEstrategia(kgPromPlan,kgPromReal,divId,labels,'line',false)
    
                // STOCK Y SALDOS 
    
    
                    // PLANIFICACION 
    
                    let insumos = '<?php echo json_encode(explode(',',str_replace(']','',str_replace('[','',$data['estrategia']['insumos'])))); ?>'
    
                    let porcentajes = '<?php echo json_encode(explode(',',str_replace('[','',str_replace(']','',($data['estrategia']['porcentajes']))))); ?>'
    
                    insumos = JSON.parse(insumos)
                    porcentajes = JSON.parse(porcentajes)
    
                    let insumosPorcentaje = {}
    
                    for (const key in insumos) {
                
                        insumosPorcentaje[insumos[key]] = porcentajes[key]
    
                    }
    
                    // DIETA REAL
    
                    let insumosPorcentajeReal = '<?php echo json_encode($data['estrategia']['dietaReal']);?>'
    
                    if(insumosPorcentajeReal != '' && insumosPorcentajeReal != 'null'){
    
                        insumosPorcentajeReal = JSON.parse(insumosPorcentajeReal.substring(1).slice(0,-1))
    
                    } else {
    
                        insumosPorcentajeReal = []
                    
                    }
    
                    let dataInsumos = {'planificado':[]}
    
                    let index = 1
    
                    $('.kgPromPlan').each(function(){
    
                        let kgProm = Number($(this).html()) 
                        let consMS = Number($(`#consumoMSPlan${index}`).html()) 
                        dataInsumos['planificado'].push({'kgProm':kgProm,'consMS':consMS})
                        index++
    
                    })
    
                    index = 1
    
                    let a = []
    
                    $('.kgPromReal').each(function(){
    
                        let kgProm = $(this).html()
                        let consMS = $(`#consumoMSReal${index}`).html() 
    
                        if(kgProm != ''){
    
                            kgProm = Number(kgProm.replace('| ','')) 
                            consMS = Number(consMS.replace('| ','')) 
            
                            a.push({'kgProm':kgProm,'consMS':consMS})
    
                        }
    
                        index++
    
                    })
    
                    dataInsumos['real'] = a
    
                    
                    let consumoDeInsumos = {'planificado':{},'real':{}}
    
                    for (let index = 0; index <= 11; index++) {
                        // INDEX = MESES
                        let kgProm = dataInsumos['planificado'][index]['kgProm']
                        let consMS = dataInsumos['planificado'][index]['consMS']
    
                        let stockMesPlan = Number($(`#stockPlan${index + 1}`).html())
    
                        let kgPromReal = dataInsumos['real']?.index?.['kgProm']
                        let consMSReal = dataInsumos['real']?.[index]?.['consMS']
                        let stockMesReal = $(`#stockReal${index + 1}`).html()
    
    
                        consumoDeInsumos['planificado'][index] = {}
    
                        for (const key in insumosPorcentaje) {
                            
                            let consumoInsumo = (insumosPorcentaje[key] * consMS) / 100 
    
    
                            consumoDeInsumos['planificado'][index][key] = {
                                                                            'consumo':consumoInsumo,
                                                                            'consumoTotal': consumoInsumo * stockMesPlan * 30 //dias del mes
                                                                        }
    
                        }
    
                        if(stockMesReal != '' && stockMesReal != null){
    
                            consumoDeInsumos['real'][index] = {}
    
                            stockMesReal = Number(stockMesReal.replace('| ',''))
    
                            for (const key in insumosPorcentajeReal) {
    
    
                                for (const i in insumosPorcentajeReal[key]) {
                                
                                    let consumoInsumoReal = (insumosPorcentajeReal[key][i] * consMSReal) / 100 
                                    
                                        consumoDeInsumos['real'][index][i] = {
                                                                                'consumo':consumoInsumoReal,
                                                                                'consumoTotal': consumoInsumoReal * stockMesReal * 30 //dias del mes
                                                                                }
                                }
                                
                            }
    
                        }
    
                    }
    
                    let stockInicialInsumosData = '<?php echo json_encode($data['estrategia']['stockInsumos']); ?>'
    
                    stockInicialInsumosData = stockInicialInsumosData.substring(1).slice(0,-1)
                    stockInicialInsumosData = JSON.parse(stockInicialInsumosData)
    
                    const stockInicialInsumos = stockInicialInsumosData.reduce((acc, obj) => {
                        const key = Object.keys(obj)[0]; // Obtener la clave del objeto
                        const value = obj[key]; // Obtener el valor asociado a esa clave
                        acc[key] = value; // Asignar al acumulador el nuevo par clave-valor
                        return acc; // Devolver el acumulador
                    }, {});
    
                    compraInsumos = '<?php echo json_encode($data['estrategia']['compraInsumosKey'],JSON_NUMERIC_CHECK)?>'
    
                    compraInsumos = JSON.parse(compraInsumos,(key,value)=>{
                        if(key == '1'){
                            return String(value - 100000)
                        } else {
                            return value
                        }
                    })
       
                    let dataCompraInsumos = compraInsumos
        
                    for (const key in compraInsumos) {
                        
                        dataCompraInsumos[key][1] = Number(dataCompraInsumos[key][1]) + Number(stockInicialInsumos[key])  
    
                    }
    
                    compraInsumosReal = '<?php echo json_encode($data['estrategia']['compraInsumosKeyReal'])?>'
    
                    compraInsumosReal = JSON.parse(compraInsumosReal)
    
                    let dataCompraInsumosReal = JSON.parse(JSON.stringify(compraInsumosReal))
    
                    let stock = {'planificado':{},
                                'real':{}
                                }
    
                    let saldo = {'planificado':{},
                                    'real':{}
                                }
                                
                    let dataCompraInsumosCorrec = {};
                    let mapping = [5, 6, 7, 8, 9, 10, 11, 12, 1, 2, 3, 4]; // Mapeo de propiedades

                    for (let key in dataCompraInsumos) {

                        for (let i = 1; i <= 12; i++) {
                            
                            if(dataCompraInsumosCorrec[key] == undefined){
                                dataCompraInsumosCorrec[key] = {}
                            }

                            dataCompraInsumosCorrec[key][i] =  dataCompraInsumos[key][mapping[i - 1]];
                        }
                    }

                    for (const insumo in dataCompraInsumosCorrec) {
    
                        for (const mes in dataCompraInsumosCorrec[insumo]) {
                            
                            if(stock.planificado[mes] == undefined){
    
                                stock.planificado[mes] = {}
                                saldo.planificado[mes] = {}
    
                                if(stock.planificado[mes][insumo] == undefined){

                                    if(mes == 1){
                                        
                                        stock.planificado[mes][insumo] = Number(stockInicialInsumos[insumo]) + Number(dataCompraInsumosCorrec[insumo][mes])
                                        saldo.planificado[mes][insumo] = Number(stock.planificado[mes][insumo]) - Number(consumoDeInsumos['planificado'][mes - 1][insumo]['consumoTotal'])
        
                                    } else {
        
                                        stock.planificado[mes][insumo] = Number(saldo.planificado[mes - 1][insumo]) + Number(dataCompraInsumosCorrec[insumo][mes])
                                        saldo.planificado[mes][insumo] = Number(stock.planificado[mes][insumo]) - Number(consumoDeInsumos['planificado'][mes - 1][insumo]['consumoTotal'])

        
                                    }
                                    
                                }
    
                            } else {
                                
                                if(mes == 1){
    
                                    stock.planificado[mes][insumo] = Number(stockInicialInsumos[insumo]) + Number(dataCompraInsumosCorrec[insumo][mes])
        
                                    saldo.planificado[mes][insumo] = Number(stock.planificado[mes][insumo]) - Number(consumoDeInsumos['planificado'][mes - 1][insumo]['consumoTotal'])
    
                                } else {
    
                                    stock.planificado[mes][insumo] = Number(saldo.planificado[mes - 1][insumo]) + Number(dataCompraInsumosCorrec[insumo][mes])
    
                                    saldo.planificado[mes][insumo] = Number(stock.planificado[mes][insumo]) - Number(consumoDeInsumos['planificado'][mes - 1][insumo]['consumoTotal'])
    
                                }
    
                            }
    
                        }
    
                    }
                    
                    for (const insumo in dataCompraInsumosReal) {
                        
                        for (const mes in dataCompraInsumosReal[insumo]) {

                            if(stock.real[mes] == undefined){
    
                                stock.real[mes] = {}
                                saldo.real[mes] = {}
    
                                if(mes == 0){
    
                                    
                                    stock.real[mes][insumo] = Number(stockInicialInsumos[insumo]) + Number(dataCompraInsumosReal[insumo][mes])
                                    saldo.real[mes][insumo] = (consumoDeInsumos['real'][mes] == undefined) ? 0 : Number(stock.real[mes][insumo]) - Number(consumoDeInsumos['real'][mes][insumo]['consumoTotal'])
    
                                } else {
    
                                    stock.real[mes][insumo] = Number(saldo.real[mes][insumo]) + Number(dataCompraInsumosReal[insumo][mes])
                                    saldo.real[mes][insumo] = (consumoDeInsumos['real'][mes] == undefined) ? 0 : Number(stock.real[mes][insumo]) - Number(consumoDeInsumos['real'][mes][insumo]['consumoTotal'])
    
                                }
    
                            } else {
    
                                if(mes == 0){
    
                                    stock.real[mes][insumo] = Number(stockInicialInsumos[insumo]) + Number(dataCompraInsumosReal[insumo][mes])
                                    saldo.real[mes][insumo] = (consumoDeInsumos['real'][mes] == undefined) ? 0 : Number(stock.real[mes][insumo]) - Number(consumoDeInsumos['real'][mes][insumo]['consumoTotal'])
    
                                } else {
    
                                    stock.real[mes][insumo] = Number(saldo.real[mes][insumo]) + Number(dataCompraInsumosReal[insumo][mes])
                                    saldo.real[mes][insumo] = (consumoDeInsumos['real'][mes] == undefined) ? 0 : Number(stock.real[mes][insumo]) - Number(consumoDeInsumos['real'][mes][insumo]['consumoTotal'])
    
    
                                }
    
                            }
                        }
    
                    }
    
                    let insumosName = '<?php echo json_encode($data['estrategia']['compraInsumos']);?>'
    
                    let i = 0
    
                    insumosName =  Object.keys(JSON.parse(insumosName))
    
                    let insumosNameId = {}
    
                    for (const key in compraInsumos) {
    
                        insumosNameId[key] = insumosName[i]
                        
                        i++
    
                    }
    
                    divId = 'stockSaldosChart'
    
                    generarGraficoEstrategiaInsumos(stock['planificado'],saldo['planificado'],stock['real'],saldo['real'],divId,labels,insumosNameId)
    
                    divId = 'stockSaldosZoomChart'
    
                    generarGraficoEstrategiaInsumos(stock['planificado'],saldo['planificado'],stock['real'],saldo['real'],divId,labels,insumosNameId)
    
            }

        // }, 2000);

    }

</script>


