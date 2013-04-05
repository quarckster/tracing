<?php echo $this->Form->create('Call');?>
<div class="row">
	<div class="span10">
		<legend>Редактировать данные об обращении
			<?php if (!$close_date) {?>
			<div class="btn-group pull-right">
				<?php echo $this->Html->link('Закрыть', array('action' => 'change_state', $this->data['Call']['id']), array('class' => 'btn'));?>
			</div>
			<?php } else {?>
			<div class="btn-group pull-right">
				<?php echo $this->Html->link('Открыть снова', array('action' => 'change_state', $this->data['Call']['id']), array('class' => 'btn'));?>
			</div>
			<span class="pull-right">Закрыто <?php echo $close_date.'&nbsp;';?></span>
			 <?php } ?>
		</legend>
	</div>
</div>
<div class="row">
	<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->data['Call']['id']));
	$span = $this->Html->tag('span', $this->data['Call']['user_sid'], array('class' => 'span3 uneditable-input'));
	$label = $this->Html->tag('label', 'Зарегистрировала');
	echo $this->Html->tag('div', $label.$span, array('class' => 'span3'));
	echo $this->Form->input('number_to', array('div' => array('class' => 'span2'), 'type' => 'text', 'class' => 'span2', 'value' => $this->data['Call']['number_to'], 'label' => 'Номер ТО'));
	echo $this->Form->input('category', array('label' => 'Категория', 'div' => array('class' => 'span3'), 'class' => 'span3', 'value' => $this->data['Call']['category'], 'options' => array('ЗД' => 'Заказ документов', 'Сбой' => 'Сбой', 'Инф.' => 'Информационный', 'Демо' => 'Демоверсия', 'УО' => 'Угроза отключения', 'РС' => 'Рекомендация СИО', 'КФВ' => 'Консультации по формализованным вопросам')));
	echo $this->Form->input('delivery', array('label' => 'Способ обращения', 'div' => array('class' => 'span2'), 'class' => 'span2', 'value' => $this->data['Call']['delivery'], 'options' => array('Сайт' => 'Сайт', 'Звонок' => 'Звонок', 'Email' => 'Email', 'СИО' => 'СИО', 'Визит' => 'Визит')));?>
</div>
<div class="row">
	<?php echo $this->Form->input('organization', array('div' => array('class' => 'span10'), 'class' => 'span10', 'value' => $this->data['Call']['organization'], 'label' => 'Организация'));?>
</div>
<div class="row">
	<?php echo $this->Form->input('contact_data', array('type' => 'text', 'div' => array('class' => 'span10'), 'class' => 'span10', 'value' => $this->data['Call']['contact_data'], 'label' => 'Контактные данные'));?>
</div>
<div class="row">
	<?php echo $this->Form->input('content', array('type' => 'text', 'div' => array('class' => 'span10'), 'class' => 'span10', 'value' => $this->data['Call']['content'], 'label' => 'Содержание'));?>
</div>
<div class="row">
	<?php echo $this->Form->input('actions', array('type' => 'text', 'div' => array('class' => 'span10'), 'class' => 'span10', 'value' => $this->data['Call']['actions'], 'label' => 'Предпринятые действия'));?>
</div>
<div class="row">
	<?php 
	echo $this->Form->input('cis_template', array('label' => 'Шаблон в КИС', 'div' => array('class' => 'span2'), 'class' => 'span2', 'value' => $this->data['Call']['cis_template'], 'options' => array(0 => 'Без шаблона', 1 => 'С шаблоном', 2 => 'Шаблон не нужен')));
	echo $this->Form->input('control', array('div' => array('class' => 'span2'), 'value' => $this->data['Call']['control'], 'label' => array('class' => 'checkbox inline', 'text' => 'На контроль'), 'type' => 'checkbox'));?>
</div>
<?php if (!empty($this->data['Call']['notified'])):?>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Html->tag('label', 'Уведомлены: ' . $this->data['Call']['notified'], array('class' => 'span10'));?>
</div>
<div class="row">
	&nbsp;
</div>
<?php endif; ?>
<div class="row">
	<?php echo $this->Form->input('notified', array('div' => array('class' => 'span10'), 'class' => 'span10', 'label' => 'Уведомить о звонке')); ?>
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
<?php if(!empty($this->data['CallsDetail'])):
		$i = 0;
		$count = count($this->data['CallsDetail']);
		foreach ($this->data['CallsDetail'] as $calls_detail):
			if (empty($calls_detail['comment'])){?>
				<div class="row">
					<div class="span5">
						<div class="input-prepend input-append required">
							<span class="add-on"><?php
								echo $calls_detail['order'];?></span><?php echo $this->Form->input('CallsDetail.'. $i .'.user_sid', array('div' => false, 'class' => 'span3','label' => false, 'value' => $calls_detail['user_sid'], 'id' => 'CallsDetailUserSid-'.$i));
								echo $this->Form->input('CallsDetail.'. $i .'.id', array('type' => 'hidden', 'value' => $calls_detail['id'], 'id' => 'CallsDetailId-'.$i));
								echo $this->Html->link('<i class="icon-remove"> </i>', array('controller' => 'calls_details', 'action' => 'delete', $calls_detail['id']), array('class' => 'btn', 'escape' => false));?>
						</div>
					</div>
				</div>
<?php 		} ?>
		<?php	if (!empty($calls_detail['comment'])):?>
			<div class="row">
				<div class="span4">
					<div class="input-prepend">
						<span class="add-on"><?php echo $calls_detail['order']; ?></span><span <?php echo 'id="CallsDetailUserSid-'.$i.'"'; ?> class="uneditable-input span3"><?php echo $calls_detail['user_sid']; ?></span>
					</div>
				</div>
			</div>
<?php	
			endif;
		$i++;
		endforeach;
	endif;
?>
<span id="insertbefore"></span><!-- Скрытое поле для работы кнопок "Добавить" и "Удалить" -->
<div class="row">
	&nbsp;
</div>
<div class="row">
			<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Сохранить', 'div' => array('class' => 'span2')));?>
</div>

<script language="javascript" type="text/javascript">
	//Поле "Уведомить"
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
	// Автозаполнение
	$("input#CallsDetailUserSid").autocomplete({
		source: "/adnames.php",
		minLength: 2
			});
	//Кнопка "Добавить"
	$('#button_add').click(function(){
		var num3 = $("input[id*='CallsDetailUserSid-']").length;
		var num4 = $("span[id*='CallsDetailUserSid-']").length;
		var num1 = num3 + num4;
		var num2 = num1 + 1;
		var newDiv = $('<div id="CallsDetailUserSid-' + num1 + '" class="row"><div class="span4"><div class="input-prepend"><span class="add-on">' + num2 + '</span><input name="data[CallsDetail][' + num1 + '][user_sid]" class="span3 autocomplete" type="text" id="CallsDetailUserSid-' + num1 + '"/></div><input name="data[CallsDetail][' + num1 + '][order]" type="hidden" id="CallsDetailOrder-' + num1 + '" value="'+ num2 +'"/></div></div>');
		$('#insertbefore').before(newDiv);
		$('.autocomplete').autocomplete({
			source: "/adnames.php",
			dataType: "json",
			minLength: 2
			});
		});
	//Кнопка "Удалить"	
	$('#button_remove').click(function(){
		var num3 = $("input[id*='CallsDetailUserSid-']").length - 1;
		var num4 = $("span[id*='CallsDetailUserSid-']").length;
		var num = num3 + num4;
		$('div#CallsDetailUserSid-' + num + '').children().remove();
		$('div#CallsDetailUserSid-' + num + '').remove();
	});
</script>