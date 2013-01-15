<div>
<?php echo $this->Form->create('SecondStage');?>
<div class="row">
	<legend class="span12">Редактировать второй этап</legend>
</div>
<div class="row">
	<?php echo $this->Form->input('SecondStage.id', array('type' => 'hidden', 'value' => $this->data['SecondStage']['id'])); 
	echo $this->Form->input('SecondStage.order_number', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Номер заказа', 'value' => $this->data['SecondStage']['order_number']));
	echo $this->Form->input('SecondStage.date', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата', 'type' => 'text', 'value' => $this->data['SecondStage']['date']));
	echo $this->Form->input('SecondStage.order_in', array('div' => array('class' => 'offset2 span2'), 'options' => array('КЦ' => 'КЦ', 'РХ' => 'РХ', 'Другие РИЦ' => 'Другие РИЦ'), 'class' => 'span2', 'label' => 'Заказ в', 'value' => $this->data['SecondStage']['order_in']));
	echo $this->Form->input('SecondStage.order_way', array('div' => array('class' => 'span3'), 'options' => array('Корпоративный сервер' => 'Корпоративный сервер', 'Email' => 'Email', 'Звонок' => 'Звонок', 'Письмо' => 'Письмо'), 'class' => 'span3', 'label' => 'Способ заказа', 'value' => $this->data['SecondStage']['order_way']));?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('SecondStage.additional_info', array('div' => array('class' => 'span6'), 'class' => 'span6', 'label' => 'Дополнительная информация и иные особенности заказа', 'type' => 'textarea', 'value' => $this->data['SecondStage']['additional_info']));
	echo $this->Form->input('SecondStage.note', array('div' => array('class' => 'span6'), 'class' => 'span6', 'label' => 'Примечания', 'type' => 'textarea', 'value' => $this->data['SecondStage']['note']));?>
</div>
<?php if (!empty($this->data['PreliminaryResponse'])):?>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<div class="span10">
		<h4>Предварительные ответы</h4>
			<table class="table table-condensed">
				<thead>
					<tr>
						<th>Дата ответа</th>
						<th>Дата отправки</th>
						<th>Способ передачи</th>
						<th>Ответ</th>
						<th></th>
					</tr>
				</thead>
				<?php
				$i=0;
				foreach ($this->data['PreliminaryResponse'] as $preliminary_responses):?>
				<tr>
					<?php echo $this->Form->input('PreliminaryResponse.'. $i .'.id', array('type' => 'hidden', 'value' => $preliminary_responses['id'])); ?>
					<td><?php echo $this->Form->input('PreliminaryResponse.'. $i .'.answer_date', array('class' => 'span2', 'type' => 'text', 'label' => false, 'value' => $preliminary_responses['answer_date']));?></td>
					<td><?php echo $this->Form->input('PreliminaryResponse.'. $i .'.send_date', array('class' => 'span2', 'type' => 'text', 'label' => false, 'value' => $preliminary_responses['send_date']));?></td>
					<td><?php echo $this->Form->input('PreliminaryResponse.'. $i .'.delivery', array('class' => 'span3', 'type' => 'text', 'options' => array('Email' => 'email', 'Исх. письмо' => 'Исх. письмо', 'Звонок клиенту' => 'Звонок клиенту', 'СИО' => 'СИО', 'Визит клиента' => 'Визит клиента'), 'type' => 'select', 'label' => false, 'value' => $preliminary_responses['delivery']));?></td>
					<td><?php echo $this->Form->input('PreliminaryResponse.'. $i .'.answer', array('class' => 'span5', 'type' => 'textarea', 'label' => false, 'value' => $preliminary_responses['answer']));?></td>
					<td><div class="btn-group pull-right"><?php
							echo $this->Html->link('<i class="icon-remove"> </i>', array('controller' => 'preliminary_responses', 'action' => 'delete', $preliminary_responses['id']), array('class' => 'btn', 'escape' => false, 'Вы уверены, что хотите удалить это?'));?>
					</div></td>
				</tr>
				<?php 
				$i++;
				endforeach;?>
			</table>
	</div>
</div>
<?php endif;?>
<?php if (!empty($this->data['Result']['id'])):?>
<div class="row">
	&nbsp;
</div>
<div>
	<h4>Результат</h4>
	<div class="row">
		<?php echo $this->Form->input('Result.id', array('type' => 'hidden', 'value' => $this->data['Result']['id']));
		echo $this->Form->input('Result.answer_source', array('class' => 'span3', 'label' => 'Источник ответа', 'div' => array('class' => 'span3'), 'options' => array('Архив РИЦ' => 'Архив РИЦ', 'Ведомства по РХ' => 'Ведомства по РХ', 'Другой РИЦ' => 'Другой РИЦ', 'Интернет' => 'Интернет', 'КЦ КП' => 'КЦ КП', 'Корпоративный сервер' => 'Корпоративный сервер', 'Нац. архив' => 'Нац. архив', 'Архив ОРВ РИЦ 188' => 'Архив ОРВ РИЦ 188', 'Официальный сайт' => 'Официальный сайт', 'СПС КП' => 'СПС КП')));
		echo $this->Form->input('Result.answer_date', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата ответа', 'type' => 'text', 'value' => $this->data['Result']['answer_date']));
		echo $this->Form->input('Result.send_date', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата отправки', 'type' => 'text', 'value' => $this->data['Result']['send_date']));
		echo $this->Form->input('Result.delivery', array('div' => array('class' => 'span3'), 'options' => array('Email' => 'email', 'Исх. письмо' => 'Исх. письмо', 'Звонок клиенту' => 'Звонок клиенту', 'СИО' => 'СИО', 'Визит клиента' => 'Визит клиента'), 'class' => 'span3', 'label' => 'Способ передачи', 'value' => $this->data['Result']['delivery']));?>
	</div>
	<div class="row">
	&nbsp;
	</div>
	<div class="row">
		<?php echo $this->Form->input('Result.answer', array('div' => array('class' => 'span6'), 'class' => 'span6', 'label' => 'Ответ', 'type' => 'textarea', 'value' => $this->data['Result']['answer']));
		echo $this->Form->input('Result.note', array('div' => array('class' => 'span6'), 'class' => 'span6', 'label' => 'Примечания', 'type' => 'textarea', 'value' => $this->data['Result']['note']));?>		
	</div>
</div>	
</div>
<?php endif;?>
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Сохранить', 'div' => array('class' => 'span2')));?>
</div>
</div>
<script language="javascript" type="text/javascript">
// Календарь
$("input[id*='Date']").datepicker();
jQuery(function($){
	$.datepicker.regional['ru'] = {
		closeText: 'Закрыть',
		prevText: '<Пред',
		nextText: 'След>',
		currentText: 'Сегодня',
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
			'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
			'Июл','Авг','Сен','Окт','Ноя','Дек'],
		dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
		dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
		dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		weekHeader: 'Не',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ru']);
});
</script>