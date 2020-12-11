<?php

require_once("util.php");

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && substr($_SERVER["HTTP_REFERER"], 0, strlen(HOST)) != HOST) {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Não enviou nenhum dado
if(empty($_POST)) {
	header("Location: ../index.php");
	return false;
}

// Limpa os campos
$cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

// Verifica se o usuário informou os dados corretos
$consulta = "select * from usuarios where cpf='" . $cpf . "' and senha='" . md5($senha) . "';";
$usuario = mysql($consulta);

// O CPF e a senha informada correspondem com o banco de dados
if(count($usuario) > 0) {
	$_SESSION["id"] = $usuario["id"];
	// Salva o horário de início do questionário

	// Pesquisa se o usuário já respondeu o formulário
	$consulta = "select * from respostas where usuario=" . $_SESSION["id"] . ";";
	if(count(mysql($consulta)) == 0) {
		$consulta = "insert into respostas(usuario, inicio, fim) values (" . $_SESSION["id"] . ", '" . date("Y-m-d H:m:i") . "', NULL);";
		mysql($consulta);
		header("Location: ../formulario-0.php");
		return true;
	}
	else {
		header("Location: ../final.php");
		return true;
	}
}
// Os dados informados estão inválidos
else {
	header("Location: ../index.php?mensagem=Os+dados+informados+estão+incorretos%2C+verifique+o+CPF+e+a+senha.");
	return false;
}
?>