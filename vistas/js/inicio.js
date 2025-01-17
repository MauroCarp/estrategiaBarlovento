
// CAMBIAR ESTILO ULTIMA COLUMNA TABLA CLASIFICACION

const rows = document.querySelectorAll('.tablaClasificacion tbody tr')

for (const row of rows) {
    
     row.lastElementChild.style.textAlign = 'center'

}

// ALTO SECCION CARPETAS ACTIVAS

let altoSeccionDestino = document.getElementById('seccionDestino')

if(altoSeccionDestino != null){
     
     let altoPantalla = window.innerHeight
     
     let divCarpetas = document.getElementById('divCarpetas')
     if(divCarpetas != null){

          divCarpetas.style.height = `${altoPantalla - altoSeccionDestino.clientHeight - 280}px`
     
     }
}


