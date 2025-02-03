<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=estrategiaBarlovento",
			            "root",
			            "root");

		$link->exec("set names utf8");

		return $link;

	}

	static public function conectarEstrategia(){

		$link = new PDO("mysql:host=localhost;dbname=estrategiaBarlovento",
			            "root",
			            "root");

		$link->exec("set names utf8");

		return $link;

	}

}