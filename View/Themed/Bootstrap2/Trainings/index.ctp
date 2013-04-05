<h2>Заявки на обучение</h2>
<?php echo $this->element('pagination'); ?>

	<table class="table table-striped table-bordered table-condensed">
	<col width="55" />
	<col width="95" />
	<col width="90" />
	<col width="auto" />
	<col width="55" />
	<col width="90" />
	<col width="auto" />
	<col width="55" />
	<col width="90" />
	<col width="120" />
	<thead>
		<tr>
			<th>Номер заявки</th>
			<th><a href="#" data-toggle="popover" data-placement="top" data-content="П - поступление заявки; О - обучение проведено; З - завершение; К - дата контроля" title data-original-title="Легенда" id="tooltip1">Даты*</a></th>
			<th>Специалист</th>
			<th>Организация</th>
			<th>Номер ТО</th>
			<th>Город</th>
			<th>Цель обучения</th>
			<th>Оборудование</th>
			<th>Преподаватель</th>
			<th></th>
		</tr>
	</thead>
	<?php
	foreach ($trainings as $training): ?>
	<tr>
		<td><?php echo $training['Training']['id']; ?>&nbsp;</td>
		<td>П:<?php echo $training['Training']['date_receipt']; ?><br>О:<?php echo $training['Training']['date_training']; ?><br>З:<?php echo $training['Training']['date_end']; if(!empty($training['Training']['date_control'])) {echo '<br>К:'.$training['Training']['date_control'];} ?>&nbsp;</td>
		<td><?php echo $training['Training']['user_sid']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['organization']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['number_to']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['town']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['purpose']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['tso']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['mentor_sid']; ?>&nbsp;</td>
		<td><div class="btn-group"><?php
			echo $this->Html->link('<i class="icon-file"> </i>', array('action' => 'view', $training['Training']['id']), array('title' => 'Открыть', 'class' => 'btn', 'escape' => false)); 
			echo $this->Html->link('<i class="icon-edit"> </i>', array('action' => 'edit', $training['Training']['id']), array('title' => 'Редактировать', 'class' => 'btn', 'escape' => false));
			echo $this->Form->postLink('<i class="icon-remove"> </i>', array('action' => 'delete', $training['Training']['id']), array('title' => 'Удалить', 'class' => 'btn', 'escape' => false), 'Вы уверены, что хотите удалить это входящее?');
			//echo $this->Html->link('<i class="icon-remove"> </i>', array('action' => 'delete', $training['Training']['id']), array('class' => 'btn', 'escape' => false, 'Вы уверены, что хотите удалить это входящее?'));?>
		</div></td>
	</tr>
<?php endforeach; ?>
	</table>
<?php echo $this->element('pagination'); ?>
<script>
$('#tooltip1').popover()
</script>