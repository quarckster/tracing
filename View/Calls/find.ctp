<div class="calls index">
<?php
/**
 * Проверяем наличие в адресной строке параметров. Если обнаруживаем больше или равным одному и если содержится
 * слово "category", то форму поиска не рисуем.
 */
	if (count($this->params['named']) >= '1' && (isset($this->params['named']['category']) || isset($this->params['named']['control']))) {
		echo null;
	} else {
		echo $this->Form->create('Call', array(
			'url' => array_merge(array('action' => 'find'), $this->params['pass'])
			));
		echo $this->Form->input('user_sid', array('div' => false, 'label' => 'Имя'));
		echo $this->Form->input('organization', array('div' => false, 'label' => 'Организация'));
		echo $this->Form->input('number_to', array('div' => false, 'label' => 'Номер ТО'));
		echo $this->Form->input('content', array('div' => false, 'label' => 'Содержание', 'type' => 'text'));
		echo $this->Form->input('contact_data', array('div' => false, 'label' => 'Контактные данные', 'type' => 'text'));
		echo $this->Form->input('range_from', array('div' => false, 'label' => 'Начальная дата'));
		echo $this->Form->input('range_to', array('div' => false, 'label' => 'Конечная дата'));  
		echo $this->Form->input('control', array('div' => false, 'label' => 'На контролe', 'type' => 'checkbox'));
		echo $this->Form->input('cis_template', array('div' => false, 'label' => 'Шаблон КИС', 'options' => array(null => 'Все', '0' => 'Без шаблона', '1' => 'С шаблоном')));
		echo $this->Form->input('category', array('label' => 'Категория', 'div' => false, 'options' => array(null => 'Все', 'ЗД' => 'Заказ документов', 'Сбой' => 'Сбой', 'Инф.' => 'Информационный', 'Демо' => 'Демоверсия', 'КФВ' => 'Консультации по ФВ')));
		echo $this->Form->input('delivery', array('label' => 'Способ обращения', 'div' => false, 'options' => array(null => 'Все', 'Звонок' => 'Звонок', 'Сайт' => 'Сайт', 'Email' => 'Email', 'СИО' => 'СИО', 'Визит' => 'Визит')));
		echo $this->Form->submit(__('Найти', true), array('div' => true));
		echo $this->Form->end();
	}
?>
	<h2><?php
		if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'ЗД')
			echo 'Заказ документов';
		if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'Сбой')
			echo 'Сбой';
		if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'Инф.')
			echo 'Информационные';
		if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'Демо')
			echo 'Демоверсия';
		if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'УО')
			echo 'Угроза отключения';
		if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'РС')
			echo 'Рекомендация СИО';
		if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'КФВ')
			echo 'Консультации по формализованным вопросам';		
		if (isset($this->params['named']['control']) && $this->params['named']['control'] == '1')
			echo 'На контроле';
		if (empty($this->params['named']['category']) && empty($this->params['named']['control']))
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
		<col width="90" />		
		<col width="125" />
		<col width="50" />
		<col width="auto" />
		<col width="auto" />
		<col width="170" />
		<col width="50" />
		<col width="70" />
	<tr>
			<th>Имя</th>
			<th>Даты</th>
			<th>Кат.</th>
			<th>Организация</th>
			<th>Контактные данные</th>
			<th>Предпр. действия</th>
			<th>КИС</th>
			<th class="actions"></th>
	</tr>
	<?php
	$i = 0;
	foreach ($calls as $call):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $call['Call']['user_sid']; ?>&nbsp;</td>
		<td>О:&nbsp;<?php echo $call['Call']['open_date']; ?><br>З:&nbsp;<?php echo $call['Call']['close_date']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['category']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['organization']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['contact_data']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['actions']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['cis_template']; ?>&nbsp;</td>
		<td class="simple">
			<?php echo $this->Html->image("b_view.png", array("alt" => "Просмотр", 'url' => array('action' => 'view', $call['Call']['id']))); ?>
			<?php echo $this->Html->image("b_edit.png", array("alt" => "Редактировать", 'url' => array('action' => 'edit', $call['Call']['id']))); ?>
			<?php echo $this->Html->link($this->Html->image("b_drop.png", array("alt" => "Удалить")), array('action' => 'delete', $call['Call']['id']), array('escape' => false), 'Вы уверены, что хотите удалить это входящее?'); ?>
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
		<li><?php echo $this->Html->link(__('Письма', true), array('controller' => 'incidents', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('action' => 'index')); ?></li>		
	</ul>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Зарег. письмо', true), array('controller' => 'incidents', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Зарег. обращение', true), array('action' => 'add')); ?></li>
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
<script language="javascript" type="text/javascript">
                // Динамическое добавление input'ов и их автозаполнение
                $("input#CallUserSid").autocomplete({
                    source: "/adnames.php",
                    minLength: 2
                });
            // Календарь
            $('#CallRangeFrom').datepicker();
            $('#CallRangeTo').datepicker();
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
