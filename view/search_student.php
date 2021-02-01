<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS E A AÇÃO DE CONSULTA DE ALUNO
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../action/search_student.php");

// TÍTULO DA PÁGINA
define("PAGE_TITLE", "Consultar Usuário");
define("PAGE_MODULE", PAGE_TITLE);

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);

// CARREGA MENU SUPERIOR DA PÁGINA
require_once(INC_ROUTES["tab"]);
?>

	<div class="container grid-lg py-4">
		<div class="text-center">
			<h6 class="display-6 text-blue"><?=PAGE_MODULE?></h6>
		</div>

		<form action="<?=BASE_NAME?>search" method="get">
			<div class="form-group">
				<label class="form-label" for="search">Nome ou CPF</label>
				<input class="form-input" id="search" name="search" placeholder="Nome ou CPF" type="text"/>
			</div>

			<div class="form-group py-2">
				<input class="btn btn-blue" type="submit" value="Consultar"/>
			</div>

			<?php foreach(get_users() as $u): ?>
			<h5 class="mb-0 mt-3"><strong><?=$u["name"]?></strong></h5>
			<p class="mb-0"><?=preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $u["alias"])?></p>
			<a class="btn btn-blue btn-sm" href="<?=BASE_NAME?>view?id=<?=$u["id"]?>">Visualizar</a>
			<a class="btn btn-green btn-sm" href="<?=BASE_NAME?>update?id=<?=$u["id"]?>">Alterar</a>
			<a class="btn btn-red btn-sm" href="<?=ACTION_NAME?>admin/student/remove?id=<?=$u["id"] . (isset($_GET["search"]) ? "&search=" . $_GET["search"] : "")?>" onclick="return confirm('Deseja realmente remover o usuário do sistema?');">Remover</a>
			<?php endforeach; ?>

			<p class="text-center text-<?=get_color()?>" id="message"><?=get_message()?></p>
		</form>

	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

</body>

</html>
