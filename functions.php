<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS
require_once(__DIR__ . "/configurations.php");


// REMOVE TAGS HTML, ESPAÇOS ADICIONAIS E ADICIONA BARRAS INVERSAS ANTES DAS ASPAS
function clean_text(string $text=null): string {
	$quotation_marks = addslashes($text);
	$html = filter_var($quotation_marks, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	return trim($html);
}


// IMPRIME A VARIÁVEL E ENCERRA A EXECUÇÃO
function die_dump(mixed ...$variable): void {
	foreach($variable as $v) {
		var_dump($v);
		echo php_sapi_name() === "cli" ? PHP_EOL : "<br/>";
	}
	exit();
}


// RETORNA O VALOR DE UMA VARIÁVEL (ISSET COM RETORNO)
function variable_value(mixed &$variable): mixed {
	if(isset($variable)) {
		return $variable;
	}
	return null;
}


// RETORNA O NOME DA VARIÁVEL
function variable_name(mixed $variable): string {
	foreach($GLOBALS as $name => $value) {
		if($value === $variable) {
			return $name;
		}
	}

	return "";
}


// RETORNA O VALOR DE UMA VARIÁVEL (CASO EXISTA, SENÃO RETORNA UM VALOR DEFINIDO)
function null_value(mixed &$variable, mixed $value=""): mixed {
	if(isset($variable)) {
		return $variable;
	}
	return $value;
}


// IMPRIME A VARIÁVEL EM FORMATO JSON
function json_dump(mixed ...$variable): void {
	$json = [];
	$index = 0;

	foreach($variable as $v) {
		$name = variable_name($v);
		if(array_key_exists($name, $json)) {
			$name = $index++;
		}

		array_push($json, [$name => $v]);
	}

	echo json_encode($json, JSON_PRETTY_PRINT);
}


// REDIRECIONA A PÁGINA OU RECARREGA
function redirect(string $location="", bool $force=true): void {
	if(!headers_sent()) {
		if(strlen($location) === 0) {
			header("Refresh: 0");
		}
		else {
			header("Location: " . $location);
		}
		exit();
	}
	elseif($force) {
		echo "<script>window.location.href = '" . $location . "'</script>";
		exit();
	}
}


// OBTÉM O CONTEÚDO HTML DE UMA PÁGINA
function get_content(string $url=null): string {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_URL, $url);

	$data = curl_exec($curl);
	curl_close($curl);

	return $data;
}


// RETORNA O ENDEREÇO IP REAL DO VISITANTE
function get_ip(): string {
	return $_SERVER["HTTP_CLIENT_IP"] ?? $_SERVER["HTTP_X_FORWARDED_FOR"] ?? $_SERVER["REMOTE_ADDR"] ?? "";
}


// ACRESCENTA ESPAÇOS EM BRANCOS AO FINAL DO TEXTO
function fill_in_blanks(string $text="", int $length=0): string {
	$string_length = strlen($text);

	if($string_length > $length) { // O TAMANHO SUGERIDO É MENOR QUE O TAMANHO DO TEXTO
		return substr($text, 0, $length);
	}

	elseif($string_length === $length) { // O TAMANHO SUGERIDO É IGUAL AO TAMANHO DO TEXTO
		return $text;
	}

	else { // ADICIONA OS ESPAÇOS EM BRANCO AO FINAL DO TEXTO
		return $text . str_repeat(" ", $length - $string_length);
	}
}


// OBTÉM O NOME DA PÁGINA SOLICITADA (URN - NOME DE RECURSO UNIVERSAL)
function get_urn(): string {
	$urn = rtrim(dirname($_SERVER["SCRIPT_NAME"] ?? ""), "/");
	$urn = trim(str_replace($urn, "", $_SERVER["REQUEST_URI"] ?? ""), "/");
	$urn = explode("?", $urn)[0];
	$urn = urldecode($urn);

	return $urn;
}


// MAPEIA TODOS OS ARQUIVOS DE UM DIRETÓRIO
function tree(string $directory): array {
	if(is_dir($directory)) {
		$files = scandir($directory);
		$files = array_diff($files, [".", ".."]);
		return array_values($files);
	}
	return [];
}


// REMOVE OS ARQUIVOS DE UMA LISTA
function remove_files(array $files): void {
	foreach($files as $file) {
		if(file_exists($file)) {
			unlink($file);
		}
	}
}


// CALCULA UM VETOR MENOS OUTRO VETOR (TUDO O QUE TEM NO PRIMEIRO MENOS O QUE TEM NO SEGUNDO)
function array_difference(array $array1, array $array2): array {
	$result = [];
	foreach($array2 as $index) {
		if(!in_array($index, $array1)) {
			array_push($result, $index);
		}
	}

	return $result;
}


// GRAVA UM TEXTO NO LOG MENSAL
function record_log(string $text=""): bool {
	$message = trim($text);

	if(strlen($text) > 0) {
		$date = fill_in_blanks(date("Y-m-d H:i:s"), 19);
		$remote_address = fill_in_blanks(isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : "undefined", 39);
		$text = $date . " " . $remote_address . " " . $message;

		try {
			if(!is_dir(LOG_PATH)) { // NÃO POSSUI UM DIRETÓRIO DE LOG CRIADO
				mkdir(LOG_PATH);

				// CRIA UM ARQUIVO QUE PROÍBE O ACESSO AO DIRETÓRIO DE LOG
				$file = fopen(LOG_PATH . ".htaccess", "w");
				fwrite($file, "Deny from all");
				fclose($file);
			}

			$filename = date("Y-m") . ".log";
			if(!file_exists(LOG_PATH . $filename)) { // O ARQUIVO AINDA NÃO FOI CRIADO
				$text = "DATETIME            IP ADDRESS                              MESSAGE" . PHP_EOL . $text;
			}

			$file = fopen(LOG_PATH . $filename, "a");
			$write = fwrite($file, $text . PHP_EOL);

			fclose($file);
			return (bool) $write;
		}

		catch(Exception $e) {
			return false;
		}
	}

	return false;
}


// RETORNA UMA INSTÂNCIA CONECTADA AO BANCO DE DADOS
function mysql(string $host=SQL_HOST, int $port=SQL_PORT, string $schema=SQL_SCHEMA, string $user=SQL_USER, string $password=SQL_PASS): ?PDO {
	if(defined("SQL_CONNECTION")) {
		$connection = SQL_CONNECTION;
	}
	else {
		try { // TENTA FAZER COMUNICAÇÃO COM O SGBD
			$connection = new PDO("mysql:host=" . $host . ";dbname=" . $schema . ";charset=utf8;port=" . $port, $user, $password);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			define("SQL_CONNECTION", $connection);
		}

		catch(PDOException $exception) { // ABORTA O PROGRAMA
			$connection = null;
			$message = "Não foi possível estabelecer conexão com o banco de dados.";
			set_message($message);
			set_json(["message" => $message]);
		}
	}

	return $connection;
}


// EXECUTA FUNÇÕES DE CRUD NO BANCO DE DADOS
function sql_query(string $query): array|bool {
	$connection = mysql();

	try {
		$statement = $connection->prepare($query);

		if($statement->execute()) {
			if(substr($query, 0, 6) === "select") { // OPERAÇÃO DE SELECT
				return $statement->fetchAll(PDO::FETCH_ASSOC);
			}

			else { // OPERAÇÃO DE INSERT, UPDATE OU DELETE
				return true;
			}
		}

		return (bool) $statement->rowCount();
	}

	catch(PDOException | Throwable $exception) {
		if(substr($query, 0, 6) === "select") {
			return [];
		}
		return false;
	}

	finally {
		$connection = null;
	}
}


// RETORNA O MÉTODO SOLICITADO NA REQUISIÇÃO
function request_method(): string {
	return isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "GET";
}


// VALIDADOR DE CPF
function validate_cpf(string $cpf): bool {
	$cpf = preg_replace("/\D/is", "", $cpf);

	if(strlen($cpf) != 11) {
		return false;
	}

	if(preg_match("/(\d)\1{10}/", $cpf)) {
		return false;
	}

	for($t=9; $t<11; $t++) {
		$d = 0;
		for($c=0; $c<$t; $c++) {
			$d += $cpf[$c] * (($t + 1) - $c);
		}
		$d = ((10 * $d) % 11) % 10;

		if($cpf[$c] != $d) {
			return false;
		}
	}

	return true;
}


// CALCULA A DIFERENÇA ENTRE DUAS DATAS
function calculate_time(string $start_time, string $end_time): string {
	$initial_data = new DateTime($start_time);
	$final_date = new DateTime($end_time);
	$interval = $initial_data->diff($final_date);
	$difference = [];

	$days = $interval->d >= 1 ? $interval->d . " dia" . ($interval->d > 1 ? "s" : "") : "";
	empty($days) ?: array_push($difference, $days);
	$months = $interval->m >= 1 ? $interval->m . ($interval->m === 1 ? " mês" : " meses") : "";
	empty($months) ?: array_push($difference, $months);
	$years = $interval->y >= 1 ? $interval->y . " ano" . ($interval->y > 1 ? "s" : "") : "";
	empty($years) ?: array_push($difference, $years);

	$hours = $interval->h >= 1 ? $interval->h . " hora" . ($interval->h > 1 ? "s" : "") : "";
	empty($hours) ?: array_push($difference, $hours);
	$minutes = $interval->i >= 1 ? $interval->i . " minuto" . ($interval->i > 1 ? "s" : "") : "";
	empty($minutes) ?: array_push($difference, $minutes);
	$seconds = $interval->s >= 1 ? $interval->s . " segundo" . ($interval->s > 1 ? "s" : "") : "";
	empty($seconds) ?: array_push($difference, $seconds);

	$last = array_pop($difference);
	if($difference) {
		return implode(", ", $difference) . " e " . $last;
	}
	return is_null($last) ? "0 segundo" : $last;
}


// CALCULA O TEMPO EFETIVO DE DIFERENTES DATAS
function total_time(array ...$times): string {
	$total = ["y" => 0, "m" => 0, "d" => 0, "h" => 0, "i" => 0, "s" => 0];

	foreach($times as $time) {
		$initial_data = new DateTime($time[0]);
		$final_date = new DateTime($time[1]);
		$difference = $initial_data->diff($final_date);

		$total["y"] += $difference->y;
		$total["m"] += $difference->m;
		$total["d"] += $difference->d;
		$total["h"] += $difference->h;
		$total["i"] += $difference->i;
		$total["s"] += $difference->s;
	}

	$current = date("Y-m-d H:i:s");
	$time = strtotime($current);
	$date = date("Y-m-d H:i:s", strtotime("+ " . $total["y"] . " years, + " . $total["m"] . " months, + " . $total["d"] . " days, + " . $total["h"] . " hours, + " . $total["i"] . " minutes, + " . $total["s"] . " seconds", $time));

	return calculate_time($current, $date);
}


// INICIA UMA SESSÃO PARA O USUÁRIO
function start_user_section(string $name, array $user): string {
	if(in_array($name, ["administrator", "student"])) {
		$_SESSION[$name] = serialize($user);
		session_regenerate_id();
	}

	return session_id();
}


// INICIA UMA SESSÃO PARA ADMINISTRADOR
function start_administrator_session(array $administrator): string {
	return start_user_section("administrator", $administrator);
}


// INICIA UMA SESSÃO PARA ALUNO
function start_student_session(array $student): string {
	return start_user_section("student", $student);
}


// VERIFICA SE O USUÁRIO É UM ADMINISTRADOR
function user_is_administrator(): bool {
	return isset($_SESSION["administrator"]);
}


// VERIFICA SE O USUÁRIO É UM ALUNO
function user_is_student(): bool {
	return isset($_SESSION["student"]);
}


// VALIDA SE O USUÁRIO ESTÁ LOGADO NO SISTEMA
function user_is_logined(): bool {
	if(!empty($_SESSION) && (isset($_SESSION["administrator"]) || isset($_SESSION["student"]))) {
		return true;
	}
	return false;
}


// RETORNA O USUÁRIO VINCULADO À SESSÃO
function get_user(): array {
	if(isset($_SESSION["administrator"])) { // VERIFICA SE O USUÁRIO É UM ADMINISTRADOR
		return unserialize($_SESSION["administrator"]);
	}

	elseif(isset($_SESSION["student"])) { // VERIFICA SE O USUÁRIO É UM ALUNO
		return unserialize($_SESSION["student"]);
	}

	return [];
}


// ENCERRA TODAS AS SESSÕES DO SISTEMA
function destroy_all_sessions(bool $message=true, bool $color=true, bool $data=true, bool $user=true, bool $users=true): void {
	if(isset($_SESSION["message"]) && $message) { // REMOVE A MENSAGEM ARMAZENADA NA SESSÃO
		unset($_SESSION["message"]);
	}

	if(isset($_SESSION["color"]) && $color) { // REMOVE A COR ARMAZENADA NA SESSÃO
		unset($_SESSION["color"]);
	}

	if(isset($_SESSION["data"]) && $data) { // REMOVE OS DADOS ARMAZENADOS NA SESSÃO
		unset($_SESSION["data"]);
	}

	if(isset($_SESSION["student"]) && $user) { // REMOVE O ALUNO ARMAZENADO NA SESSÃO
		unset($_SESSION["student"]);
	}

	elseif(isset($_SESSION["administrator"]) && $user) { // REMOVE O ADMINISTRADOR ARMAZENADO NA SESSÃO
		unset($_SESSION["administrator"]);
	}

	elseif(isset($_SESSION["users"]) && $users) { // REMOVE OS USUÁRIOS ARMAZENADOS NA SESSÃO
		unset($_SESSION["users"]);
	}

	if($message && $color && $data && $user && $users) { // DESTRÓI A SESSÃO
		session_unset();
		session_destroy();
	}
}


// SALVA UMA MENSAGEM NA SESSÃO
function set_message(string $message): void {
	$_SESSION["message"] = $message;
}


// OBTÉM A MENSAGEM QUE ESTIVER SALVA NA SESSÃO E APAGA
function get_message(bool $unset=true): string {
	if(isset($_SESSION["message"])) {
		$message = $_SESSION["message"];

		if($unset) {
			unset($_SESSION["message"]);
		}

		return $message;
	}

	return "";
}


// SALVA UM DADO NA SESSÃO
function set_data(string $key, string $value): void {
	$_SESSION["data"][$key] = $value;
}


// OBTÉM O DADO QUE ESTIVER SALVO NA SESSÃO E APAGA
function get_data(string $key, bool $unset=true): string {
	if(isset($_SESSION["data"][$key])) {
		$data = $_SESSION["data"][$key];

		if($unset) {
			unset($_SESSION["data"][$key]);
		}

		return $data;
	}

	return "";
}


// SALVA UMA COR NA SESSÃO
function set_color(string $color): void {
	$_SESSION["color"] = $color;
}


// OBTÉM A COR QUE ESTIVER SALVA NA SESSÃO E APAGA
function get_color(): string {
	if(isset($_SESSION["color"])) {
		$color = $_SESSION["color"];
		unset($_SESSION["color"]);

		return $color;
	}

	return "red";
}


// SALVA UNS USUÁRIOS NA SESSÃO
function set_users(array $users): void {
	$_SESSION["users"] = $users;
}


// OBTÉM OS USUÁRIOS QUE ESTIVEREM SALVOS NA SESSÃO E APAGA
function get_users(): array {
	if(isset($_SESSION["users"])) {
		$users = $_SESSION["users"];
		unset($_SESSION["users"]);

		return $users;
	}

	return [];
}


// SALVA UMA MENSAGEM NA SESSÃO
function set_json(array $json): void {
	if(function_exists("getallheaders")) {
		$headers = getallheaders();

		if(isset($headers["sec-fetch-mode"]) && $headers["sec-fetch-mode"] === "cors") {
			echo json_encode($json);
			exit();
		}
	}
}


// CONSULTA UM ADMINISTRADOR PELO IDENTIFICADOR
function get_administrator(int $id): array {
	$query = "select users.`id`, users.`name`, users.`alias`, users.`password`, users.`registration_date`, administrators.`id` ref_id from users inner join administrators on users.`id`=administrators.`user` where users.`id`=" . $id . ";";
	return sql_query($query);
}


// CONSULTA UM ALUNO PELO IDENTIFICADOR
function get_student(int $id): array {
	$query = "select users.`id`, users.`name`, users.`alias`, users.`password`, users.`registration_date`, students.`id` ref_id from users inner join students on users.`id`=students.`user` where users.`id`=" . $id . ";";
	return sql_query($query);
}


// VERIFICA SE O USUÁRIO (ALUNO) INICIOU O FORMULÁRIO
function user_started_the_form(): bool {
	$query = "select `student` from forms where `student`=" . get_user()["student"] . ";";
	$rows = sql_query($query);

	return (bool) !empty($rows);
}


// VERIFICA SE O USUÁRIO (ALUNO) TERMINOU O FORMULÁRIO
function user_finished_the_form(): bool {
	$query = "select count(*) from forms where `student`=" . get_user()["student"] . ";";
	$count = sql_query($query);

	$query = "select `student` from forms where `student`=" . get_user()["student"] . " and `stage`=" . count(FORM_STAGES) . " and `end_time` is not null;";
	$rows = sql_query($query);

	$query = "select `student` from analysis where `student`=" . get_user()["student"] . ";";
	$analysis = sql_query($query);

	if((count(FORM_STAGES) === (int) $count[0]["count(*)"] && !empty($rows)) || !empty($analysis)) { // USUÁRIO (ALUNO) JÁ RESPONDEU A QUANTIDADE DE PERGUNTAS
		return true;
	}
	return false;
}


// RETORNA EM QUAL MÓDULO E ETAPA DA AVALIAÇÃO O USUÁRIO (ALUNO) ESTÁ
function what_is_the_level(): array {
	if(user_started_the_form()) { // USUÁRIO (ALUNO) INICIOU O FORMULÁRIO
		$query = "select modules.`name` `module`, stages.`name` `stage` from stages inner join modules on stages.`module`=modules.`id` where stages.`id`=(select min(`stage`) from forms where `student`=" . get_user()["student"] . " and `end_time` is null);";
		$rows = sql_query($query);

		if(isset($rows) && !empty($rows)) { // USUÁRIO (ALUNO) INICIOU O FORMULÁRIO E NÃO TERMINOU
			$rows[0]["started"] = true;
			$rows[0]["finished"] = false;
			return $rows[0];
		}
	}

	$query = "select modules.`name` `module`, stages.`name` `stage` from stages inner join modules on stages.`module`=modules.`id` where stages.`id`=(select max(`stage`) from forms where `student`=" . get_user()["student"] . " and `end_time` is null);";
	$rows = sql_query($query);

	if(isset($rows) && !empty($rows)) { // USUÁRIO (ALUNO) INICIOU O FORMULÁRIO E TERMINOU
		$rows[0]["started"] = true;
		$rows[0]["finished"] = true;
		return $rows[0];
	}

	$query = "select modules.`name` `module`, stages.`name` `stage` from stages inner join modules on stages.`module`=modules.`id` where stages.`id`=(select `id` from stages where `id`=(select max(`stage`) from forms where `student`=" . get_user()["student"] . ")+1);";
	$rows = sql_query($query);

	if(isset($rows) && !empty($rows)) { // USUÁRIO (ALUNO) INICIOU O FORMULÁRIO E TERMINOU O MÓDULO ANTERIOR
		$rows[0]["started"] = false;
		$rows[0]["finished"] = false;
		return $rows[0];
	}

	// USUÁRIO (ALUNO) NÃO INICIOU O FORMULÁRIO
	return ["module" => FORM_MODULES[0], "stage" => FORM_STAGES[0], "started" => false, "finished" => false];
}


// RETORNA QUAL O PRÓXIMO MÓDULO E ETAPA DA AVALIAÇÃO
function get_next_level(): array {
	$query = "select modules.`name` `module`, stages.`name` `stage` from stages inner join modules on stages.`module`=modules.`id` where stages.`id`=(select max(`stage`)+1 from forms where `student`=" . get_user()["student"] . ");";
	$rows = sql_query($query);

	if(isset($rows) && !empty($rows)) { // ENCONTROU O PRÓXIMO FORMULÁRIO
		$rows[0]["started"] = false;
		$rows[0]["finished"] = false;
		return $rows[0];
	}

	// USUÁRIO (ALUNO) JÁ TERMINOU TODO O FORMULÁRIO
	$form_modules = FORM_MODULES;
	$form_stages = FORM_STAGES;
	return ["module" => end($form_modules), "stage" => end($form_stages), "started" => false, "finished" => false];
}


// RETORNA EM QUAL ETAPA DE ANÁLISE O USUÁRIO (ALUNO) ESTÁ
function which_analysis_is(): string {
	$query = "select situations.`name` from situations inner join analysis on situations.`id`=analysis.`situation` where analysis.`student`=" . get_user()["student"] . ";";
	$rows = sql_query($query);

	if(is_array($rows) && !empty($rows)) { // ENCONTROU A ETAPA ATUAL
		return $rows[0]["name"];
	}

	return "Formulário Finalizado";
}


// INSERE UM NOVO FORMULÁRIO NO BANCO DE DADOS
function insert_form(int $stage, string $response): bool {
	$query = "insert into forms (`student`, `stage`, `response`, `start_time`, `end_time`) values (";
	$query .= get_user()["student"] . ", " . $stage . ", '" . $response . "', '" . date("Y-m-d H:i:s") . "', null);";
	return sql_query($query);
}


// ALTERA UM FORMULÁRIO NO BANCO DE DADOS
function update_form(int $stage, string $response, bool $finished=true): bool {
	$query = "update forms set `response`='" . $response . "', `start_time`=(select `start_time` from forms where `student`=" . get_user()["student"] . " and `stage`=" . $stage . "), `end_time`=" . ($finished ? "'" . date("Y-m-d H:i:s") . "'" : "null") . " where ";
	$query .= "`student`=" . get_user()["student"] . " and `stage`=" . $stage . ";";
	return sql_query($query);
}


// RETORNA O LINK DO PDF DO CERTIFICADO, CASO EXISTA
function issued_certificate(): ?string {
	if(which_analysis_is() === "Certificado de Conclusão") {
		$query = "select `certificate` from analysis where `student`=" . get_user()["student"] . ";";
		$rows = sql_query($query);

		if(is_array($rows) && !empty($rows)) { // ENCONTROU O CERTIFICADO
			return $rows[0]["certificate"];
		}
	}

	return "";
}


// RETORNA O IDENTIFICADOR PARA VALIDAR O CERTIFICADO, CASO EXISTA
function validator_key(): ?string {
	if(which_analysis_is() === "Certificado de Conclusão") {
		$query = "select `identifier` from analysis where `student`=" . get_user()["student"] . ";";
		$rows = sql_query($query);

		if(is_array($rows) && !empty($rows)) { // ENCONTROU O IDENTIFICADOR
			return $rows[0]["identifier"];
		}
	}

	return "";
}


// RETORNA O IDENTIFICADOR DO TESTE DO USUÁRIO (ALUNO) NA API DO BIGFIVE, CASO EXISTA
function bigfive_api_key(): string {
	if(which_analysis_is() === "Avaliação Devolutiva") {
		$query = "select `link` from analysis where `student`=" . get_user()["student"] . ";";
		$rows = sql_query($query);

		if(is_array($rows) && !empty($rows)) { // ENCONTROU O IDENTIFICADOR
			return $rows[0]["link"];
		}
	}

	return "";
}


// OBTÉM OS DADOS ANALISADOS DO BIGFIVE
function get_bigfive(?string $id, string $language="pt-br"): ?object {
	$url = BIGFIVE_API . "result/" . $id . "/" . $language;
	$curl = curl_init($url);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_URL, $url);
	$response = curl_exec($curl);

	$response = json_decode($response);
	$response = isset($response->results) ? $response : null;
	curl_close($curl);

	return $response;
}


// RENDERIZA UM GRÁFICO COM O APEXCHARTS
function render_chart(array $series, array $categories): string {
	$series = implode(", ", $series);
	$categories = implode(", ", $categories);
	return "<div class='chart' data-series='" . $series . "' data-categories='" . $categories . "'></div>";
}


// RENDERIZA TODO O RESULTADO DO BIGFIVE
function bigfive_results(?string $id): string {
	$response = get_bigfive($id);
	$html = "";

	if(!$response) {
		return "";
	}

	foreach($response->results as $result) {
		$graphic["values"][] = $result->score;
		$graphic["labels"][] = $result->title;
	}

	$html .= render_chart($graphic["values"], $graphic["labels"]);

	foreach($response->results as $result) {
		$html .= "<h2 class='mb-0 text-blue'>" . $result->title . "</h2>";
		$html .= "<p class='text-gray'>Pontuação: " . $result->score . " - " . translate($result->scoreText) . "</p>";
		$html .= "<p class='text-justify'>" . $result->shortDescription . "</p>";

		foreach($result->facets as $facet) {
			$graphic["values"][] = $facet->score;
			$graphic["labels"][] = $facet->title;
		}

		$html .= render_chart($graphic["values"], $graphic["labels"]);
		$graphic = [];

		foreach($result->facets as $facet) {
			$html .= "<h4 class='mb-0 text-blue'>" . $facet->title . "</h4>";
			$html .= "<p class='text-gray'>Pontuação: " . $facet->score . " - " . translate($facet->scoreText) . "</p>";
			$html .= "<p class='text-justify'>" . $facet->text . "</p>";
		}
	}

	return $html;
}


// TRADUZ AS PALAVRAS OBTIDAS DO BIGFIVE
function translate(string $word, string $language="pt-br"): string {
	$languages = [
		"pt-br" => [ // PORTUGUÊS (BRASIL)
			"low" => "baixo",
			"neutral" => "neutro",
			"high" => "alto"
		]
	];

	return isset($languages[$language][$word]) ? $languages[$language][$word] : $word;
}
