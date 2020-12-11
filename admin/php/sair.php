<?php

require_once("../../php/util.php");

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && substr($_SERVER["HTTP_REFERER"], 0, strlen(HOST)) != HOST) {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Usuário não está autenticado
if(empty($_SESSION) && !isset($_SESSION["id"])) {
	header("Location: ../index.php");
	return false;
}

// Encerra a sessão
unset($_SESSION["id"]);
session_destroy();

header("Location: ../index.php?mensagem=Você+realizou+o+logout.");
return false;
?>