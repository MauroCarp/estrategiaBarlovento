<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=c2701336_estra",
			            "c2701336_estra",
			            "99LUnirawa");

		$link->exec("set names utf8");

		return $link;

	}

	static public function conectarEstrategia(){

		$link = new PDO("mysql:host=localhost;dbname=c2701336_estra",
			            "c2701336_estra",
			            "99LUnirawa");

		$link->exec("set names utf8");

		return $link;

	}

}