<div class="histories index">
	<h2><?php echo __('История изменений');?></h2>
	<?php if (!empty($histories)):?>
	<h3>Содержание письма</h3>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Номер входящего</th>
			<th>Номер ТО</th>
			<th>Организация</th>
			<th>Содержание</th>
			<th>Зарегистр.</th>
			<th>Дата исполнения</th>
			<th>Дата изменения</th>
			<th>Редактировал(а)</th>
	</tr>
	<?php
	foreach ($histories as $history): ?>
	<tr>
		<td><?php echo $history['Incident']['incoming_num']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['number_to']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['organization']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['content']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['start_date']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['exp_date']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['version_created']; ?>&nbsp;</td>
		<td><?php echo $history['Incident']['changed_by']; ?>&nbsp;</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<?php endif;?>
	<?php if (!empty($details_histories)):?>
	<h3>Участники, которые были удалены из маршрута</h3>
		<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Очерёдность в маршруте</th>
			<th>Имя участника</th>
			<th>Дата изменения</th>
			<th>Редактировал(а)</th>
	</tr>
	<?php
	foreach ($details_histories as $details_history): ?>
	<tr>
		<td><?php echo $details_history['DetailsRev']['comment_id']; ?>&nbsp;</td>
		<td><?php echo $details_history['DetailsRev']['user_sid']; ?>&nbsp;</td>
		<td><?php echo $details_history['DetailsRev']['modify_time']; ?>&nbsp;</td>
		<td><?php echo $details_history['DetailsRev']['changed_by']; ?>&nbsp;</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<?php endif;?>
</div>

<div class="actions">
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
	</ul>
	<h3>Действия</h3>
	<ul>
		<?php if (isset($history)) {$id = $history['Incident']['id'];}
		else {$id = $details_history['DetailsRev']['incident_id'];}?>
		<li><?php echo $this->Html->link(__('Редактировать', true), array('controller' => 'incidents', 'action' => 'edit', $id)); ?> </li>
		<li><?php echo $this->Html->link(__('Перейти к письму', true), array('controller' => 'incidents', 'action' => 'view', $id)); ?> </li>
		<li><?php echo $this->Html->link(__('Зарег. письмо', true), array('controller' => 'incidents', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Зарег. обращение', true), array('controller' => 'calls', 'action' => 'add')); ?></li>	
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
