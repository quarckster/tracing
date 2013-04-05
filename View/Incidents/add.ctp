<div class="incidents form">
<?php echo $this->Form->create('Incident');?>
	<fieldset>
		<legend>Добавить входящее</legend>
	<?php
		echo 'Номера последних входящих: ';
		echo $incoming_number['IP']['Incident']['incoming_num'], ', ', $incoming_number['API']['Incident']['incoming_num'], ', ', $incoming_number['KS']['Incident']['incoming_num'], ', ', $incoming_number['RKS']['Incident']['incoming_num'];
		echo $this->Form->input('Incident.incoming_num', array( 'label' => 'Входящий номер' ));
		//echo $this->Form->input('Incident.user_sid', array( 'label' => 'Ваше имя' ));
		echo $this->Form->input('Incident.organization', array( 'label' => 'Организация' ));
		echo $this->Form->input('Incident.number_to', array( 'label' => 'Номер ТО' ));
		echo $this->Form->input('Incident.exp_date', array( 'label' => 'Дата исполнения', 'type' => 'text' ));
		echo $this->Form->input('Incident.content', array('rows' => '3', 'label' => 'Содержание'));
		echo $this->Html->link('Добавить', 'javascript:', array('id' => 'button_add'));
		echo "&nbsp;";
		echo $this->Html->link('Удалить', 'javascript:', array('id' => 'button_remove'));
/*
		echo $this->Form->input('Detail.0.user_sid', array( 'label' => 'Имя' ));
		echo $this->Form->input('Detail.0.notify_only', array( 'label' => '' ));
		echo "<div id=\"inputs\"><input id=\"DetailUserSid-0\" name=\"data[Detail][user_sid]\" type=\"hidden\"><input name=\"data[Detail][notify_only]\" type=\"hidden\" value=\"0\"></div>";
*/
		echo "<div id=\"inputs\"><input id=\"DetailUserSid-0\" type=\"hidden\"><input type=\"hidden\"></div>";

	?>
	</fieldset>
<?php echo $this->Form->end('Сохранить');?>
</div>
<div class="actions">
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
	</ul>
	<h3>Фильтры</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Все', true), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Просроченные обр-ые', true), array('action' => 'find', 'filter' => 'delayed')); ?></li>
		<li><?php echo $this->Html->link(__('Просроченные необр-ые', true), array('action' => 'find', 'filter' => 'delayed_in_progress')); ?></li>
		<li><?php echo $this->Html->link(__('В работе', true), array('action' => 'find', 'filter' => 'in_progress')); ?></li>
		<li><?php echo $this->Html->link(__('Об откл. за долги', true), array('action' => 'find', 'filter' => 'debt')); ?></li>
		<li><hr size="0" /></li>
		<li><?php echo $this->Html->link(__('Поиск', true), array('action' => 'find')); ?></li>
	</ul>
</div>
<script language="javascript" type="text/javascript">
                // Динамическое добавление input'ов и их автозаполнение
                $("input#IncidentUserSid").autocomplete({
                    source: "/adnames.php",
                    minLength: 2
                });
                $('#button_add').click(function(a){
                    num = $("input[id*='DetailUserSid-']").length;
                    var newInp = $('<br><input name="data[Detail][' + num + '][user_sid]" style="width: 80%" type="text" id="DetailUserSid-' + num + '"/>&nbsp;<select style="width: 120px;" name="data[Detail][' + num + '][notify_only]"><option value="0">Отправить</option><<option value="1">Уведомить</option></select><input name="data[Detail][' + num + '][comment_id]" type="hidden" id="DetailNotifyOnly-' + num + '" value="'+ num +'"/>');
                    var newDiv  = $('<div id="inputs' + num + '"></div>');

                    newDiv.append(newInp);

                    $('#inputs').append(newDiv);
                    newInp.autocomplete({
                        source: "/adnames.php",
                        dataType: "json",
                        minLength: 2,
                        select: function(event, ui) {
                            $('#Name_id').val(ui.item.id);
                        }
                    });
                });
                $('#button_remove').click(function(b){
                    document.getElementById('inputs').removeChild(document.getElementById('inputs').getElementsByTagName('div')[document.getElementById('inputs').getElementsByTagName('div').length-1])
                });
            // Календарь
            $('#IncidentExpDate').datepicker();
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
                    dateFormat: 'dd.mm.yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['ru']);
            });
</script>
