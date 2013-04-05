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
	<?php
	$i = 0;
	foreach ($secondStages as $secondStage): ?>
	<tr>
		<td><?php echo h($secondStage['SecondStage']['order_number']); ?></td>
		<td><?php echo h($secondStage['SecondStage']['order_in']); ?></td>
		<td><?php echo h($secondStage['Call']['organization']); ?></td>
		<td><?php echo h($secondStage['Call']['contact_data']); ?></td>
		<td><?php echo h($secondStage['Call']['open_date']); ?></td>
		<td><?php echo h($secondStage['SecondStage']['date']); ?></td>
		<td><?php echo h($secondStage['Result']['answer_date']); ?></td>
		<td><?php if (empty($secondStage['Result']['answer'])): ?>&nbsp;
			<?php else: ?>
			<?php echo $this->Html->link($secondStage['Result']['send_date'], '#answerModal-'.$i, array('data-toggle' => 'modal')); ?>
			<!-- Modal -->
			<div id="<?php echo 'answerModal-'.$i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Результат" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3>Результат</h3>
				</div>
				<div class="modal-body">
					<p><?php echo nl2br($secondStage['Result']['answer']); ?></p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
				</div>
			</div>
			<?php endif; ?>
		</td>
		<td><?php echo h($secondStage['Result']['delivery']); ?></td>
		<td><div class="btn-group"><?php
			echo $this->Html->link('<i class="icon-file"> </i>', array('action' => 'view', $secondStage['SecondStage']['id']), array('class' => 'btn', 'escape' => false)); 
			echo $this->Html->link('<i class="icon-edit"> </i>', array('action' => 'edit', $secondStage['SecondStage']['id']), array('class' => 'btn', 'escape' => false));
			echo $this->Html->link('<i class="icon-remove"> </i>', array('action' => 'delete', $secondStage['SecondStage']['id']), array('class' => 'btn', 'escape' => false, 'Вы уверены, что хотите удалить это входящее?'));?>
		</div></td>
	</tr>
	<?php 
	$i++;
	endforeach; ?>
</table>
<?php echo $this->element('pagination'); ?>