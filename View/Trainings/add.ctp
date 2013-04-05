<div class="trainings form">
<?php echo $this->Form->create('Training');?>
	<fieldset>
		<legend><?php echo __('Add Training'); ?></legend>
	<?php
		echo $this->Form->input('training_num');
		echo $this->Form->input('user_sid');
		echo $this->Form->input('date_receipt');
		echo $this->Form->input('date_training');
		echo $this->Form->input('date_end');
		echo $this->Form->input('organization');
		echo $this->Form->input('number_to');
		echo $this->Form->input('town');
		echo $this->Form->input('transport');
		echo $this->Form->input('purpose');
		echo $this->Form->input('tso');
		echo $this->Form->input('mentor_sid');
		echo $this->Form->input('status');
		echo $this->Form->input('kind_training');
		echo $this->Form->input('additional_info');
		echo $this->Form->input('address_fact');
		echo $this->Form->input('systems_set');
		echo $this->Form->input('amount');
		echo $this->Form->input('competitors');
		echo $this->Form->input('comfortable_time');
		echo $this->Form->input('not_comfortable_time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Trainings'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Trainings Comments'), array('controller' => 'trainings_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trainings Comment'), array('controller' => 'trainings_comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
