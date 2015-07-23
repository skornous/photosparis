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

<div class="bordered">
	<iframe src="materializeTooltipContent.php" frameborder="0"></iframe>
</div>
<!-- data-position can be : bottom, top, left, or right -->
<!-- data-delay controls delay before tooltip shows (in milliseconds)-->
<?php
	require("template/footer.php");
?>
