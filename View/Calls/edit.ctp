<div class="calls form">
<?php echo $this->Form->create('Call');?>
	<fieldset>
		<legend><?php __('Редактировать данные о звонке'); ?></legend>
	<?php
		if ($close_date) echo "Закрыт $close_date";
		echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->data['Call']['id']));
		echo $this->Form->input('organization', array('label' => 'Организация'));
		echo $this->Form->input('number_to', array('label' => 'Номер ТО'));
		echo $this->Form->input('contact_data', array('label' => 'Контактные данные'));
		echo $this->Form->input('category', array('label' => 'Категория звонка', 'div' => false, 'options' => array('ЗД' => 'Заказ документов', 'Сбой' => 'Сбой', 'Инф.' => 'Информационный', 'Демо' => 'Демоверсия', 'УО' => 'Угроза отключения', 'РС' => 'Рекомендация СИО', 'КФВ' => 'Консультации по формализованным вопросам')));
		echo $this->Form->input('delivery', array('label' => 'Способ обращения', 'div' => false, 'options' => array('Сайт' => 'Сайт', 'Звонок' => 'Звонок', 'Email' => 'Email', 'СИО' => 'СИО', 'Визит' => 'Визит')));
		echo $this->Form->input('content', array('label' => 'Содержание'));
		echo $this->Form->input('actions', array('label' => 'Предпринятые действия'));
		echo $this->Form->input('cis_template', array('label' => 'Шаблон в КИС', 'type' => 'checkbox'));
		echo $this->Form->input('control', array('label' => 'На контроль', 'type' => 'checkbox'));
		if (!empty($this->data['Call']['notified'])) {
			echo $this->Html->tag('label', 'Уведомлены: ' . $this->data['Call']['notified']);
		}
		echo $this->Form->input('notified', array('label' => 'Уведомить'));
		echo $this->Html->tag('label', 'Участники звонка');
		echo $this->Html->link('Добавить', 'javascript:', array('id' => 'button_add'));
		echo "&nbsp;";
		echo $this->Html->link('Удалить', 'javascript:', array('id' => 'button_remove'));
		echo "<div id=\"inputs\"><input id=\"CallsDetailUserSid-0\" type=\"hidden\"><input type=\"hidden\"></div>";

	?>
	<?php if(!empty($this->data['CallsDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
		<col width="70" />
		<col width="auto" />
		<col width="90" />
	<tr>
		<th>№ п/п</th>
		<th>Имя</th>
		<th>&nbsp;</th>
	</tr>
	<?php	
		$i=0;
		foreach ($this->data['CallsDetail'] as $calls_detail):
			$CallsDetailUserSid = "CallsDetailUserSid-{$i}";
	?>
	<tr <?php echo "id=\"duplicate{$i}\""; ?>>
		<?php
			if (empty($calls_detail['comment']) && $calls_detail['notify_only'] != 1) {
				echo $this->Form->input('CallsDetail.'. $i .'.id', array('type' => 'hidden', 'value' => $calls_detail['id']));
		?>

				<td><?php echo $calls_detail['order']; ?></td>
				<td><?php echo $this->Form->input('CallsDetail.'. $i .'.user_sid', array('label' => false, 'value' => $calls_detail['user_sid'], 'id' => $CallsDetailUserSid)); ?></td>
				<td><?php echo $this->Html->link($this->Html->image("b_drop.png", array("alt" => "Удалить")), array('controller' => 'calls_details', 'action' => 'delete', $calls_detail['id']), array('escape' => false), 'Вы уверены, что хотите удалить это?');
						//$this->Html->link(__('Удалить', true), array('controller' => 'calls_details', 'action' => 'delete', $calls_detail['id']), null, sprintf(__('Вы уверены, что хотите участника %s?', true), $calls_detail['user_sid']));
					echo "&#09;";
					echo $this->Html->image("down-arrow.jpg", array("alt" => "Добавить после", 'url' => array('controller' => 'calls_details', 'action' => 'add', $calls_detail['id'], 'after')));
					echo "&#09;";
					echo $this->Html->image("up-arrow.jpg", array("alt" => "Просмотр", 'url' => array('controller' => 'calls_details', 'action' => 'add', $calls_detail['id'], 'before')));
					//echo $this->Html->link(__('↓', true), array('controller' => 'calls_details', 'action' => 'add', $calls_detail['id'], 'after'));
					//echo $this->Html->link(__('↑', true), array('controller' => 'calls_details', 'action' => 'add', $calls_detail['id'], 'before'));
				?></td>

	</tr>
	<?php  
			} else {
	?>
				<td><?php echo $calls_detail['order']; ?></td>
				<td><?php echo $calls_detail['user_sid']; ?></td>
				<td>&nbsp;</td>
		
	<?php		}
		$i++;
		endforeach;
	?>
</table>
<?php endif;?>
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
	<h3>Действия</h3>
	<ul>

		<li><?php echo $this->Html->link(__('Удалить', true), array('action' => 'delete', $this->Form->value('Call.id')), null, sprintf(__('Вы уверены, что хотите удалить этот звонок?', true), $this->Form->value('Call.id'))); ?></li>
		<li><?php 
				if (!$close_date) {
					echo $this->Html->link(__('Закрыть', true), array('action' => 'change_state', $this->Form->value('Call.id')));
				} else {
					echo $this->Html->link(__('Открыть', true), array('action' => 'change_state', $this->Form->value('Call.id')));
				}
		 ?></li>
<!--		<li><?php echo $this->Html->link(__('List Calls', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Details', true), array('controller' => 'calls_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New CallsDetail', true), array('controller' => 'calls_details', 'action' => 'add')); ?> </li>
-->
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
                // Автозаполнение
                $("input#CallsDetailUserSid").autocomplete({
			source: "/adnames.php",
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

