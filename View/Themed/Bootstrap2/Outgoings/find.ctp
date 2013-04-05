<div>
<?php
	if (count($this->params['named']) >= '1' && isset($this->params['named']['filter'])) {
		echo null;
	} else {
		echo $this->Form->create('Outgoing', array('url' => array_merge(array('action' => 'find'), $this->params['pass']))); ?>
		<div class="row"><?php
			echo $this->Form->input('Outgoing.outgoing_num', array('div' => array('class' => 'span2'), 'label' => 'Номер письма', 'class' => 'span2'));
			echo $this->Form->input('Outgoing.content', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Содержание'));
			echo $this->Form->input('Outgoing.executer', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Исполнитель'));
			echo $this->Form->input('filter', array( 'class' => 'span2', 'label' => 'Где искать', 'div' => array('class' => 'span2'), 'options' => array(null => 'Все исходящие', 'RKS' => 'РКС', 'SP' => 'СП', 'API' => 'АПИ', 'IP' => 'ИП', 'KS' => 'КС')));
			echo $this->Form->input('cis', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Шаблон КИС', 'options' => array(null => 'Все', '0' => 'Без шаблона', '1' => 'С шаблоном')));
			echo $this->Form->input('folder', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Папка', 'options' => array(null => 'Все', '0' => 'Нет', '1' => 'Да')));?>
		</div>
		<div class="row">
			<?php echo $this->Form->input('Outgoing.organization', array('div' => array('class' => 'span4'), 'class' => 'span4', 'label' => 'Организация'));
			echo $this->Form->input('range_from', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Начальная дата'));
			echo $this->Form->input('range_to', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Конечная дата'));?>
		</div>
		<div class="row"><?php
			echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Найти', 'div' => array('class' => 'span2')));?>
		</div>
<?php } ?>
	<?php //if (!empty($this->params['named']['filter'])):
				echo $this->element('pagination'); ?>
	<table class="table table-striped table-bordered table-condensed">
		<col width="70" />
		<col width="auto" />
		<col width="auto" />
		<col width="90" />
		<col width="180" />
		<col width="40" />
		<col width="40" />
		<col width="120" />
	<tr>
		<thead>
			<th>Номер</th>
			<th>Организация</th>
			<th>Содержание</th>
			<th>Дата</th>
			<th>Исполнитель</th>
			<th>Папка</th>
			<th>КИС</th>
			<th class="actions"></th>
		</thead>	
	</tr>
	<?php foreach ($outgoings as $outgoing):?>
	<tr>
		<td><?php echo $outgoing['Outgoing']['outgoing_num']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['organization']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['content']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['date']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['executer']; ?>&nbsp;</td>
		<td><?php if ($outgoing['Outgoing']['folder'] == 1){ echo '<i class="icon-ok aligncenter"> </i>'; } ?>&nbsp;</td>
		<td><?php if ($outgoing['Outgoing']['cis'] == 1){ echo '<i class="icon-ok aligncenter"> </i>'; } ?>&nbsp;</td>
		<td><div class="btn-group">
			<?php echo $this->Html->link('<i class="icon-file"> </i>', array('action' => 'view', $outgoing['Outgoing']['id']), array('class' => 'btn', 'escape' => false)); 
			echo $this->Html->link('<i class="icon-edit"> </i>', array('action' => 'edit', $outgoing['Outgoing']['id']), array('class' => 'btn', 'escape' => false));
			echo $this->Html->link('<i class="icon-remove"> </i>', array('action' => 'delete', $outgoing['Outgoing']['id']), array('class' => 'btn', 'escape' => false));?>
		</div></td>
	</tr>
	<?php endforeach; ?>
	</table>
	<?php echo $this->element('pagination');
	//endif; ?>
</div>
<script language="javascript" type="text/javascript">
	$("input#OutgoingExecuter").autocomplete({
		source: "/adnames.php",
		minLength: 2
	});
	// Календарь
	$('#OutgoingDate').datepicker();
	$(function() {
		$( "#OutgoingRangeFrom" ).datepicker({
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				$( "#OutgoingRangeTo" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#OutgoingRangeTo" ).datepicker({
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				$( "#OutgoingRangeFrom" ).datepicker( "option", "maxDate", selectedDate );
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
