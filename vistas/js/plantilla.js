/*=============================================
EXISTE ELEMENTO
=============================================*/
const  isInPage = node=>{

	return (node === document.body) ? false : document.body.contains(node);

}

/*=============================================
GET COOKIE
=============================================*/

const getCookie = cname=>{
	
	let name = cname + "=";
	
	let decodedCookie = decodeURIComponent(document.cookie);
	
	let ca = decodedCookie.split(';');
	
	for(let i = 0; i <ca.length; i++) {
	  let c = ca[i];
	  while (c.charAt(0) == ' ') {
		c = c.substring(1);
	  }
	
	  if (c.indexOf(name) == 0) {
		return c.substring(name.length, c.length);
	  }
	
	}
	
	return null;
  
}

/*=============================================
PRIMER LETRA MAYUSCULAS
=============================================*/

const capitalizarPrimeraLetra = (str)=>{

	return str.charAt(0).toUpperCase() + str.slice(1);

}

/*=============================================
SideBar Menu
=============================================*/

$('.sidebar-menu').tree()

/*=============================================
Data Table
=============================================*/

$(".tablas").DataTable({
	"ordering": false,
	"searching": false,
	"lengthChange": false,
	"pageLength" : 10,
	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		}

	}


});

/*=============================================
 //iCheck for checkbox and radio inputs
=============================================*/

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
})

/*=============================================
 //input Mask
=============================================*/

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

/*=============================================
CORRECCIÓN BOTONERAS OCULTAS BACKEND	
=============================================*/

// if(window.matchMedia("(max-width:767px)").matches){
	
	// $("body").removeClass('sidebar-collapse');

// }

/*=============================================
MENU ENLACE DIRECTOS A ARCHIVOS EN CARPETAS	
=============================================*/

const redireccionarMenu = (seccion)=>{

	window.location =  `index.php?ruta=${seccion}`;

}

const getQueryVariable = variable => {

	var query = window.location.search.substring(1);
  
	var vars = query.split("&");
  
	for (var i=0; i < vars.length; i++) {
  
		var pair = vars[i].split("=");
  
		if(pair[0] == variable) {
  
			return pair[1];
  
		}
  
	}
  
	return false;
  
}

const sumarFecha = (fecha,dato,cantidad) =>{

	fecha = fecha.split('-');

	let año = fecha[0];

	let mes = fecha[1];

	let dia = fecha[2];

	let nuevaFecha;

	if(dato == 'mes')	
		nuevaFecha = `${año}-${parseFloat(mes) + parseFloat(cantidad)}-${dia}`;
		
	if(dato == 'año')
		nuevaFecha = `${parseFloat(año) + parseFloat(cantidad)}-${mes}-${dia}`;

	return nuevaFecha;

}

const formatearFecha = fecha =>{

	return fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');

}

/*=============================================
RUTA
=============================================*/

const seccionURL = getQueryVariable('ruta');

/*=============================================
GENERAR SELECT
=============================================*/	

const cargarSelect = (params)=>{

	let url = `fetch/${params.fetchUrl}.fetch.php`

	let formData = new FormData()

	formData.append('accion',params.accion)

	fetch(url,{
		method:'post',
		body:formData
	}).then(resp=>resp.json())
	.then(respuesta=>{

		document.getElementById(params.idSelect).innerHTML = ''

		options = document.createDocumentFragment()

		respuesta.map(option=>{		
			
			let opt = document.createElement('OPTION')
			
			opt.setAttribute('value',option[params.value])
			opt.innerText = option[params.optText]
			
			options.append(opt)
			
		})
				
		document.getElementById(params.idSelect).appendChild(options)

	})
	.catch(er => console.log(er))
	
}

const selectCarpetas = ()=>{
	
	let url = `fetch/carpetas.fetch.php`

	let formData = new FormData()
	formData.append('accion','mostrarActivas')

	fetch(url,{
		method:'post',
		body:formData
	}).then(resp=>resp.json())
	.then(respuesta=>{

		let opts = respuesta.map(carpeta=>{

			if(carpeta.descripcion != 'Sin destino'){

				return `<option value='${carpeta.idCarpeta}-${carpeta.tipo}'>${carpeta.descripcion}</option>`
			}
			
		})

		opts.unshift(`<option value=''>Seleccionar</option>`)

		let selects = document.querySelectorAll('.selectCarpetasActivas')

		for (const select of selects) {
			
			select.innerHTML = opts

		}

	})
	.catch(err=>console.log(err))
}

