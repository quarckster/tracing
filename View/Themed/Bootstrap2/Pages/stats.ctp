<h2>Статистика</h2>
<div class="row">
<?php
		echo $this->Form->create('Stats');
		echo $this->Form->input('start', array('div' => 'span2', 'class' => 'span2', 'label' => 'Начальная дата'));
		echo $this->Form->input('end', array('div' => 'span2', 'class' => 'span2', 'label' => 'Конечная дата'));?>
	<div class="span2">
		&nbsp;
		<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Показать'));?>
	</div>
</div>
<?php if (isset($stats_data)):?>
<div class="row">&nbsp;</div>
<div class="well">
	<div class="row">
		<div class="span3"><h4>Заказ документов: <?php echo $stats_data['Calls']['ЗД']['overall']; ?></h4>
			<ul>
				<li>звонки: <?php echo $stats_data['Calls']['ЗД']['Звонок']; ?></li>
				<li>сайт: <?php echo $stats_data['Calls']['ЗД']['Сайт']; ?></li>
				<li>сио: <?php echo $stats_data['Calls']['ЗД']['СИО']; ?></li>
				<li>email: <?php echo $stats_data['Calls']['ЗД']['Email']; ?></li>
				<li>визит: <?php echo $stats_data['Calls']['ЗД']['Визит']; ?></li>
			</ul>
		</div>
		<div class="span1"><h4>Сбой: <?php echo $stats_data['Calls']['Сбой']['overall']; ?></h4></div>
		<div class="span3"><h4>Информационные: <?php echo $stats_data['Calls']['Инф.']['overall']; ?></h4></div>
		<div class="span2"><h4>Демоверсии: <?php echo $stats_data['Calls']['Демо']['overall']; ?></h4>
			<ul>
				<li>звонки: <?php echo $stats_data['Calls']['Демо']['Звонок']; ?></li>
				<li>сайт: <?php echo $stats_data['Calls']['Демо']['Сайт']; ?></li>
				<li>сио: <?php echo $stats_data['Calls']['Демо']['СИО']; ?></li>
				<li>email: <?php echo $stats_data['Calls']['Демо']['Email']; ?></li>
				<li>визит: <?php echo $stats_data['Calls']['Демо']['Визит']; ?></li>
			</ul>
		</div>
		<div class="span3"><h4>Консультации по ФВ: <?php echo $stats_data['Calls']['КФВ']['overall']; ?></h4>
			<ul>
				<li>звонки: <?php echo $stats_data['Calls']['КФВ']['Звонок']; ?></li>
				<li>сайт: <?php echo $stats_data['Calls']['КФВ']['Сайт']; ?></li>
				<li>сио: <?php echo $stats_data['Calls']['КФВ']['СИО']; ?></li>
				<li>email: <?php echo $stats_data['Calls']['КФВ']['Email']; ?></li>
				<li>визит: <?php echo $stats_data['Calls']['КФВ']['Визит']; ?></li>
			</ul>
		</div>
	</div>
	<div class="row">&nbsp;</div>
	<div class="row">
		<div class="span4"><h4>Количество входящих писем: <?php echo $stats_data['Incidents']; ?></h4></div>
		<div class="span4"><h4>Количество исходящих писем: <?php echo $stats_data['Outgoings']; ?></h4></div>
	</div>
	<div class="row">&nbsp;</div>
	<div class="row">
		<div class="span2"><h4>Второй этап</h4>
			<ul>
				<li>КЦ: <?php echo $stats_data['SecondStages']['КЦ'];?></li>
				<li>РХ: <?php echo $stats_data['SecondStages']['РХ'];?></li>
				<li>Другие РИЦ: <?php echo $stats_data['SecondStages']['Другие РИЦ'];?></li>
			</ul>
		</div>
	</div>
</div>
<?php	endif; ?>
<script language="javascript" type="text/javascript">
	// Календарь
	$(function() {
		$( "#StatsStart" ).datepicker({
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				$( "#StatsEnd" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#StatsEnd" ).datepicker({
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				$( "#StatsStart" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	});
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
