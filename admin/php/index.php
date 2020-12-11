<?php

require_once("../../php/util.php");

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
$login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

// Verifica se o usuário informou os dados corretos
$consulta = "select * from administradores where nome='" . $login . "' and senha='" . md5($senha) . "';";
$usuario = mysql($consulta);

// O login e a senha informados correspondem com o banco de dados
if(count($usuario) > 0) {
	$_SESSION["admin"] = $usuario["id"];
	header("Location: ../painel.php");
	return true;
}
// Os dados informados estão inválidos
else {
	header("Location: ../index.php?mensagem=Os+dados+informados+estão+incorretos%2C+verifique+o+login+e+a+senha.");
	return false;
}
?>