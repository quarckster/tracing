<div class="incidents index">
	<h2>Исходящие</h2>
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
		<col width="auto" />
		<col width="110" />
		<col width="180" />
		<col width="40" />
		<col width="40" />
		<col width="70" />
	<tr>
			<th>Номер</th>
			<th>Организация</th>
			<th>Содержание</th>
			<th>Дата</th>
			<th>Исполнитель</th>
			<th>Папка</th>
			<th>КИС</th>
			<th class="actions"></th>
	</tr>
	<?php
	$i = 0;
	foreach ($outgoings as $outgoing):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $outgoing['Outgoing']['outgoing_num']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['organization']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['content']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['date']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['executer']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['folder']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['cis']; ?>&nbsp;</td>
		<td class="simple">
			<?php echo $this->Html->image("b_view.png", array("alt" => "Просмотр", 'url' => array('action' => 'view', $outgoing['Outgoing']['id']))); ?>
			<?php echo $this->Html->image("b_edit.png", array("alt" => "Редактировать", 'url' => array('action' => 'edit', $outgoing['Outgoing']['id']))); ?>
			<?php echo $this->Html->link($this->Html->image("b_drop.png", array("alt" => "Удалить")), array('action' => 'delete', $outgoing['Outgoing']['id']), array('escape' => false), 'Вы уверены, что хотите удалить это входящее?'); ?>
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
		<li><?php echo $this->Html->link(__('Входящие', true), array('controller' => 'incidents', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
	</ul>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Зарег. исходящее', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Зарег. входящее', true), array('controller' => 'incidents', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Зарег. обращение', true), array('controller' => 'calls', 'action' => 'add')); ?></li>		
		<li><hr size="0" /></li>
		<li><?php echo $this->Html->link(__('Поиск', true), array('action' => 'find')); ?></li>
	</ul>
</div>
