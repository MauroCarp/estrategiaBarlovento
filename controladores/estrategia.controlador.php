<?php
class ControladorEstrategia{

	/*=============================================
	MOSTRAR DATOS
	=============================================*/

	static public function buscarInsumoPorId($id, $array) {

		foreach ($array as $item) {

			if ($item['id'] == $id) {

				return $item['insumo'];

			}

		}
		
		return null; // Si no se encuentra el id, devolver null o un valor por defecto

	}

	static public function ctrMostrarInsumos(){

		$tabla = "insumos";

		$respuesta = ModeloEstrategia::mdlMostrarInsumos($tabla);

		return $respuesta;

	}

    static public function ctrMostrarDietas(){

		$tabla = "dietas";

		$respuesta = ModeloEstrategia::mdlMostrarDietas($tabla);

		return $respuesta;

	}

	static public function ctrMostrarDieta($idDieta){

		$tabla = "dietas";

		$respuesta = ModeloEstrategia::mdlMostrarDietas($tabla,$idDieta);

		$idInsumos = implode(',',json_decode($respuesta['insumos']));

		$porcentajes = json_decode($respuesta['porcentajes']);

		$insumos = ModeloEstrategia::mdlMostrarInsumos('insumos',$idInsumos);

		$data = array();

		foreach (json_decode($respuesta['insumos']) as $key => $value) {
			
			$data[] = array('insumo'=>ControladorEstrategia::buscarInsumoPorId($value,$insumos),'idInsumo'=>$value,'porcentaje'=>$porcentajes[$key]);

		}

		return $data;

	}

	static public function ctrMostrarEstrategia($campania = null){
		
		$tabla = "estrategias";

		$respuesta = ModeloEstrategia::mdlMostrarEstrategia($tabla,$campania);

		
		$insumos = ControladorEstrategia::ctrMostrarInsumos();
		
		if(!is_null($respuesta['cerealesPlan']) && $respuesta['cerealesPlan']){	

			$arr_cerealesPlan = json_decode($respuesta['cerealesPlan'],true);

			ksort($arr_cerealesPlan);

			foreach ($arr_cerealesPlan as $key => $value) {
	
				$insumoCompra = ControladorEstrategia::buscarInsumoPorId($key,$insumos);
	
				$respuesta['compraInsumos'][$insumoCompra] = $value;
				$respuesta['compraInsumosKey'][$key] = $value;
	
			}

		}
		

		if(!is_null($respuesta['cerealesReal'])){

			$arr_cerealesRealData = json_decode($respuesta['cerealesReal'],true);

			ksort($arr_cerealesRealData);

			$arr_cerealesReal = array();

			foreach ($arr_cerealesRealData as $key => $value) {
				
				foreach ($value as $insumo => $valor) {
		
					$arr_cerealesReal[$insumo][] = $valor;

				}

			}
			

			foreach ($arr_cerealesReal as $key => $value) {
				
				
				$insumoCompra = ControladorEstrategia::buscarInsumoPorId($key,$insumos);
				

				$respuesta['compraInsumosReal'][$insumoCompra] = $value;
				$respuesta['compraInsumosKeyReal'][$key] = $value;
	
			}

		}

		
		
		$campanias = ModeloEstrategia::mdlMostrarEstrategia($tabla,'campanias');

		return array('estrategia'=>$respuesta,'campanias'=>$campanias);

	}

	static public function ctrSetearEstrategia(){

		// var_dump($_POST);
		// die;
		if(isset($_POST['btnSetear'])){
		
			$ingresos = array();
			$kgIngresos = array();
			$precioIngresos = array();
			$aPagarIngresos = array();
			$ventas = array();
			$kgVentas = array();
			$precioVentas = array();
			$aPagarVentas = array();
			$insumos = array();

		
			foreach ($_POST as $key => $value) {

				if(strpos($key,'insumoIngreso') === 0){

					$toFormat = str_replace('insumoIngreso','',$key);
					$idInsumo = substr($toFormat, 0, 2);
					$month = substr($toFormat, 2);

					$insumos[$idInsumo][$month]['cantidad'] = $value;		

				}

				if(strpos($key,'insumoPrecio') === 0){

					$toFormat = str_replace('insumoPrecio','',$key);
					$idInsumo = substr($toFormat, 0, 2);
					$month = substr($toFormat, 2);

					$insumos[$idInsumo][$month]['precio'] = $value;		

				}

				if(strpos($key,'insumoAPagar') === 0){

					$toFormat = str_replace('insumoAPagar','',$key);
					$idInsumo = substr($toFormat, 0, 2);
					$month = substr($toFormat, 2);

					$insumos[$idInsumo][$month]['aPagar'] = $value;		

				}

				if(strpos($key,'ingreso') === 0 && strpos($key,'kg') !== 0){
					$ingresos[str_replace('ingreso','',$key)] = $value;		
				}

				if(strpos($key,'kgIngreso') === 0){
					$kgIngresos[str_replace('kgIngreso','',$key)] = $value;		
				}

				if(strpos($key,'venta') === 0 && strpos($key,'kg') !== 0){
					$ventas[str_replace('venta','',$key)] = $value;		
				}

				if(strpos($key,'kgVenta') === 0){
					$kgVentas[str_replace('kgVenta','',$key)] = $value;		
				}

				if(strpos($key,'precioKgIngreso') === 0){
					$precioIngresos[str_replace('precioKgIngreso','',$key)] = $value;		
				}

				if(strpos($key,'precioKgVenta') === 0){
					$precioVentas[str_replace('precioKgVenta','',$key)] = $value;		
				}

				if(strpos($key,'aPagarIngreso') === 0){
					$aPagarIngresos[str_replace('aPagarIngreso','',$key)] = $value;		
				}

				if(strpos($key,'aPagarVenta') === 0){
					$aPagarVentas[str_replace('aPagarVenta','',$key)] = $value;		
				}


			}

			$data = array('stockInsumos'=>$_POST['stockInsumos'],
						  'stockAnimales'=>$_POST['stockAnimales'],
						  'stockKgProm'=>$_POST['stockKgProm'],
						  'idDieta'=>$_POST['dieta'],
						  'adp'=>$_POST['adpv'],
						  'msPorce'=>$_POST['porcentMS'],
						  'campania'=>$_POST['selectCampania']);

			$idEstrategia = ControladorEstrategia::ctrSetearCampania($data);

			$dataAnimales = array('idEstrategia'=>$idEstrategia['id'],
								  'ingresos'=>$ingresos,
								  'kgIngresos'=>$kgIngresos,
								  'precioKgIngresos'=>$precioIngresos,
								  'aPagarIngresos'=>$aPagarIngresos,
								  'ventas'=>$ventas,
								  'kgVentas'=>$kgVentas,
	                   			  'precioKgVentas'=>$precioVentas,
								  'aPagarVentas'=>$aPagarVentas);
			
			$setearAnimales = ControladorEstrategia::ctrSetearAnimales($dataAnimales);
			
			$dataInsumos = array('idEstrategia'=>$idEstrategia['id'],'insumos'=>$insumos);
	
			$setearInsumos = ControladorEstrategia::ctrSetearInsumos($dataInsumos);
		
			if($setearAnimales == 'ok' && $setearInsumos == 'ok'){

				echo'<script>

					Swal.fire({
					position: "top-end",
					icon: "success",
					title: "Estrategia seteada correctamente",
					showConfirmButton: false,
					timer: 2500
					})
					.then(function(){
						window.location = "index.php?ruta=inicio&campania=' . $_POST['selectCampania'] . '";
					});
				

				</script>';
				
			}else{

			
			}

		}

	}

	static public function ctrSetearCampania($data){

		$tabla = 'estrategias';

		return ModeloEstrategia::mdlSetearCampania($tabla,$data);

	}

	static public function ctrSetearAnimales($data){

		$tabla = 'movimientosanimales';

		return ModeloEstrategia::mdlSetearAnimales($tabla,$data);

	}

	static public function ctrSetearInsumos($data){

		$tabla = 'movimientoscereales';

		return ModeloEstrategia::mdlSetearInsumos($tabla,$data);

	}

	static public function ctrEliminarDieta($id){

		$tabla = 'dietas';

		return ModeloEstrategia::mdlEliminarDieta($tabla,$id);

	}

	static public function ctrNuevaDieta(){
		
		if(isset($_POST['btnNuevaDieta'])){

			$tabla = 'dietas';

			$insumos = implode(',',$_POST['insumo']);
			$porcentajeInsumo = implode(',',$_POST['porcentajeInsumo']);

			$data = array('nombre'=>$_POST['nombreDieta'],'insumos'=>'[' . $insumos . ']','porcentajes'=>'[' . $porcentajeInsumo . ']');

			$respuesta = ModeloEstrategia::mdlNuevaDieta($tabla,$data);
	
			if($respuesta != 'ok'){

				echo'<script>

					Swal.fire({
					position: "top-end",
					icon: "error",
					 title: `Hubo un problema al cargar la dieta!';

                        if($_SESSION['usuario'] == 'tecnicoEstrategia'){
                            echo json_encode($respuesta);
                        }

                        echo '`,
					showConfirmButton: false,
					timer: 2500
					})
					.then(function(){
						window.location = "index.php?ruta=estrategia";
					});
				

				</script>';

            } else {

				echo'<script>

					Swal.fire({
					position: "top-end",
					icon: "success",
					title: "La Dieta ha sido cargada correctamente",
					showConfirmButton: false,
					timer: 2500
					})
					.then(function(){
						window.location = "index.php?ruta=estrategia";
					});
				

				</script>';

            
			}

		}

		

	}

	static public function ctrCargaReal(){

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
				var_dump($_POST);
			$month = $_POST['month'];

			$campania = $_POST['campaniaReal'];

			$dataEstrategia = ControladorEstrategia::ctrMostrarEstrategia($campania);

			$dataKeys = ['msReal', 'adpReal', 'ingresosReal', 'kgIngresosReal','precioKgIngresoReal','aPagarIngresoReal', 'ventasReal', 'kgVentasReal','precioKgVentaReal','aPagarVentaReal','dietaReal'];
			$data = [];

			foreach ($dataKeys as $key) {

				if (!is_null($dataEstrategia['estrategia'][$key])) {
					$data[$key] = json_decode($dataEstrategia['estrategia'][$key], true);
				} else {
					$data[$key] = [];
				}

				$data[$key][$month] = $_POST[$key];

			}

			$data['cerealesReal'] = (!is_null($dataEstrategia['estrategia']['cerealesReal']) && $dataEstrategia['estrategia']['cerealesReal'] != 'null') ? json_decode($dataEstrategia['estrategia']['cerealesReal'],true) : array();

			foreach ($_POST as $key => $value) {

				if(strpos($key,'dietaReal') === 0){

					$index = str_replace('dietaReal','',$key);

					$data['dietaReal'][$month][$index] = $value;

				}

	
				if(strpos($key,'insumoReal') === 0){

					$index = str_replace('insumoReal','',$key);

					$data['cerealesReal'][$month][$index] = $value;

				}
				
				if(strpos($key,'precioInsumoReal') === 0){

					$index = str_replace('precioInsumoReal','',$key);

					$data['precioCerealesReal'][$month][$index] = $value;

				}

			}

			$data['idEstrategia'] = $dataEstrategia['estrategia']['idEstrategia'];
	
			var_dump($data);
			die;
			$estrategiaReal = ModeloEstrategia::mdlEstrategiaReal('estrategias',$data);
			$cerealesReal = ModeloEstrategia::mdlInsumosReal('movimientoscereales',$data,'cerealesReal');
			$animalesReal = ModeloEstrategia::mdlAnimalesReal('movimientosanimales',$data);
			
			if($estrategiaReal == 'ok' && $cerealesReal == 'ok' && $animalesReal == 'ok'){

				echo'<script>

					Swal.fire({
					position: "top-end",
					icon: "success",
					title: "Estrategia Real mes de ' . ControladorEstrategia::getMonthName($month) . ' seteado correctamente.",
					showConfirmButton: false,
					timer: 2500
					})
					.then(function(){
						window.location = "index.php?' . $campania . '";
					});
				

				</script>';

			} else {

				echo'<script>

					Swal.fire({
					position: "top-end",
					icon: "error",
					title:  "Hubo un error en el seteo del mes de ' . ControladorEstrategia::getMonthName($month) . '",
					showConfirmButton: false,
					timer: 2500
					})
					.then(function(){
						window.location = "index.php?ruta=inicio&campania=' . $campania . '";
					});
			

				</script>';
			}
			

			
		}

	}

	static public function ctrNuevaCampania(){

		$tabla = 'estrategias';

		if(isset($_POST['btnNuevaCampania'])){

			$campania = $_POST['campania'];

			$buscarCampania = $campania . "/" . ($campania + 1);
			
			$campanias = ModeloEstrategia::mdlMostrarEstrategia($tabla,'campanias');

			if(empty($campanias) || !in_array($buscarCampania,$campanias[0])){

				$resultado = ModeloEstrategia::mdlNuevaCampania($tabla,$campania);

				if($resultado == 'ok'){

					$url = "index.php?ruta=inicio&asd=asd&campania=" . urlencode($buscarCampania);

					echo'<script>
						console.log("' . $url .'")
						Swal.fire({
						position: "top-end",
						icon: "success",
						title: "Estrategia creada correctamente.",
						showConfirmButton: false,
						timer: 2500
						})
						.then(function(){
							window.location = "' . $url . '";
						});
					

					</script>';
	
				}

			} else {

				echo'<script>

					Swal.fire({
					position: "top-end",
					icon: "error",
					title: "Estrategia de campaña duplicada.",
					showConfirmButton: false,
					timer: 2500
					})
					.then(function(){
						window.location = "index.php?ruta=estrategia";
					});
				

				</script>';
			}

		}

	}

	static public function getMonthName($numberMonth){

		$meses = array(1=>'Mayo',2=>'Junio',3=>'Julio',4=>'Agosto',5=>'Septiembre',6=>'Octubre',7=>'Noviembre',8=>'Diciembre',9=>'Enero',10=>'Febrero',11=>'Marzo',12=>'Abril');

		return $meses[$numberMonth];		
	
	}

}
	


