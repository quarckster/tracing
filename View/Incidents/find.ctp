<div class="incidents index">
<?php
	if (count($this->params['named']) >= '1' && isset($this->params['named']['filter'])) {
		echo null;
	}
	else {
		echo $this->Form->create('Incident', array(
			'url' => array_merge(array('action' => 'find'), $this->params['pass'])
			));
		echo $this->Form->input('user_sid', array('div' => false, 'label' => 'Имя участника'));
		echo $this->Form->input('incoming_num', array('div' => false, 'label' => 'Входящий номер'));
		echo $this->Form->input('number_to', array('div' => false, 'label' => 'Номер ТО'));
		echo $this->Form->input('organization', array('div' => false, 'label' => 'Организация'));
		echo $this->Form->input('content', array('div' => false, 'label' => 'Содержание'));
		echo $this->Form->input('range_from', array('div' => false, 'label' => 'Начальная дата'));
		echo $this->Form->input('range_to', array('div' => false, 'label' => 'Конечная дата'));  
		echo $this->Form->input('filter', array('label' => 'Где искать', 'div' => false, 'options' => array(null => 'Все входящие', 'in_progress' => 'В работе', 'archive' => 'Архив', 'delayed' => 'Просроченные', 'delayed_in_progress' => 'Просроченные в обработке', 'debt' => 'Об отключении за долги')));
		echo $this->Form->submit(__('Найти', true), array('div' => true));
		echo $this->Form->end();
	}
?>
	<h2><?php
		if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'archive')
			echo 'Архив';
		if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'delayed')
			echo 'Просроченные обработанные';
		if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'delayed_in_progress')
			echo 'Просроченные в обработке';
		if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'in_progress')
			echo 'В работе';
		if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'debt')
			echo 'Об отключении за долги';
		if (empty($this->params['named']['filter']))
			echo 'Поиск';
	?></h2>
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
		<td><?php if ($incident['Incident']['incoming_num'] != '-1') echo $incident['Incident']['incoming_num']; ?>&nbsp;</td>
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
		<li><?php echo $this->Html->link(__('Зарегистрировать письмо', true), array('action' => 'add')); ?></li>
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
<script language="javascript" type="text/javascript">
                $("input#IncidentUserSid").autocomplete({
                    source: "/adnames.php",
                    minLength: 2
                });
            // Календарь
            $('#IncidentRangeFrom').datepicker();
            $('#IncidentRangeTo').datepicker();
            jQuery(function($){
                $.datepicker.regional['ru'] = {
                    closeText: 'Закрыть',
                    prevText: '&#x3c;Пред',
                    nextText: 'След&#x3e;',
                    currentText: 'Сегодня',
                    monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                        'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
                    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
                        'Июл','Авг','Сен','Окт','Ноя','Дек'],
                    dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
                    dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
                    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
                    weekHeader: 'Не',
                    dateFormat: 'yy-mm-dd',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['ru']);
            });                 
</script>
