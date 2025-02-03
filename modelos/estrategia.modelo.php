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
													INNER JOIN dietas ON $tabla.idDieta = dietas.id 
													WHERE $tabla.campania = :campania");

				$stmt -> bindParam(":campania", $campania, PDO::PARAM_STR);
				
			} else {

				$stmt = Conexion::conectarEstrategia()->prepare("SELECT * FROM $tabla 
				INNER JOIN movimientoscereales ON $tabla.id = movimientoscereales.idEstrategia 
				INNER JOIN movimientosanimales ON $tabla.id = movimientosanimales.idEstrategia 
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


	static public function mdlSetearCampania($tabla,$data){


		$stmt = Conexion::conectarEstrategia()->prepare("UPDATE $tabla SET idDieta = :idDieta, stockInsumos = :stockInsumos, adpPlan = :adpPlan, msPlan = :msPlan, stockAnimales = :stockAnimales, stockKgProm = :stockKgProm, seteado = 1 WHERE campania = :campania");

		$stmt -> bindParam(":idDieta", $data['idDieta'], PDO::PARAM_STR);
		$stmt -> bindParam(":stockInsumos", $data['stockInsumos'], PDO::PARAM_STR);
		$stmt -> bindParam(":adpPlan", json_encode($data['adp']), PDO::PARAM_STR);
		$stmt -> bindParam(":msPlan", json_encode($data['msPorce']), PDO::PARAM_STR);
		$stmt -> bindParam(":stockAnimales", $data['stockAnimales'], PDO::PARAM_STR);
		$stmt -> bindParam(":stockKgProm", $data['stockKgProm'], PDO::PARAM_STR);
		$stmt -> bindParam(":campania", $data['campania'], PDO::PARAM_STR);
				
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


		$stmt = Conexion::conectarEstrategia()->prepare("INSERT INTO $tabla(ingresosPlan, kgIngresosPlan,precioKgIngresosPlan,aPagarIngresosPlan, egresosPlan, kgEgresosPlan,preciokgEgresosPlan,aPagarEgresosPlan, idEstrategia) VALUES(:ingresosPlan, :kgIngresosPlan, :precioKgIngresosPlan, :aPagarIngresosPlan, :egresosPlan, :kgEgresosPlan,:preciokgEgresosPlan,:aPagarEgresosPlan,:idEstrategia)");


		$stmt -> bindParam(":ingresosPlan", json_encode($data['ingresos']), PDO::PARAM_STR);
		$stmt -> bindParam(":kgIngresosPlan", json_encode($data['kgIngresos']), PDO::PARAM_STR);
		$stmt -> bindParam(":preciokgIngresosPlan", json_encode($data['kgIngresos']), PDO::PARAM_STR);
		$stmt -> bindParam(":aPagarIngresosPlan", json_encode($data['kgIngresos']), PDO::PARAM_STR);
		$stmt -> bindParam(":egresosPlan", json_encode($data['ventas']), PDO::PARAM_STR);
		$stmt -> bindParam(":kgEgresosPlan", json_encode($data['kgVentas']), PDO::PARAM_STR);
		$stmt -> bindParam(":idEstrategia", $data['idEstrategia'], PDO::PARAM_STR);
				
		if($stmt -> execute()){
		
			return 'ok';
		
		}else{

			return $stmt->errorInfo();
		
		};


	}

	static public function mdlSetearInsumos($tabla,$data){


		$stmt = Conexion::conectarEstrategia()->prepare("INSERT INTO $tabla(cerealesPlan, idEstrategia) VALUES(:cerealesPlan,:idEstrategia)");

		$stmt -> bindParam(":cerealesPlan",json_encode($data['insumos']),PDO::PARAM_STR);
		$stmt -> bindParam(":idEstrategia",$data['idEstrategia'], PDO::PARAM_STR);

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


		$stmt = Conexion::conectarEstrategia()->prepare("UPDATE $tabla SET cerealesReal = :cerealesReal WHERE idEstrategia = :idEstrategia");

		$stmt -> bindParam(":cerealesReal", json_encode($data['cerealesReal']), PDO::PARAM_STR);
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

		$stmt = Conexion::conectarEstrategia()->prepare("UPDATE $tabla SET ingresosReal = :ingresosReal, kgIngresosReal = :kgIngresosReal, ventasReal = :ventasReal, kgVentasReal = :kgVentasReal WHERE idEstrategia = :idEstrategia");

		$stmt -> bindParam(":ingresosReal", json_encode($data['ingresosReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":kgIngresosReal", json_encode($data['kgIngresosReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":ventasReal", json_encode($data['ventasReal']), PDO::PARAM_STR);
		$stmt -> bindParam(":kgVentasReal", json_encode($data['kgVentasReal']), PDO::PARAM_STR);
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
