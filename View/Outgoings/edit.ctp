<div class="outgoings form">
<?php echo $this->Form->create('Outgoing');?>
	<fieldset>
		<legend><?php echo __('Редактировать исходящее'); ?></legend>
	<?php
		echo $this->Form->input('Outgoing.outgoing_num', array('label' => 'Исходящий номер'));
		echo $this->Form->input('Outgoing.organization', array('label' => 'Организация'));
		echo $this->Form->input('Outgoing.executer', array('label' => 'Исполнитель'));
		echo $this->Form->input('Outgoing.content', array('rows' => '3', 'label' => 'Содержание'));
		echo $this->Form->input('Outgoing.folder', array('type' => 'checkbox', 'label' => 'Наличие в папке'));
		echo $this->Form->input('Outgoing.cis', array('type' => 'checkbox', 'label' => 'Наличие в КИС'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Сохранить'));?>
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
		<li><hr size="0" /></li>
		<li><?php echo $this->Html->link(__('Поиск', true), array('action' => 'find')); ?></li>
	</ul>
</div>
