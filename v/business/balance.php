<?php load_partial('header'); ?>
<div class="container">
	<div class="card business">
	<h2>你的收益 <?php echo $bizName; ?></h2>

	<p>项目总收益: <?php echo $profits; ?></p>

	<p>你的收益: <?php echo $userProfits; ?></p>
	</div>
</div>
<?php load_partial('footer'); ?>