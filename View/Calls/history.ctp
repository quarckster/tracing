<div class="histories index">
	<h2><?php echo __('История изменений');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('user_id', 'Кто изменил');?></th>
			<th>Действие</th>
			<th><?php echo $this->Paginator->sort('date', 'Дата');?></th>
	</tr>
	<?php
	foreach ($histories as $history): ?>
	<tr>
		<td><?php echo h($history['History']['user_id']); ?></td>
		<td><?php echo h($history['History']['action']); ?>&nbsp;</td>
		<td><?php echo h($history['History']['date']); ?>&nbsp;</td>
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
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Звонки', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
	</ul>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Редактировать', true), array('controller' => 'incidents', 'action' => 'edit', $history['Incident']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Перейти к звонку', true), array('controller' => 'calls', 'action' => 'view', $history['Call']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Зарег. письмо', true), array('controller' => 'incidents', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Зарег. звонок', true), array('controller' => 'calls', 'action' => 'add')); ?></li>	
	</ul>
	<h3>Категории</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Заказ документов', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'ЗД')); ?></li>
		<li><?php echo $this->Html->link(__('Заказ по email', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'ЗЭП')); ?></li>
		<li><?php echo $this->Html->link(__('Сбой', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'Сбой')); ?></li>
		<li><?php echo $this->Html->link(__('Информационные', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'Инф.')); ?></li>
		<li><?php echo $this->Html->link(__('Угроза отключения', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'УО')); ?></li>
		<li><?php echo $this->Html->link(__('Демоверсии', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'Демо')); ?></li>
		<li><?php echo $this->Html->link(__('Рекомендации СИО', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'РС')); ?></li>
		<li><?php echo $this->Html->link(__('Консультации по ФВ', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'КФВ')); ?></li>
		<li><?php echo $this->Html->link(__('На контроле', true), array('controller' => 'calls', 'action' => 'find', 'control' => '1')); ?></li>
		<li><hr size="0" /></li>
		<li><?php echo $this->Html->link(__('Поиск', true), array('controller' => 'calls', 'action' => 'find')); ?></li>
	</ul>
</div>
