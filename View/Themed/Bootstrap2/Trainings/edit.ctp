<?php echo $this->Form->create('Training');?>
<div class="row">
	<legend class="span10 offset1">Редактирование заявки на обучение №<?php echo $this->data['Training']['id'];?></legend>
</div>
<div class="row">
	<?php echo $this->Form->input('Training.id', array('type' => 'hidden'));
	echo $this->Form->input('Training.user_sid', array('div' => array('class' => 'span2 offset1'), 'label' => 'Специалист', 'class' => 'span2'));
	echo $this->Form->input('Training.purpose', array('div' => array('class' => 'span5'), 'label' => 'Цель обучения', 'class' => 'span5'));
	echo $this->Form->input('Training.kind_training', array('div' => array('class' => 'span2'), 'label' => 'Вид обучения', 'class' => 'span2', 'options' => array('Индивидуальное' => 'Индивидуальное', 'Коллективное' => 'Коллективное')));?>
</div>
<div class="row">
&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('Training.number_to', array('div' => array('class' => 'span1 offset1'), 'class' => 'span1', 'label' => 'Номер ТО', 'type' => 'text'));
	echo $this->Form->input('Training.organization', array('div' => array('class' => 'span4'), 'class' => 'span4', 'label' => 'Организация'));
	echo $this->Form->input('Training.town', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Город'));
	echo $this->Form->input('Training.address_fact', array('div' => array('class' => 'span3'), 'class' => 'span3', 'label' => 'Адрес'));
	// echo $this->Form->input('Training.transport', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Транспорт'));
	?>
</div>
<div class="row">
&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('Training.systems_set', array('div' => array('class' => 'span2 offset1'), 'class' => 'span2', 'label' => 'Комплект систем'));
	echo $this->Form->input('Training.amount', array('div' => array('class' => 'span1'), 'class' => 'span1', 'label' => 'Cумма'));
	echo $this->Form->input('Training.competitors', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Конкуренты'));
	echo $this->Form->input('Training.tso', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Оборудование', 'options' => array('Нет' => 'Нет', 'Ноутбук' => 'Ноутбук', 'Флеш' => 'Флеш')));
	echo $this->Form->input('Training.additional_info', array('div' => array('class' => 'span3'), 'label' => 'Дополнительная информация', 'class' => 'span3'));
	// echo $this->Form->input('Training.comfortable_time', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Удобное время'));
	// echo $this->Form->input('Training.not_comfortable_time', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Неудобное время'));
	?>
</div>
<div class="row">
&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('Training.date_control', array('div' => array('class' => 'span2 offset1'), 'class' => 'span2', 'label' => 'Дата контроля', 'type' => 'text'));
	echo $this->Form->input('Training.date_receipt', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата получения', 'type' => 'text'));
	echo $this->Form->input('Training.date_training', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Обучение проведено', 'type' => 'text'));
	echo $this->Form->input('Training.date_end', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата завершения', 'type' => 'text'));
	echo $this->Form->input('Training.mentor_sid', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Преподаватель', 'type' => 'text'));?>
</div>
<br>
<?php if(!empty($this->data['TrainingsContact'])):?>
<?php $i = 0;?>
<div class="row">
	<legend class="span10 offset1">Список контактных лиц клиента</legend>
	<div class="span3 offset1">
		<?php echo $this->Html->link('Добавить', '#add', array('class' => 'btn', 'id' => 'button_add'));?>
		<?php echo $this->Html->link('Удалить', '#remove', array('class' => 'btn', 'id' => 'button_remove'));?>
	</div>
</div>
<br>
<?php foreach($this->data['TrainingsContact'] as $trainingscontact):?>
<div class="row">
	<?php echo $this->Form->input('TrainingsContact.'.$i.'.id', array('type' => 'hidden'));
	echo $this->Form->input('TrainingsContact.'.$i.'.name', array('div' => array('class' => 'span3 offset1'), 'class' => 'span3', 'label' => 'Имя'));
	echo $this->Form->input('TrainingsContact.'.$i.'.occupation', array('div' => array('class' => 'span3'), 'class' => 'span3', 'label' => 'Должность'));
	echo $this->Form->input('TrainingsContact.'.$i.'.phone', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Телефон'));
	echo $this->Form->input('TrainingsContact.'.$i.'.misc', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Примечание'));?>
</div>
<?php $i++;?>
<?php endforeach;?>
<div class="row">
&nbsp;
</div>
<?php endif;?>
<div class="row">
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Сохранить', 'div' => array('class' => 'span2 offset1')));?>
</div>
<script>
// Автозаполнение
$("input#TrainingUserSid,input#TrainingMentorSid").autocomplete({
	source: "/adnames.php",
	minLength: 2
});
$('#button_add').click(function(){
	num = $('input').filter(function() {
		return this.id.match(/TrainingsContact\dId/);
	}).length;
	num2 = num - 1;
	idVal = $('#TrainingsContact'+ num2 +'Id').val();
	//idVal++; 
	newDiv = $('<div class="row"><input type="hidden" name="data[TrainingsContact]['+ num +'][id]" id="TrainingsContact'+ num +'Id"><div class="span3 offset1 required"><label for="TrainingsContact'+ num +'Name">Имя</label><input name="data[TrainingsContact]['+ num +'][name]" class="span3" maxlength="255" type="text" id="TrainingsContact'+ num +'Name"></div><div class="span3 required"><label for="TrainingsContact'+ num +'Occupation">Должность</label><input name="data[TrainingsContact]['+ num +'][occupation]" class="span3" maxlength="255" type="text" id="TrainingsContact'+ num +'Occupation"></div><div class="span2"><label for="TrainingsContact'+ num +'Phone">Телефон</label><input name="data[TrainingsContact]['+ num +'][phone]" class="span2" maxlength="255" type="text" id="TrainingsContact'+ num +'Phone"></div><div class="span2"><label for="TrainingsContact'+ num +'Misc">Примечание</label><input name="data[TrainingsContact]['+ num +'][misc]" class="span2" maxlength="255" type="text" id="TrainingsContact'+ num +'Misc"></div></div>');
	num = num - 1;
	$('#TrainingsContact' + num + 'Id').parent().after(newDiv);
	});
$('#button_remove').click(function(){
	num = $('input').filter(function() {
		return this.id.match(/TrainingsContact\dId/);
	}).length;
	num = num - 1;
	if (!($('input#TrainingsContact' + num + 'Name').val())){
		$('input#TrainingsContact' + num + 'Id').parent().remove();
	}
});
// Календарь
$("input#TrainingDateControl,input#TrainingDateReceipt,input#TrainingDateTraining,input#TrainingDateEnd").datepicker();
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