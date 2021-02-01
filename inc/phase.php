<?php
defined("ANALYZE") ?: define("ANALYZE", "");
defined("ANALYSIS") ?: define("ANALYSIS", []);
?>

	<div class="container grid-lg pt-4">
		<ul class="step">
			<?php foreach(ANALYSIS as $analyze): ?>
			<li class="<?=$analyze === ANALYZE ? "active" : "c-disabled"?> step-item">
				<a class="tooltip" data-tooltip="<?=$analyze?>" href="javascript:void(0)"><?=$analyze?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
