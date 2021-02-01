<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");

defined("PAGE_TITLE") ?: define("PAGE_TITLE", "AirTalent");
defined("CURRENT_YEAR") ?: define("CURRENT_YEAR", date("Y"));
?>

	<footer>
		<script src="<?=SCRIPT_NAME?>jquery.min.js"></script>
		<script src="<?=SCRIPT_NAME?>jquery.mask.js"></script>
		<script src="<?=SCRIPT_NAME?>apexcharts.min.js"></script>

		<script>
			$(document).ready(function() {
				// IMPRIME UMA MENSAGEM NO CONSOLE
				console.log("%c<?=SYSTEM_NAME?>", "color: #195596; font-family: sans-serif; font-size: 30px; font-weight: bold;");
				console.log("%cCopyright <?=CURRENT_YEAR?> <?=SYSTEM_AUTHOR?>", "color: #195596; font-family: sans-serif; font-size: 15px;");
				console.log("\n");
				console.log("%c<?=PAGE_TITLE?>", "color: #195596; font-family: sans-serif; font-size: 15px; font-weight: bold;");

				<?php if(DARK_THEME): ?>
				// CORES UTILIZADAS NO TEMA CLARO QUE PRECISAM SER ALTERADAS
				const map = {
					"rgb(238, 240, 243)": "rgb(69, 80, 96)",
					"rgb(247, 248, 249)": "rgb(0, 0, 0)",
					"rgb(35, 39, 43)": "rgb(255, 255, 255)",
					"rgb(31, 35, 38)": "rgb(255, 255, 255)",
					"rgb(255, 255, 255)": "rgb(0, 0, 0)",
					"rgb(0, 0, 0)": "rgb(255, 255, 255)",
					"rgb(102, 117, 140)": "rgb(255, 255, 255)",
					"rgb(69, 80, 96)": "rgb(238, 240, 243)",
					"rgb(59, 67, 81)": "rgb(255, 255, 255)",
					"rgb(188, 195, 206)": "rgb(0, 0, 0)",
					"rgb(48, 55, 66)": "rgb(255, 255, 255)",
					"rgb(251, 252, 252)": "rgb(69, 80, 96)"
				};

				// TEMA ESCURO
				$("*").each(function() {
					if(!$(this).is("base, head, html, link, meta, script, style, title")) {
						if($(this).css("background-color") in map) {
							if($(this).parent().data("background-color") !== "dark")
								$(this).css("background-color", map[$(this).css("background-color")]);
							else
								$(this).css("background-color", $(this).parent().css("background-color"));
							$(this).data("background-color", "dark");

							if($(this).is("[class^='bg-']")) {
								$(this).removeClass(function(index, css) {
									return (css.match(/(^|\s)bg-\S+/g) || []).join(" ");
								});
							}
						}

						if($(this).css("color") in map) {
							if($(this).parent().data("color") !== "dark")
								$(this).css("color", map[$(this).css("color")]);
							else
								$(this).css("color", $(this).parent().css("color"));
							$(this).data("color", "dark");
							$(this).removeClass("text-black");
						}
					}
				});
				<?php endif; ?>

				// DATA PARA MARCAR O TEMPO DO RELÓGIO E DATA ATUAL DO SISTEMA
				const initialDate = new Date($("span[id='date']").html());
				const systemDate = new Date($("span[id='system-date']").html());

				// CONTADOR
				var updatesTime = function() {
					var currentDate = new Date();
					var milliseconds = (Math.abs(currentDate.getTime() - systemDate.getTime()) + currentDate.getTime()) - initialDate.getTime();
					var days = Math.floor(milliseconds / (1000 * 3600 * 24));
					var hours = Math.floor((milliseconds % 86400000) / 3600000);
					var minutes = Math.floor(((milliseconds % 86400000) % 3600000) / 60000);

					var printDays = days <= 0 ? "" : days > 1 ? days + " dias e " : days + " dia e ";
					var printHours = hours >= 10 ? hours : "0" + hours;
					var printMinutes = minutes >= 10 ? minutes : "0" + minutes;
					$("h5[id='time']").html(printDays + printHours + ":" + printMinutes + "h");
				};

				// CHAMA A FUNÇÃO UMA VEZ E DEPOIS DEIXA PARA ATUALIZAR A CADA 30 SEGUNDOS
				updatesTime();
				setInterval(updatesTime, 30000);

				// FORMULÁRIO DA PÁGINA
				const form = $("form[method='post']");

				// VERIFICA SE TEM UM FORMULÁRIO E SALVA OS DADOS ANTES DE SAIR
				$("a[data-anchor='<?=ACTION_NAME?>logout']").click(function() {
					if(form.data("save")) {
						form.append($("<input>").attr("name", "logout").attr("type", "hidden").val(1));
						form.submit();
					}
					else
						window.location.replace("<?=ACTION_NAME?>logout");
				});

				// EVITA QUE O USUÁRIO SUBMETA AS RESPOSTAS AO APERTAR ENTER
				$("input").keypress(function(e) {
					var code = null;
					code = (e.keyCode ? e.keyCode : e.which);
					return (code === 13) ? false : true;
				});
			});

			function validateCPF(cpf) {
				if(cpf.length === 11) {
					var sum;
					var rest;
					sum = 0;
					if(["00000000000", "11111111111", "22222222222", "33333333333", "44444444444", "55555555555", "66666666666", "77777777777", "88888888888", "99999999999"].includes(cpf))
						return false;

					for(i=1; i<=9; i++)
						sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
					rest = (sum * 10) % 11;

					if(rest === 10 || rest === 11)
						rest = 0;
					if(rest !== parseInt(cpf.substring(9, 10)))
						return false;

					sum = 0;
					for(i=1; i<=10; i++)
						sum = sum + parseInt(cpf.substring(i - 1, i)) * (12 - i);
					rest = (sum * 10) % 11;

					if(rest === 10 || rest === 11)
						rest = 0;
					if(rest !== parseInt(cpf.substring(10, 11)))
						return false;
					return true;
				}
				return false;
			}
		</script>
	</footer>
