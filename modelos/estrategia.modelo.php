<?php

require_once "conexion.php";

class ModeloEstrategia{

	/*=============================================
	MOSTRAR Datos
	=============================================*/

	static public function mdlMostrarInsumos($tabla,$id = null){

		if($id == null){

			$stmt = Conexion::conectarEstrategia()->prepare("SELECT * FROM $tabla ORDER BY insumo ASC");
	
			$stmt -> execute();
	
			return $stmt -> fetchAll();

		} else {

			$stmt = Conexion::conectarEstrategia()->prepare("SELECT id,insumo FROM $tabla WHERE id IN ($id) ORDER BY id ASC");
			// $stmt -> bindParam(":id", $id, PDO::PARAM_STR);

			$stmt -> execute();
	
			return $stmt -> fetchAll();

		}

		
	}

	static public function mdlMostrarDietas($tabla,$idDieta = null){

		if($idDieta == null){

			$stmt = Conexion::conectarEstrategia()->prepare("SELECT * FROM $tabla ORDER BY nombre ASC");
	
			$stmt -> execute();
	
			return $stmt -> fetchAll();

		} else {

			$stmt = Conexion::conectarEstrategia()->prepare("SELECT * FROM $tabla WHERE id = :id");
			$stmt -> bindParam(":id", $idDieta, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();

		}
		
	}

	static public function mdlMostrarEstrategia($tabla,$campania){

		if($campania == 'campanias'){

			$stmt = Conexion::conectarEstrategia()->prepare("SELECT campania FROM $tabla ORDER BY created_at DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		} else {

			if($campania != null){

				$stmt = Conexion::conectarEstrategia()->prepare("SELECT * FROM $tabla 
													INNER JOIN movimientoscereales ON $tabla.id = movimientoscereales.idEstrategia 
													INNER JOIN movimientosanimales ON $tabla.id = movimientosanimales.idEstrategia 
													INNER JOIN movimientosestructura ON $tabla.id = movimientosestructura.idEstrategia 
													INNER JOIN dietas ON $tabla.idDieta = dietas.id 
													WHERE $tabla.campania = :campania");

				$stmt -> bindParam(":campania", $campania, PDO::PARAM_STR);
				
			} else {
				$stmt = Conexion::conectarEstrategia()->prepare("SELECT * FROM $tabla 
				INNER JOIN movimientoscereales ON $tabla.id = movimientoscereales.idEstrategia 
				INNER JOIN movimientosanimales ON $tabla.id = movimientosanimales.idEstrategia 
				INNER JOIN movimientosestructura ON $tabla.id = movimientosestructura.idEstrategia 
				INNER JOIN dietas ON $tabla.idDieta = dietas.id 
				WHERE $tabla.id = (select MAX($tabla.id) from $tabla)");
				

			}

			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt -> execute();

			return $stmt -> fetch();

		}
	
		
	}

	/*=============================================
	MOSTRAR Datos ANUAL
	=============================================*/

	static public function mdlMostrarDatosAnual($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectarEstrategia()->prepare("SELECT * FROM $tabla WHERE YEAR($item) IN ($valor)");

			$stmt -> execute();
			
			return $stmt -> fetchAll();
			
		}else{
			
			$stmt = Conexion::conectarEstrategia()->prepare("SELECT * FROM $tabla ORDER BY periodoTime");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
	}


	static public function mdlSetearCampania($tabla,$data,$guardar){


		$stmt = Conexion::conectarEstrategia()->prepare("UPDATE $tabla SET idDieta = :idDieta, stockInsumos = :stockInsumos, adpPlan = :adpPlan, msPlan = :msPlan, stockAnimales = :stockAnimales, stockKgProm = :stockKgProm, seteado = :seteado WHERE campania = :campania");

		$stmt -> bindParam(":idDieta", $data['idDieta'], PDO::PARAM_STR);
		$stmt -> bindParam(":stockInsumos", $data['stockInsumos'], PDO::PARAM_STR);
		$stmt -> bindParam(":adpPlan", json_encode($data['adp']), PDO::PARAM_STR);
		$stmt -> bindParam(":msPlan", json_encode($data['msPorce']), PDO::PARAM_STR);
		$stmt -> bindParam(":stockAnimales", $data['stockAnimales'], PDO::PARAM_STR);
		$stmt -> bindParam(":stockKgProm", $data['stockKgProm'], PDO::PARAM_STR);
		$stmt -> bindParam(":campania", $data['campania'], PDO::PARAM_STR);
		$seteado = $guardar == true ? 0 : 1;
		$stmt -> bindParam(":seteado", $seteado, PDO::PARAM_STR);
				
		if($stmt -> execute()){

			$selectStmt = Conexion::conectarEstrategia()->prepare("SELECT id FROM $tabla WHERE campania = :campania");
			$selectStmt->bindParam(":campania", $data['campania'], PDO::PARAM_STR);
			$selectStmt->execute();
		
			// Retornar los datos del registro actualizado
			return $selectStmt->fetch(PDO::FETCH_ASSOC);
		
		}else{

			return $stmt->errorInfo();
		
		};


	}

	static public function mdlSetearAnimales($tabla,$data){


		$stmt = Conexion::conectarEstrategia()->prepare("INSERT INTO $tabla(ingresosPlan, kgIngresosPlan,precioKgIngresosPlan,aPagarIngresosPlan, egresosPlan, kgEgresosPlan,preciokgEgresosPlan,aPagarEgresosPlan, idEstrategia) VALUES(:ingresosPlan, :kgIngresosPlan, :precioKgIngresosPlan,:aPagarIngresosPlan, :egresosPlan, :kgEgresosPlan,:preciokgEgresosPlan,:aPagarEgresosPlan,:idEstrategia)");


		$stmt -> bindParam(":ingresosPlan", json_encode($data['ingresos']), PDO::PARAM_STR);
		$stmt -> bindParam(":kgIngresosPlan", json_encode($data['kgIngresos']), PDO::PARAM_STR);
		$stmt -> bindParam(":precioKgIngresosPlan", json_encode($data['precioKgIngresos']), PDO::PARAM_STR);
		$stmt -> bindParam(":aPagarIngresosPlan", json_encode($data['aPagarIngresos']), PDO::PARAM_STR);
		$stmt -> bindParam(":egresosPlan", json_encode($data['ventas']), PDO::PARAM_STR);
		$stmt -> bindParam(":kgEgresosPlan", json_encode($data['kgVentas']), PDO::PARAM_STR);
		$stmt -> bindParam(":preciokgEgresosPlan", json_encode($data['precioKgVentas']), PDO::PARAM_STR);
		$stmt -> bindParam(":aPagarEgresosPlan", json_encode($data['aPagarVentas']), PDO::PARAM_STR);
		$stmt -> bindParam(":idEstrategia", $data['idEstrategia'], PDO::PARAM_STR);

				
		if($stmt -> execute()){
		
			return 'ok';
		
		}else{

			return $stmt->errorInfo();
		
		};


	}

	static public function mdlSetearInsumos($tabla,$data){

		$stmt = Conexion::conectarEstrategia()->prepare("INSERT INTO $tabla(cerealesPlan,precioPlan,idEstrategia) VALUES(:cerealesPlan,:precioPlan,:idEstrategia)");

		$stmt -> bindParam(":cerealesPlan",json_encode($data['insumos']['cantidad']),PDO::PARAM_STR);
		$stmt -> bindParam(":precioPlan",json_encode($data['insumos']['precio']),PDO::PARAM_STR);
		$stmt -> bindParam(":idEstrategia",$data['idEstrategia'], PDO::PARAM_STR);

		if($stmt -> execute()){
		
			return 'ok';
		
		}else{

			return $stmt->errorInfo();
		
		};


	}

	static public function mdlSetearEstructura($tabla,$data){


		$stmt = Conexion::conectarEstrategia()->prepare("INSERT INTO $tabla(idEstrategia,directaImportePlan,indirectaImportePlan,gastosImportePlan,ingresosImportePlan,directaApagarPlan,indirectaApagarPlan,gastosApagarPlan,ingresosApagarPlan) VALUES(:idEstrategia,:directaImportePlan,:indirectaImportePlan,:gastosImportePlan,:ingresosImportePlan,:directaApagarPlan,:indirectaApagarPlan,:gastosApagarPlan,:ingresosApagarPlan)");

		$stmt -> bindParam(":idEstrategia",$data['idEstrategia'], PDO::PARAM_STR);
		$stmt -> bindParam(":directaImportePlan",json_encode($data['estructuraDirecto_importe']),PDO::PARAM_STR);
		$stmt -> bindParam(":indirectaImportePlan",json_encode($data['estructuraIndirecto_importe']),PDO::PARAM_STR);
		$stmt -> bindParam(":gastosImportePlan",json_encode($data['gastosVarios_importe']),PDO::PARAM_STR);
		$stmt -> bindParam(":ingresosImportePlan",json_encode($data['ingresosExtraordinarios_importe']),PDO::PARAM_STR);
		$stmt -> bindParam(":directaApagarPlan",json_encode($data['estructuraDirecto_aPagar']),PDO::PARAM_STR);
		$stmt -> bindParam(":indirectaApagarPlan",json_encode($data['estructuraIndirecto_aPagar']),PDO::PARAM_STR);
		$stmt -> bindParam(":gastosApagarPlan",json_encode($data['gastosVarios_aPagar']),PDO::PARAM_STR);
		$stmt -> bindParam(":ingresosApagarPlan",json_encode($data['ingresosExtraordinarios_aPagar']),PDO::PARAM_STR);

		if($stmt -> execute()){
		
			return 'ok';
		
		}else{

			return $stmt->errorInfo();		
		
		};


	}

	static public function mdlEliminarDieta($tabla,$id){

		$stmt = Conexion::conectarEstrategia()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $id, PDO::PARAM_STR);
				
		if($stmt -> execute()){
		
			return 'ok';
		
		}else{

			return $stmt->errorInfo();
		
		};


	}

	static public function mdlNuevaDieta($tabla,$data){

		$stmt = Conexion::conectarEstrategia()->prepare("INSERT INTO $tabla(nombre,insumos,porcentajes) VALUES(:nombre,:insumos,:porcentajes)");

		$stmt -> bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
		$stmt -> bindParam(":insumos", $data['insumos'], PDO::PARAM_STR);
		$stmt -> bindParam(":porcentajes", $data['porcentajes'], PDO::PARAM_STR);
				
		if($stmt -> execute()){
		
			return 'ok';
		
		}else{

			return $stmt->errorInfo();
		
		};


	}

	static public function mdlInsumosReal($tabla,$data){


		$stmt = Conexion::conectarEstrategia()->prepare("UPDATE $tabla SET cerealesReal = :cerealesReal,precioReal = :precioReal WHERE idEstrategia = :idEstrategia");

		$stmt -> bindParam(":cerealesReal", json_encode($data['cerealesReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":precioReal", json_encode($data['precioCerealesReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":idEstrategia", $data['idEstrategia'], PDO::PARAM_STR);
				
		if($stmt -> execute()){
		
			// Retornar los datos del registro actualizado
			return 'ok';
		
		}else{

			return $stmt->errorInfo();
		
		};


	}

	static public function mdlEstructuraReal($tabla,$data){


		$stmt = Conexion::conectarEstrategia()->prepare("UPDATE $tabla SET 
		directaImporteReal = :directaImporteReal,
		directaApagarReal = :directaApagarReal,
		indirectaImporteReal = :indirectaImporteReal,
		indirectaApagarReal = :indirectaApagarReal,
		gastosImporteReal = :gastosImporteReal,
		gastosApagarReal = :gastosApagarReal,
		ingresosImporteReal = :ingresosImporteReal,
		ingresosApagarReal = :ingresosApagarReal 
		WHERE idEstrategia = :idEstrategia");
		$stmt -> bindParam(":directaImporteReal", json_encode($data['estructuraDirectaImporteReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":directaApagarReal", json_encode($data['estructuraDirectaAPagarReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":indirectaImporteReal", json_encode($data['estructuraIndirectaImporteReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":indirectaApagarReal", json_encode($data['estructuraIndirectaAPagarReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":gastosImporteReal", json_encode($data['gastosVariosImporteReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":gastosApagarReal", json_encode($data['gastosVariosPagarReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":ingresosImporteReal", json_encode($data['ingresoExtraImporteReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":ingresosApagarReal", json_encode($data['ingresoExtraAPagarReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":idEstrategia", $data['idEstrategia'], PDO::PARAM_STR);
				
		if($stmt -> execute()){
		
			// Retornar los datos del registro actualizado
			return 'ok';
		
		}else{

			return $stmt->errorInfo();
		
		};


	}

	static public function mdlEstrategiaReal($tabla,$data){


		$stmt = Conexion::conectarEstrategia()->prepare("UPDATE $tabla SET dietaReal = :dietaReal, adpReal = :adpReal, msReal = :msReal WHERE id = :id");

		$stmt -> bindParam(":dietaReal", json_encode($data['dietaReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":adpReal", json_encode($data['adpReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":msReal", json_encode($data['msReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":id", $data['idEstrategia'], PDO::PARAM_STR);
		
		if($stmt -> execute()){
		
			// Retornar los datos del registro actualizado
			return 'ok';
		
		}else{

			return $stmt->errorInfo();
		
		};


	}

	static public function mdlAnimalesReal($tabla,$data){

		$stmt = Conexion::conectarEstrategia()->prepare("UPDATE $tabla SET ingresosReal = :ingresosReal, kgIngresosReal = :kgIngresosReal,precioKgIngresosReal = :precioKgIngresosReal,aPagarIngresosReal = :aPagarIngresosReal, ventasReal = :ventasReal, kgVentasReal = :kgVentasReal, precioKgEgresosReal = :precioKgEgresosReal,aPagarEgresosReal = :aPagarEgresosReal WHERE idEstrategia = :idEstrategia");

		$stmt -> bindParam(":ingresosReal", json_encode($data['ingresosReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":kgIngresosReal", json_encode($data['kgIngresosReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":precioKgIngresosReal", json_encode($data['precioKgIngresoReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":aPagarIngresosReal", json_encode($data['aPagarIngresoReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":ventasReal", json_encode($data['ventasReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":kgVentasReal", json_encode($data['kgVentasReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":precioKgEgresosReal", json_encode($data['precioKgVentaReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":aPagarEgresosReal", json_encode($data['aPagarVentaReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":idEstrategia", $data['idEstrategia'], PDO::PARAM_STR);
				
		if($stmt -> execute()){
		
			// Retornar los datos del registro actualizado
			return 'ok';
		
		}else{

			return $stmt->errorInfo();
		
		};


	}

	static public function mdlNuevaCampania($tabla,$campania){
		
		$stmt = Conexion::conectarEstrategia()->prepare("INSERT INTO $tabla(campania) VALUES(:campania)");

		$campanias = $campania . '/' . ($campania + 1);

		$stmt -> bindParam(":campania", $campanias , PDO::PARAM_STR);
		
		if($stmt -> execute()){
		
			return 'ok';
		
		}else{

			return $stmt->errorInfo();
		
		};
	}

}
