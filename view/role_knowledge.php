<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ALUNOS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../student.php");

// MÓDULO NECESSÁRIO, ESTÁGIO NECESSÁRIO E TÍTULO DA PÁGINA
define("PAGE_MODULE", FORM_MODULES[1]);
define("PAGE_STAGE", FORM_STAGES[1]);
define("PAGE_TITLE", PAGE_MODULE . " (" . PAGE_STAGE . ")");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA TODAS AS RESPOSTAS DO USUÁRIO
$r = role_knowledge_response(get_user()["student"]);

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

		<form action="<?=ACTION_NAME?>technical-evaluation/role-knowledge" class="form-horizontal" data-save="true" method="post">
			<div class="divider text-center" data-content="Rotina de funções"></div>
			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-1">1. Qual sua última experiência/cargo na função pretendida?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-1" name="question-1" placeholder="Qual sua última experiência/cargo na função pretendida?" rows="2" style="resize: none;"><?=$r["question-1"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-2">2. Quanto tempo trabalhou nesta função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-2" name="question-2" placeholder="Quanto tempo trabalhou nesta função?" type="text" value="<?=$r["question-2"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-3">3. Descreva sua rotina diária, semanal ou mensal na função:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-3" name="question-3" placeholder="Descreva sua rotina diária, semanal ou mensal na função" rows="2" style="resize: none;"><?=$r["question-3"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-4">4. Quais tipos de conhecimentos desenvolveu executando a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-4" name="question-4" placeholder="Quais tipos de conhecimentos desenvolveu executando a função?" rows="2" style="resize: none;"><?=$r["question-4"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-5">5. Quais habilidades desenvolveu desempenhando a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-5" name="question-5" placeholder="Quais habilidades desenvolveu desempenhando a função?" rows="2" style="resize: none;"><?=$r["question-5"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-6">6. Qual o tamanho da equipe de trabalho que atuava com você na execução das tarefas?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-6" name="question-6" placeholder="Qual o tamanho da equipe de trabalho que atuava com você na execução das tarefas?" rows="2" style="resize: none;"><?=$r["question-6"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-7">7. Qual o seu nível hierárquico dentro da equipe?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-7" name="question-7" placeholder="Qual o seu nível hierárquico dentro da equipe?" type="text" value="<?=$r["question-7"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-8">8. Descreva seus maiores desafios na rotina da função:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-8" name="question-8" placeholder="Descreva seus maiores desafios na rotina da função" rows="2" style="resize: none;"><?=$r["question-8"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-9">9. O que você acha que poderia ter feito diferente?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-9" name="question-9" placeholder="O que você acha que poderia ter feito diferente?" rows="2" style="resize: none;"><?=$r["question-9"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-10">10. Qual sua maior conquista durante seu tempo nesta função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-10" name="question-10" placeholder="Qual sua maior conquista durante seu tempo nesta função?" rows="2" style="resize: none;"><?=$r["question-10"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-11">11. Já trabalhou com metas?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-11"] === "Não" ? "checked" : ""?> id="question-11" name="question-11" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-11"] === "Sim" ? "checked" : ""?> name="question-11" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, cite as metas e sua performance nas últimas funções:
					</label>
					<input class="form-input" id="question-11-1-disabled" name="question-11-1" placeholder="Cite as metas e sua performance nas últimas funções" type="text" value="<?=$r["question-11-1"]?>"/>
				</div>
			</div>

			<div class="divider text-center" data-content="Familiaridade com manuais relativos a função"></div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-12">12. Quantos manuais eram empregados nas tarefas que você executava? Quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-12" name="question-12" placeholder="Quantos manuais eram empregados nas tarefas que você executava? Quais?" rows="2" style="resize: none;"><?=$r["question-12"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-13">13. Você ajudou no desenvolvimento de algum desses manuais? Quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-13" name="question-13" placeholder="Você ajudou no desenvolvimento de algum desses manuais? Quais?" rows="2" style="resize: none;"><?=$r["question-13"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-14">14. Você já trabalhou seguindo procedimentos operacionais padronizados pela empresa?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-14"] === "Não" ? "checked" : ""?> id="question-14" name="question-14" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-14"] === "Sim" ? "checked" : ""?> name="question-14" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="question-14-1-disabled" name="question-14-1" placeholder="Quais?" type="text" value="<?=$r["question-14-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-15-1">15. Você teve contato com manuais relativos a:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Operação de aeronaves", $r["question-15"]) ? "checked": ""?> id="question-15-1" name="question-15[]" type="checkbox" value="Operação de aeronaves"/>
							<i class="form-icon"></i>
							Operação de aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Manutenção de aeronaves", $r["question-15"]) ? "checked": ""?> id="question-15-2" name="question-15[]" type="checkbox" value="Manutenção de aeronaves"/>
							<i class="form-icon"></i>
							Manutenção de aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Operação de solo", $r["question-15"]) ? "checked": ""?> id="question-15-3" name="question-15[]" type="checkbox" value="Operação de solo"/>
							<i class="form-icon"></i>
							Operação de solo
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Operação de cargas", $r["question-15"]) ? "checked": ""?> id="question-15-4" name="question-15[]" type="checkbox" value="Operação de cargas"/>
							<i class="form-icon"></i>
							Operação de cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("SGSO ou Safety", $r["question-15"]) ? "checked": ""?> id="question-15-5" name="question-15[]" type="checkbox" value="SGSO ou Safety"/>
							<i class="form-icon"></i>
							SGSO ou Safety
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Atendimento a Pax", $r["question-15"]) ? "checked": ""?> id="question-15-6" name="question-15[]" type="checkbox" value="Atendimento a Pax"/>
							<i class="form-icon"></i>
							Atendimento a Pax
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("AVSEC", $r["question-15"]) ? "checked": ""?> id="question-15-7" name="question-15[]" type="checkbox" value="AVSEC"/>
							<i class="form-icon"></i>
							AVSEC
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros procedimentos", $r["question-15"]) ? "checked": ""?> id="question-15-8" name="question-15[]" type="checkbox" value="Outros procedimentos"/>
							<i class="form-icon"></i>
							Outros procedimentos
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-15-8-1" name="question-15-8-1" placeholder="Quais?" type="text" value="<?=$r["question-15-8-1"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-16">16. Algum desses manuais eram em inglês?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-16"] === "Não" ? "checked" : ""?> id="question-16" name="question-16" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-16"] === "Sim" ? "checked" : ""?> name="question-16" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="question-16-1-disabled" name="question-16-1" placeholder="Quais?" type="text" value="<?=$r["question-16-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-17">17. Descreva como esses manuais influenciavam sua rotina diária:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-17" name="question-17" placeholder="Descreva como esses manuais influenciavam sua rotina diária" rows="2" style="resize: none;"><?=$r["question-17"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-18">18. Qual o manual mais utilizado?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-18" name="question-18" placeholder="Qual o manual mais utilizado?" type="text" value="<?=$r["question-18"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-19">19. Você teve ou possui alguma dificuldade em relação aos manuais que trabalhou? Descreva:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-19" name="question-19" placeholder="Você teve ou possui alguma dificuldade em relação aos manuais que trabalhou? Descreva" rows="2" style="resize: none;"><?=$r["question-19"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-20">20. Você propôs alguma melhoria nos procedimentos descritos enquanto trabalhava na função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-20"] === "Não" ? "checked" : ""?> id="question-20" name="question-20" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-20"] === "Sim" ? "checked" : ""?> name="question-20" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="question-20-1-disabled" name="question-20-1" placeholder="Quais?" type="text" value="<?=$r["question-20-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-21">21. Com qual manual você tinha mais facilidade de manuseio e entendimento? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-21" name="question-21" placeholder="Com qual manual você tinha mais facilidade de manuseio e entendimento? Por quê?" rows="2" style="resize: none;"><?=$r["question-21"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-22">22. Com qual manual você tinha mais dificuldade de manuseio e entendimento? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-22" name="question-22" placeholder="Com qual manual você tinha mais dificuldade de manuseio e entendimento? Por quê?" rows="2" style="resize: none;"><?=$r["question-22"]?></textarea>
				</div>
			</div>

			<div class="divider text-center" data-content="Familiaridade com manuais relativos aos setores envolvidos"></div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-23">23. Com quais manuais você teve contato que não eram diretamente ligados à sua função, mas influenciavam sua rotina devido às tarefas executadas por pessoas que estavam envolvidas nos seus processos diários?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-23" name="question-23" placeholder="Com quais manuais você teve contato que não eram diretamente ligados à sua função, mas influenciavam sua rotina devido às tarefas executadas por pessoas que estavam envolvidas nos seus processos diários?" rows="6" style="resize: none;"><?=$r["question-23"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-24">24. Descreva como esses manuais e processos influenciavam sua rotina diária:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-24" name="question-24" placeholder="Descreva como esses manuais e processos influenciavam sua rotina diária" rows="2" style="resize: none;"><?=$r["question-24"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-25">25. Algum desses manuais eram em inglês?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-25"] === "Não" ? "checked" : ""?> id="question-25" name="question-25" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-25"] === "Sim" ? "checked" : ""?> name="question-25" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="question-25-1-disabled" name="question-25-1" placeholder="Quais?" type="text" value="<?=$r["question-25-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-26">26. Você teve alguma dificuldade com procedimentos “não compatíveis” entre os setores?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-26"] === "Não" ? "checked" : ""?> id="question-26" name="question-26" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-26"] === "Sim" ? "checked" : ""?> name="question-26" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="question-26-1-disabled" name="question-26-1" placeholder="Quais?" type="text" value="<?=$r["question-26-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-27">27. Por que julga que os procedimentos não eram compatíveis?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-27" name="question-27" placeholder="Por que julga que os procedimentos não eram compatíveis?" rows="2" style="resize: none;"><?=$r["question-27"]?></textarea>
				</div>
			</div>

			<div class="divider text-center" data-content="Familiaridade com legislação vigente, normas, requisitos e procedimentos gerais aplicáveis (ANAC, FAA, RF, Jurídico"></div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" id="question-28" for="question-28-1">28. Com quais autoridades regulatórias, normas ou procedimentos você teve mais contato na função?</label>
				</div>
				<div class="col-8 col-sm-12 pb-2 pl-1">
					<label class="form-label" for="question-28-1">ICAO</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-1"] === "Nenhum" ? "checked" : ""?> id="question-28-1" name="question-28-1" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-1"] === "Fraco" ? "checked" : ""?> name="question-28-1" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-1"] === "Regular" ? "checked" : ""?> name="question-28-1" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-1"] === "Bom" ? "checked" : ""?> name="question-28-1" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-1"] === "Ótimo" ? "checked" : ""?> name="question-28-1" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-2">ANAC</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-2"] === "Nenhum" ? "checked" : ""?> id="question-28-2" name="question-28-2" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-2"] === "Fraco" ? "checked" : ""?> name="question-28-2" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-2"] === "Regular" ? "checked" : ""?> name="question-28-2" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-2"] === "Bom" ? "checked" : ""?> name="question-28-2" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-2"] === "Ótimo" ? "checked" : ""?> name="question-28-2" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-3">FAA</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-3"] === "Nenhum" ? "checked" : ""?> id="question-28-3" name="question-28-3" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-3"] === "Fraco" ? "checked" : ""?> name="question-28-3" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-3"] === "Regular" ? "checked" : ""?> name="question-28-3" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-3"] === "Bom" ? "checked" : ""?> name="question-28-3" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-3"] === "Ótimo" ? "checked" : ""?> name="question-28-3" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-4">EASA</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-4"] === "Nenhum" ? "checked" : ""?> id="question-28-4" name="question-28-4" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-4"] === "Fraco" ? "checked" : ""?> name="question-28-4" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-4"] === "Regular" ? "checked" : ""?> name="question-28-4" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-4"] === "Bom" ? "checked" : ""?> name="question-28-4" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-4"] === "Ótimo" ? "checked" : ""?> name="question-28-4" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-5">IATA</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-5"] === "Nenhum" ? "checked" : ""?> id="question-28-5" name="question-28-5" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-5"] === "Fraco" ? "checked" : ""?> name="question-28-5" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-5"] === "Regular" ? "checked" : ""?> name="question-28-5" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-5"] === "Bom" ? "checked" : ""?> name="question-28-5" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-5"] === "Ótimo" ? "checked" : ""?> name="question-28-5" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-6">IOSA</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-6"] === "Nenhum" ? "checked" : ""?> id="question-28-6" name="question-28-6" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-6"] === "Fraco" ? "checked" : ""?> name="question-28-6" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-6"] === "Regular" ? "checked" : ""?> name="question-28-6" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-6"] === "Bom" ? "checked" : ""?> name="question-28-6" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-6"] === "Ótimo" ? "checked" : ""?> name="question-28-6" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-7">Infraero</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-7"] === "Nenhum" ? "checked" : ""?> id="question-28-7" name="question-28-7" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-7"] === "Fraco" ? "checked" : ""?> name="question-28-7" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-7"] === "Regular" ? "checked" : ""?> name="question-28-7" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-7"] === "Bom" ? "checked" : ""?> name="question-28-7" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-7"] === "Ótimo" ? "checked" : ""?> name="question-28-7" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-8">Receita Federal</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-8"] === "Nenhum" ? "checked" : ""?> id="question-28-8" name="question-28-8" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-8"] === "Fraco" ? "checked" : ""?> name="question-28-8" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-8"] === "Regular" ? "checked" : ""?> name="question-28-8" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-8"] === "Bom" ? "checked" : ""?> name="question-28-8" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-8"] === "Ótimo" ? "checked" : ""?> name="question-28-8" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-9">Jurídico</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-9"] === "Nenhum" ? "checked" : ""?> id="question-28-9" name="question-28-9" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-9"] === "Fraco" ? "checked" : ""?> name="question-28-9" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-9"] === "Regular" ? "checked" : ""?> name="question-28-9" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-9"] === "Bom" ? "checked" : ""?> name="question-28-9" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-9"] === "Ótimo" ? "checked" : ""?> name="question-28-9" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-10">Seis Sigma</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-10"] === "Nenhum" ? "checked" : ""?> id="question-28-10" name="question-28-10" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-10"] === "Fraco" ? "checked" : ""?> name="question-28-10" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-10"] === "Regular" ? "checked" : ""?> name="question-28-10" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-10"] === "Bom" ? "checked" : ""?> name="question-28-10" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-10"] === "Ótimo" ? "checked" : ""?> name="question-28-10" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-11">ISSO</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-11"] === "Nenhum" ? "checked" : ""?> id="question-28-11" name="question-28-11" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-11"] === "Fraco" ? "checked" : ""?> name="question-28-11" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-11"] === "Regular" ? "checked" : ""?> name="question-28-11" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-11"] === "Bom" ? "checked" : ""?> name="question-28-11" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-11"] === "Ótimo" ? "checked" : ""?> name="question-28-11" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-12">Anvisa</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-12"] === "Nenhum" ? "checked" : ""?> id="question-28-12" name="question-28-12" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-12"] === "Fraco" ? "checked" : ""?> name="question-28-12" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-12"] === "Regular" ? "checked" : ""?> name="question-28-12" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-12"] === "Bom" ? "checked" : ""?> name="question-28-12" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-12"] === "Ótimo" ? "checked" : ""?> name="question-28-12" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-13">Polícia Federal</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-13"] === "Nenhum" ? "checked" : ""?> id="question-28-13" name="question-28-13" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-13"] === "Fraco" ? "checked" : ""?> name="question-28-13" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-13"] === "Regular" ? "checked" : ""?> name="question-28-13" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-13"] === "Bom" ? "checked" : ""?> name="question-28-13" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-13"] === "Ótimo" ? "checked" : ""?> name="question-28-13" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-28-14">Forças Armadas (Marinha, Exército e/ou Aeronáutica)</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-14"] === "Nenhum" ? "checked" : ""?> id="question-28-14" name="question-28-14" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-14"] === "Fraco" ? "checked" : ""?> name="question-28-14" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-14"] === "Regular" ? "checked" : ""?> name="question-28-14" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-14"] === "Bom" ? "checked" : ""?> name="question-28-14" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-14"] === "Ótimo" ? "checked" : ""?> name="question-28-14" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2" id="question-28-15-disabled">
					<label class="form-label" for="question-28-15">Forças Armadas Estrangeiras</label>
					<label class="form-inline pr-2">
						<input class="form-input" id="question-28-15" name="question-28-15" placeholder="Quais?" type="text" value="<?=$r["question-28-15"]?>"/>
					</label>
					<br/>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-15-1"] === "Nenhum" ? "checked" : ""?> id="question-28-15-1" name="question-28-15-1" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-15-1"] === "Fraco" ? "checked" : ""?> name="question-28-15-1" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-15-1"] === "Regular" ? "checked" : ""?> name="question-28-15-1" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-15-1"] === "Bom" ? "checked" : ""?> name="question-28-15-1" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-15-1"] === "Ótimo" ? "checked" : ""?> name="question-28-15-1" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2" id="question-28-16-disabled">
					<label class="form-label" for="question-28-16">Outros</label>
					<label class="form-inline pr-2">
						<input class="form-input" id="question-28-16" name="question-28-16" placeholder="Quais?" type="text" value="<?=$r["question-28-16"]?>"/>
					</label>
					<br/>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-16-1"] === "Nenhum" ? "checked" : ""?> id="question-28-16-1" name="question-28-16-1" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-16-1"] === "Fraco" ? "checked" : ""?> name="question-28-16-1" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-16-1"] === "Regular" ? "checked" : ""?> name="question-28-16-1" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-16-1"] === "Bom" ? "checked" : ""?> name="question-28-16-1" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-28-16-1"] === "Ótimo" ? "checked" : ""?> name="question-28-16-1" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-29">29. Qual a regulação (lei, norma, procedimento, etc.) aplicável à sua função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-29" name="question-29" placeholder="Qual a regulação (lei, norma, procedimento, etc.) aplicável à sua função?" type="text" value="<?=$r["question-29"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-30">30. Você fez algum curso relativo a essa regulação?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-30"] === "Não" ? "checked" : ""?> id="question-30" name="question-30" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-30"] === "Sim" ? "checked" : ""?> name="question-30" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, qual?
					</label>
					<input class="form-input" id="question-30-1-disabled" name="question-30-1" placeholder="Qual?" type="text" value="<?=$r["question-30-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-31">31. Quais procedimentos executados por você estavam ligados a essas autoridades?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-31" name="question-31" placeholder="Quais procedimentos executados por você estavam ligados a essas autoridades?" rows="2" style="resize: none;"><?=$r["question-31"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-32">32. Como esses procedimentos influenciavam sua rotina diária?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-32" name="question-32" placeholder="Como esses procedimentos influenciavam sua rotina diária?" rows="2" style="resize: none;"><?=$r["question-32"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-33">33. Qual a maior dificuldade que você tinha no relacionamento com a Autoridade?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-33" name="question-33" placeholder="Qual a maior dificuldade que você tinha no relacionamento com a Autoridade?" rows="2" style="resize: none;"><?=$r["question-33"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-34">34. Você tinha contato direto com alguma agência do item <a href="#question-28">28</a>?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-34"] === "Não" ? "checked" : ""?> id="question-34" name="question-34" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-34"] === "Sim" ? "checked" : ""?> name="question-34" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, qual o nível hierárquico do contato?
					</label>
					<input class="form-input" id="question-34-1-disabled" name="question-34-1" placeholder="Qual o nível hierárquico do contato?" type="text" value="<?=$r["question-34-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-35">35. Você esteve envolvido em algum processo de certificação ligado a Autoridade?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-35"] === "Não" ? "checked" : ""?> id="question-35" name="question-35" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-35"] === "Sim" ? "checked" : ""?> name="question-35" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="question-35-1-disabled" name="question-35-1" placeholder="Quais?" type="text" value="<?=$r["question-35-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-36">36. Em algum momento você teve atrito (discussão, processo administrativo ou jurídico) com a Autoridade?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-36" name="question-36" placeholder="Em algum momento você teve atrito (discussão, processo administrativo ou jurídico) com a Autoridade?" rows="2" style="resize: none;"><?=$r["question-36"]?></textarea>
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
			// DESABILITAR AS FORÇAS ARMADAS ESTRANGEIRAS
			if($("input[id='question-28-15']").val().trim().length === 0) {
				$("input[id='question-28-15-1']").prop("checked", false);
				$("input[name='question-28-15-1']").prop("disabled", true);
			}
			else
				$("input[id='question-28-15-1']").prop("disabled", false);

			// DESABILITAR OUTRAS AUTORIDADES REGULATÓRIAS
			if($("input[id='question-28-16']").val().trim().length === 0) {
				$("input[id='question-28-16-1']").prop("checked", false);
				$("input[name='question-28-16-1']").prop("disabled", true);
			}
			else
				$("input[id='question-28-16-1']").prop("disabled", false);

			// DESABILITAR OS "SE SIM, QUAIS?"
			$("input[id*='disabled'][type='text']").each(function() {
				var nome = $(this).attr("name");
				if($("input[name='" + nome.substr(nome, nome.length-2) + "']:checked").val() === "Sim")
					$("input[name='" + nome + "']").prop("disabled", false);
				else
					$("input[name='" + nome + "']").prop("disabled", true).val("");
			})

			// HABILITAR O CAMPO DE MUDANÇA DE META
			$("input[name='question-11']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-11-1']").prop("disabled", false);
				else
					$("input[name='question-11-1']").prop("disabled", true).val("");
			});

			// HABILITAR O CAMPO DE PROCEDIMENTOS OPERACIONAIS PADRONIZADOS
			$("input[name='question-14']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-14-1']").prop("disabled", false);
				else
					$("input[name='question-14-1']").prop("disabled", true).val("");
			});

			// HABILITAR O CAMPO DE MANUAIS EM INGLÊS
			$("input[name='question-16']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-16-1']").prop("disabled", false);
				else
					$("input[name='question-16-1']").prop("disabled", true).val("");
			});

			// HABILITAR O CAMPO DE MUDANÇA DE MELHORIAS NOS PROCEDIMENTOS
			$("input[name='question-20']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-20-1']").prop("disabled", false);
				else
					$("input[name='question-20-1']").prop("disabled", true).val("");
			});

			// HABILITAR O CAMPO DE MUDANÇA DE PROCEDIMENTOS NÃO COMPATÍVEIS
			$("input[name='question-26']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-26-1']").prop("disabled", false);
				else
					$("input[name='question-26-1']").prop("disabled", true).val("");
			});

			// HABILITAR O CAMPO DE MUDANÇA DE CURSO RELATIVO
			$("input[name='question-30']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-30-1']").prop("disabled", false);
				else
					$("input[name='question-30-1']").prop("disabled", true).val("");
			});

			// HABILITAR O CAMPO DE MUDANÇA DE CONTATO DIRETO COM ALGUMA AGÊNCIA
			$("input[name='question-34']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-34-1']").prop("disabled", false);
				else
					$("input[name='question-34-1']").prop("disabled", true).val("");
			});

			// HABILITAR O CAMPO DE MUDANÇA DE PROCESSO LIGADO A AUTORIDADE
			$("input[name='question-35']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-35-1']").prop("disabled", false);
				else
					$("input[name='question-35-1']").prop("disabled", true).val("");
			});

			// HABILITAR O CAMPO DE MUDANÇA DE MANUAIS ERAM EM INGLÊS
			$("input[name='question-25']").on("change click", function() {
				if($(this).val() === "Sim")
					$("input[name='question-25-1']").prop("disabled", false);
				else
					$("input[name='question-25-1']").prop("disabled", true).val("");
			});

			// DESABILITAR MUDANÇA DE OUTROS PROCEDIMENTOS
			if($("input[id='question-15-8']").is(":checked"))
				$("input[name='question-15-8-1']").prop("disabled", false);
			else
				$("input[name='question-15-8-1']").prop("disabled", true);

			// HABILITAR FORÇAS ARMADAS ESTRANGEIRAS
			$("input[name='question-28-15']").on("keyup keydown", function() {
				if($(this).val().trim().length > 0)
					$("div[id*='disabled'] input[type='radio'][name='question-28-15-1']").prop("disabled", false);
				else {
					$("div[id*='disabled'] input[type='radio'][name='question-28-15-1']").prop("disabled", true).prop("checked", false);
				}
			});

			// HABILITAR OUTRAS AUTORIDADES REGULATÓRIAS
			$("input[name='question-28-16']").on("keyup keydown", function() {
				if($(this).val().trim().length > 0)
					$("div[id*='disabled'] input[type='radio'][name='question-28-16-1']").prop("disabled", false);
				else {
					$("div[id*='disabled'] input[type='radio'][name='question-28-16-1']").prop("disabled", true).prop("checked", false);
				}
			});

			// HABILITAR O CAMPO DE OUTROS PROCEDIMENTOS
			$("input[id='question-15-8']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='question-15-8-1']").prop("disabled", false);
				else
					$("input[name='question-15-8-1']").prop("disabled", true).val("");
			});
		});
	</script>

</body>

</html>
