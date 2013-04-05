<div class="incidents view">
<h2>Входящее</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<!--<dt<?php if ($i % 2 == 0) echo $class;?>>Зарегистрировал</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $incident['Incident']['user_sid']; ?>
			&nbsp;
		</dd>-->
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
		<dt<?php if ($i % 2 == 0) echo $class;?>>Уведомлены</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php $notified = array();
			foreach ($incident['Detail'] as $detail0):
				if ($detail0['notify_only'] == 1) {
				$notified[] = $detail0['user_sid'];
				}
			endforeach;
			echo implode(", ", $notified);
			 ?>
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
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Редактировать', true), array('action' => 'edit', $incident['Incident']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('История изменений', true), array('action' => 'history', $incident['Incident']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Удалить', true), array('action' => 'delete', $incident['Incident']['id']), null, sprintf(__('Вы уверены, что хотите удалить это входящее?', true))); ?> </li>
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
<?php if (!empty($incident['Detail'])):?>
<div class="related">
	<h3>Комментарии</h3>
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
		$i = 0;
		foreach ($incident['Detail'] as $detail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			if (!empty($detail['comment'])) {
				echo"
				<tr{$class}>
					<td>{$detail['comment_id']}</td>
					<td>{$detail['user_sid']}</td>
					<td>{$detail['comment']}</td>
					<td>{$detail['comment_date']}</td>
					<td class=\"actions\">&nbsp;</td>
				</tr>";
			}
			if ($detail['comment_id'] == $min_comment_id) {
				echo"
				<tr{$class}>
					<td>{$detail['comment_id']}</td>
					<td>{$detail['user_sid']}</td>
					<td>{$detail['comment']}</td>
					<td>{$detail['comment_date']}</td>
					<td class=\"actions\">{$this->Html->link(__('Редактировать', true), array('controller' => 'incidents', 'action' => 'edit_comment', 'incident_id' => $detail['incident_id'], 'detail_id' => $detail['id']))}</td>
				</tr>";
			}
			if (empty($detail['comment']) && $detail['comment_id'] != $min_comment_id && $detail['notify_only'] != 1) {
				echo"
				<tr{$class}>
					<td>{$detail['comment_id']}</td>
					<td>{$detail['user_sid']}</td>
					<td>{$detail['comment']}</td>
					<td>{$detail['comment_date']}</td>
					<td class=\"actions\">&nbsp;</td>
				</tr>";
			}
			/*if ($detail['notify_only'] == 1) {
				echo"
				<tr{$class}>
					<td>{$detail['comment_id']}</td>
					<td>{$detail['user_sid']}</td>
					<td>(уведомление)</td>
					<td>&nbsp;</td>
					<td class=\"actions\">&nbsp;</td>
				</tr>";
			}*/
			endforeach; ?>
		</tr>
	</table>
<!--
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Доработать входящее', true), array('controller' => 'details', 'action' => 'add'));?> </li>
		</ul>
	</div>
-->
</div>
<?php endif; ?>
