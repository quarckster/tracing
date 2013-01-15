<div class="row">
	<div class="span4">
		<h2>Второй этап</h2>
	</div>
	<div class="offset2 span6">
		<div class="btn-group pull-right"><?php 
					echo $this->Html->link('<i class="icon-edit"> </i> Редактировать', array('action' => 'edit', $secondStage['SecondStage']['id']), array('class' => 'btn', 'escape' => false));
					echo $this->Html->link('<i class="icon-list-alt"> </i> Перейти к обращению', array('controller' => 'calls', 'action' => 'view', $secondStage['SecondStage']['call_id']), array('class' => 'btn', 'escape' => false));?>
		</div>
	</div>
</div>
<dl>
	<div class="row">
		<div class="span2">
			<dt>Номер заказа</dt>
			<dd>
				<?php echo $secondStage['SecondStage']['order_number']; ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Дата заказа</dt>
			<dd>
				<?php echo $secondStage['SecondStage']['date']; ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Запрос отправлен в</dt>
			<dd>
				<?php echo $secondStage['SecondStage']['order_in']; ?>
			</dd>
		</div>
		<div class="span3">
			<dt>Способ заказа</dt>
			<dd>
				<?php echo $secondStage['SecondStage']['order_way']; ?>
			</dd>
		</div>
	</div>
	<div class="row">
	&nbsp;
	</div>
	<div class="row">
		<div class="span6">
			<dt>Доп. информация и иные особенности заказа</dt>
			<dd>
				<?php echo $secondStage['SecondStage']['additional_info']; ?>
			</dd>
		</div>
		<div class="span6">
			<dt>Примечания</dt>
			<dd>
				<?php echo $secondStage['SecondStage']['note']; ?>
			</dd>
		</div>
	</div>
</dl>
<?php if (!empty($secondStage['PreliminaryResponse'])):?>
<div>
	<h3>Предварительные ответы</h3>
	<table class="table table-striped table-bordered table-condensed">
		<col width="100"/>
		<col width="110"/>
		<col width="130"/>
		<col width="auto"/>
		<thead>
			<tr>
				<th>Дата ответа</th>
				<th>Дата отправки</th>
				<th>Способ передачи</th>
				<th>Ответ</th>
			</tr>
		</thead>
	<?php foreach ($secondStage['PreliminaryResponse'] as $preliminary_responses): ?>
	<tr>
		<td><?php echo $preliminary_responses['answer_date']; ?></td>
		<td><?php echo $preliminary_responses['send_date']; ?></td>
		<td><?php echo $preliminary_responses['delivery']; ?></td>
		<td><?php echo $preliminary_responses['answer']; ?></td>
	</tr>
	<?php endforeach;?>
</table>
</div>
<?php endif; ?>
<?php if (!empty($secondStage['Result']['id'])):?>
<div>
	<h3>Результат</h3>
	<dl>
		<div class="row">
			<div class="span2">
				<dt>Источник ответа</dt>
				<dd>
					<?php echo $secondStage['Result']['answer_source']; ?>
				</dd>
			</div>
			<div class="span2">
				<dt>Дата ответа</dt>
				<dd>
					<?php echo $secondStage['Result']['answer_date']; ?>
				</dd>
			</div>
			<div class="span2">
				<dt>Дата отправки</dt>
				<dd>
					<?php echo $secondStage['Result']['send_date']; ?>
				</dd>
			</div>
			<div class="span2">
				<dt>Способ передачи</dt>
				<dd>
					<?php echo $secondStage['Result']['delivery']; ?>
				</dd>
			</div>
		</div>
		<div class="row">
		&nbsp;
		</div>
		<div class="row">
			<div class="span6">
				<dt>Ответ</dt>
				<dd>
					<?php echo $secondStage['Result']['answer']; ?>
				</dd>
			</div>
			<div class="span6">
				<dt>Примечания</dt>
				<dd>
					<?php echo $secondStage['Result']['note']; ?>
				</dd>
			</div>
		</div>
	</dl>
</div>
<?php endif; ?>
<?php if (empty($secondStage['Result']['id'])):?>
<div class="row">
	<?php echo $this->Html->link('Добавить предварительный ответ', array('controller' => 'preliminary_responses', 'action' => 'add', 'second_stage_id' => $secondStage['SecondStage']['id']), array('class' => 'btn btn-primary btn-large span4'));
	echo $this->Html->link('Добавить результат', array('controller' => 'results', 'action' => 'add', 'second_stage_id' => $secondStage['SecondStage']['id']), array('class' => 'btn btn-primary btn-large span3')); ?>
</div>
<?php endif; ?>