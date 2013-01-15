<?php debug($incident); ?>
<div class="incidents view">
<h2>Входящее</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Дата регистрации</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $incident['Incident']['start_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Дата выполнения</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $incident['Incident']['exp_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Входящий номер</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $incident['Incident']['incoming_num']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Организация</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $incident['Incident']['organization']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Содержание</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $incident['Incident']['content']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Номер ТО</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $incident['Incident']['number_to']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3>&nbsp;</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Список входящих', true), array('action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3>Комментарии</h3>
	<?php if (!empty($incident['Detail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th>№ п/п</th>
		<th>Имя</th>
		<th>Комментарий</th>
		<th>Дата</th>
		<th class="actions">&nbsp;</th>
	</tr>
	<?php
		echo $this->Form->create('Incident');
		$i = 0;
		foreach ($incident['Detail'] as $detail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $detail['comment_id'];?></td>
			<td><?php echo $detail['user_sid'];?></td>
			<td><?php if ($detail['id'] == $detail_id) echo input('Detail.comment', $detail['comment']); ?></td>
			<td><?php echo $detail['comment_date'];?></td>
			<td class="actions">
			<?php if ($detail['id'] == $detail_id) echo $this->Form->end('Сохранить'); ?>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Доработать входящее', true), array('controller' => 'details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
