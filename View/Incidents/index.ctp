<div class="incidents index">
	<h2>Входящие</h2>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Страница {:page} из {:pages}', true)
	));
	?>
	</p>
	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('пред.', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('след.', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<table cellpadding="0" cellspacing="0">
		<col width="100" />
		<col width="auto" />
		<col width="110" />
		<col width="110" />
		<col width="60" />
		<col width="70" />
	<tr>
			<th>Номер входящего</th>
			<th>Организация</th>
			<th>Зарегистр.</th>
			<th>Дата исполнения</th>
			<th>Номер ТО</th>
			<th class="actions"></th>
	</tr>
	<?php
	$i = 0;
	foreach ($incidents as $incident):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $incident['Incident']['incoming_num']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['organization']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['start_date']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['exp_date']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['number_to']; ?>&nbsp;</td>
		<td class="simple">
			<?php echo $this->Html->image("b_view.png", array("alt" => "Просмотр", 'url' => array('action' => 'view', $incident['Incident']['id']))); ?>
			<?php echo $this->Html->image("b_edit.png", array("alt" => "Редактировать", 'url' => array('action' => 'edit', $incident['Incident']['id']))); ?>
			<?php echo $this->Html->link($this->Html->image("b_drop.png", array("alt" => "Удалить")), array('action' => 'delete', $incident['Incident']['id']), array('escape' => false), 'Вы уверены, что хотите удалить это входящее?'); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Страница {:page} из {:pages}', true)
	));
	?>
	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('пред.', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('след.', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
	</ul>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Зарег. письмо', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Зарег. обращение', true), array('controller' => 'calls', 'action' => 'add')); ?></li>		
	</ul>
	<h3>Фильтры</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Все', true), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Просроченные обр-ые', true), array('action' => 'find', 'filter' => 'delayed')); ?></li>
		<li><?php echo $this->Html->link(__('Просроченные необр-ые', true), array('action' => 'find', 'filter' => 'delayed_in_progress')); ?></li>
		<li><?php echo $this->Html->link(__('В работе', true), array('action' => 'find', 'filter' => 'in_progress')); ?></li>
		<li><?php echo $this->Html->link(__('Об откл. за долги', true), array('action' => 'find', 'filter' => 'debt')); ?></li>
		<li><hr size="0" /></li>
		<li><?php echo $this->Html->link(__('Поиск', true), array('action' => 'find')); ?></li>
	</ul>
</div>
