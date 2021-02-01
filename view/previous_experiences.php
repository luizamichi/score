<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ALUNOS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../student.php");

// MÓDULO NECESSÁRIO, ESTÁGIO NECESSÁRIO E TÍTULO DA PÁGINA
define("PAGE_MODULE", FORM_MODULES[1]);
define("PAGE_STAGE", FORM_STAGES[4]);
define("PAGE_TITLE", PAGE_MODULE . " (" . PAGE_STAGE . ")");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA TODAS AS RESPOSTAS DO USUÁRIO
$r = previous_experiences_response(get_user()["student"]);

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

		<form action="<?=ACTION_NAME?>technical-evaluation/previous-experiences" class="form-horizontal" data-save="true" method="post">
			<div class="divider text-center" data-content="Funções e cargos de relevância"></div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-1">1. Cite as empresas e período trabalhado em cada uma de suas experiências anteriores:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-1" name="question-1" placeholder="Cite as empresas e período trabalhado em cada uma de suas experiências anteriores" rows="2" style="resize: none;"><?=$r["question-1"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-2">2. Nas experiências anteriores, cite o cenário encontrado quando chegou na empresa e como você trabalhou para melhorar o que encontrou?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-2" name="question-2" placeholder="Nas experiências anteriores, cite o cenário encontrado quando chegou na empresa e como você trabalhou para melhorar o que encontrou?" rows="3" style="resize: none;"><?=$r["question-2"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-3">3. Em quais tipos de empresa você já desempenhou tarefas relativas a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Aeroportos", $r["question-3"]) ? "checked" : ""?> id="question-3" name="question-3[]" type="checkbox" value="Aeroportos"/>
							<i class="form-icon"></i>
							Aeroportos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Passageiros", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Empresas de Transporte Aéreo de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Cargas", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Empresas de Transporte Aéreo de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Passageiros", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Empresas de Serviços Auxiliares de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Cargas", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Empresas de Serviços Auxiliares de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Aeronaves", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Fabricantes de Aeronaves"/>
							<i class="form-icon"></i>
							Fabricantes de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Motores", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Fabricantes de Motores"/>
							<i class="form-icon"></i>
							Fabricantes de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Componentes", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Fabricantes de Componentes"/>
							<i class="form-icon"></i>
							Fabricantes de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Químicos", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Fabricantes de Químicos"/>
							<i class="form-icon"></i>
							Fabricantes de Químicos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Ferramentas", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Fabricantes de Ferramentas"/>
							<i class="form-icon"></i>
							Fabricantes de Ferramentas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Distribuidores de Partes e Componentes", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Distribuidores de Partes e Componentes"/>
							<i class="form-icon"></i>
							Distribuidores de Partes e Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Aeronaves", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Empresas de Manutenção de Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Motores", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Empresas de Manutenção de Motores"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Componentes", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Empresas de Manutenção de Componentes"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Equipamentos Auxiliares", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Empresas de Manutenção de Equipamentos Auxiliares"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Equipamentos Auxiliares
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Ferramentas", $r["question-3"]) ? "checked" : ""?> name="question-3[]" type="checkbox" value="Empresas de Manutenção de Ferramentas"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Ferramentas
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-4">4. Você já trabalhou em mais de uma empresa ou cargo relativo a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-4"] === "Não" ? "checked" : ""?> id="question-4" name="question-4" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-4"] === "Sim" ? "checked" : ""?> name="question-4" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="question-4-1-disabled" name="question-4-1" placeholder="Quais?" type="text" value="<?=$r["question-4-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-5">5. Em qual nível você já trabalhou na função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-radio">
						<input <?=$r["question-5"] === "Estágio" ? "checked" : ""?> id="question-5" name="question-5" type="radio" value="Estágio"/>
						<i class="form-icon"></i>
						Estágio
					</label>
					<label class="form-radio">
						<input <?=$r["question-5"] === "Trainee" ? "checked" : ""?> name="question-5" type="radio" value="Trainee"/>
						<i class="form-icon"></i>
						Trainee
					</label>
					<label class="form-radio">
						<input <?=$r["question-5"] === "Junior" ? "checked" : ""?> name="question-5" type="radio" value="Junior"/>
						<i class="form-icon"></i>
						Junior
					</label>
					<label class="form-radio">
						<input <?=$r["question-5"] === "Pleno" ? "checked" : ""?> name="question-5" type="radio" value="Pleno"/>
						<i class="form-icon"></i>
						Pleno
					</label>
					<label class="form-radio">
						<input <?=$r["question-5"] === "Sênior" ? "checked" : ""?> name="question-5" type="radio" value="Sênior"/>
						<i class="form-icon"></i>
						Sênior
					</label>
					<label class="form-radio">
						<input <?=$r["question-5"] === "Supervisão" ? "checked" : ""?> name="question-5" type="radio" value="Supervisão"/>
						<i class="form-icon"></i>
						Supervisão
					</label>
					<label class="form-radio">
						<input <?=$r["question-5"] === "Coordenação" ? "checked" : ""?> name="question-5" type="radio" value="Coordenação"/>
						<i class="form-icon"></i>
						Coordenação
					</label>
					<label class="form-radio">
						<input <?=$r["question-5"] === "Gerência" ? "checked" : ""?> name="question-5" type="radio" value="Gerência"/>
						<i class="form-icon"></i>
						Gerência
					</label>
					<label class="form-radio">
						<input <?=$r["question-5"] === "Diretoria" ? "checked" : ""?> name="question-5" type="radio" value="Diretoria"/>
						<i class="form-icon"></i>
						Diretoria
					</label>
					<label class="form-radio">
						<input <?=$r["question-5"] === "Presidência" ? "checked" : ""?> name="question-5" type="radio" value="Presidência"/>
						<i class="form-icon"></i>
						Presidência
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-6">6. Em qual nível você já desempenhou tarefas relativas a função indiretamente?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-radio">
						<input <?=$r["question-6"] === "Estágio" ? "checked" : ""?> id="question-6" name="question-6" type="radio" value="Estágio"/>
						<i class="form-icon"></i>
						Estágio
					</label>
					<label class="form-radio">
						<input <?=$r["question-6"] === "Trainee" ? "checked" : ""?> name="question-6" type="radio" value="Trainee"/>
						<i class="form-icon"></i>
						Trainee
					</label>
					<label class="form-radio">
						<input <?=$r["question-6"] === "Junior" ? "checked" : ""?> name="question-6" type="radio" value="Junior"/>
						<i class="form-icon"></i>
						Junior
					</label>
					<label class="form-radio">
						<input <?=$r["question-6"] === "Pleno" ? "checked" : ""?> name="question-6" type="radio" value="Pleno"/>
						<i class="form-icon"></i>
						Pleno
					</label>
					<label class="form-radio">
						<input <?=$r["question-6"] === "Sênior" ? "checked" : ""?> name="question-6" type="radio" value="Sênior"/>
						<i class="form-icon"></i>
						Sênior
					</label>
					<label class="form-radio">
						<input <?=$r["question-6"] === "Supervisão" ? "checked" : ""?> name="question-6" type="radio" value="Supervisão"/>
						<i class="form-icon"></i>
						Supervisão
					</label>
					<label class="form-radio">
						<input <?=$r["question-6"] === "Coordenação" ? "checked" : ""?> name="question-6" type="radio" value="Coordenação"/>
						<i class="form-icon"></i>
						Coordenação
					</label>
					<label class="form-radio">
						<input <?=$r["question-6"] === "Gerência" ? "checked" : ""?> name="question-6" type="radio" value="Gerência"/>
						<i class="form-icon"></i>
						Gerência
					</label>
					<label class="form-radio">
						<input <?=$r["question-6"] === "Diretoria" ? "checked" : ""?> name="question-6" type="radio" value="Diretoria"/>
						<i class="form-icon"></i>
						Diretoria
					</label>
					<label class="form-radio">
						<input <?=$r["question-6"] === "Presidência" ? "checked" : ""?> name="question-6" type="radio" value="Presidência"/>
						<i class="form-icon"></i>
						Presidência
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-7">7. Quais setores internos da empresa você teve relacionamento ao longo de sua carreira? (mais de uma alternativa pode ser marcada)</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Comercial", $r["question-7"]) ? "checked" : ""?> id="question-7" name="question-7[]" type="checkbox" value="Comercial"/>
							<i class="form-icon"></i>
							Comercial
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Compras/suprimentos", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Compras/suprimentos"/>
							<i class="form-icon"></i>
							Compras/suprimentos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Marketing", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Marketing"/>
							<i class="form-icon"></i>
							Marketing
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("RH", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="RH"/>
							<i class="form-icon"></i>
							RH
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Engenharia", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Engenharia"/>
							<i class="form-icon"></i>
							Engenharia
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Manutenção", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Manutenção"/>
							<i class="form-icon"></i>
							Manutenção
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Operações (Tripulação)", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Operações (Tripulação)"/>
							<i class="form-icon"></i>
							Operações (Tripulação)
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Atendimento aeroportuário (Ground Handling)", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Atendimento aeroportuário (Ground Handling)"/>
							<i class="form-icon"></i>
							Atendimento aeroportuário (Ground Handling)
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Cliente externo e/ou passageiros", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Cliente externo e/ou passageiros"/>
							<i class="form-icon"></i>
							Cliente externo e/ou passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Qualidade", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Qualidade"/>
							<i class="form-icon"></i>
							Qualidade
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Segurança Operacional (Safety)", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Segurança Operacional (Safety)"/>
							<i class="form-icon"></i>
							Segurança Operacional (Safety)
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Segurança patrimonial (Security)", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Segurança patrimonial (Security)"/>
							<i class="form-icon"></i>
							Segurança patrimonial (Security)
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Jurídico", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Jurídico"/>
							<i class="form-icon"></i>
							Jurídico
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Financeiro", $r["question-7"]) ? "checked" : ""?> name="question-7[]" type="checkbox" value="Financeiro"/>
							<i class="form-icon"></i>
							Financeiro
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-8">8. Qual o maior desafio que você enfrentou na construção de sua carreira?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-8" name="question-8" placeholder="Qual o maior desafio que você enfrentou na construção de sua carreira?" rows="2" style="resize: none;"><?=$r["question-8"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-9">9. Qual o maior desafio profissional que você enfrentou desempenhando a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-9" name="question-9" placeholder="Qual o maior desafio profissional que você enfrentou desempenhando a função?" rows="2" style="resize: none;"><?=$r["question-9"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-10">10. Qual foi sua maior conquista profissional desempenhando a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-10" name="question-10" placeholder="Qual foi sua maior conquista profissional desempenhando a função?" rows="2" style="resize: none;"><?=$r["question-10"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-11">11. Qual foi a melhor empresa que você já trabalhou? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-11" name="question-11" placeholder="Qual foi a melhor empresa que você já trabalhou? Por quê?" rows="2" style="resize: none;"><?=$r["question-11"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-12">12. Qual foi a pior empresa que você trabalhou? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-12" name="question-12" placeholder="Qual foi a pior empresa que você trabalhou? Por quê?" rows="2" style="resize: none;"><?=$r["question-12"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-13">13. Você já teve algum chefe/gerente que considerasse tóxico?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-13"] === "Não" ? "checked" : ""?> id="question-13" name="question-13" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-13"] === "Sim" ? "checked" : ""?> name="question-13" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, conte-nos sobre isso sem mencionar o nome da pessoa.
					</label>
					<input class="form-input" id="question-13-1-disabled" name="question-13-1" placeholder="Conte-nos sobre isso sem mencionar o nome da pessoa." type="text" value="<?=$r["question-13-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-14">14. Qual foi a pessoa que mais influenciou sua carreira positivamente dentro de uma empresa?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-14" name="question-14" placeholder="Qual foi a pessoa que mais influenciou sua carreira positivamente dentro de uma empresa?" rows="2" style="resize: none;"><?=$r["question-14"]?></textarea>
				</div>
			</div>

			<div class="divider text-center" data-content="Conhecimento adquirido (competências específicas e gerais)"></div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-15-1">15. Com quais tipos de aeronaves você já desempenhou tarefas relativas a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-15-1"><strong>Aeronaves</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Airbus 320", $r["question-15-1"]) ? "checked" : ""?> id="question-15-1" name="question-15-1[]" type="checkbox" value="Airbus 320"/>
							<i class="form-icon"></i>
							Airbus 320
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Airbus 330", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Airbus 330"/>
							<i class="form-icon"></i>
							Airbus 330
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Airbus 340", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Airbus 340"/>
							<i class="form-icon"></i>
							Airbus 340
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Airbus 380", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Airbus 380"/>
							<i class="form-icon"></i>
							Airbus 380
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("ATR 42/72 – 200/300/500", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="ATR 42/72 – 200/300/500"/>
							<i class="form-icon"></i>
							ATR 42/72 – 200/300/500
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("ATR 42/72 – 600", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="ATR 42/72 – 600"/>
							<i class="form-icon"></i>
							ATR 42/72 – 600
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 737CL", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Boeing 737CL"/>
							<i class="form-icon"></i>
							Boeing 737CL
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 737NG", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Boeing 737NG"/>
							<i class="form-icon"></i>
							Boeing 737NG
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 747", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Boeing 747"/>
							<i class="form-icon"></i>
							Boeing 747
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 757", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Boeing 757"/>
							<i class="form-icon"></i>
							Boeing 757
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 767", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Boeing 767"/>
							<i class="form-icon"></i>
							Boeing 767
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 777", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Boeing 777"/>
							<i class="form-icon"></i>
							Boeing 777
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 787", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Boeing 787"/>
							<i class="form-icon"></i>
							Boeing 787
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Dash8", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Dash8"/>
							<i class="form-icon"></i>
							Dash8
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Embraer 110", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Embraer 110"/>
							<i class="form-icon"></i>
							Embraer 110
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Embraer 120", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Embraer 120"/>
							<i class="form-icon"></i>
							Embraer 120
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Embraer 135/145", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Embraer 135/145"/>
							<i class="form-icon"></i>
							Embraer 135/145
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Embraer E1", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Embraer E1"/>
							<i class="form-icon"></i>
							Embraer E1
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Embraer E2", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Embraer E2"/>
							<i class="form-icon"></i>
							Embraer E2
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Pilatus PC12", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Pilatus PC12"/>
							<i class="form-icon"></i>
							Pilatus PC12
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Cessna Caravan", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Cessna Caravan"/>
							<i class="form-icon"></i>
							Cessna Caravan
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Sikorsky S76", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Sikorsky S76"/>
							<i class="form-icon"></i>
							Sikorsky S76
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Sikorsky S92", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Sikorsky S92"/>
							<i class="form-icon"></i>
							Sikorsky S92
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Sikorsky Blackhawk", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Sikorsky Blackhawk"/>
							<i class="form-icon"></i>
							Sikorsky Blackhawk
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Mil Mi 35 - Sabre", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Mil Mi 35 - Sabre"/>
							<i class="form-icon"></i>
							Mil Mi 35 - Sabre
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 206", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Bell 206"/>
							<i class="form-icon"></i>
							Bell 206
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 406", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Bell 406"/>
							<i class="form-icon"></i>
							Bell 406
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 212", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Bell 212"/>
							<i class="form-icon"></i>
							Bell 212
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 412", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Bell 412"/>
							<i class="form-icon"></i>
							Bell 412
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 429", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Bell 429"/>
							<i class="form-icon"></i>
							Bell 429
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 407", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Bell 407"/>
							<i class="form-icon"></i>
							Bell 407
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 430", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Bell 430"/>
							<i class="form-icon"></i>
							Bell 430
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Agusta A 109", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Agusta A 109"/>
							<i class="form-icon"></i>
							Agusta A 109
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Agusta A 129", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Agusta A 129"/>
							<i class="form-icon"></i>
							Agusta A 129
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Agusta AW139", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Agusta AW139"/>
							<i class="form-icon"></i>
							Agusta AW139
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Agusta AW 169", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Agusta AW 169"/>
							<i class="form-icon"></i>
							Agusta AW 169
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter Tiger", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Eurocopter Tiger"/>
							<i class="form-icon"></i>
							Eurocopter Tiger
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter EC-155", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Eurocopter EC-155"/>
							<i class="form-icon"></i>
							Eurocopter EC-155
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter EC-725", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Eurocopter EC-725"/>
							<i class="form-icon"></i>
							Eurocopter EC-725
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter AS350", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Eurocopter AS350"/>
							<i class="form-icon"></i>
							Eurocopter AS350
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter AS350 B2", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Eurocopter AS350 B2"/>
							<i class="form-icon"></i>
							Eurocopter AS350 B2
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter EC120", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Eurocopter EC120"/>
							<i class="form-icon"></i>
							Eurocopter EC120
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter Super Puma", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Eurocopter Super Puma"/>
							<i class="form-icon"></i>
							Eurocopter Super Puma
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter H145", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Eurocopter H145"/>
							<i class="form-icon"></i>
							Eurocopter H145
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter Cougar", $r["question-15-1"]) ? "checked" : ""?> name="question-15-1[]" type="checkbox" value="Eurocopter Cougar"/>
							<i class="form-icon"></i>
							Eurocopter Cougar
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros procedimentos", $r["question-15-1"]) ? "checked" : ""?> id="question-15-1-other" name="question-15-1[]" type="checkbox" value="Outros procedimentos"/>
							<i class="form-icon"></i>
							Outros procedimentos
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-15-1-1" name="question-15-1-1" placeholder="Quais?" type="text" value="<?=$r["question-15-1-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-15-2"><strong>Motores</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Lycoming", $r["question-15-2"]) ? "checked" : ""?> id="question-15-2" name="question-15-2[]" type="checkbox" value="Lycoming"/>
							<i class="form-icon"></i>
							Lycoming
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Continental", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="Continental"/>
							<i class="form-icon"></i>
							Continental
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PT6", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="PT6"/>
							<i class="form-icon"></i>
							PT6
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PW100", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="PW100"/>
							<i class="form-icon"></i>
							PW100
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CFM56", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="CFM56"/>
							<i class="form-icon"></i>
							CFM56
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CF6", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="CF6"/>
							<i class="form-icon"></i>
							CF6
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("RR Trent", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="RR Trent"/>
							<i class="form-icon"></i>
							RR Trent
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("RR 300", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="RR 300"/>
							<i class="form-icon"></i>
							RR 300
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("R 250", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="R 250"/>
							<i class="form-icon"></i>
							R 250
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("GE90/9X", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="GE90/9X"/>
							<i class="form-icon"></i>
							GE90/9X
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("GEnx", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="GEnx"/>
							<i class="form-icon"></i>
							GEnx
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("LEAP", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="LEAP"/>
							<i class="form-icon"></i>
							LEAP
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CF34", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="CF34"/>
							<i class="form-icon"></i>
							CF34
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("JT8", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="JT8"/>
							<i class="form-icon"></i>
							JT8
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("JT15", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="JT15"/>
							<i class="form-icon"></i>
							JT15
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("TPE", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="TPE"/>
							<i class="form-icon"></i>
							TPE
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("TFE", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="TFE"/>
							<i class="form-icon"></i>
							TFE
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("RB211", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="RB211"/>
							<i class="form-icon"></i>
							RB211
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("LM2500", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="LM2500"/>
							<i class="form-icon"></i>
							LM2500
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("V2500", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="V2500"/>
							<i class="form-icon"></i>
							V2500
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("T700", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="T700"/>
							<i class="form-icon"></i>
							T700
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PW1000", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="PW1000"/>
							<i class="form-icon"></i>
							PW1000
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PW4000", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="PW4000"/>
							<i class="form-icon"></i>
							PW4000
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PW300/500", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="PW300/500"/>
							<i class="form-icon"></i>
							PW300/500
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("T56", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="T56"/>
							<i class="form-icon"></i>
							T56
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("H80", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="H80"/>
							<i class="form-icon"></i>
							H80
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Turbomeca", $r["question-15-2"]) ? "checked" : ""?> name="question-15-2[]" type="checkbox" value="Turbomeca"/>
							<i class="form-icon"></i>
							Turbomeca
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros procedimentos", $r["question-15-2"]) ? "checked" : ""?> id="question-15-2-other" name="question-15-2[]" type="checkbox" value="Outros procedimentos"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-15-2-1" name="question-15-2-1" placeholder="Quais?" type="text" value="<?=$r["question-15-2-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-15-3"><strong>Marque os aviônicos que tem mais familiarização ou já equiparam aeronaves que operou/trabalhou:</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Rockwell Collins", $r["question-15-3"]) ? "checked" : ""?> id="question-15-3" name="question-15-3[]" type="checkbox" value="Rockwell Collins"/>
							<i class="form-icon"></i>
							Rockwell Collins
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-15-3-1" name="question-15-3-1" placeholder="Cite modelos" type="text" value="<?=$r["question-15-3-1"]?>"/>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Honeywell", $r["question-15-3"]) ? "checked" : ""?> id="question-15-3-honeywell" name="question-15-3[]" type="checkbox" value="Honeywell"/>
							<i class="form-icon"></i>
							Honeywell
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-15-3-2" name="question-15-3-2" placeholder="Cite modelos" type="text" value="<?=$r["question-15-3-2"]?>"/>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Garmin", $r["question-15-3"]) ? "checked" : ""?> id="question-15-3-garmin" name="question-15-3[]" type="checkbox" value="Garmin"/>
							<i class="form-icon"></i>
							Garmin
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-15-3-3" name="question-15-3-3" placeholder="Cite modelos" type="text" value="<?=$r["question-15-3-3"]?>"/>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-15-3"]) ? "checked" : ""?> id="question-15-3-other" name="question-15-3[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-15-3-4" name="question-15-3-4" placeholder="Cite fabricante e modelos" type="text" value="<?=$r["question-15-3-4"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-16-1-1">16. Qual o seu nível de conhecimento nos seguintes campos?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-1-1"><strong>Aeronaves</strong></label>
					<label class="form-label" for="question-16-1-1">Estruturas</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-1-1" max="10" min="0" name="question-16-1-1" type="range" value="<?=is_numeric($r["question-16-1-1"]) ? $r["question-16-1-1"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-1-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-1-2">Motores</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-1-2" max="10" min="0" name="question-16-1-2" type="range" value="<?=is_numeric($r["question-16-1-2"]) ? $r["question-16-1-2"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-1-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-1-3">Aviônica</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-1-3" max="10" min="0" name="question-16-1-3" type="range" value="<?=is_numeric($r["question-16-1-3"]) ? $r["question-16-1-3"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-1-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-1-4">Sistemas</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-1-4" max="10" min="0" name="question-16-1-4" type="range" value="<?=is_numeric($r["question-16-1-4"]) ? $r["question-16-1-4"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-1-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-1-5">Ferramental</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-1-5" max="10" min="0" name="question-16-1-5" type="range" value="<?=is_numeric($r["question-16-1-5"]) ? $r["question-16-1-5"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-1-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-2-1"><strong>Operações</strong></label>
					<label class="form-label" for="question-16-2-1">Coordenação</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-2-1" max="10" min="0" name="question-16-2-1" type="range" value="<?=is_numeric($r["question-16-2-1"]) ? $r["question-16-2-1"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-2-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-2-2">Climatologia</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-2-2" max="10" min="0" name="question-16-2-2" type="range" value="<?=is_numeric($r["question-16-2-2"]) ? $r["question-16-2-2"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-2-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-2-3">Rotas</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-2-3" max="10" min="0" name="question-16-2-3" type="range" value="<?=is_numeric($r["question-16-2-3"]) ? $r["question-16-2-3"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-2-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-2-4">Peso e Balanceamento</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-2-4" max="10" min="0" name="question-16-2-4" type="range" value="<?=is_numeric($r["question-16-2-4"]) ? $r["question-16-2-4"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-2-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-2-5">AOG</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-2-5" max="10" min="0" name="question-16-2-5" type="range" value="<?=is_numeric($r["question-16-2-5"]) ? $r["question-16-2-5"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-2-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-2-6">SGSO</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-2-6" max="10" min="0" name="question-16-2-6" type="range" value="<?=is_numeric($r["question-16-2-6"]) ? $r["question-16-2-6"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-2-6"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-2-7">AVSEC</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-2-7" max="10" min="0" name="question-16-2-7" type="range" value="<?=is_numeric($r["question-16-2-7"]) ? $r["question-16-2-7"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-2-7"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-3-1"><strong>Engenharia</strong></label>
					<label class="form-label" for="question-16-3-1">Planejamento</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-3-1" max="10" min="0" name="question-16-3-1" type="range" value="<?=is_numeric($r["question-16-3-1"]) ? $r["question-16-3-1"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-3-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-3-2">Projetos</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-3-2" max="10" min="0" name="question-16-3-2" type="range" value="<?=is_numeric($r["question-16-3-2"]) ? $r["question-16-3-2"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-3-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-3-3">Manutenção</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-3-3" max="10" min="0" name="question-16-3-3" type="range" value="<?=is_numeric($r["question-16-3-3"]) ? $r["question-16-3-3"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-3-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-3-4">Reparos</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-3-4" max="10" min="0" name="question-16-3-4" type="range" value="<?=is_numeric($r["question-16-3-4"]) ? $r["question-16-3-4"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-3-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-3-5">Qualidade</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-3-5" max="10" min="0" name="question-16-3-5" type="range" value="<?=is_numeric($r["question-16-3-5"]) ? $r["question-16-3-5"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-3-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-3-6">CTM</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-3-6" max="10" min="0" name="question-16-3-6" type="range" value="<?=is_numeric($r["question-16-3-6"]) ? $r["question-16-3-6"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-3-6"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-4-1"><strong>Administração</strong></label>
					<label class="form-label" for="question-16-4-1">Compras</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-4-1" max="10" min="0" name="question-16-4-1" type="range" value="<?=is_numeric($r["question-16-4-1"]) ? $r["question-16-4-1"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-4-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-4-2">Reparos</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-4-2" max="10" min="0" name="question-16-4-2" type="range" value="<?=is_numeric($r["question-16-4-2"]) ? $r["question-16-4-2"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-4-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-4-3">Almoxarifado</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-4-3" max="10" min="0" name="question-16-4-3" type="range" value="<?=is_numeric($r["question-16-4-3"]) ? $r["question-16-4-3"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-4-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-4-4">Logística</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-4-4" max="10" min="0" name="question-16-4-4" type="range" value="<?=is_numeric($r["question-16-4-4"]) ? $r["question-16-4-4"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-4-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-4-5">Vendas</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-4-5" max="10" min="0" name="question-16-4-5" type="range" value="<?=is_numeric($r["question-16-4-5"]) ? $r["question-16-4-5"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-4-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-4-6">Prospecção</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-4-6" max="10" min="0" name="question-16-4-6" type="range" value="<?=is_numeric($r["question-16-4-6"]) ? $r["question-16-4-6"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-4-6"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-4-7">Marketing</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-4-7" max="10" min="0" name="question-16-4-7" type="range" value="<?=is_numeric($r["question-16-4-7"]) ? $r["question-16-4-7"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-4-7"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-4-8">Design</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-4-8" max="10" min="0" name="question-16-4-8" type="range" value="<?=is_numeric($r["question-16-4-8"]) ? $r["question-16-4-8"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-4-8"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-4-9">Contabilidade</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-4-9" max="10" min="0" name="question-16-4-9" type="range" value="<?=is_numeric($r["question-16-4-9"]) ? $r["question-16-4-9"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-4-9"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-4-10">RH</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-4-10" max="10" min="0" name="question-16-4-10" type="range" value="<?=is_numeric($r["question-16-4-10"]) ? $r["question-16-4-10"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-4-10"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-5-1"><strong>TI</strong></label>
					<label class="form-label" for="question-16-5-1">Programação</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-5-1" max="10" min="0" name="question-16-5-1" type="range" value="<?=is_numeric($r["question-16-5-1"]) ? $r["question-16-5-1"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-5-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-5-2">Help Desk</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-5-2" max="10" min="0" name="question-16-5-2" type="range" value="<?=is_numeric($r["question-16-5-2"]) ? $r["question-16-5-2"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-5-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-5-3">Redes</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-5-3" max="10" min="0" name="question-16-5-3" type="range" value="<?=is_numeric($r["question-16-5-3"]) ? $r["question-16-5-3"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-5-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-5-4">Banco de Dados</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-5-4" max="10" min="0" name="question-16-5-4" type="range" value="<?=is_numeric($r["question-16-5-4"]) ? $r["question-16-5-4"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-5-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-5-5">Projetos</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-5-5" max="10" min="0" name="question-16-5-5" type="range" value="<?=is_numeric($r["question-16-5-5"]) ? $r["question-16-5-5"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-5-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-1"><strong>Softwares</strong></label>
					<label class="form-label" for="question-16-6-1">Excel</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-1" max="10" min="0" name="question-16-6-1" type="range" value="<?=is_numeric($r["question-16-6-1"]) ? $r["question-16-6-1"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-2">Word</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-2" max="10" min="0" name="question-16-6-2" type="range" value="<?=is_numeric($r["question-16-6-2"]) ? $r["question-16-6-2"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-3">PowerPoint</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-3" max="10" min="0" name="question-16-6-3" type="range" value="<?=is_numeric($r["question-16-6-3"]) ? $r["question-16-6-3"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-4">Access</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-4" max="10" min="0" name="question-16-6-4" type="range" value="<?=is_numeric($r["question-16-6-4"]) ? $r["question-16-6-4"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-5">Totvs</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-5" max="10" min="0" name="question-16-6-5" type="range" value="<?=is_numeric($r["question-16-6-5"]) ? $r["question-16-6-5"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-6">SAP</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-6" max="10" min="0" name="question-16-6-6" type="range" value="<?=is_numeric($r["question-16-6-6"]) ? $r["question-16-6-6"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-6"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-7">Photoshop</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-7" max="10" min="0" name="question-16-6-7" type="range" value="<?=is_numeric($r["question-16-6-7"]) ? $r["question-16-6-7"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-7"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-8">Premiere</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-8" max="10" min="0" name="question-16-6-8" type="range" value="<?=is_numeric($r["question-16-6-8"]) ? $r["question-16-6-8"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-8"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-9">Illustrator</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-9" max="10" min="0" name="question-16-6-9" type="range" value="<?=is_numeric($r["question-16-6-9"]) ? $r["question-16-6-9"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-9"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-10">Salesforce</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-10" max="10" min="0" name="question-16-6-10" type="range" value="<?=is_numeric($r["question-16-6-10"]) ? $r["question-16-6-10"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-10"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-11">PowerBI</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-11" max="10" min="0" name="question-16-6-11" type="range" value="<?=is_numeric($r["question-16-6-11"]) ? $r["question-16-6-11"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-11"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-12">Notes</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-12" max="10" min="0" name="question-16-6-12" type="range" value="<?=is_numeric($r["question-16-6-12"]) ? $r["question-16-6-12"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-12"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-16-6-13">Outros</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="question-16-6-13" max="10" min="0" name="question-16-6-13" type="range" value="<?=is_numeric($r["question-16-6-13"]) ? $r["question-16-6-13"] : 0?>"/>
						<p class="text-bold text-center"><?=$r["question-16-6-13"]?></p>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-17">17. Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto mais forte?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-17" name="question-17" placeholder="Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto mais forte?" rows="2" style="resize: none;"><?=$r["question-17"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-18">18. Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto de melhoria?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-18" name="question-18" placeholder="Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto de melhoria?" rows="2" style="resize: none;"><?=$r["question-18"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-19">19. Você se considera um expert em algo?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-19"] === "Não" ? "checked" : ""?> id="question-19" name="question-19" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-19"] === "Sim" ? "checked" : ""?> name="question-19" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, qual(is)?
					</label>
					<input class="form-input" id="question-19-1-disabled" name="question-19-1" placeholder="Qual(is)?" type="text" value="<?=$r["question-19-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-20">20. Descreva algum conhecimento técnico específico que você adquiriu no desempenho da função não descrito acima:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-20" name="question-20" placeholder="Descreva algum conhecimento técnico específico que você adquiriu no desempenho da função não descrito acima" rows="2" style="resize: none;"><?=$r["question-20"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-21">21. Descreva algum conhecimento técnico específico que você adquiriu na sua carreira e que julga de importância, mas não descrito acima:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-21" name="question-21" placeholder="Descreva algum conhecimento técnico específico que você adquiriu na sua carreira e que julga de importância, mas não descrito acima" rows="2" style="resize: none;"><?=$r["question-21"]?></textarea>
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
			// DESABILITAR MUDANÇA DE OUTROS PROCEDIMENTOS
			if($("input[id='question-15-1-other']").is(":checked"))
				$("input[name='question-15-1-1']").prop("disabled", false);
			else
				$("input[name='question-15-1-1']").prop("disabled", true);
			if($("input[id='question-15-2-other']").is(":checked"))
				$("input[name='question-15-2-1']").prop("disabled", false);
			else
				$("input[name='question-15-2-1']").prop("disabled", true);

			// DESABILITAR CAMPOS DE AERONAVES QUE JÁ OPEROU
			if($("input[id='question-15-3']").is(":checked"))
				$("input[name='question-15-3-1']").prop("disabled", false);
			else
				$("input[name='question-15-3-1']").prop("disabled", true);
			if($("input[id='question-15-3-honeywell']").is(":checked"))
				$("input[name='question-15-3-2']").prop("disabled", false);
			else
				$("input[name='question-15-3-2']").prop("disabled", true);
			if($("input[id='question-15-3-garmin']").is(":checked"))
				$("input[name='question-15-3-3']").prop("disabled", false);
			else
				$("input[name='question-15-3-3']").prop("disabled", true);
			if($("input[id='question-15-3-other']").is(":checked"))
				$("input[name='question-15-3-4']").prop("disabled", false);
			else
				$("input[name='question-15-3-4']").prop("disabled", true);

			// HABILITAR O CAMPO DE OUTROS PROCEDIMENTOS
			$("input[id='question-15-1-other']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='question-15-1-1']").prop("disabled", false);
				else
					$("input[name='question-15-1-1']").prop("disabled", true).val("");
			});
			$("input[id='question-15-2-other']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='question-15-2-1']").prop("disabled", false);
				else
					$("input[name='question-15-2-1']").prop("disabled", true).val("");
			});

			// HABILITAR CAMPOS DE AERONAVES QUE JÁ OPEROU
			$("input[id='question-15-3']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='question-15-3-1']").prop("disabled", false);
				else
					$("input[name='question-15-3-1']").prop("disabled", true).val("");
			});
			$("input[id='question-15-3-honeywell']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='question-15-3-2']").prop("disabled", false);
				else
					$("input[name='question-15-3-2']").prop("disabled", true).val("");
			});
			$("input[id='question-15-3-garmin']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='question-15-3-3']").prop("disabled", false);
				else
					$("input[name='question-15-3-3']").prop("disabled", true).val("");
			});
			$("input[id='question-15-3-other']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='question-15-3-4']").prop("disabled", false);
				else
					$("input[name='question-15-3-4']").prop("disabled", true).val("");
			});

			// DESABILITAR OS "SE SIM, QUAIS?"
			$("input[id*='disabled'][type='text']").each(function() {
				var nome = $(this).attr("name");
				if($("input[name='" + nome.substr(nome, nome.length-2) + "']:checked").val() === "Sim")
					$("input[name='" + nome + "']").prop("disabled", false);
				else
					$("input[name='" + nome + "']").prop("disabled", true).val("");
			})

			// HABILITAR O CAMPO DE CARGOS RELATIVOS À FUNÇÃO
			$("input[name='question-4']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-4-1']").prop("disabled", false);
				else
					$("input[name='question-4-1']").prop("disabled", true).val("");
			});

			// HABILITAR O CAMPO DE GERENTE TÓXICO
			$("input[name='question-13']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-13-1']").prop("disabled", false);
				else
					$("input[name='question-13-1']").prop("disabled", true).val("");
			});

			// HABILITAR O CAMPO DE EXPERT EM ALGO
			$("input[name='question-19']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-19-1']").prop("disabled", false);
				else
					$("input[name='question-19-1']").prop("disabled", true).val("");
			});

			// ANIMA A BARRA DE CONTROLE DESLIZANTE
			$("input[type='range']").each(function() {
				$(this).next().text($(this).val());
			});
			$("input[type='range']").on("click mousemove", function() {
				$(this).next().text($(this).val());
			});
		});
	</script>

</body>

</html>
