<div class="results view">
<h2><?php  echo __('Result');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($result['Result']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Second Stage Id'); ?></dt>
		<dd>
			<?php echo h($result['Result']['second_stage_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer Source'); ?></dt>
		<dd>
			<?php echo h($result['Result']['answer_source']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer Date'); ?></dt>
		<dd>
			<?php echo h($result['Result']['answer_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Send Date'); ?></dt>
		<dd>
			<?php echo h($result['Result']['send_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Delivery'); ?></dt>
		<dd>
			<?php echo h($result['Result']['delivery']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer'); ?></dt>
		<dd>
			<?php echo h($result['Result']['answer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($result['Result']['note']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Result'), array('action' => 'edit', $result['Result']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Result'), array('action' => 'delete', $result['Result']['id']), null, __('Are you sure you want to delete # %s?', $result['Result']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Results'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Result'), array('action' => 'add')); ?> </li>
	</ul>
</div>
