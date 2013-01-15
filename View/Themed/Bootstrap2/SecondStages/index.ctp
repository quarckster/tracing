<h2>Второй этап</h2>
<?php echo $this->element('pagination'); ?>
<table class="table table-striped table-bordered table-condensed">
	<col width="auto" />
	<col width="auto" />
	<col width="auto" />
	<col width="auto" />
	<col width="auto" />
	<col width="auto" />
	<col width="auto" />
	<col width="auto" />
	<col width="auto" />
	<col width="120" />
	<thead>
		<tr>
				<th>Номер заказа</th>
				<th>Заказ в</th>
				<th>Организация</th>
				<th>Контактные данные</th>
				<th>Дата обращения</th>
				<th>Дата отправки заявки</th>
				<th>Дата поступления ответа</th>
				<th>Дата отправки ответа</th>
				<th>Способ передачи</th>
				<th></th>
		</tr>
	</thead>
	<?php foreach ($secondStages as $secondStage): ?>
	<tr>
		<td><?php echo h($secondStage['SecondStage']['order_number']); ?>&nbsp;</td>
		<td><?php echo h($secondStage['SecondStage']['order_in']); ?>&nbsp;</td>
		<td><?php echo h($secondStage['Call']['organization']); ?>&nbsp;</td>
		<td><?php echo h($secondStage['Call']['contact_data']); ?>&nbsp;</td>
		<td><?php echo h($secondStage['Call']['open_date']); ?>&nbsp;</td>
		<td><?php echo h($secondStage['SecondStage']['date']); ?>&nbsp;</td>
		<td><?php echo h($secondStage['Result']['answer_date']); ?>&nbsp;</td>
		<td><?php echo h($secondStage['Result']['send_date']); ?>&nbsp;</td>
		<td><?php echo h($secondStage['Result']['delivery']); ?>&nbsp;</td>
		<td><div class="btn-group"><?php
			echo $this->Html->link('<i class="icon-file"> </i>', array('action' => 'view', $secondStage['SecondStage']['id']), array('class' => 'btn', 'escape' => false)); 
			echo $this->Html->link('<i class="icon-edit"> </i>', array('action' => 'edit', $secondStage['SecondStage']['id']), array('class' => 'btn', 'escape' => false));
			echo $this->Html->link('<i class="icon-remove"> </i>', array('action' => 'delete', $secondStage['SecondStage']['id']), array('class' => 'btn', 'escape' => false, 'Вы уверены, что хотите удалить это входящее?'));?>
		</div></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php echo $this->element('pagination'); ?>