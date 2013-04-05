<div class="row">
	<div class="<?php echo $class; ?> offset2">
		<a class="close" data-dismiss="alert" href="#">×</a>
		<?php if (isset($heading)):?>
		<h4 class="alert-heading"><?php echo $heading; ?></h4>
		<?php endif;?>
		<?php echo $message; ?>
	</div>
</div>