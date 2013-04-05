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
	<h3>Комментарии</h3>
	<?php if (!empty($call['CallsDetail'])):?>
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
		echo $this->Form->create('Call');
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
			<td><?php if ($calls_detail['id'] == $calls_detail_id) {
					//$date = date('Y-m-d G:i:s');
					echo $this->Form->input('CallsDetail.comment', array('value' => $calls_detail['comment'], 'label' => false));
					echo $this->Form->input('CallsDetail.id', array('type' => 'hidden', 'value' => $calls_detail_id, 'label' => false));
					echo $this->Form->input('CallsDetail.call_id', array('type' => 'hidden', 'value' => $call['Call']['id'], 'label' => false));
					echo $this->Form->input('CallsDetail.order', array('type' => 'hidden', 'value' => $calls_detail['order'], 'label' => false));
					//echo $this->Form->input('CallsDetail.user_sid', array('type' => 'hidden', 'value' => $calls_detail['user_sid'], 'label' => false));
					//echo $this->Form->input('Detail.comment_date', array('type' => 'hidden', 'value' => $date, 'label' => false));
					if (empty($calls_detail['comment'])) {
						echo $this->Form->input('CallsDetail.user_sid', array('label' => 'Передать звонок'));
					}
				  } else {
					echo $calls_detail['comment'];
				  }?><td><?php if (!empty($calls_detail['comment_date'])) {
					echo $calls_detail['comment_date'];
				   }?></td>
			<td class="actions">
			<?php if ($calls_detail['id'] == $calls_detail_id) echo $this->Form->end('Сохранить'); ?>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>
<script language="javascript" type="text/javascript">
                // Динамическое добавление input'ов и их автозаполнение
                $("input#CallsDetailUserSid").autocomplete({
                    source: "/adnames.php",
                    minLength: 2
                });
</script>
