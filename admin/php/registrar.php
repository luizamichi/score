<?php

require_once("../../php/util.php");

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && substr($_SERVER["HTTP_REFERER"], 0, strlen(HOST . "admin/registrar.php")) != HOST . "admin/registrar.php") {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Não enviou nenhum dado
if(empty($_POST) && !isset($_POST["cpf"]) && !isset($_POST["senha"])) {
	header("Location: ../registrar.php");
	return false;
}

// Usuário não está autenticado
if(empty($_SESSION) && !isset($_SESSION["id"])) {
	header("Location: ../index.php");
	return false;
}

// Verifica se o usuário existe
$consulta = "select id from usuarios where cpf='" . $_POST["cpf"] . "';";
$usuario = mysql($consulta);

// Usuário já cadastrado
if(count($usuario) > 0) {
	header("Location: ../registrar.php?mensagem=Usuário+já+está+cadastrado+no+sistema.");
	return false;
}
// Insere os dados
else {
	// Insere o usuário
	$consulta = "insert into usuarios(cpf, senha) values ('" . $_POST["cpf"] . "', '" . md5($_POST["senha"]) . "');";
	// Salva no banco de dados
	$envio = mysql($consulta);

	// Recupera o último usuário
	$consulta = "select * from usuarios where cpf='" . $_POST["cpf"] . "';";
	$usuario = mysql($consulta);

	// Insere a senha original
	$consulta = "insert into senhas(usuario, senha, horario) values (" . $usuario["id"] . ", '" . $_POST["senha"] . "', '" . date("Y-m-d H:i:s") . "');";
	// Salva no banco de dados
	$envio = mysql($consulta);

	header("Location: ../registrar.php?mensagem=Usuário+cadastrado+com+sucesso.");
}
return true;
?>