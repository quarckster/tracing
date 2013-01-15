
<div>
<?php echo $this->Form->create('Incident');?>
<div class="row">
	<legend class="span9">Редактировать входящее</legend>
</div>
<div class="row">
	<?php echo $this->Form->input('Incident.id', array('type' => 'hidden', 'value' => $this->data[0]['Incident']['id'])); 
	echo $this->Form->input('Incident.incoming_num', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Входящий номер', 'value' => $this->data[0]['Incident']['incoming_num']));
	echo $this->Form->input('Incident.number_to', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Номер ТО', 'value' => $this->data[0]['Incident']['number_to']));
	echo $this->Form->input('Incident.exp_date', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата исполнения', 'type' => 'text', 'value' => $this->data[0]['Incident']['exp_date']));
	echo $this->Form->input('Incident.content', array('div' => array('class' => 'span3'), 'class' => 'span3', 'label' => 'Содержание', 'value' => $this->data[0]['Incident']['content'])); ?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
		<?php echo $this->Form->input('Incident.organization', array('div' => array('class' => 'span8'), 'class' => 'span9', 'label' => 'Организация', 'value' => $this->data[0]['Incident']['organization'])); ?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<div class="span8"><?php
		$notified = array();
		foreach ($this->data[0]['Detail'] as $detail0):
			if ($detail0['notify_only'] == 1) {
				$notified[] = $detail0['user_sid'];
			}
		endforeach;
		echo $this->Html->tag('label', 'Уведомлены: ' . implode(", ", $notified));?>
	</div>
</div>
<div class="row">
	&nbsp;
</div>
<?php	
	$i=0;
	foreach ($this->data[0]['Detail'] as $detail):
		if (empty($detail['comment']) && $detail['notify_only'] != 1):
				echo $this->Form->input('Detail.'. $i .'.id', array('type' => 'hidden', 'value' => $detail['id']));
?>
<div class="row">
	<div class="span5">
		<div class="input-prepend input-append required">
			<span class="add-on"><?php echo $detail['comment_id']; ?></span><?php echo $this->Form->input('Detail.'. $i .'.user_sid', array('div' => false, 'class' => 'span3','label' => false, 'value' => $detail['user_sid'], 'id' => 'DetailUserSid'));
			echo $this->Html->link('<i class="icon-arrow-down"> </i>', array('controller' => 'details', 'action' => 'add', $detail['id'], 'after'), array('class' => 'btn', 'escape' => false)); 
			echo $this->Html->link('<i class="icon-arrow-up"> </i>', array('controller' => 'details', 'action' => 'add', $detail['id'], 'before'), array('class' => 'btn', 'escape' => false));
			echo $this->Html->link('<i class="icon-remove"> </i>', array('controller' => 'details', 'action' => 'delete', $detail['id']), array('class' => 'btn', 'escape' => false));?>
		</div>
	</div>
</div>
<?php  
		endif; 
		if (!empty($detail['comment']) && $detail['notify_only'] != 1):
?>
<div class="row">
	<div class="span4">
		<div class="input-prepend">
			<span class="add-on"><?php echo $detail['comment_id']; ?></span><span class="uneditable-input span3"><?php echo $detail['user_sid']; ?></span>
		</div>
	</div>
</div>
<?php	
	endif;
	$i++;
	endforeach;
?>
<div class="row">
			<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Сохранить', 'div' => array('class' => 'span2')));?>
</div>
</div>
<script language="javascript" type="text/javascript">
                // Автозаполнение
                $("input#DetailUserSid").autocomplete({
                    source: "/adnames.php",
                    minLength: 2
                });
            // Календарь
            $('#IncidentExpDate').datepicker();
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
