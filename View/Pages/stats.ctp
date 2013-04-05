<div class="index">
<h2>Статистика</h2>
<?php
		echo $this->Form->create('Stats');
		echo $this->Form->input('start', array('div' => 'inline', 'label' => 'Начальная дата'));
		echo $this->Form->input('end', array('div' => 'inline', 'label' => 'Конечная дата'));
		echo $this->Form->submit(__('Найти', true), array('div' => true));
		echo $this->Form->end();
?>	
<?php	if (isset($stats_data)): ?>
		<div class="justify">Заказ документов: <?php echo $stats_data['Calls']['ЗД']['overall']; ?>
			<ul>
				<li>звонки: <?php echo $stats_data['Calls']['ЗД']['Звонок']; ?></li>
				<li>сайт: <?php echo $stats_data['Calls']['ЗД']['Сайт']; ?></li>
				<li>сио: <?php echo $stats_data['Calls']['ЗД']['СИО']; ?></li>
				<li>email: <?php echo $stats_data['Calls']['ЗД']['Email']; ?></li>
				<li>визит: <?php echo $stats_data['Calls']['ЗД']['Визит']; ?></li>
			</ul>
		</div>
		<div class="justify">Сбой: <?php echo $stats_data['Calls']['Сбой']['overall']; ?></div>
		<div class="justify">Информационные: <?php echo $stats_data['Calls']['Инф.']['overall']; ?></div>
		<div class="justify">Демоверсии: <?php echo $stats_data['Calls']['Демо']['overall']; ?>
			<ul>
				<li>звонки: <?php echo $stats_data['Calls']['Демо']['Звонок']; ?></li>
				<li>сайт: <?php echo $stats_data['Calls']['Демо']['Сайт']; ?></li>
				<li>сио: <?php echo $stats_data['Calls']['Демо']['СИО']; ?></li>
				<li>email: <?php echo $stats_data['Calls']['Демо']['Email']; ?></li>
				<li>визит: <?php echo $stats_data['Calls']['Демо']['Визит']; ?></li>
			</ul>
		</div>
		<div class="justify">Консультации по ФВ: <?php echo $stats_data['Calls']['КФВ']['overall']; ?>
			<ul>
				<li>звонки: <?php echo $stats_data['Calls']['КФВ']['Звонок']; ?></li>
				<li>сайт: <?php echo $stats_data['Calls']['КФВ']['Сайт']; ?></li>
				<li>сио: <?php echo $stats_data['Calls']['КФВ']['СИО']; ?></li>
				<li>email: <?php echo $stats_data['Calls']['КФВ']['Email']; ?></li>
				<li>визит: <?php echo $stats_data['Calls']['КФВ']['Визит']; ?></li>
			</ul>
		</div>
		<div class="justify">Количество входящих писем: <?php echo $stats_data['Incidents']; ?></div>
		<div class="justify">Количество исходящих писем: <?php echo $stats_data['Outgoings']; ?></div>
<?php	endif; ?>
</div>	
<div class="actions">
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Входящие', true), array('controller' => 'incidents', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Исходящие', true), array('controller' => 'outgoings', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('action' => 'index')); ?></li>		
	</ul>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Зарег. входящее', true), array('controller' => 'incidents', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Зарег. исходящее', true), array('controller' => 'outgoings', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Зарег. обращение', true), array('action' => 'add')); ?></li>
	</ul>
</div>
<script language="javascript" type="text/javascript">
                // Динамическое добавление input'ов и их автозаполнение
                $("input#CallUserSid").autocomplete({
                    source: "/adnames.php",
                    minLength: 2
                });
            // Календарь
            $('#StatsStart').datepicker();
            $('#StatsEnd').datepicker();
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
