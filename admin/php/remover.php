<?php

require_once("../../php/util.php");

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && substr($_SERVER["HTTP_REFERER"], 0, strlen(HOST . "admin/remover.php")) != HOST . "admin/remover.php") {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Não enviou nenhum dado
if(empty($_POST) && !isset($_POST["cpf"])) {
	header("Location: ../remover.php");
	return false;
}

// Usuário não está autenticado
if(empty($_SESSION) && !isset($_SESSION["id"])) {
	header("Location: ../index.php");
	return false;
}

// Verifica se o usuário existe
$consulta = "select * from usuarios where cpf='" . $_POST["cpf"] . "';";
$usuario = mysql($consulta);

// Usuário não está cadastrado
if(count($usuario) <= 0 || !isset($usuario["cpf"])) {
	header("Location: ../remover.php?mensagem=Usuário+não+está+cadastrado+no+sistema.");
	return false;
}
// Remove os dados
elseif(isset($usuario["id"])) {
	// Remove os formulários
	$consulta = "delete from formularios where usuario=" .$usuario["id"] . ";";
	// Salva no banco de dados
	$envio = mysql($consulta);

	// Remove as respostas
	$consulta = "delete from respostas where usuario=" .$usuario["id"] . ";";
	// Salva no banco de dados
	$envio = mysql($consulta);

	// Remove a senha
	$consulta = "delete from senhas where usuario=" .$usuario["id"] . ";";
	// Salva no banco de dados
	$envio = mysql($consulta);

	// Remove o usuário
	$consulta = "delete from usuarios where id=" .$usuario["id"] . ";";
	// Salva no banco de dados
	$envio = mysql($consulta);

	header("Location: ../remover.php?mensagem=Usuário+removido+com+sucesso.");
}
return true;
?>