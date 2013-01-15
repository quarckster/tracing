<div class="calls index">
<h2>Статистика обращений</h2>
<?php
		echo $this->Form->create('Call');
		echo $this->Form->input('start', array('div' => 'inline', 'label' => 'Начальная дата'));
		echo $this->Form->input('end', array('div' => 'inline', 'label' => 'Конечная дата'));
		echo $this->Form->submit(__('Найти', true), array('div' => true));
		echo $this->Form->end();
?>	
<?php	if (isset($stats_data)): ?>
		<div class="justify">Заказ документов: <?php echo $stats_data['ЗД']['overall']; ?>
			<ul>
				<li>звонки: <?php echo $stats_data['ЗД']['Звонок']; ?></li>
				<li>сайт: <?php echo $stats_data['ЗД']['Сайт']; ?></li>
				<li>сио: <?php echo $stats_data['ЗД']['СИО']; ?></li>
				<li>email: <?php echo $stats_data['ЗД']['Email']; ?></li>
				<li>визит: <?php echo $stats_data['ЗД']['Визит']; ?></li>
			</ul>
		</div>
		<div class="justify">Сбой: <?php echo $stats_data['Сбой']['overall']; ?></div>
		<div class="justify">Информационные: <?php echo $stats_data['Инф.']['overall']; ?></div>
		<div class="justify">Демоверсии: <?php echo $stats_data['Инф.']['overall']; ?>
			<ul>
				<li>звонки: <?php echo $stats_data['Демо']['Звонок']; ?></li>
				<li>сайт: <?php echo $stats_data['Демо']['Сайт']; ?></li>
				<li>сио: <?php echo $stats_data['Демо']['СИО']; ?></li>
				<li>email: <?php echo $stats_data['Демо']['Email']; ?></li>
				<li>визит: <?php echo $stats_data['Демо']['Визит']; ?></li>
			</ul>
		</div>
		<div class="justify">Консультации по ФВ: <?php echo $stats_data['КФВ']['overall']; ?>
			<ul>
				<li>звонки: <?php echo $stats_data['КФВ']['Звонок']; ?></li>
				<li>сайт: <?php echo $stats_data['КФВ']['Сайт']; ?></li>
				<li>сио: <?php echo $stats_data['КФВ']['СИО']; ?></li>
				<li>email: <?php echo $stats_data['КФВ']['Email']; ?></li>
				<li>визит: <?php echo $stats_data['КФВ']['Визит']; ?></li>
			</ul>
		</div>
<?php	endif; ?>
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
            $('#CallStart').datepicker();
            $('#CallEnd').datepicker();
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
