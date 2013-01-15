<div class="row">
	<div class="span4">
		<h2>Обращение</h2>
	</div>
	<div class="offset2 span6">
		<div class="btn-group pull-right"><?php 
					if (!$call['Call']['close_date']) {
						echo $this->Html->link('Закрыть', array('action' => 'change_state', $call['Call']['id']), array('class' => 'btn'));
					} else {
						echo $this->Html->link('Открыть снова', array('action' => 'change_state', $call['Call']['id']), array('class' => 'btn'));
					}
					echo $this->Html->link('<i class="icon-edit"> </i> Редактировать', array('action' => 'edit', $call['Call']['id']), array('class' => 'btn', 'escape' => false));
					echo $this->Html->link('<i class="icon-list-alt"> </i> Ревизии', array('action' => 'history', $call['Call']['id']), array('class' => 'btn', 'escape' => false));?>
		</div>
	</div>
</div>
<dl>
	<div class="row">
		<div class="span2">
			<dt>Зарегистрировала</dt>
			<dd>
				<?php echo $call['Call']['user_sid']; ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Дата регистрации</dt>
			<dd>
				<?php echo $call['Call']['open_date']; ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Дата закрытия</dt>
			<dd>
				<?php if ($call['Call']['close_date']) echo $call['Call']['close_date']; ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Номер ТО</dt>
			<dd>
				<?php if ($call['Call']['number_to'] == 0) {echo null;} else {echo $call['Call']['number_to'];} ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Категория</dt>
			<dd>
				<?php echo $call['Call']['category']; ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Способ обращения</dt>
			<dd>
				<?php echo $call['Call']['delivery']; ?>
			</dd>
		</div>
	</div>
	<div class="row">
	&nbsp;
	</div>
	<div class="row">
		<div class="span12">
			<dt>Организация</dt>
			<dd>
				<?php echo $call['Call']['organization']; ?>
			</dd>
		</div>
	</div>
	<div class="row">
		&nbsp;
	</div>
	<div class="row">
		<div class="span12">
			<dt>Контактные данные</dt>
			<dd>
				<?php echo $call['Call']['contact_data']; ?>
			</dd>
		</div>
	</div>
	<div class="row">
		&nbsp;
	</div>
	<div class="row">
		<div class="span12">
			<dt>Содержание</dt>
			<dd>
				<?php echo $call['Call']['content']; ?>
			</dd>
		</div>
	</div>
	<div class="row">
		&nbsp;
	</div>
	<div class="row">
		<div class="span12">
			<dt>Предпринятые действия</dt>
			<dd>
				<?php echo $call['Call']['actions']; ?>
			</dd>
		</div>
	</div>
	<?php if (!empty($call['Call']['notified'])): ?>
	<div class="row">
		&nbsp;
	</div>
	<div class="row">
		<div class="span10">
			<dt>Уведомлены</dt>
			<dd>
				<?php echo $call['Call']['notified']; ?>
			</dd>
		</div>
	</div>
	<?php endif; ?>
</dl>
<?php if (!empty($call['CallsDetail'])):?>
<div>
	<h3>Комментарии</h3>
	<table class="table table-striped table-bordered table-condensed">
		<col width="70" />
		<col width="200" />
		<col width="auto" />
		<col width="150" />
		<col width="120" />
		<thead>
			<tr>
				<th>№ п/п</th>
				<th>Имя</th>
				<th>Комментарий</th>
				<th>Дата</th>
				<th>Действия</th>
			</tr>
		</thead>
		<?php foreach ($call['CallsDetail'] as $calls_detail): ?>
		<tr>
			<td><?php echo $calls_detail['order'];?></td>
			<td><?php echo $calls_detail['user_sid'];?></td>
			<td><?php echo $calls_detail['comment'];?></td>
			<td><?php echo $calls_detail['date'];?></td>
			<td><?php echo $this->Html->link('<i class="icon-edit"> </i>Редактировать', array('controller' => 'calls', 'action' => 'edit_comment', 'calls_detail_id' => $calls_detail['id'], 'call_id' => $call['Call']['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
<?php endif; ?>
<?php if (empty($call['SecondStage']['id']) && ($call['Call']['category'] == 'ЗД' || $call['Call']['category'] == 'КФВ')): ?>
	<hr>
	<?php echo $this->Html->link('Перейти ко второму этапу', array('controller' => 'second_stages', 'action' => 'add', 'call_id' => $call['Call']['id']), array('class' => 'btn btn-primary btn-large'));?>
<?php elseif(!empty($call['SecondStage']['id']) && ($call['Call']['category'] == 'ЗД' || $call['Call']['category'] == 'КФВ')): ?>
	<hr>
	<div>
		<div class="row">
			<div class="span4">
				<h2>Второй этап</h2>
			</div>
			<div class="offset2 span6">
				<div class="btn-group pull-right"><?php 
							echo $this->Html->link('<i class="icon-file"> </i> Посмотреть', array('controller' => 'second_stages', 'action' => 'view', $call['SecondStage']['id']), array('class' => 'btn', 'escape' => false));
							echo $this->Html->link('<i class="icon-edit"> </i> Редактировать', array('controller' => 'second_stages', 'action' => 'edit', $call['SecondStage']['id']), array('class' => 'btn', 'escape' => false));?>
				</div>
			</div>
		</div>
		<dl>
			<div class="row">
				<div class="span2">
					<dt>Номер заказа</dt>
					<dd>
						<?php echo $call['SecondStage']['order_number']; ?>
					</dd>
				</div>
				<div class="span2">
					<dt>Дата заказа</dt>
					<dd>
						<?php echo $call['SecondStage']['date']; ?>
					</dd>
				</div>
				<div class="span2">
					<dt>Запрос отправлен в</dt>
					<dd>
						<?php echo $call['SecondStage']['order_in']; ?>
					</dd>
				</div>
				<div class="span3">
					<dt>Способ заказа</dt>
					<dd>
						<?php echo $call['SecondStage']['order_way']; ?>
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
						<?php echo $call['SecondStage']['additional_info']; ?>
					</dd>
				</div>
				<div class="span6">
					<dt>Примечания</dt>
					<dd>
						<?php echo $call['SecondStage']['note']; ?>
					</dd>
				</div>
			</div>
		</dl>
	</div>
	<?php if (!empty($call['SecondStage']['PreliminaryResponse'])):?>
		<div>
			<h4>Предварительные ответы</h4>
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
			<?php foreach ($call['SecondStage']['PreliminaryResponse'] as $preliminary_responses): ?>
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
	<?php if (!empty($call['SecondStage']['Result'])):?>
		<div>
			<h4>Результат</h4>
			<dl>
				<div class="row">
					<div class="span2">
						<dt>Источник ответа</dt>
						<dd>
							<?php echo $call['SecondStage']['Result']['answer_source']; ?>
						</dd>
					</div>
					<div class="span2">
						<dt>Дата ответа</dt>
						<dd>
							<?php echo $call['SecondStage']['Result']['answer_date']; ?>
						</dd>
					</div>
					<div class="span2">
						<dt>Дата отправки</dt>
						<dd>
							<?php echo $call['SecondStage']['Result']['send_date']; ?>
						</dd>
					</div>
					<div class="span2">
						<dt>Способ передачи</dt>
						<dd>
							<?php echo $call['SecondStage']['Result']['delivery']; ?>
						</dd>
					</div>
				</div>
				<div class="row">
				&nbsp;
				</div>
				<div class="row">
					<div class="span8">
						<dt>Ответ</dt>
						<dd>
							<?php echo $call['SecondStage']['Result']['answer']; ?>
						</dd>
					</div>
					<div class="span4">
						<dt>Примечания</dt>
						<dd>
							<?php echo $call['SecondStage']['Result']['note']; ?>
						</dd>
					</div>
				</div>
			</dl>
		</div>
	<?php endif; ?>
	<?php if (empty($call['SecondStage']['Result'])):?>
		<div class="row">
			<?php echo $this->Html->link('Добавить предварительный ответ', array('controller' => 'preliminary_responses', 'action' => 'add', 'second_stage_id' => $call['SecondStage']['id']), array('class' => 'btn btn-primary btn-large span4'));
			echo $this->Html->link('Добавить результат', array('controller' => 'results', 'action' => 'add', 'second_stage_id' => $call['SecondStage']['id']), array('class' => 'btn btn-primary btn-large span3')); ?>
		</div>
	<?php endif; ?>
<?php endif; ?>