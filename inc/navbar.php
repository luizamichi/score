<?php
defined("PAGE_MODULE") ?: define("PAGE_MODULE", "");
?>

	<ul class="bg-gray columns tab tab-block" style="margin-top: 0;">
		<li class="col-4 tab-item">
			<a class="<?=PAGE_MODULE === "Avaliação Técnica" ? "active" : "c-disabled text-gray"?> tab-text" href="javascript:void(0)">
				<span class="tab-label">1ª AVALIAÇÃO</span> Técnica
			</a>
		</li>
		<li class="col-4 tab-item">
			<a class="<?=PAGE_MODULE === "Nível de Inglês" ? "active" : "c-disabled text-gray"?> tab-text" href="javascript:void(0)">
				<span class="tab-label">2ª AVALIAÇÃO</span> Inglês
			</a>
		</li>
		<li class="col-4 tab-item">
			<a class="<?=PAGE_MODULE === "Avaliação Comportamental" ? "active" : "c-disabled text-gray"?> tab-text" href="javascript:void(0)">
				<span class="tab-label">3ª AVALIAÇÃO</span> Comportamental
			</a>
		</li>
	</ul>
