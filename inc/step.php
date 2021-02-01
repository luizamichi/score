<?php
defined("PAGE_MODULE") ?: define("PAGE_MODULE", 0);
defined("FORM_LEVELS") ?: define("FORM_LEVELS", [[]]);
defined("PAGE_STAGE") ?: define("PAGE_STAGE", "");
?>

	<div class="container grid-lg pt-4">
		<ul class="step">
			<?php foreach(FORM_LEVELS[PAGE_MODULE] as $stage): ?>
			<li class="<?=PAGE_STAGE === $stage ? "active" : "c-disabled"?> step-item">
				<a class="tooltip" data-tooltip="<?=$stage?>" href="javascript:void(0)"><?=$stage?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
