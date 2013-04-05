<div class="prelimiaryResponses form">
<?php echo $this->Form->create('PrelimiaryResponse');?>
	<fieldset>
		<legend><?php echo __('Edit Prelimiary Response'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('second_stage_id');
		echo $this->Form->input('answer_date');
		echo $this->Form->input('send_date');
		echo $this->Form->input('delivery');
		echo $this->Form->input('answer');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PrelimiaryResponse.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PrelimiaryResponse.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Prelimiary Responses'), array('action' => 'index'));?></li>
	</ul>
</div>
