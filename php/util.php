<?php

date_default_timezone_set("America/Sao_Paulo");

if(session_status() != PHP_SESSION_ACTIVE)
	session_start();

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

define("HOST", "http://localhost/score/");

function mysql(string $consulta, bool $multiple=false, string $index="") {
	$mysqli = new mysqli("localhost", "root", "@irTalent2020", "score");

	// Falha na conexão do banco
	if ($mysqli->connect_errno)
		exit();

	$instancia = $mysqli->query($consulta);
	$resultado = [];

	// Operação de SELECT múltipla
	if(substr($consulta, 0, 6) == "select" && !$multiple)
		while($dados = $instancia->fetch_array(MYSQLI_ASSOC))
			foreach($dados as $chave => $valor)
				$resultado[$chave] = $valor;
	// Operação de SELECT
	elseif(substr($consulta, 0, 6) == "select")
		while($dados = $instancia->fetch_array(MYSQLI_ASSOC)) {
			$registro = [];
			foreach($dados as $chave => $valor)
				$registro[$chave] = $valor;
			array_push($resultado, $registro);
		}
	// Operação de UPDATE
	elseif(substr($consulta, 0, 6) == "update")
		$resultado = $instancia;
	// Operação de INSERT ou DELETE
	else
		$resultado = $instancia;

	if($index != "") {
		$array = [];
		foreach ($resultado as $r)
			array_push($array, $r[$index]);
		$resultado = $array;
	}

	return $resultado;
}

function die_dump($variavel) {
	var_dump($variavel);
	die();
}
?>