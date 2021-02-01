<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ALUNOS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../student.php");

// MÓDULO NECESSÁRIO, ESTÁGIO NECESSÁRIO E TÍTULO DA PÁGINA
define("PAGE_MODULE", FORM_MODULES[2]);
define("PAGE_STAGE", FORM_STAGES[5]);
define("PAGE_TITLE", PAGE_MODULE . " (" . PAGE_STAGE . ")");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA TODAS AS RESPOSTAS DO USUÁRIO
$r = medium_english_response(get_user()["student"]);

// DEFINE O TEMPO PARA EXIBIR EM TELA
$time = initial_registration_start_time(get_user()["student"]);

// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);

// CARREGA O MENU SUPERIOR DA PÁGINA
require_once(INC_ROUTES["navbar"]);
?>

	<div class="container grid-lg py-4">
		<div class="text-center">
			<h6 class="display-6 text-blue"><?=PAGE_STAGE?></h6>
		</div>

		<form action="<?=ACTION_NAME?>english-level/medium" class="form-horizontal" data-save="true" method="post">
			<div>Fill in the blanks respectively with the correct alternative:</div>
			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-1">1. Charlie! Good to see you, man. It’s ____ a long time we don’t chat! How ____ Lisa doing?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-1"] === "Going / where" ? "checked" : ""?> id="question-1" name="question-1" required="required" type="radio" value="Going / where"/>
						<i class="form-icon"></i>
						Going / where
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-1"] === "Being / has" ? "checked" : ""?> name="question-1" required="required" type="radio" value="Being / has"/>
						<i class="form-icon"></i>
						Being / has
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-1"] === "Doing / was" ? "checked" : ""?> name="question-1" required="required" type="radio" value="Doing / was"/>
						<i class="form-icon"></i>
						Doing / was
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-1"] === "Been / is" ? "checked" : ""?> name="question-1" required="required" type="radio" value="Been / is"/>
						<i class="form-icon"></i>
						Been / is
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-2">2. The Catering is waiting but I can’t open the door, L5 door is jammed. ____ you please help me ____ it? I’ll call the engineers to come check it out.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-2"] === "Should / lock" ? "checked" : ""?> id="question-2" name="question-2" required="required" type="radio" value="Should / lock"/>
						<i class="form-icon"></i>
						Should / lock
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2"] === "Can / seal" ? "checked" : ""?> name="question-2" required="required" type="radio" value="Can / seal"/>
						<i class="form-icon"></i>
						Can / seal
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2"] === "Would / push" ? "checked" : ""?> name="question-2" required="required" type="radio" value="Would / push"/>
						<i class="form-icon"></i>
						Would / push
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2"] === "Will / close" ? "checked" : ""?> name="question-2" required="required" type="radio" value="Will / close"/>
						<i class="form-icon"></i>
						Will / close
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-3">3. The outbreak of Coronavirus disease (COVID-19) has acted as a massive restraint on the commercial aircraft manufacturing market in 2020, as supply chains were disrupted due to trade restrictions and manufacturing was affected by extensive lockdowns globally.</label>
					<div>What subject is the author discussing?</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-3"] === "The threat of the Coronavirus to the manufacturers of aircrafts and supplies, as it is a highly contagious and deadly virus." ? "checked" : ""?> id="question-3" name="question-3" required="required" type="radio" value="The threat of the Coronavirus to the manufacturers of aircrafts and supplies, as it is a highly contagious and deadly virus."/>
						<i class="form-icon"></i>
						The threat of the Coronavirus to the manufacturers of aircrafts and supplies, as it is a highly contagious and deadly virus.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-3"] === "The economic impact of COVID-19 and its preventative measures on commercial negotiations in the aircraft manufacturing market and industry development in 2020." ? "checked" : ""?> name="question-3" required="required" type="radio" value="The economic impact of COVID-19 and its preventative measures on commercial negotiations in the aircraft manufacturing market and industry development in 2020."/>
						<i class="form-icon"></i>
						The economic impact of COVID-19 and its preventative measures on commercial negotiations in the aircraft manufacturing market and industry development in 2020.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-3"] === "The consequences of COVID-19 to the aircraft manufacturing professionals, potentially affected by the disruption in the market." ? "checked" : ""?> name="question-3" required="required" type="radio" value="The consequences of COVID-19 to the aircraft manufacturing professionals, potentially affected by the disruption in the market."/>
						<i class="form-icon"></i>
						The consequences of COVID-19 to the aircraft manufacturing professionals, potentially affected by the disruption in the market.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-3"] === "The damaging ongoing outcome of Coronavirus in the aviation industry, causing companies to take extreme measures to protect their businesses." ? "checked" : ""?> name="question-3" required="required" type="radio" value="The damaging ongoing outcome of Coronavirus in the aviation industry, causing companies to take extreme measures to protect their businesses."/>
						<i class="form-icon"></i>
						The damaging ongoing outcome of Coronavirus in the aviation industry, causing companies to take extreme measures to protect their businesses.
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-4">4. Scarcely ______ taken off, we were forced to make an emergency landing.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-4"] === "we have" ? "checked" : ""?> id="question-4" name="question-4" required="required" type="radio" value="we have"/>
						<i class="form-icon"></i>
						we have
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-4"] === "we had" ? "checked" : ""?> name="question-4" required="required" type="radio" value="we had"/>
						<i class="form-icon"></i>
						we had
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-4"] === "have we" ? "checked" : ""?> name="question-4" required="required" type="radio" value="have we"/>
						<i class="form-icon"></i>
						have we
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-4"] === "had we" ? "checked" : ""?> name="question-4" required="required" type="radio" value="had we"/>
						<i class="form-icon"></i>
						had we
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-5">5. Aircraft manufacturers are using machine-learning techniques such as artificial intelligence (AI) to enhance aircraft safety and quality, as well as the manufacturing productivity.</label>
					<div>The word in bold could be replaced by:</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-5"] === "Improve" ? "checked" : ""?> id="question-5" name="question-5" required="required" type="radio" value="Improve"/>
						<i class="form-icon"></i>
						Improve
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-5"] === "Test" ? "checked" : ""?> name="question-5" required="required" type="radio" value="Test"/>
						<i class="form-icon"></i>
						Test
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-5"] === "Innovate" ? "checked" : ""?> name="question-5" required="required" type="radio" value="Innovate"/>
						<i class="form-icon"></i>
						Innovate
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-5"] === "Apply" ? "checked" : ""?> name="question-5" required="required" type="radio" value="Apply"/>
						<i class="form-icon"></i>
						Apply
					</label>
				</div>
			</div>

			<br/>
			<div>Fill in the blanks respectively with the correct alternative:</div>
			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-6">6. Susan: Hey Mike, just to let you know, I got a flat tire and I probably _____________ late for the meeting. I’m on my way there though.</label>
					<div>Mike: No worries, Susan! ______________</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-6"] === "will be / You alright?" ? "checked" : ""?> id="question-6" name="question-6" required="required" type="radio" value="will be / You alright?"/>
						<i class="form-icon"></i>
						will be / You alright?
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-6"] === "am / Take care." ? "checked" : ""?> name="question-6" required="required" type="radio" value="am / Take care."/>
						<i class="form-icon"></i>
						am / Take care.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-6"] === "will be running / Do you need a ride?" ? "checked" : ""?> name="question-6" required="required" type="radio" value="will be running / Do you need a ride?"/>
						<i class="form-icon"></i>
						will be running / Do you need a ride?
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-6"] === "will get / Have a nice day!" ? "checked" : ""?> name="question-6" required="required" type="radio" value="will get / Have a nice day!"/>
						<i class="form-icon"></i>
						will get / Have a nice day!
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-7">7. You’d better take these tools with you _______ you need to make a repair.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-7"] === "otherwise" ? "checked" : ""?> id="question-7" name="question-7" required="required" type="radio" value="otherwise"/>
						<i class="form-icon"></i>
						otherwise
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-7"] === "unless" ? "checked" : ""?> name="question-7" required="required" type="radio" value="unless"/>
						<i class="form-icon"></i>
						unless
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-7"] === "in case" ? "checked" : ""?> name="question-7" required="required" type="radio" value="in case"/>
						<i class="form-icon"></i>
						in case
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-7"] === "because" ? "checked" : ""?> name="question-7" required="required" type="radio" value="because"/>
						<i class="form-icon"></i>
						because
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-8">8. Would you mind _________ the Section 7.3 of the Manual to me, please? There’s a procedure I want to review with the team today.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-8"] === "to forward" ? "checked" : ""?> id="question-8" name="question-8" required="required" type="radio" value="to forward"/>
						<i class="form-icon"></i>
						to forward
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-8"] === "forwarding" ? "checked" : ""?> name="question-8" required="required" type="radio" value="forwarding"/>
						<i class="form-icon"></i>
						forwarding
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-8"] === "to check" ? "checked" : ""?> name="question-8" required="required" type="radio" value="to check"/>
						<i class="form-icon"></i>
						to check
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-8"] === "checking" ? "checked" : ""?> name="question-8" required="required" type="radio" value="checking"/>
						<i class="form-icon"></i>
						checking
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-9">9. Boeing has successfully built machine-learning algorithms to design aircraft and automate factory operations.</label>
					<div>Which alternative best describes what you’ve read?</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-9"] === "It’s a good project, however artificial intelligence is merely a projection into the future." ? "checked" : ""?> id="question-9" name="question-9" required="required" type="radio" value="It’s a good project, however artificial intelligence is merely a projection into the future."/>
						<i class="form-icon"></i>
						It’s a good project, however artificial intelligence is merely a projection into the future.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9"] === "Automated systems and robots are gradually replacing human labor." ? "checked" : ""?> name="question-9" required="required" type="radio" value="Automated systems and robots are gradually replacing human labor."/>
						<i class="form-icon"></i>
						Automated systems and robots are gradually replacing human labor.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9"] === "Artificial Intelligence has been employed in the aircraft manufacturing industry." ? "checked" : ""?> name="question-9" required="required" type="radio" value="Artificial Intelligence has been employed in the aircraft manufacturing industry."/>
						<i class="form-icon"></i>
						Artificial Intelligence has been employed in the aircraft manufacturing industry.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-9"] === "Boeing is a successful aerospace company that designs, manufactures and sells airplanes." ? "checked" : ""?> name="question-9" required="required" type="radio" value="Boeing is a successful aerospace company that designs, manufactures and sells airplanes."/>
						<i class="form-icon"></i>
						Boeing is a successful aerospace company that designs, manufactures and sells airplanes.
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-10">10. The other day I ran into Juliet on the way to the office and she told me about the new policies to be implemented.</label>
					<div>The terms in bold could be replaced by:</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-10"] === "Asked" ? "checked" : ""?> id="question-10" name="question-10" required="required" type="radio" value="Asked"/>
						<i class="form-icon"></i>
						Asked
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-10"] === "Spoke with" ? "checked" : ""?> name="question-10" required="required" type="radio" value="Spoke with"/>
						<i class="form-icon"></i>
						Spoke with
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-10"] === "Walked along" ? "checked" : ""?> name="question-10" required="required" type="radio" value="Walked along"/>
						<i class="form-icon"></i>
						Walked along
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-10"] === "Bumped into" ? "checked" : ""?> name="question-10" required="required" type="radio" value="Bumped into"/>
						<i class="form-icon"></i>
						Bumped into
					</label>
				</div>
			</div>

			<br/>
			<div>Choose which alternative best describes the sentence below.</div>
			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-11">11. I can’t wait to see my father. He’s arriving tomorrow.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-11"] === "I’m looking forward to it." ? "checked" : ""?> id="question-11" name="question-11" required="required" type="radio" value="I’m looking forward to it."/>
						<i class="form-icon"></i>
						I’m looking forward to it.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-11"] === "I don’t like waiting." ? "checked" : ""?> name="question-11" required="required" type="radio" value="I don’t like waiting."/>
						<i class="form-icon"></i>
						I don’t like waiting.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-11"] === "I don’t want to see my father." ? "checked" : ""?> name="question-11" required="required" type="radio" value="I don’t want to see my father."/>
						<i class="form-icon"></i>
						I don’t want to see my father.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-11"] === "I don’t have time tomorrow." ? "checked" : ""?> name="question-11" required="required" type="radio" value="I don’t have time tomorrow."/>
						<i class="form-icon"></i>
						I don’t have time tomorrow.
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-12">12. Flight Attendant: Which one do you prefer, coffee or tea?</label>
					<div>Mrs. Fox: ______ the tea, please. With milk, no sugar.</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-12"] === "I’d have" ? "checked" : ""?> id="question-12" name="question-12" required="required" type="radio" value="I’d have"/>
						<i class="form-icon"></i>
						I’d have
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-12"] === "I’d rather prefer" ? "checked" : ""?> name="question-12" required="required" type="radio" value="I’d rather prefer"/>
						<i class="form-icon"></i>
						I’d rather prefer
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-12"] === "I’m having" ? "checked" : ""?> name="question-12" required="required" type="radio" value="I’m having"/>
						<i class="form-icon"></i>
						I’m having
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-12"] === "I’ll have" ? "checked" : ""?> name="question-12" required="required" type="radio" value="I’ll have"/>
						<i class="form-icon"></i>
						I’ll have
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-13">13. Machine learning algorithms collect data from machine-to-machine and machine-tohuman interfaces and use data analytics to drive effective decision making. These technologies optimize manufacturing operations and lower costs. For example, GE Aviation uses machine learning and data analytics to identify faults in engines, which increases components’ lives and reduces maintenance costs.</label>
					<div>Which alternative best describes what you’ve read?</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-13"] === "The learning capacity of machines is highly effective for factory operation, as it can be used in various segments of manufacturing and assist in decision making." ? "checked" : ""?> id="question-13" name="question-13" required="required" type="radio" value="The learning capacity of machines is highly effective for factory operation, as it can be used in various segments of manufacturing and assist in decision making."/>
						<i class="form-icon"></i>
						The learning capacity of machines is highly effective for factory operation, as it can be used in various segments of manufacturing and assist in decision making.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-13"] === "The advancement of technology is turning the manufacturing operations cost-effective by engaging artificial intelligence to diagnose and prevent shortcomings." ? "checked" : ""?> name="question-13" required="required" type="radio" value="The advancement of technology is turning the manufacturing operations cost-effective by engaging artificial intelligence to diagnose and prevent shortcomings."/>
						<i class="form-icon"></i>
						The advancement of technology is turning the manufacturing operations cost-effective by engaging artificial intelligence to diagnose and prevent shortcomings.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-13"] === "Data analytics help optimize the operations performance, assist in an effective decision making and reduces maintenance costs." ? "checked" : ""?> name="question-13" required="required" type="radio" value="Data analytics help optimize the operations performance, assist in an effective decision making and reduces maintenance costs."/>
						<i class="form-icon"></i>
						Data analytics help optimize the operations performance, assist in an effective decision making and reduces maintenance costs.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-13"] === "These are configurations, processes and technologies that allow machines to learn how to develop efficient algorithms without human validation." ? "checked" : ""?> name="question-13" required="required" type="radio" value="These are configurations, processes and technologies that allow machines to learn how to develop efficient algorithms without human validation."/>
						<i class="form-icon"></i>
						These are configurations, processes and technologies that allow machines to learn how to develop efficient algorithms without human validation.
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-14">14. I need to _____ a word with Oscar about my license expiration, I’ll _____ on a break in an hour.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-14"] === "speak / take" ? "checked" : ""?> id="question-14" name="question-14" required="required" type="radio" value="speak / take"/>
						<i class="form-icon"></i>
						speak / take
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-14"] === "talk / come" ? "checked" : ""?> name="question-14" required="required" type="radio" value="talk / come"/>
						<i class="form-icon"></i>
						talk / come
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-14"] === "have / go" ? "checked" : ""?> name="question-14" required="required" type="radio" value="have / go"/>
						<i class="form-icon"></i>
						have / go
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-14"] === "get / talk" ? "checked" : ""?> name="question-14" required="required" type="radio" value="get / talk"/>
						<i class="form-icon"></i>
						get / talk
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-15">15. _____ can I get to the main station from here? _____ I go up or down this street?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["question-15"] === "Where / Can" ? "checked" : ""?> id="question-15" name="question-15" required="required" type="radio" value="Where / Can"/>
						<i class="form-icon"></i>
						Where / Can
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-15"] === "What / Must" ? "checked" : ""?> name="question-15" required="required" type="radio" value="What / Must"/>
						<i class="form-icon"></i>
						What / Must
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-15"] === "Who / Which" ? "checked" : ""?> name="question-15" required="required" type="radio" value="Who / Which"/>
						<i class="form-icon"></i>
						Who / Which
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-15"] === "How / Should" ? "checked" : ""?> name="question-15" required="required" type="radio" value="How / Should"/>
						<i class="form-icon"></i>
						How / Should
					</label>
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

</body>

</html>
