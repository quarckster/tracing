<div class="calls form">
<?php echo $this->Form->create('Call');?>
	<fieldset>
		<legend>Зарегистрировать обращение</legend>
	<?php
//		echo $this->Form->input('open_date', array('label' => 'Дата регистрации'));
		echo $this->Form->input('Call.user_sid', array( 'label' => 'Ваше имя' ));
		echo $this->Form->input('Call.organization', array('label' => 'Организация'));
		echo $this->Form->input('Call.number_to', array('label' => 'Номер ТО'));
		echo $this->Form->input('Call.contact_data', array('label' => 'Контактные данные', 'rows' => '2'));
		echo $this->Form->input('Call.category', array('label' => 'Категория звонка', 'div' => false, 'options' => array('ЗД' => 'Заказ документов', 'Сбой' => 'Сбой', 'Инф.' => 'Информационный', 'Демо' => 'Демоверсия', 'КФВ' => 'Консультации по формализованным вопросам')));
		echo $this->Form->input('Call.delivery', array('label' => 'Способ обращения', 'div' => false, 'options' => array('Звонок' => 'Звонок', 'Сайт' => 'Сайт', 'Email' => 'Email', 'СИО' => 'СИО', 'Визит' => 'Визит')));
		echo $this->Form->input('Call.content', array('label' => 'Содержание', 'rows' => '2'));
		echo $this->Form->input('Call.control', array('label' => 'На контроль', 'type' => 'checkbox'));
		echo $this->Form->input('Call.notified', array('label' => 'Уведомить о звонке'));
		echo $this->Html->tag('label', 'Участники звонка');
		echo $this->Html->link('Добавить', 'javascript:', array('id' => 'button_add'));
		echo "&nbsp;";
		echo $this->Html->link('Удалить', 'javascript:', array('id' => 'button_remove'));
		echo "<div id=\"inputs\"><input id=\"CallsDetailUserSid-0\" type=\"hidden\"><input type=\"hidden\"></div>";
//		echo $this->Form->input('CallsDetail.0.user_sid', array('label' => 'Передать звонок'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Сохранить', true));?>
</div>
<div class="actions">
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Письма', true), array('controller' => 'incidents', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('action' => 'index')); ?></li>
	</ul>
	<h3>Категории</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Заказ документов', true), array('action' => 'find', 'category' => 'ЗД')); ?></li>
		
		<li><?php echo $this->Html->link(__('Сбой', true), array('action' => 'find', 'category' => 'Сбой')); ?></li>
		<li><?php echo $this->Html->link(__('Информационные', true), array('action' => 'find', 'category' => 'Инф.')); ?></li>
		<!--<li><?php echo $this->Html->link(__('Заказ по email', true), array('action' => 'find', 'category' => 'ЗЭП')); ?></li>
		<li><?php echo $this->Html->link(__('Рекомендации СИО', true), array('action' => 'find', 'category' => 'РС')); ?></li>
		<li><?php echo $this->Html->link(__('Угроза отключения', true), array('action' => 'find', 'category' => 'УО')); ?></li>-->
		<li><?php echo $this->Html->link(__('Демоверсии', true), array('action' => 'find', 'category' => 'Демо')); ?></li>
		<li><?php echo $this->Html->link(__('Консультации по ФВ', true), array('action' => 'find', 'category' => 'КФВ')); ?></li>
		<li><?php echo $this->Html->link(__('На контроле', true), array('action' => 'find', 'control' => '1')); ?></li>	
		<li><hr size="0" /></li>
		<li><?php echo $this->Html->link(__('Поиск', true), array('action' => 'find')); ?></li>
	</ul>
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
                $("textarea#CallContactData").autocomplete({
                    source: "/orgautocomplete.php",
                    minLength: 2
                });
		$('#button_add').click(function(a){
                    var num = $("input[id*='CallsDetailUserSid-']").length;
                    var newInp = $('<br><input name="data[CallsDetail][' + num + '][user_sid]" style="width: 99%" type="text" id="CallsDetailUserSid-' + num + '"/>&nbsp;<input name="data[CallsDetail][' + num + '][order]" type="hidden" id="CallsDetailNotifyOnly-' + num + '" value="'+ num +'"/>');
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
</script>
