<?php 
echo $this->Form->create('Incident');?>
<div class="row">
	<legend class="span12">Добавить входящее</legend>
</div>
<div class="row">
		<?php
			if (isset($incoming_numbers)) {
				echo $this->Form->input('Incident.incoming_num', array('div' => array('class' => 'span5'), 'label' => 'Входящий номер', 'class' => 'span5', 'placeholder' => implode(", ", $incoming_numbers)));
			} else {
				echo $this->Form->input('Incident.incoming_num', array('div' => array('class' => 'span4'), 'label' => 'Входящий номер', 'class' => 'span4'));
			}
			echo $this->Form->input('Incident.number_to', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Номер ТО'));
			echo $this->Form->input('Incident.exp_date', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата исполнения', 'type' => 'text'));
			echo $this->Form->input('Incident.content', array('div' => array('class' => 'span3'), 'class' => 'span3', 'label' => 'Содержание'));?>
</div>
<div class="row">
&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('Incident.organization', array('div' => array('class' => 'span11'), 'class' => 'span11', 'label' => 'Организация'));?>
</div>
<div class="row">
	<?php echo $this->Form->input('Detail.notify', array('div' => array('class' => 'span11'), 'class' => 'span11', 'label' => 'Уведомить'));?>
</div>
<div class="row">
&nbsp;
</div>
<div class="row">
	<div class="span3">
		<h4>Участники маршрута</h4>
	</div>
	<div class="span3">
			<?php echo $this->Html->link('Добавить', '#', array('class' => 'btn', 'id' => 'button_add'));?>
			<?php echo $this->Html->link('Удалить', '#', array('class' => 'btn', 'id' => 'button_remove'));?>
	</div>
</div>
<div class="row">
&nbsp;
</div>
<input id="DetailUserSid-0" type="hidden">
<div class="row">
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Сохранить', 'div' => array('class' => 'span2')));?>
</div>
<script language="javascript" type="text/javascript">
	$("input#DetailNotify").tokenInput("/adnames.php", {
		minChars: "2",
		theme: "facebook",
		queryParam: "term",
		hintText: "",
		noResultsText: "Ничего не найдено",
		searchingText: "Поиск...",
		propertyToSearch: "value",
		tokenValue: "value",
		tokenDelimiter: ", ",
		preventDuplicates: true			
	});
	// Динамическое добавление input'ов и их автозаполнение
	$('#button_add').click(function(){
		num = $("input[id*='DetailUserSid-']").length;
		var newDiv = $('<div id="DetailUserSid-' + num + '" class="row"><div class="span4"><div class="input-prepend"><span class="add-on">' + num + '</span><input name="data[Detail][' + num + '][user_sid]" class="span3 autocomplete" type="text" id="DetailUserSid-' + num + '"/></div><input name="data[Detail][' + num + '][notify_only]" type="hidden" id="DetailNotifyOnly-' + num + '" value="0"/><input name="data[Detail][' + num + '][comment_id]" type="hidden" id="DetailCommentId-' + num + '" value="'+ num +'"/></div></div>');
		$('#DetailUserSid-0').before(newDiv);
		$('.autocomplete').autocomplete({
			source: "/adnames.php",
			dataType: "json",
			minLength: 2
			});
		});
	$('#button_remove').click(function(){
		num = $("input[id*='DetailUserSid-']").length - 1;
		$('div#DetailUserSid-' + num + '').children().remove();
		$('div#DetailUserSid-' + num + '').remove();
	});
	// Календарь
	$('#IncidentExpDate').datepicker();
	jQuery(function($){
		$.datepicker.regional['ru'] = {
			closeText: 'Закрыть',
			prevText: '&#x3c;Пред',
			nextText: 'След&#x3e;',
			currentText: 'Сегодня',
			monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
			monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
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
