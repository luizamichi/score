<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ALUNOS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../student.php");

// MÓDULO NECESSÁRIO, ESTÁGIO NECESSÁRIO E TÍTULO DA PÁGINA
define("PAGE_MODULE", FORM_MODULES[0]);
define("PAGE_STAGE", FORM_STAGES[0]);
define("PAGE_TITLE", PAGE_MODULE . " (" . PAGE_STAGE . ")");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA TODAS AS RESPOSTAS DO USUÁRIO
$r = initial_registration_response(get_user()["student"]);

// DEFINE O TEMPO PARA EXIBIR EM TELA
$time = initial_registration_start_time(get_user()["student"]);

// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);
?>

	<div class="container grid-lg py-4">
		<div class="text-center">
			<h6 class="display-6 text-blue"><?=PAGE_STAGE?></h6>
		</div>

		<form action="<?=ACTION_NAME?>personal-data/initial-registration" class="form-horizontal" data-save="true" method="post">
			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-1">1. Nome</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-1" name="question-1" placeholder="Nome" type="text" value="<?=$r["question-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-2">2. Sobrenome</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-2" name="question-2" placeholder="Sobrenome" type="text" value="<?=$r["question-2"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-3">3. E-mail</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-3" name="question-3" placeholder="E-mail" type="email" value="<?=$r["question-3"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-4">4. Telefone</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-4" name="question-4" placeholder="Telefone" type="tel" value="<?=$r["question-4"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-5">5. Data de nascimento</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-5" name="question-5" type="date" value="<?=$r["question-5"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-6">6. Escolaridade</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<select class="form-select" id="question-6" name="question-6">
						<option disabled="disabled" <?=$r["question-6"] ? "" : "selected='selected'"?> value="">Escolha uma opção</option>
						<option <?=$r["question-6"] === "Ensino básico incompleto" ? "selected='selected'" : ""?> value="Ensino básico incompleto">Ensino básico incompleto</option>
						<option <?=$r["question-6"] === "Ensino básico completo" ? "selected='selected'" : ""?> value="Ensino básico completo">Ensino básico completo</option>
						<option <?=$r["question-6"] === "Ensino médio incompleto" ? "selected='selected'" : ""?> value="Ensino médio incompleto">Ensino médio incompleto</option>
						<option <?=$r["question-6"] === "Ensino médio completo" ? "selected='selected'" : ""?> value="Ensino médio completo">Ensino médio completo</option>
						<option <?=$r["question-6"] === "Ensino superior incompleto" ? "selected='selected'" : ""?> value="Ensino superior incompleto">Ensino superior incompleto</option>
						<option <?=$r["question-6"] === "Ensino superior completo" ? "selected='selected'" : ""?> value="Ensino superior completo">Ensino superior completo</option>
						<option <?=$r["question-6"] === "Especialização" ? "selected='selected'" : ""?> value="Especialização">Especialização</option>
						<option <?=$r["question-6"] === "Mestrado" ? "selected='selected'" : ""?> value="Mestrado">Mestrado</option>
						<option <?=$r["question-6"] === "Doutorado" ? "selected='selected'" : ""?> value="Doutorado">Doutorado</option>
					</select>
				</div>
			</div>

			<div class="form-group py-2" id="question-6-1-hide">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-6-1">Qual curso?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-6-1" list="courses" name="question-6-1" placeholder="Qual curso?" type="text" value="<?=$r["question-6-1"]?>"/>
					<datalist id="courses">
						<option value="Administração Pública"></option>
						<option value="Agronegócios"></option>
						<option value="Agronomia"></option>
						<option value="Antropologia"></option>
						<option value="Arqueologia"></option>
						<option value="Arquitetura"></option>
						<option value="Arquivologia"></option>
						<option value="Artes Cênicas"></option>
						<option value="Artes Plásticas"></option>
						<option value="Artes Visuais"></option>
						<option value="Astronomia"></option>
						<option value="Biblioteconomia"></option>
						<option value="Biologia"></option>
						<option value="Biomedicina"></option>
						<option value="Biotecnologia"></option>
						<option value="Cinema"></option>
						<option value="Ciência da Computação"></option>
						<option value="Ciências Ambientais"></option>
						<option value="Ciências Atuárias"></option>
						<option value="Ciências Biológicas"></option>
						<option value="Ciências Contábeis"></option>
						<option value="Ciências Exatas"></option>
						<option value="Ciências Naturais"></option>
						<option value="Ciências Políticas"></option>
						<option value="Ciências Sociais"></option>
						<option value="Comunicação Social"></option>
						<option value="Comércio Exterior"></option>
						<option value="Dança"></option>
						<option value="Desenho Industrial"></option>
						<option value="Design Gráfico"></option>
						<option value="Design de Games"></option>
						<option value="Direito"></option>
						<option value="Economia"></option>
						<option value="Educação Física"></option>
						<option value="Enfermagem"></option>
						<option value="Engenharia Aeronáutica"></option>
						<option value="Engenharia Aerospacial"></option>
						<option value="Engenharia Agrícola"></option>
						<option value="Engenharia Ambiental"></option>
						<option value="Engenharia Biomédica"></option>
						<option value="Engenharia Civil"></option>
						<option value="Engenharia Elétrica"></option>
						<option value="Engenharia Florestal"></option>
						<option value="Engenharia Mecatrônica"></option>
						<option value="Engenharia Mecânica"></option>
						<option value="Engenharia Metalúrgica"></option>
						<option value="Engenharia Naval"></option>
						<option value="Engenharia Nuclear"></option>
						<option value="Engenharia Química"></option>
						<option value="Engenharia da Computação"></option>
						<option value="Engenharia de Agrimensura"></option>
						<option value="Engenharia de Alimentos"></option>
						<option value="Engenharia de Controle e Automação"></option>
						<option value="Engenharia de Energia"></option>
						<option value="Engenharia de Materiais"></option>
						<option value="Engenharia de Minas"></option>
						<option value="Engenharia de Pesca"></option>
						<option value="Engenharia de Petróleo"></option>
						<option value="Engenharia de Produção"></option>
						<option value="Engenheria de Telecomunicações"></option>
						<option value="Estética"></option>
						<option value="Farmácia"></option>
						<option value="Filosofia"></option>
						<option value="Fisioterapia"></option>
						<option value="Fonoaudiologia"></option>
						<option value="Fotografia"></option>
						<option value="Física"></option>
						<option value="Gastronomia"></option>
						<option value="Geografia"></option>
						<option value="Geologia"></option>
						<option value="Gestão Ambiental"></option>
						<option value="Gestão Comercial"></option>
						<option value="Gestão Financeira"></option>
						<option value="Gestão Hospitalar"></option>
						<option value="Gestão de Recursos Humanos"></option>
						<option value="Hotelaria e Turismo"></option>
						<option value="Jornalismo"></option>
						<option value="Letras"></option>
						<option value="Logística"></option>
						<option value="Matemática"></option>
						<option value="Mecânica Industrial"></option>
						<option value="Medicina"></option>
						<option value="Medicina Veterinária"></option>
						<option value="Meteorologia"></option>
						<option value="Moda"></option>
						<option value="Multimídia"></option>
						<option value="Música"></option>
						<option value="Negócios Imobiliários"></option>
						<option value="Nutrição"></option>
						<option value="Oceanografia"></option>
						<option value="Odontologia"></option>
						<option value="Pedagogia"></option>
						<option value="Processos Gerenciais"></option>
						<option value="Psicologia"></option>
						<option value="Publicidade e Propaganda"></option>
						<option value="Química"></option>
						<option value="Radiologia"></option>
						<option value="Relações Internacionais"></option>
						<option value="Relações Públicas"></option>
						<option value="Rádio e TV"></option>
						<option value="Secretariado"></option>
						<option value="Segurança do Trabalho"></option>
						<option value="Serviço Social"></option>
						<option value="Sistemas de Informação"></option>
						<option value="Teatro"></option>
						<option value="Tecnologia da Informação"></option>
						<option value="Teologia"></option>
						<option value="Terapia Ocupacional"></option>
						<option value="Zootecnia"></option>
					</datalist>
				</div>
			</div>

			<div class="form-group py-2" id="question-6-2-hide">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-6-2">Qual campo?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-6-2" name="question-6-2" placeholder="Qual campo?" type="text" value="<?=$r["question-6-2"]?>"/>
				</div>
			</div>

			<div class="form-group py-2" id="question-6-3-hide">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-6-3">Universidade</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-6-3" list="universities" name="question-6-3" placeholder="Universidade" type="text" value="<?=$r["question-6-3"]?>"/>
					<datalist id="universities">
						<option value="FURB - Universidade Regional de Blumenau"></option>
						<option value="PUC-MG - Pontifícia Universidade Católica de Minas Gerais"></option>
						<option value="PUC-PR - Pontifícia Universidade Católica do Paraná"></option>
						<option value="PUC-RJ- Pontifícia Universidade Católica do Rio de Janeiro"></option>
						<option value="PUC-RS - Pontifícia Universidade Católica do Rio Grande do Sul"></option>
						<option value="PUC-SP - Pontifícia Universidade Católica de São Paulo"></option>
						<option value="PUCCAMP - Pontifícia Universidade Católica de Campinas"></option>
						<option value="UA - Universidade do Amazonas"></option>
						<option value="UAM - Universidade Anhembi Morumbi"></option>
						<option value="UBC - Universidade Braz Cubas"></option>
						<option value="UCB - Universidade Castelo Branco"></option>
						<option value="UCB - Universidade Católica de Brasília"></option>
						<option value="UCDB - Universidade Católica Dom Bosco"></option>
						<option value="UCG - Universidade Católica do Goiás"></option>
						<option value="UCP - Universidade Católica de Petrópolis"></option>
						<option value="UCPEL - Universidade Católica de Pelotas"></option>
						<option value="UCS - Universidade de Caxias do Sul"></option>
						<option value="UCSAL - Universidade Católica do Salvador"></option>
						<option value="UDESC - Universidade do Estado de Santa Catarina"></option>
						<option value="UECE - Universidade Estadual do Ceará"></option>
						<option value="UEFS - Universidade Estadual de Feira de Santana"></option>
						<option value="UEL - Universidade Estadual de Londrina"></option>
						<option value="UEM - Universidade Estadual de Maringá"></option>
						<option value="UEMA - Universidade Estadual do Maranhão"></option>
						<option value="UEMG - Universidade do Estado de Minas Gerais"></option>
						<option value="UEMS - Universidade Estadual de Mato Grosso do Sul."></option>
						<option value="UEPB - Universidade Estadual da Paraíba"></option>
						<option value="UEPG - Universidade Estadual de Ponta Grossa"></option>
						<option value="UERJ - Universidade do Estado do Rio de Janeiro"></option>
						<option value="UESB - Universidade Estadual do Sudoeste da Bahia"></option>
						<option value="UFAC - Universidade Federal do Acre"></option>
						<option value="UFAL - Universidade Federal de Alagoas"></option>
						<option value="UFBA - Universidade Federal da Bahia"></option>
						<option value="UFC - Universidade Federal do Ceará"></option>
						<option value="UFES - Universidade Federal do Espírito Santo"></option>
						<option value="UFF - Universidade Estadual do Norte Fluminense"></option>
						<option value="UFF - Universidade Federal Fluminense"></option>
						<option value="UFG - Universidade Federal de Goiás"></option>
						<option value="UFJF - Universidade Federal de Juiz de Fora"></option>
						<option value="UFLA - Universidade Federal de Lavras"></option>
						<option value="UFMA - Universidade Federal do Maranhão"></option>
						<option value="UFMA - Universidade Federal do Maranhão"></option>
						<option value="UFMG - Universidade Federal de Minas Gerais"></option>
						<option value="UFMS - Universidade Federal de Mato Grosso do Sul"></option>
						<option value="UFMT - Universidade Federal de Mato Grosso"></option>
						<option value="UFOP - Universidade Federal de Ouro Preto"></option>
						<option value="UFPA - Universidade Federal do Pará"></option>
						<option value="UFPB - Universidade Federal da Paraíba"></option>
						<option value="UFPE - Universidade Federal de Pernambuco"></option>
						<option value="UFPEL - Universidade Federal de Pelotas"></option>
						<option value="UFPI - Universidade Federal do Piauí"></option>
						<option value="UFPR - Universidade Federal do Paraná"></option>
						<option value="UFRGS - Universidade Federal do Rio Grande do Sul"></option>
						<option value="UFRJ - Universidade Federal do Rio de Janeiro"></option>
						<option value="UFRN - Universidade Federal do Rio Grande do Norte"></option>
						<option value="UFRPE - Universidade Federal Rural de Pernambuco"></option>
						<option value="UFRR - Universidade Federal de Roraima"></option>
						<option value="UFRRJ - Universidade Federal Rural do Rio de Janeiro"></option>
						<option value="UFS - Universidade Federal de Sergipe"></option>
						<option value="UFSC - Universidade Federal de Santa Catarina"></option>
						<option value="UFSC - Universidade Planalto Catarinense"></option>
						<option value="UFSCAR - Universidade Federal de São Carlos"></option>
						<option value="UFSM - Universidade Federal de Santa Maria"></option>
						<option value="UFU - Universidade Federal de Uberaba"></option>
						<option value="UFU - Universidade Federal de Uberlândia"></option>
						<option value="UFV - Universidade Federal de Viçosa"></option>
						<option value="UGF - Universidade Gama Filho"></option>
						<option value="ULBRA - Universidade Luterana do Brasil"></option>
						<option value="UM - Universidade Mackenzie"></option>
						<option value="UMC - Universidade de Mogi das Cruzes"></option>
						<option value="UNAERP - Universidade de Ribeirão Preto"></option>
						<option value="UNAMA - Universidade da Amazônia"></option>
						<option value="UNESA - Universidade Estácio de Sá"></option>
						<option value="UNESP - Universidade Paulista Júlio de Mesquita Filho"></option>
						<option value="UNG - Universidade de Guarulhos"></option>
						<option value="UNIABC - Universidade do ABC"></option>
						<option value="UNIANA - Universidade Estadual de Anápolis"></option>
						<option value="UNIARA - Centro Universitário de Araraquara"></option>
						<option value="UNIB - Universidade Ibirapuera"></option>
						<option value="UNIBAN - Universidade Bandeirantes de São Paulo"></option>
						<option value="UNICAMP - Universidade Estadual de Campinas"></option>
						<option value="UNICAP - Universidade Católica de Pernambuco"></option>
						<option value="UNICID - Universidade Cidade de São Paulo"></option>
						<option value="UNICSUL - Universidade Cruzeiro do Sul"></option>
						<option value="UNIDERP - Universidade para o Desenvolvimento do Estado e da Região do Pantanal"></option>
						<option value="UNIFENAS - Universidade de Alfenas"></option>
						<option value="UNIFESP - Universidade Federal de São Paulo"></option>
						<option value="UNIFOR - Universidade de Fortaleza"></option>
						<option value="UNIFRAN - Universidade de Franca"></option>
						<option value="UNIG - Universidade de Nova Iguaçu"></option>
						<option value="UNIGRANRIO - Universidade do Grande Rio"></option>
						<option value="UNIJUÍ - Universidade Regional do Noroeste do Estado do Rio Grande do Sul"></option>
						<option value="UNIMAR - Universidade de Marília"></option>
						<option value="UNIMARCO - Universidade São Marcos"></option>
						<option value="UNIMEP - Universidade Metodista de Piracicaba"></option>
						<option value="UNIMES - Universidade Metropolitana de Santos"></option>
						<option value="UNIOESTE - Universidade Estadual do Oeste do Paraná"></option>
						<option value="UNIP - Universidade Paulista"></option>
						<option value="UNIPE - Universidade de Ensino Superior do IPE"></option>
						<option value="UNIR - Fundação Universidade Federal de Rondônia"></option>
						<option value="UNIRIO - Universidade do Rio de Janeiro"></option>
						<option value="UNISA - Universidade Santo Amaro"></option>
						<option value="UNISANTA - Universidade de Santa Cecília"></option>
						<option value="UNISANTOS - Universidade Católica de Santos"></option>
						<option value="UNISC - Universidade de Santa Cruz do Sul"></option>
						<option value="UNISINOS - Universidade do Vale do Rio dos Sinos"></option>
						<option value="UNISUL - Universidade do Extremo Sul de Santa Catarina"></option>
						<option value="UNISUL - Universidade do Sul de Santa Catarina"></option>
						<option value="UNIT - Universidade Tiradentes"></option>
						<option value="UNITAU - Universidade de Taubaté"></option>
						<option value="UNIVALI - Universidade do Vale do Itajaí"></option>
						<option value="UNIVAP - Universidade do Vale do Paraíba"></option>
						<option value="UNIVERSO - Universidade Salgado de Oliveira"></option>
						<option value="UNOESTE - Universidade do Oeste Paulista"></option>
						<option value="UPE - Fundação Universidade de Pernambuco"></option>
						<option value="UPF - Universidade de Passo Fundo"></option>
						<option value="URCA - Universidade Regional do Cariri"></option>
						<option value="URCAMP - Universidade da Região de Campanha"></option>
						<option value="URG - Universidade do Rio Grande"></option>
						<option value="URI - Universidade Regional Integrada do Alto Uruguai e das Missões"></option>
						<option value="URRN - Universidade Regional do Rio Grande do Norte"></option>
						<option value="USC - Universidade do Sagrado Coração"></option>
						<option value="USF - Universidade São Francisco"></option>
						<option value="USJT - Universidade São Judas Tadeu"></option>
						<option value="USP - Universidade de São Paulo"></option>
						<option value="USU - Universidade Santa Úrsula"></option>
						<option value="UVA - Universidade Estadual do Vale do Acaraú"></option>
						<option value="UVA - Universidade Veiga de Almeida"></option>
						<option value="UnB - Universidade de Brasília"></option>
					</datalist>
				</div>
			</div>

			<div class="form-group py-2" id="question-6-4-hide">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-6-4">Data de conclusão</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-6-4" name="question-6-4" type="date" value="<?=$r["question-6-4"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-7">7. Para qual cargo e função você gostaria de ser avaliado?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-7" name="question-7" placeholder="Para qual cargo e função você gostaria de ser avaliado?" type="text" value="<?=$r["question-7"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-8">8. Qual seu nível atual de experiência?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-8"] === "Estagiário" ? "checked" : ""?> id="question-8" name="question-8" type="radio" value="Estagiário"/>
						<i class="form-icon"></i>
						Estagiário
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-8"] === "Junior" ? "checked" : ""?> name="question-8" type="radio" value="Junior"/>
						<i class="form-icon"></i>
						Junior
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-8"] === "Pleno" ? "checked" : ""?> name="question-8" type="radio" value="Pleno"/>
						<i class="form-icon"></i>
						Pleno
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-8"] === "Sênior" ? "checked" : ""?> name="question-8" type="radio" value="Sênior"/>
						<i class="form-icon"></i>
						Sênior
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-8"] === "Gerencial" ? "checked" : ""?> name="question-8" type="radio" value="Gerencial"/>
						<i class="form-icon"></i>
						Gerencial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-8"] === "Diretoria" ? "checked" : ""?> name="question-8" type="radio" value="Diretoria"/>
						<i class="form-icon"></i>
						Diretoria
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-9-1">9. Quais línguas você fala?</label>
				</div>
				<div class="col-8 col-sm-12 pb-2 pl-1">
					<label class="form-label" for="question-9-1"><strong>Inglês</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-1"] === "Nenhum" ? "checked" : ""?> id="question-9-1" name="question-9-1" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-1"] === "Básico" ? "checked" : ""?> name="question-9-1" type="radio" value="Básico"/>
						<i class="form-icon"></i>
						Básico
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-1"] === "Médio" ? "checked" : ""?> name="question-9-1" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-1"] === "Avançado" ? "checked" : ""?> name="question-9-1" type="radio" value="Avançado"/>
						<i class="form-icon"></i>
						Avançado
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-1"] === "Fluente" ? "checked" : ""?> name="question-9-1" type="radio" value="Fluente"/>
						<i class="form-icon"></i>
						Fluente
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-9-2"><strong>Espanhol</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-2"] === "Nenhum" ? "checked" : ""?> id="question-9-2" name="question-9-2" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-2"] === "Básico" ? "checked" : ""?> name="question-9-2" type="radio" value="Básico"/>
						<i class="form-icon"></i>
						Básico
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-2"] === "Médio" ? "checked" : ""?> name="question-9-2" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-2"] === "Avançado" ? "checked" : ""?> name="question-9-2" type="radio" value="Avançado"/>
						<i class="form-icon"></i>
						Avançado
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-2"] === "Fluente" ? "checked" : ""?> name="question-9-2" type="radio" value="Fluente"/>
						<i class="form-icon"></i>
						Fluente
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-9-3"><strong>Francês</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-3"] === "Nenhum" ? "checked" : ""?> id="question-9-3" name="question-9-3" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-3"] === "Básico" ? "checked" : ""?> name="question-9-3" type="radio" value="Básico"/>
						<i class="form-icon"></i>
						Básico
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-3"] === "Médio" ? "checked" : ""?> name="question-9-3" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-3"] === "Avançado" ? "checked" : ""?> name="question-9-3" type="radio" value="Avançado"/>
						<i class="form-icon"></i>
						Avançado
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-3"] === "Fluente" ? "checked" : ""?> name="question-9-3" type="radio" value="Fluente"/>
						<i class="form-icon"></i>
						Fluente
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-9-4"><strong>Alemão</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-4"] === "Nenhum" ? "checked" : ""?> id="question-9-4" name="question-9-4" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-4"] === "Básico" ? "checked" : ""?> name="question-9-4" type="radio" value="Básico"/>
						<i class="form-icon"></i>
						Básico
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-4"] === "Médio" ? "checked" : ""?> name="question-9-4" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-4"] === "Avançado" ? "checked" : ""?> name="question-9-4" type="radio" value="Avançado"/>
						<i class="form-icon"></i>
						Avançado
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-4"] === "Fluente" ? "checked" : ""?> name="question-9-4" type="radio" value="Fluente"/>
						<i class="form-icon"></i>
						Fluente
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2" id="question-9-5-disabled">
					<label class="form-label" for="question-9-5"><strong>Outros</strong></label>
					<label class="form-inline pr-2">
						<input class="form-input" id="question-9-5" name="question-9-5" placeholder="Quais?" type="text" value="<?=$r["question-9-5"]?>"/>
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-5-1"] === "Básico" ? "checked" : ""?> id="question-9-5-1" name="question-9-5-1" type="radio" value="Básico"/>
						<i class="form-icon"></i>
						Básico
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-5-1"] === "Médio" ? "checked" : ""?> name="question-9-5-1" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-5-1"] === "Avançado" ? "checked" : ""?> name="question-9-5-1" type="radio" value="Avançado"/>
						<i class="form-icon"></i>
						Avançado
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9-5-1"] === "Fluente" ? "checked" : ""?> name="question-9-5-1" type="radio" value="Fluente"/>
						<i class="form-icon"></i>
						Fluente
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-10">10. Você tem experiência na área que pretende desenvolver no futuro?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<select class="form-select" id="question-10" name="question-10">
						<option disabled="disabled" <?=$r["question-10"] ? "" : "selected='selected'"?> value="">Escolha uma opção</option>
						<option <?=$r["question-10"] === "Não tenho experiência" ? "selected='selected'" : ""?> value="Não tenho experiência">Não tenho experiência</option>
						<option <?=$r["question-10"] === "Menos de 1 ano de experiência" ? "selected='selected'" : ""?> value="Menos de 1 ano de experiência">Menos de 1 ano de experiência</option>
						<option <?=$r["question-10"] === "Entre 1 e 3 anos de experiência" ? "selected='selected'" : ""?> value="Entre 1 e 3 anos de experiência">Entre 1 e 3 anos de experiência</option>
						<option <?=$r["question-10"] === "Entre 3 e 5 anos de experiência" ? "selected='selected'" : ""?> value="Entre 3 e 5 anos de experiência">Entre 3 e 5 anos de experiência</option>
						<option <?=$r["question-10"] === "Acima de 5 anos de experiência" ? "selected='selected'" : ""?> value="Acima de 5 anos de experiência">Acima de 5 anos de experiência</option>
					</select>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-11">11. Pretende mudar de área?</label>
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
						Sim, porquê?
					</label>
					<label class="form-inline" id="question-11-1-disabled">
						<input class="form-input" id="question-11-1" name="question-11-1" placeholder="Porquê?" type="text" value="<?=$r["question-11-1"]?>"/>
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-12">12. Considerando as respostas da perguntas <a href="#question-7">7</a> e <a href="#question-8">8</a>, onde você se imagina daqui a 5 anos?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-12" name="question-12" placeholder="Considerando as respostas da perguntas 7 e 8, onde você se imagina daqui a 5 anos?" rows="2" style="resize: none;"><?=$r["question-12"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-13">13. Qual o emprego dos seus sonhos?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-13" name="question-13" placeholder="Qual o emprego dos seus sonhos?" type="text" value="<?=$r["question-13"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-14">14. Conte-nos algo mais sobre você:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-14" name="question-14" placeholder="Conte-nos algo mais sobre você" rows="3" style="resize: none;"><?=$r["question-14"]?></textarea>
				</div>
			</div>

			<div class="text-right">
				<input class="btn btn-green btn-lg" type="submit" value="Salvar"/>
			</div>
		</form>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

	<script>
		// DESABILITAR CAMPOS DE ESCOLARIDADE
		$("div[id*='hide'] input[value='']").parentsUntil("div[id*='hide']").parent().hide();

		// DESABILITAR OS BOTÕES DE OUTROS IDIOMAS
		if($("input[id='question-9-5']").val().length === 0) {
			$("input[id='question-9-5-1']").prop("checked", false);
			$("input[name='question-9-5-1']").prop("disabled", true);
		}
		else
			$("input[id='question-9-5-1']").prop("disabled", false);

		// DESABILITAR MUDANÇA DE ÁREA
		$("label[id*='disabled'] input[type='text']").prop("disabled", true);
		if($("input[name='question-11']:checked").val() === "Sim")
			$("label[id*='disabled'] input[type='text']").prop("disabled", false);

		// MOSTRAR CAMPOS ADICIONAIS DE ACORDO COM A ESCOLARIDADE
		$("select[name='question-6']").on("change", function() {
			if($.inArray($(this).val(), ["Ensino superior completo", "Ensino superior incompleto"]) >= 0) {
				$("div[id=question-6-2-hide]").hide().val("");
				$("div[id=question-6-1-hide], div[id=question-6-3-hide], div[id=question-6-4-hide]").show();
			}
			else if($.inArray($(this).val(), ["Especialização", "Mestrado", "Doutorado"]) >= 0) {
				$("div[id=question-6-1-hide]").hide().val("");
				$("div[id=question-6-2-hide], div[id=question-6-3-hide], div[id=question-6-4-hide]").show();
			}
			else
				$("div[id*='hide']").hide().val("");
		});

		// HABILITAR OUTROS IDIOMAS
		$("input[name='question-9-5']").on("keyup keydown", function() {
			if($(this).val().length > 0)
				$("div[id*='disabled'] input[type='radio']").prop("disabled", false);
			else {
				$("div[id*='disabled'] input[type='radio']").prop("disabled", true).prop("checked", false);
			}
		});

		// HABILITAR O CAMPO DE MUDANÇA DE ÁREA
		$("input[name='question-11']").on("change click", function() {
			if($(this).val() === "Sim")
				$("input[name='question-11-1']").prop("disabled", false);
			else
				$("input[name='question-11-1']").prop("disabled", true).val("");
		});
	</script>

</body>

</html>
