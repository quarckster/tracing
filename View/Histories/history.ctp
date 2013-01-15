<div class="histories index">
	<h2><?php echo __('История изменений');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Номер входящего</th>
			<th>Организация</th>
			<th>Зарегистр.</th>
			<th>Дата исполнения</th>
			<th>Дата изменения</th>
			<th>Редактировал</th>
	</tr>
	<?php
	foreach ($histories as $history): ?>
	<tr>
		<td><?php echo $history['Incident']['incoming_num']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['organization']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['start_date']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['exp_date']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['version_created']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['changed_by']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>

<div class="actions">
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Звонки', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
	</ul>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Редактировать', true), array('controller' => 'incidents', 'action' => 'edit', $history['Incident']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Перейти к письму', true), array('controller' => 'incidents', 'action' => 'view', $history['Incident']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Зарег. письмо', true), array('controller' => 'incidents', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Зарег. звонок', true), array('controller' => 'calls', 'action' => 'add')); ?></li>	
	</ul>
	<h3>Фильтры</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Все', true), array('controller' => 'incidents', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Просроченные обр-ые', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'delayed')); ?></li>
		<li><?php echo $this->Html->link(__('Просроченные необр-ые', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'delayed_in_progress')); ?></li>
		<li><?php echo $this->Html->link(__('В работе', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'in_progress')); ?></li>
		<li><?php echo $this->Html->link(__('Об откл. за долги', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'debt')); ?></li>
		<li><hr size="0" /></li>
		<li><?php echo $this->Html->link(__('Поиск', true), array('controller' => 'incidents', 'action' => 'find')); ?></li>
	</ul>
</div>
