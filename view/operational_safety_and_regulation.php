<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ALUNOS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../student.php");

// MÓDULO NECESSÁRIO, ESTÁGIO NECESSÁRIO E TÍTULO DA PÁGINA
define("PAGE_MODULE", FORM_MODULES[1]);
define("PAGE_STAGE", FORM_STAGES[3]);
define("PAGE_TITLE", PAGE_MODULE . " (" . PAGE_STAGE . ")");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA TODAS AS RESPOSTAS DO USUÁRIO
$r = operational_safety_and_regulation_response(get_user()["student"]);

// DEFINE O TEMPO PARA EXIBIR EM TELA
$time = initial_registration_start_time(get_user()["student"]);

// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);

// CARREGA O MENU SUPERIOR DA PÁGINA
require_once(INC_ROUTES["navbar"]);

// CARREGA A ETAPA DA PÁGINA
require_once(INC_ROUTES["step"]);
?>

	<div class="container grid-lg py-4">
		<div class="text-center">
			<h6 class="display-6 text-blue"><?=PAGE_STAGE?></h6>
		</div>

		<form action="<?=ACTION_NAME?>technical-evaluation/operational-safety-and-regulation" class="form-horizontal" data-save="true" method="post">
			<div class="divider text-center" data-content="Relacionamento com SGSO (Sistema de Gerenciamento e Segurança Operacional)"></div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-1">1. Você possui algum conhecimento sobre SGSO? Se sim, escreva em poucas palavras o que você entende sobre SGSO:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-1" name="question-1" placeholder="Você possui algum conhecimento sobre SGSO? Se sim, escreva em poucas palavras o que você entende sobre SGSO" rows="2" style="resize: none;"><?=$r["question-1"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-2">2. Alguma de suas tarefas e procedimentos tem relacionamento direto com os itens cobertos por Manuais de SGSO? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-2" name="question-2" placeholder="Alguma de suas tarefas e procedimentos tem relacionamento direto com os itens cobertos por Manuais de SGSO? Se sim, quais?" rows="2" style="resize: none;"><?=$r["question-2"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-3">3. Você teve contato direto com os manuais de SGSO no desempenho da função? Se sim, em quais procedimentos?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-3" name="question-3" placeholder="Você teve contato direto com os manuais de SGSO no desempenho da função? Se sim, em quais procedimentos?" rows="2" style="resize: none;"><?=$r["question-3"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-4">4. Você teve dificuldade com os procedimentos de Segurança Operacional no exercício da função? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-4" name="question-4" placeholder="Você teve dificuldade com os procedimentos de Segurança Operacional no exercício da função? Se sim, quais?" rows="2" style="resize: none;"><?=$r["question-4"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-5">5. Você já desenvolveu procedimentos ou manuais de SGSO? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-5" name="question-5" placeholder="Você já desenvolveu procedimentos ou manuais de SGSO? Se sim, quais?" rows="2" style="resize: none;"><?=$r["question-5"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-6">6. Você teve contato com manuais e procedimentos de SGSO em inglês?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-6" name="question-6" placeholder="Você teve contato com manuais e procedimentos de SGSO em inglês?" type="text" value="<?=$r["question-6"]?>"/>
				</div>
			</div>

			<div class="divider text-center" data-content="Consequências dos atos na segurança operacional e regulação aplicável"></div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-7">7. Você já executou tarefas relacionadas diretamente a Segurança Operacional nos seguintes tipos de empresa?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Aeroportos", $r["question-7"]) ? "checked" : ""?> id="question-7" name="question-7[]" type="checkbox" value="Aeroportos"/>
							<i class="form-icon"></i>
							Aeroportos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Passageiros", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Empresas de Transporte Aéreo de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Cargas", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Empresas de Transporte Aéreo de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Passageiros", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Empresas de Serviços Auxiliares de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Cargas", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Empresas de Serviços Auxiliares de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Aeronaves", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Fabricantes de Aeronaves"/>
							<i class="form-icon"></i>
							Fabricantes de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Motores", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Fabricantes de Motores"/>
							<i class="form-icon"></i>
							Fabricantes de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Componentes", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Fabricantes de Componentes"/>
							<i class="form-icon"></i>
							Fabricantes de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Químicos", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Fabricantes de Químicos"/>
							<i class="form-icon"></i>
							Fabricantes de Químicos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Ferramentas", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Fabricantes de Ferramentas"/>
							<i class="form-icon"></i>
							Fabricantes de Ferramentas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Distribuidores de Partes e Componentes", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Distribuidores de Partes e Componentes"/>
							<i class="form-icon"></i>
							Distribuidores de Partes e Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Aeronaves", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Empresas de Manutenção de Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Motores", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Empresas de Manutenção de Motores"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Componentes", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Empresas de Manutenção de Componentes"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Equipamentos Auxiliares", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Empresas de Manutenção de Equipamentos Auxiliares"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Equipamentos Auxiliares
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Ferramentas", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Empresas de Manutenção de Ferramentas"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Ferramentas
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-8">8. Você já executou tarefas que poderiam influenciar na Segurança Operacional? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-8" name="question-8" placeholder="Você já executou tarefas que poderiam influenciar na Segurança Operacional? Se sim, quais?" rows="2" style="resize: none;"><?=$r["question-8"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-9">9. Qual seu grau de envolvimento direto na Segurança Operacional?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-9" max="10" min="0" name="question-9" type="range" value="<?=is_numeric($r["question-9"]) ? $r["question-9"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-9"]?></p>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-10">10. Havia regulação específica ou supervisionamento de alguma autoridade aeronáutica nessas tarefas? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-10" name="question-10" placeholder="Havia regulação específica ou supervisionamento de alguma autoridade aeronáutica nessas tarefas? Se sim, quais?" rows="2" style="resize: none;"><?=$r["question-10"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-11">11. Você já teve alguma dificuldade para manter a Segurança Operacional devido ao atrito com alguma pessoa ou autoridade? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-11" name="question-11" placeholder="Você já teve alguma dificuldade para manter a Segurança Operacional devido ao atrito com alguma pessoa ou autoridade? Se sim, quais?" rows="3" style="resize: none;"><?=$r["question-11"]?></textarea>
				</div>
			</div>

			<div class="text-right">
				<input class="btn btn-green btn-lg" type="submit" value="Próximo"/>
			</div>
		</form>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

	<script>
		$(document).ready(function() {
			// ANIMA A BARRA DE CONTROLE DESLIZANTE
			$("input[type='range']").next().text($("input[type='range']").val());
			$("input[type='range']").on("click mousemove", function() {
				$(this).next().text($(this).val());
			});
		});
	</script>

</body>

</html>
