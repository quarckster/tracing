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
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
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
<div class="related">
	<h3>Комментарии</h3>
	<?php if (!empty($incident['Detail'])):?>
	<table cellpadding = "0" cellspacing = "0">
		<col width="70" />
		<col width="200" />
		<col width="auto" />
		<col width="150" />
		<col width="150" />
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
			<td><?php if ($detail['id'] == $detail_id) {
					echo $this->Form->input('Detail.comment', array('value' => $detail['comment'], 'label' => false));
					echo $this->Form->input('Detail.id', array('type' => 'hidden', 'value' => $detail_id, 'label' => false));
					echo $this->Form->input('Detail.incident_id', array('type' => 'hidden', 'value' => $incident['Incident']['id'], 'label' => false));
					echo $this->Form->input('Detail.comment_id', array('type' => 'hidden', 'value' => $detail['comment_id'], 'label' => false));
					echo $this->Form->input('Detail.user_sid', array('type' => 'hidden', 'value' => $detail['user_sid'], 'label' => false));
				  } else {
					echo $detail['comment'];
				  }?></td>
			<td><?php echo $detail['comment_date'];?></td>
			<td class="actions">
			<?php if ($detail['id'] == $detail_id) echo $this->Form->end('Сохранить'); ?>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

<!--	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Доработать входящее', true), array('controller' => 'details', 'action' => 'add'));?> </li>
		</ul>
	</div>
-->
</div>
