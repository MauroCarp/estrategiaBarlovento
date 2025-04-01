
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

</script>


