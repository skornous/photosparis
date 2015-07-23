<?php
	$title = "Test bordered tooltip";
	$pageURL = "materializeTooltip.php";
	require("template/header.php");
?>
	<style>
		.bordered {
			border: dashed;
		}
	</style>
	<div class="">
		<div class="bordered" style="width: 10px;">
			<a class="btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="I am tooltip">!</a>
			<a class="btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="I am tooltip">Hover</a>
			<a class="btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="I am tooltip">me</a>
		</div>
	</div>
<?php
	$scripts = array();

	$scripts[] = "$(document).ready(function(){
			$('.tooltipped').tooltip({delay: 50});
		});";

	require("template/footer.php");
?>