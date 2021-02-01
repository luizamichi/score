<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS E AS FUNÇÕES GLOBAIS
require_once(__DIR__ . "/configurations.php");
require_once(__DIR__ . "/functions.php");


if(MAINTENANCE_MODE) { // VERIFICA SE O MODO DE MANUTENÇÃO ESTÁ ATIVADO
	include_once(VIEW_PATH . "maintenance.php");
	exit();
}


// OBTÉM O NOME DA PÁGINA SOLICITADA
$urn = get_urn();


try { // FAZ UM TRY/CATCH PARA FINALIZAR A EXECUÇÃO EM CASO DE ERRO E GRAVAR O REGISTRO DO ERRO EM LOG
	if(!user_is_logined()) { // VERIFICA SE NÃO HÁ USUÁRIO LOGADO NO SISTEMA
		// REALIZA A REQUISIÇÃO DE TODAS AS CONSTANTES DO SISTEMA
		include_once(__DIR__ . "/student.php");

		if($urn === "action/login") { // VERIFICA SE O USUÁRIO ESTÁ TENTANDO SE LOGAR
			include_once(ACTION_ROUTES["action/login"]);
		}

		elseif($urn === "action/certificate") { // VERIFICA SE O USUÁRIO ESTÁ TENTANDO VALIDAR UM CERTIFICADO
			include_once(ACTION_ROUTES["action/certificate"]);
		}

		else {
			include_once(VIEW_ROUTES["login"]);
		}
	}


	elseif(user_is_administrator()) { // VERIFICA SE O USUÁRIO É UM ADMINISTRADOR
		// REALIZA A REQUISIÇÃO DE TODAS AS CONSTANTES DO PAINEL ADMINISTRATIVO
		include_once(__DIR__ . "/administrator.php");

		// VARIÁVEL UTILIZADA PARA AS BOAS-VINDAS
		$username = get_user()["name"];

		if(in_array($urn, array_keys(ACTION_ROUTES))) { // REALIZA UM CRUD DO PAINEL ADMINISTRATIVO
			include_once(ACTION_ROUTES[$urn]);
		}

		elseif(in_array($urn, array_keys(VIEW_ROUTES))) { // EXIBE A TELA SOLICITADA
			include_once(VIEW_ROUTES[$urn]);
		}

		else { // REDIRECIONA PARA A PÁGINA PRINCIPAL
			include_once(VIEW_ROUTES["list"]);
		}
	}


	elseif(user_is_student()) { // VERIFICA SE O USUÁRIO É UM ALUNO
		// REALIZA A REQUISIÇÃO DE TODAS AS CONSTANTES DO SISTEMA
		include_once(__DIR__ . "/student.php");

		if(in_array($urn, array_keys(ACTION_ROUTES))) { // REALIZA O CRUD DO SISTEMA
			include_once(ACTION_ROUTES[$urn]);
		}

		else { // REDIRECIONA PARA A PÁGINA CORRETA
			// VARIÁVEL UTILIZADA PARA AS BOAS-VINDAS
			$username = get_user()["name"];

			if(!user_started_the_form()) { // ALUNO AINDA NÃO INICIOU O FORMULÁRIO
				include_once(VIEW_ROUTES["index"]);
			}

			elseif(user_finished_the_form()) { // ALUNO JÁ TERMINOU O FORMULÁRIO
				include_once(VIEW_ROUTES["finished"]);
			}

			else { // ALUNO AINDA NÃO TERMINOU O FORMULÁRIO
				$level = what_is_the_level();

				if(!$level["started"] || $level["finished"]) { // REDIRECIONA O ALUNO PARA O PRÓXIMO MÓDULO
					$next_level = get_next_level();
					include_once(MODULE_ROUTES[$next_level["module"]]);
				}

				else { // REDIRECIONA O ALUNO PARA A ETAPA ATUAL
					include_once(STAGES_ROUTES[$level["stage"]]);
				}
			}
		}
	}
}

catch (Throwable $th) {
	record_log("Error (" . $th->getLine() . ":" . $th->getFile() . ") found in " . $th->getMessage());

	// EXIBE A TELA DE ERRO
	include_once(VIEW_PATH . "error.php");
}
