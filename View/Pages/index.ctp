<?php $this->layout = 'incidents'; ?>
<div class="center">
<fieldset>
	<legend>Входящие</legend>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Зарег. входящее', true), array('controller' => 'incidents', 'action' => 'add')); ?></li>
	</ul>
	<h3>Фильтры</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Все', true), array('controller' => 'incidents', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Просроченные', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'delayed')); ?></li>
		<li><?php echo $this->Html->link(__('Просроченные в обработке', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'delayed_in_progress')); ?></li>		
		<li><?php echo $this->Html->link(__('В работе', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'in_progress')); ?></li>
		<li><?php echo $this->Html->link(__('Об откл. за долги', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'debt')); ?></li>
		<li><?php echo $this->Html->link(__('Поиск', true), array('controller' => 'incidents', 'action' => 'find')); ?></li>
	</ul>
</fieldset>
</div>
<div class="center">
<fieldset>
	<legend>Обращения</legend>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Зарег. обращение', true), array('controller' => 'calls', 'action' => 'add')); ?></li>
	</ul>
	<h3>Фильтры</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Все', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Заказ документов', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'ЗД')); ?></li>
		<li><?php echo $this->Html->link(__('Сбой', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'Сбой')); ?></li>
		<li><?php echo $this->Html->link(__('Информационные', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'Инф.')); ?></li>
		<li><?php echo $this->Html->link(__('Демоверсии', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'Демо')); ?></li>
		<li><?php echo $this->Html->link(__('Консультации по формализованным вопросам', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'КФВ')); ?></li>		
		<li><?php echo $this->Html->link(__('На контроле', true), array('controller' => 'calls', 'action' => 'find', 'control' => '1')); ?></li>	
		<li><?php echo $this->Html->link(__('Поиск', true), array('controller' => 'calls', 'action' => 'find')); ?></li>
	</ul>
</fieldset>
</div>
<div class="center">
<fieldset>
	<legend>Исходящие</legend>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Зарег. исходящее', true), array('controller' => 'outgoings', 'action' => 'add')); ?></li>
	</ul>
	<h3>Фильтры</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Все', true), array('controller' => 'outgoings', 'action' => 'index')); ?></li>
	</ul>
</fieldset>
</div>

