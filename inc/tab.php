<?php
defined("PAGE_MODULE") ?: define("PAGE_MODULE", "");
?>

	<ul class="bg-gray columns tab tab-block" style="margin-top: 0;">
		<li class="tab-item col-4">
			<a class="<?=PAGE_MODULE === "Painel Administrativo" ? "active" : ""?> tab-text" href="<?=BASE_NAME?>list">
				Painel Administrativo
			</a>
		</li>
		<li class="tab-item col-4">
			<a class="<?=PAGE_MODULE === "Consultar Usuário" ? "active" : ""?> tab-text" href="<?=BASE_NAME?>search">
				Consultar Usuário
			</a>
		</li>
		<li class="tab-item col-4">
			<a class="<?=PAGE_MODULE === "Cadastrar Usuário" ? "active" : ""?> tab-text" href="<?=BASE_NAME?>insert">
				Cadastrar Usuário
			</a>
		</li>
		<li class="tab-item col-4">
			<a class="<?=PAGE_MODULE === "Alterar Usuário" ? "active" : "c-disabled text-gray"?> tab-text" href="javascript:void(0)">
				Alterar Usuário
			</a>
		</li>
		<li class="tab-item col-4">
			<a class="<?=PAGE_MODULE === "Visualizar Usuário" ? "active" : "c-disabled text-gray"?> tab-text" href="javascript:void(0)">
				Visualizar Usuário
			</a>
		</li>
	</ul>
