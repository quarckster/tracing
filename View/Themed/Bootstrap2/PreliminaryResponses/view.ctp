<div class="prelimiaryResponses view">
<h2><?php  echo __('Prelimiary Response');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($prelimiaryResponse['PrelimiaryResponse']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Second Stage Id'); ?></dt>
		<dd>
			<?php echo h($prelimiaryResponse['PrelimiaryResponse']['second_stage_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer Date'); ?></dt>
		<dd>
			<?php echo h($prelimiaryResponse['PrelimiaryResponse']['answer_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Send Date'); ?></dt>
		<dd>
			<?php echo h($prelimiaryResponse['PrelimiaryResponse']['send_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Delivery'); ?></dt>
		<dd>
			<?php echo h($prelimiaryResponse['PrelimiaryResponse']['delivery']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer'); ?></dt>
		<dd>
			<?php echo h($prelimiaryResponse['PrelimiaryResponse']['answer']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Prelimiary Response'), array('action' => 'edit', $prelimiaryResponse['PrelimiaryResponse']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Prelimiary Response'), array('action' => 'delete', $prelimiaryResponse['PrelimiaryResponse']['id']), null, __('Are you sure you want to delete # %s?', $prelimiaryResponse['PrelimiaryResponse']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Prelimiary Responses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prelimiary Response'), array('action' => 'add')); ?> </li>
	</ul>
</div>
