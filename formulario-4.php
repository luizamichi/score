<?php

require_once("php/util.php");

// Páginas acessíveis de encaminhamento
$paginas = [HOST . "formulario-0.php", HOST . "formulario-1.php", HOST . "formulario-2.php", HOST . "formulario-3.php", HOST . "formulario-5.php", HOST . "formulario-6.php"];

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && !in_array($_SERVER["HTTP_REFERER"], $paginas)) {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Usuário não está autenticado
if(empty($_SESSION) && !isset($_SESSION["id"])) {
	header("Location: index.php");
	return false;
}
// Captura os dados do banco, caso existam
else {
	$campos = ["pergunta-1", "pergunta-2", "pergunta-3", "pergunta-4", "pergunta-5", "pergunta-6", "pergunta-7", "pergunta-8", "pergunta-9", "pergunta-10", "pergunta-11"];
	$consulta = mysql("select resposta from formularios where modulo=4 and usuario=" . $_SESSION["id"] . ";");

	$vetor = [];
	for($i = 0; $i < 11; $i++)
		array_push($vetor, "");

	$respostas = $consulta ? explode("|$*|", $consulta["resposta"]) : $vetor;
	$r = [];

	// Deixa os dados esteticamente bonitos
	foreach($campos as $indice => $campo)
		$r[$campo] = $respostas[$indice];

	// Obtém os valores a partir do SELECT da pergunta 7
	$r["pergunta-7"] = explode("||", $r["pergunta-7"]);
}

// Verifica se o usuário já respondeu todo o questionário
$consulta = "select * from respostas where usuario=" . $_SESSION["id"] . ";";
$mysql = mysql($consulta);
if($mysql["fim"]) {
	header("Location: final.php");
	return true;
}

// Captura o horário de início do formulário
$tempo = $mysql["inicio"];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>AirTalent - Avaliação técnica (Segurança operacional e regulação)</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="css/spectre.min.css"/>
	<link rel="stylesheet" href="css/spectre-exp.min.css"/>
	<link rel="stylesheet" href="css/spectre-icons.min.css"/>
</head>

<body>
	<div class="bg-gray">
		<header class="navbar" style="background: #195596; padding: 5px 15px;">
			<section class="navbar-section">
				<img alt="AirTalent" class="img-responsive" src="img/airtalent-b.png" style="width: 140px;"/>
			</section>
			<section class="navbar-center" style="color: #fff; flex-direction: column;">
				<a href="#" class="btn btn-link">
					<span style="color: #fff; font-size: 10px;">TEMPO DECORRIDO</span>
					<h4 id="tempo" style="color: #fff;"></h4>
					<span id="data" style="display: none;"><?=$tempo?></span>
				</a>
			</section>
			<section class="navbar-section">
				<a class="btn btn-link" href="php/sair.php" style="height: auto; color: #fff;">
					<span style="color: #fff; font-size: 10px;">SAIR</span><br/>
					<img alt="Sair" src="img/sair-b.png" style="width: 30px;"/>
				</a>
			</section>
		</header>

		<ul class="tab tab-block">
			<li class="tab-item">
				<a data-anchor="formulario-0.php" href="#"><span style="font-size: 10px;">INÍCIO</span><br/>SCORE</a>
			</li>
			<li class="tab-item">
				<a data-anchor="formulario-1.php" href="#"><span style="font-size: 10px;">DADOS PESSOAIS</span><br/>Cadastro inicial</a>
			</li>
			<li class="tab-item">
				<a data-anchor="formulario-2.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Conhecimento da função</a>
			</li>
			<li class="tab-item">
				<a data-anchor="formulario-3.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Conhecimento técnico específico</a>
			</li>
			<li class="tab-item">
				<a class="active" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Segurança operacional</a>
			</li>
			<li class="tab-item text-gray">
				<a data-anchor="formulario-5.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Experiências anteriores</a>
			</li>
			<li class="tab-item text-gray">
				<a data-anchor="formulario-6.php" href="#"><span style="font-size: 10px;">NÍVEL DE INGLÊS</span><br/>Inglês intermediário</a>
			</li>
		</ul>
	</div>

	<div class="container grid-lg">
		<div class="pt-2 text-center" style="color: #195596;">
			<h1 class="mt-2">Avaliação técnica</h1>
			<h3>Segurança operacional e regulação</h3>
		</div>

		<form action="php/formulario-4.php" class="form-horizontal" method="post">
			<div class="divider"></div>
			<h5 class="text-center">Relacionamento com SGSO (Sistema de Gerenciamento e Segurança Operacional)</h5>
			<div class="divider"></div>
			<!--<div class="divider text-center" data-content="Relacionamento com SGSO (Sistema de Gerenciamento e Segurança Operacional)"></div>-->

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-1">1. Você possui algum conhecimento sobre SGSO? Se sim, escreva em poucas palavras o que você entende sobre SGSO:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-1" name="pergunta-1" placeholder="Você possui algum conhecimento sobre SGSO? Se sim, escreva em poucas palavras o que você entende sobre SGSO" rows="2" style="resize: none;"><?=$r["pergunta-1"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-2">2. Alguma de suas tarefas e procedimentos tem relacionamento direto com os itens cobertos por Manuais de SGSO? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-2" name="pergunta-2" placeholder="Alguma de suas tarefas e procedimentos tem relacionamento direto com os itens cobertos por Manuais de SGSO? Se sim, quais?" rows="2" style="resize: none;"><?=$r["pergunta-2"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-3">3. Você teve contato direto com os manuais de SGSO no desempenho da função? Se sim, em quais procedimentos?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-3" name="pergunta-3" placeholder="Você teve contato direto com os manuais de SGSO no desempenho da função? Se sim, em quais procedimentos?" rows="2" style="resize: none;"><?=$r["pergunta-3"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-4">4. Você teve dificuldade com os procedimentos de Segurança Operacional no exercício da função? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-4" name="pergunta-4" placeholder="Você teve dificuldade com os procedimentos de Segurança Operacional no exercício da função? Se sim, quais?" rows="2" style="resize: none;"><?=$r["pergunta-4"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-5">5. Você já desenvolveu procedimentos ou manuais de SGSO? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-5" name="pergunta-5" placeholder="Você já desenvolveu procedimentos ou manuais de SGSO? Se sim, quais?" rows="2" style="resize: none;"><?=$r["pergunta-5"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-6">6. Você teve contato com manuais e procedimentos de SGSO em inglês?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-6" name="pergunta-6" placeholder="Você teve contato com manuais e procedimentos de SGSO em inglês?" type="text" value="<?=$r["pergunta-6"]?>"/>
				</div>
			</div>

			<div class="divider"></div>
			<h5 class="text-center">Consequências dos atos na segurança operacional e regulação aplicável</h5>
			<div class="divider"></div>
			<!--<div class="divider text-center" data-content="Consequências dos atos na segurança operacional e regulação aplicável"></div>-->

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-7">7. Você já executou tarefas relacionadas diretamente a Segurança Operacional nos seguintes tipos de empresa?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Aeroportos", $r["pergunta-7"]) ? "checked" : ""?> id="pergunta-7" name="pergunta-7[]" type="checkbox" value="Aeroportos"/>
							<i class="form-icon"></i>
							Aeroportos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Passageiros", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Empresas de Transporte Aéreo de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Cargas", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Empresas de Transporte Aéreo de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Passageiros", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Empresas de Serviços Auxiliares de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Cargas", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Empresas de Serviços Auxiliares de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Aeronaves", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Fabricantes de Aeronaves"/>
							<i class="form-icon"></i>
							Fabricantes de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Motores", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Fabricantes de Motores"/>
							<i class="form-icon"></i>
							Fabricantes de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Componentes", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Fabricantes de Componentes"/>
							<i class="form-icon"></i>
							Fabricantes de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Químicos", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Fabricantes de Químicos"/>
							<i class="form-icon"></i>
							Fabricantes de Químicos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Ferramentas", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Fabricantes de Ferramentas"/>
							<i class="form-icon"></i>
							Fabricantes de Ferramentas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Distribuidores de Partes e Componentes", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Distribuidores de Partes e Componentes"/>
							<i class="form-icon"></i>
							Distribuidores de Partes e Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Aeronaves", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Empresas de Manutenção de Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Motores", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Empresas de Manutenção de Motores"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Componentes", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Empresas de Manutenção de Componentes"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Equipamentos Auxiliares", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Empresas de Manutenção de Equipamentos Auxiliares"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Equipamentos Auxiliares
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Ferramentas", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Empresas de Manutenção de Ferramentas"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Ferramentas
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-8">8. Você já executou tarefas que poderiam influenciar na Segurança Operacional? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-8" name="pergunta-8" placeholder="Você já executou tarefas que poderiam influenciar na Segurança Operacional? Se sim, quais?" rows="2" style="resize: none;"><?=$r["pergunta-8"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-9">9. Qual seu grau de envolvimento direto na Segurança Operacional?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-9" max="10" min="0" name="pergunta-9" type="range" value="<?=$r["pergunta-9"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-9"]?></p>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-10">10. Havia regulação específica ou supervisionamento de alguma autoridade aeronáutica nessas tarefas? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-10" name="pergunta-10" placeholder="Havia regulação específica ou supervisionamento de alguma autoridade aeronáutica nessas tarefas? Se sim, quais?" rows="2" style="resize: none;"><?=$r["pergunta-10"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-11">11. Você já teve alguma dificuldade para manter a Segurança Operacional devido ao atrito com alguma pessoa ou autoridade? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-11" name="pergunta-11" placeholder="Você já teve alguma dificuldade para manter a Segurança Operacional devido ao atrito com alguma pessoa ou autoridade? Se sim, quais?" rows="3" style="resize: none;"><?=$r["pergunta-11"]?></textarea>
				</div>
			</div>

			<div class="text-right">
				<input class="btn btn-primary input-group-btn" name="anterior" type="submit" value="Anterior"/>
				<input class="btn btn-primary input-group-btn" name="proximo" type="submit" value="Próximo"/>
			</div>

			<input name="pagina" type="hidden" value=""/>
		</form>
	</div>

	<script src="js/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function() {
			// Anima a barra de controle deslizante
			$("input[type='range']").next().text($("input[type='range']").val());
			$("input[type='range']").on("click mousemove", function() {
				$(this).next().text($(this).val());
			});

			// Salva a página requerida no formulário
			$("input[name='anterior']").click(function() {
				$("input[name='proximo']").val("");
			});
			$("input[name='proximo']").click(function() {
				$("input[name='anterior']").val("");
			});

			// Direcionadores dos links do menu superior
			$("a[data-anchor='formulario-0.php'], a[data-anchor='formulario-1.php'], a[data-anchor='formulario-2.php'], a[data-anchor='formulario-3.php'], a[data-anchor='formulario-5.php'], a[data-anchor='formulario-6.php'], a[data-anchor='php/sair.php']").click(function() {
				$("input[name='pagina']").val($(this).data("anchor"));
				$("form[action='php/formulario-4.php']").submit();
			});

			// Relógio
			var dataInicial = new Date($("span[id='data']").html());
			setInterval(function() {
				var dataAtual = new Date();
				var data = dataAtual.getTime() - dataInicial.getTime();
				var dias = Math.floor(data/(1000 * 3600 * 24)); // 86.400.000 milisegundos
				var horas = Math.abs(dataAtual.getHours() - dataInicial.getHours());
				var minutos = Math.abs(dataAtual.getMinutes() - dataInicial.getMinutes());

				var imprimeDias = dias > 1 ? dias + " dias" : dias + " dia";
				var imprimeHoras = horas > 10 ? horas : "0" + horas;
				var imprimeMinutos = minutos > 10 ? minutos : "0" + minutos;
				$("h4[id='tempo']").html(imprimeDias + " e " + imprimeHoras + ":" + imprimeMinutos + "h");
			}, 1000);
		});
	</script>

</body>

</html>