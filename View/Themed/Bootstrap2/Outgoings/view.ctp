<div class="row">
	<div class="span4">
		<h2>Исходящее <?php echo $outgoing['Outgoing']['outgoing_num']; ?></h2>
	</div>
	<div class="offset4 span2">
		<?php echo $this->Html->link('<i class="icon-edit"> </i> Редактировать', array('action' => 'edit', $outgoing['Outgoing']['id']), array('div' => array('class' => 'pull-right'), 'class' => 'btn', 'escape' => false));?>
	</div>
</div>
<dl>
	<div class="row">
		<div class="span2">
			<dt>Дата регистрации</dt>
			<dd>
				<?php echo $outgoing['Outgoing']['date']; ?>
			</dd>
		</div>
	</div>
	<div class="row">
	&nbsp;
	</div>
	<div class="row">
		<div class="span4">
			<dt>Содержание</dt>
			<dd>
				<?php echo $outgoing['Outgoing']['content']; ?>
			</dd>
		</div>
	</div>
	<div class="row">
	&nbsp;
	</div>
	<div class="row">
		<div class="span10">
			<dt>Организация</dt>
			<dd>
				<?php echo $outgoing['Outgoing']['organization']; ?>
			</dd>
		</div>
	</div>
</dl>