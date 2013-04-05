<?php echo $this->Form->create('Call');?>
<div class="row">
	<legend class="span10">Зарегистрировать обращение</legend>
</div>
<div class="row">
	<?php echo $this->Form->input('Call.user_sid', array('div' => array('class' => 'span3'), 'class' => 'span3', 'label' => 'Ваше имя' ));
	echo $this->Form->input('Call.number_to', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Номер ТО', 'type' => 'text'));
	echo $this->Form->input('Call.category', array('class' => 'span3', 'label' => 'Категория', 'div' => array('class' => 'span3'), 'options' => array('ЗД' => 'Заказ документов', 'Сбой' => 'Сбой', 'Инф.' => 'Информационное', 'Демо' => 'Демоверсия', 'УО' => 'Угроза отключения', 'РС' => 'Рекомендация СИО', 'КФВ' => 'Консультации по формализованным вопросам')));
	echo $this->Form->input('Call.delivery', array('class' => 'span2', 'label' => 'Способ обращения', 'div' => array('class' => 'span2'), 'options' => array('Звонок' => 'Звонок', 'Сайт' => 'Сайт', 'Email' => 'Email', 'СИО' => 'СИО', 'Визит' => 'Визит'))); ?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('Call.organization', array('div' => array('class' => 'span10'), 'class' => 'span10', 'label' => 'Организация')); ?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('Call.contact_data', array('type' => 'text', 'div' => array('class' => 'span10'), 'class' => 'span10', 'label' => 'Контактные данные')); ?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('Call.content', array('type' => 'text', 'rows' => '2', 'div' => array('class' => 'span10'), 'class' => 'span10', 'label' => 'Содержание')); ?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('Call.notified', array('div' => array('class' => 'span10'), 'class' => 'span10', 'label' => 'Уведомить об обращении')); ?>
</div>

<div class="row">
	&nbsp;
</div>
<div class="row">
		<?php echo $this->Form->input('Call.control', array('div' => array('class' => 'span2'), 'label' => array('text' => 'На контроле', 'class' => 'checkbox inline'), 'type' => 'checkbox')); ?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<div class="span3">
		<h4>Участники обращения</h4>
	</div>
	<div class="span3">
			<?php echo $this->Html->link('Добавить', '#', array('class' => 'btn', 'id' => 'button_add'));?>
			<?php echo $this->Html->link('Удалить', '#', array('class' => 'btn', 'id' => 'button_remove'));?>
	</div>
</div>
<div class="row">
&nbsp;
</div>
<input id="CallsDetailUserSid-0" type="hidden">
<div class="row">
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Сохранить', 'div' => array('class' => 'span2')));?>
</div>
<script language="javascript" type="text/javascript">
	$("input#CallNotified").tokenInput("/adnames.php", {
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
	$("input#CallUserSid").autocomplete({
		source: "/adnames.php",
		minLength: 2
	});
	$("input#CallContactData").autocomplete({
		source: "/orgautocomplete.php",
		minLength: 2
	});
	$('#button_add').click(function(){
		num = $("input[id*='CallsDetailUserSid-']").length;
		var newDiv = $('<div id="CallsDetailUserSid-' + num + '" class="row"><div class="span4"><div class="input-prepend"><span class="add-on">' + num + '</span><input name="data[CallsDetail][' + num + '][user_sid]" class="span3 autocomplete" type="text" id="CallsDetailUserSid-' + num + '"/></div><input name="data[CallsDetail][' + num + '][order]" type="hidden" id="CallsDetailOrder-' + num + '" value="'+ num +'"/></div></div>');
		$('#CallsDetailUserSid-0').before(newDiv);
		$('.autocomplete').autocomplete({
			source: "/adnames.php",
			dataType: "json",
            minLength: 2
            });
        });
	$('#button_remove').click(function(){
		num = $("input[id*='CallsDetailUserSid-']").length - 1;
		$('div#CallsDetailUserSid-' + num + '').children().remove();
		$('div#CallsDetailUserSid-' + num + '').remove();
	});
</script>
