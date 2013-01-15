
<div class="calls view">
<h2>Обращение</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Зарегистрировала</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $call['Call']['user_sid']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Дата регистрации</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $call['Call']['open_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Дата закрытия</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if ($call['Call']['close_date']) echo $call['Call']['close_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Организация</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $call['Call']['organization']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Номер ТО</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $call['Call']['number_to']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Контактные данные</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $call['Call']['contact_data']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Категория</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $call['Call']['category']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Способ обращения</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $call['Call']['delivery']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Содержание</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $call['Call']['content']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Предпринятые действия</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $call['Call']['actions']; ?>
			&nbsp;
		</dd>
		<?php if (!empty($call['Call']['notified'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>>Уведомлены</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $call['Call']['notified']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
	</dl>
</div>
<div class="actions">
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Письма', true), array('controller' => 'incidents', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('action' => 'index')); ?></li>
	</ul>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Редактировать', true), array('action' => 'edit', $call['Call']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Удалить', true), array('action' => 'delete', $call['Call']['id']), null, sprintf(__('Вы уверены, что хотите удалить данные о звонке?', true), $call['Call']['id'])); ?> </li>
		<li><?php 
				if (!$call['Call']['close_date']) {
					echo $this->Html->link(__('Закрыть', true), array('action' => 'change_state', $call['Call']['id']));
				} else {
					echo $this->Html->link(__('Открыть', true), array('action' => 'change_state', $call['Call']['id']));
				}
		 ?></li>
	</ul>
	<h3>Категории</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Заказ документов', true), array('action' => 'find', 'category' => 'ЗД')); ?></li>
		
		<li><?php echo $this->Html->link(__('Сбой', true), array('action' => 'find', 'category' => 'Сбой')); ?></li>
		<li><?php echo $this->Html->link(__('Информационные', true), array('action' => 'find', 'category' => 'Инф.')); ?></li>
		<!--<li><?php echo $this->Html->link(__('Заказ по email', true), array('action' => 'find', 'category' => 'ЗЭП')); ?></li>
		<li><?php echo $this->Html->link(__('Рекомендации СИО', true), array('action' => 'find', 'category' => 'РС')); ?></li>
		<li><?php echo $this->Html->link(__('Угроза отключения', true), array('action' => 'find', 'category' => 'УО')); ?></li>-->
		<li><?php echo $this->Html->link(__('Демоверсии', true), array('action' => 'find', 'category' => 'Демо')); ?></li>
		<li><?php echo $this->Html->link(__('Консультации по ФВ', true), array('action' => 'find', 'category' => 'КФВ')); ?></li>
		<li><?php echo $this->Html->link(__('На контроле', true), array('action' => 'find', 'control' => '1')); ?></li>	
		<li><hr size="0" /></li>
		<li><?php echo $this->Html->link(__('Поиск', true), array('action' => 'find')); ?></li>
	</ul>
</div>
<div class="related">
	<?php if (!empty($call['CallsDetail'])):?>
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
		<th class="actions">Действия</th>
	</tr>
	<?php
		$i = 0;
		foreach ($call['CallsDetail'] as $calls_detail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $calls_detail['order'];?></td>
			<td><?php echo $calls_detail['user_sid'];?></td>
			<td><?php echo $calls_detail['comment'];?></td>
			<td><?php echo $calls_detail['date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Редактировать', true), array('controller' => 'calls', 'action' => 'edit_comment', 'calls_detail_id' => $calls_detail['id'], 'call_id' => $call['Call']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
