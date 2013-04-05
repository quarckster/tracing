<div class="trainings view">
<h2><?php  echo __('Training');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($training['Training']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Training Num'); ?></dt>
		<dd>
			<?php echo h($training['Training']['training_num']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Sid'); ?></dt>
		<dd>
			<?php echo h($training['Training']['user_sid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Receipt'); ?></dt>
		<dd>
			<?php echo h($training['Training']['date_receipt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Training'); ?></dt>
		<dd>
			<?php echo h($training['Training']['date_training']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date End'); ?></dt>
		<dd>
			<?php echo h($training['Training']['date_end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo h($training['Training']['organization']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number To'); ?></dt>
		<dd>
			<?php echo h($training['Training']['number_to']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Town'); ?></dt>
		<dd>
			<?php echo h($training['Training']['town']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transport'); ?></dt>
		<dd>
			<?php echo h($training['Training']['transport']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purpose'); ?></dt>
		<dd>
			<?php echo h($training['Training']['purpose']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tso'); ?></dt>
		<dd>
			<?php echo h($training['Training']['tso']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mentor Sid'); ?></dt>
		<dd>
			<?php echo h($training['Training']['mentor_sid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($training['Training']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kind Training'); ?></dt>
		<dd>
			<?php echo h($training['Training']['kind_training']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Additional Info'); ?></dt>
		<dd>
			<?php echo h($training['Training']['additional_info']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address Fact'); ?></dt>
		<dd>
			<?php echo h($training['Training']['address_fact']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Systems Set'); ?></dt>
		<dd>
			<?php echo h($training['Training']['systems_set']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($training['Training']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Competitors'); ?></dt>
		<dd>
			<?php echo h($training['Training']['competitors']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comfortable Time'); ?></dt>
		<dd>
			<?php echo h($training['Training']['comfortable_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Not Comfortable Time'); ?></dt>
		<dd>
			<?php echo h($training['Training']['not_comfortable_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Training'), array('action' => 'edit', $training['Training']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Training'), array('action' => 'delete', $training['Training']['id']), null, __('Are you sure you want to delete # %s?', $training['Training']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Trainings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Training'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Trainings Comments'), array('controller' => 'trainings_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trainings Comment'), array('controller' => 'trainings_comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Trainings Comments');?></h3>
	<?php if (!empty($training['TrainingsComment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Trainings Id'); ?></th>
		<th><?php echo __('User Sid'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($training['TrainingsComment'] as $trainingsComment): ?>
		<tr>
			<td><?php echo $trainingsComment['id'];?></td>
			<td><?php echo $trainingsComment['trainings_id'];?></td>
			<td><?php echo $trainingsComment['user_sid'];?></td>
			<td><?php echo $trainingsComment['comment'];?></td>
			<td><?php echo $trainingsComment['date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'trainings_comments', 'action' => 'view', $trainingsComment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'trainings_comments', 'action' => 'edit', $trainingsComment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'trainings_comments', 'action' => 'delete', $trainingsComment['id']), null, __('Are you sure you want to delete # %s?', $trainingsComment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Trainings Comment'), array('controller' => 'trainings_comments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
