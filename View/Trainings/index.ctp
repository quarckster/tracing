<div class="trainings index">
	<h2><?php echo __('Trainings');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('training_num');?></th>
			<th><?php echo $this->Paginator->sort('user_sid');?></th>
			<th><?php echo $this->Paginator->sort('date_receipt');?></th>
			<th><?php echo $this->Paginator->sort('date_training');?></th>
			<th><?php echo $this->Paginator->sort('date_end');?></th>
			<th><?php echo $this->Paginator->sort('organization');?></th>
			<th><?php echo $this->Paginator->sort('number_to');?></th>
			<th><?php echo $this->Paginator->sort('town');?></th>
			<th><?php echo $this->Paginator->sort('transport');?></th>
			<th><?php echo $this->Paginator->sort('purpose');?></th>
			<th><?php echo $this->Paginator->sort('tso');?></th>
			<th><?php echo $this->Paginator->sort('mentor_sid');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('kind_training');?></th>
			<th><?php echo $this->Paginator->sort('additional_info');?></th>
			<th><?php echo $this->Paginator->sort('address_fact');?></th>
			<th><?php echo $this->Paginator->sort('systems_set');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('competitors');?></th>
			<th><?php echo $this->Paginator->sort('comfortable_time');?></th>
			<th><?php echo $this->Paginator->sort('not_comfortable_time');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($trainings as $training): ?>
	<tr>
		<td><?php echo h($training['Training']['id']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['training_num']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['user_sid']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['date_receipt']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['date_training']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['date_end']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['organization']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['number_to']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['town']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['transport']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['purpose']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['tso']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['mentor_sid']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['status']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['kind_training']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['additional_info']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['address_fact']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['systems_set']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['amount']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['competitors']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['comfortable_time']); ?>&nbsp;</td>
		<td><?php echo h($training['Training']['not_comfortable_time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $training['Training']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $training['Training']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $training['Training']['id']), null, __('Are you sure you want to delete # %s?', $training['Training']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Training'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Trainings Comments'), array('controller' => 'trainings_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trainings Comment'), array('controller' => 'trainings_comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
