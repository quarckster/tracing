<div class="outgoings view">
<h2><?php  echo __('Исходящее письмо');?></h2>
	<dl>
		<dt><?php echo __('Исходящий номер'); ?></dt>
		<dd>
			<?php echo h($outgoing['Outgoing']['outgoing_num']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Организация'); ?></dt>
		<dd>
			<?php echo h($outgoing['Outgoing']['organization']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Исполнитель'); ?></dt>
		<dd>
			<?php echo h($outgoing['Outgoing']['executer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Дата'); ?></dt>
		<dd>
			<?php echo h($outgoing['Outgoing']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Содержание'); ?></dt>
		<dd>
			<?php echo h($outgoing['Outgoing']['content']); ?>
			&nbsp;
		</dd>
		<!--<dt><?php echo __('Folder'); ?></dt>
		<dd>
			<?php echo h($outgoing['Outgoing']['folder']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cis'); ?></dt>
		<dd>
			<?php echo h($outgoing['Outgoing']['cis']); ?>
			&nbsp;
		</dd>-->
	</dl>
</div>
<div class="actions">
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Исходящие', true), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Входящие', true), array('controller' => 'incidents', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
	</ul>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Зарег. исходящее', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Зарег. входящее', true), array('controller' => 'incidents', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Зарег. обращение', true), array('controller' => 'calls', 'action' => 'add')); ?></li>		
		<li><?php echo $this->Form->postLink(__('Удалить'), array('action' => 'delete', $this->Form->value('Outgoing.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Outgoing.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Редактировать'), array('action' => 'edit', $outgoing['Outgoing']['id'])); ?> </li>
		<li><hr size="0" /></li>
		<li><?php echo $this->Html->link(__('Поиск', true), array('action' => 'find')); ?></li>
	</ul>
</div>
