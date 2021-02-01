<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");

defined("PAGE_TITLE") ?: define("PAGE_TITLE", "AirTalent");
defined("PAGE_DESCRIPTION") ?: define("PAGE_DESCRIPTION", "O SCORE é uma avaliação individual que mede as habilidades soft e hard skills. A avaliação identifica seus pontos fortes e fracos, canalizando seus recursos para melhorar sua empregabilidade.");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>SCORE - <?=PAGE_TITLE?></title>
	<base href="<?=BASE_NAME?>"/>

	<meta charset="utf-8"/>
	<meta content="<?=SYSTEM_AUTHOR?>" name="author"/>
	<meta content="<?=PAGE_DESCRIPTION?>" name="description"/>
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

	<meta content="summary_large_image" name="twitter:card"/>
	<meta content="<?=BASE_NAME?>" name="twitter:domain"/>
	<meta content="SCORE - <?=PAGE_TITLE?>" name="twitter:title"/>
	<meta content="<?=PAGE_DESCRIPTION?>" name="twitter:description"/>
	<meta content="<?=BASE_NAME?>media/logo.png" name="twitter:image"/>
	<meta content="<?=BASE_NAME?>" name="twitter:url"/>

	<meta content="SCORE" property="og:site_name"/>
	<meta content="SCORE - <?=PAGE_TITLE?>" property="og:title"/>
	<meta content="<?=PAGE_DESCRIPTION?>" property="og:description"/>
	<meta content="<?=BASE_NAME?>media/logo.png" property="og:image"/>
	<meta content="<?=BASE_NAME?>media/logo.png" property="og:image:secure_url"/>
	<meta content="website" property="og:type"/>
	<meta content="<?=BASE_NAME?>" property="og:url"/>

	<link href="<?=STYLE_NAME?>score-reset.css" rel="stylesheet" type="text/css"/>
	<link href="<?=STYLE_NAME?>score-style.css" rel="stylesheet" type="text/css"/>
	<link href="<?=STYLE_NAME?>apexcharts.css" rel="stylesheet" type="text/css"/>
	<link href="<?=MEDIA_NAME?>logo.png" rel="icon" type="image/png"/>
</head>
