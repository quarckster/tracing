<div class="row">
	<div class="span2 offset2">
		<h2>Обращение</h2>
	</div>
	<div class="offset4 span2">
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
		<div class="span2 offset2">
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
		<?php if ($call['Call']['number_to'] != 0):?>
		<div class="span2">
			<dt>Номер ТО</dt>
			<dd>
				<?php echo $call['Call']['number_to']; ?>
			</dd>
		</div>
		<?php endif;?>
	</div>
	<div class="row">
	&nbsp;
	</div>
	<div class="row">
		<div class="span2 offset2">
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
		<div class="span8 offset2">
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
		<div class="span8 offset2">
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
		<div class="span8 offset2 linkify">
			<dt>Содержание</dt>
			<dd>
				<?php echo nl2br($call['Call']['content']); ?>
			</dd>
		</div>
	</div>
	<div class="row">
		&nbsp;
	</div>
	<div class="row">
		<div class="span8 offset2">
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
		<div class="span8 offset2">
			<dt>Уведомлены</dt>
			<dd>
				<?php echo $call['Call']['notified']; ?>
			</dd>
		</div>
	</div>
	<?php endif; ?>
</dl>
<?php if (!empty($call['CallsDetail'])):?>
<div class="row">
	<h3 class="span4 offset2">Комментарии</h3>
	<table class="span8 offset2 table table-striped table-bordered table-condensed">
		<col width="60" />
		<col width="150" />
		<col width="auto" />
		<col width="120" />
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
<?php if (empty($call['SecondStage']) && ($call['Call']['category'] == 'ЗД' || $call['Call']['category'] == 'КФВ')): ?>
	<div class="row">
		<div class="span8 offset2"><hr></div>
		<?php echo $this->Html->link('Перейти ко второму этапу', array('controller' => 'second_stages', 'action' => 'add', 'call_id' => $call['Call']['id']), array('class' => 'btn btn-primary btn-medium offset2'));?>
	</div>
<?php elseif(!empty($call['SecondStage']) && ($call['Call']['category'] == 'ЗД' || $call['Call']['category'] == 'КФВ')): ?>
	<div class="row"><h2 class="offset2">Второй этап</h2></div>
	<?php $i = 1;?>
	<?php foreach ($call['SecondStage'] as $second_stage): ?>
	<div class="row">
		<?php echo $this->Html->link('От '.$second_stage['date'], '#toggle'.$i, array('data-toggle' => 'collapse', 'data-target' => '#toggle-'.$i, 'class' => 'lead span6 offset2'));?>
		<div class="span2">
			<div class="btn-group pull-right"><?php 
						echo $this->Html->link('<i class="icon-file"> </i> Перейти', array('controller' => 'second_stages', 'action' => 'view', $second_stage['id']), array('class' => 'btn', 'escape' => false));
						echo $this->Html->link('<i class="icon-edit"> </i> Редактировать', array('controller' => 'second_stages', 'action' => 'edit', $second_stage['id']), array('class' => 'btn', 'escape' => false));?>
			</div>
		</div>
	</div>
	<div id="<?php echo 'toggle-'.$i;?>" class="collapse">
		<dl>
			<div class="row">
				<div class="span2 offset2">
					<dt>Номер заказа</dt>
					<dd>
						<?php echo $second_stage['order_number']; ?>
					</dd>
				</div>
				<div class="span2">
					<dt>Дата заказа</dt>
					<dd>
						<?php echo $second_stage['date']; ?>
					</dd>
				</div>
				<div class="span2">
					<dt>Запрос отправлен в</dt>
					<dd>
						<?php echo $second_stage['order_in']; ?>
					</dd>
				</div>
			</div>
			<div class="row">
			&nbsp;
			</div>
			<div class="row">
				<div class="span2 offset2">
					<dt>Способ заказа</dt>
					<dd>
						<?php echo $second_stage['order_way']; ?>
					</dd>
				</div>
				<div class="span2">
					<dt>Категория</dt>
					<dd>
						<?php echo $second_stage['category']; ?>
					</dd>
				</div>
			</div>
			<div class="row">
			&nbsp;
			</div>
			<div class="row">
				<div class="span8 offset2 linkify">
					<dt>Доп. информация и иные особенности заказа</dt>
					<dd>
						<?php echo nl2br($second_stage['additional_info']); ?>
					</dd>
				</div>
			</div>
			<div class="row">
			&nbsp;
			</div>
			<div class="row">
				<div class="span8 offset2">
					<dt>Примечания</dt>
					<dd>
						<?php echo $second_stage['note']; ?>
					</dd>
				</div>
			</div>
		</dl>
		<?php if (!empty($second_stage['PreliminaryResponse'])):?>
			<div class="row">
				<h4 class="offset2">Предварительные ответы</h4>
				<table class="span8 offset2 table table-striped table-bordered table-condensed">
					<col width="100"/>
					<col width="110"/>
					<col width="130"/>
					<col width="auto"/>
					<col width="40" />
					<thead>
						<tr>
							<th>Дата ответа</th>
							<th>Дата отправки</th>
							<th>Способ передачи</th>
							<th>Ответ</th>
							<th>КИС</th>
						</tr>
					</thead>
				<?php foreach ($second_stage['PreliminaryResponse'] as $preliminary_responses): ?>
				<tr>
					<td><?php echo $preliminary_responses['answer_date']; ?></td>
					<td><?php echo $preliminary_responses['send_date']; ?></td>
					<td><?php echo $preliminary_responses['delivery']; ?></td>
					<td class="linkify"><?php echo $preliminary_responses['answer']; ?></td>
					<td><?php if ($preliminary_responses['cis'] == 1) {
						echo '<i class="icon-ok aligncenter"> </i>';
					} else {
						echo '&nbsp;';
					} ?></td>
				</tr>
				<?php endforeach;?>
			</table>
			</div>
		<?php endif; ?>
		<?php if (!empty($second_stage['Result'])):?>
			<div class="row">
				<h4 class="offset2">Результат</h4>
			</div>
			<dl>
				<div class="row">
					<div class="span2 offset2">
						<dt>Источник ответа</dt>
						<dd>
							<?php echo $second_stage['Result']['answer_source']; ?>
						</dd>
					</div>
					<div class="span2">
						<dt>Дата ответа</dt>
						<dd>
							<?php echo $second_stage['Result']['answer_date']; ?>
						</dd>
					</div>
					<div class="span2">
						<dt>Дата отправки</dt>
						<dd>
							<?php echo $second_stage['Result']['send_date']; ?>
						</dd>
					</div>
					<div class="span2">
						<dt>Способ передачи</dt>
						<dd>
							<?php echo $second_stage['Result']['delivery']; ?>
						</dd>
					</div>
				</div>
				<div class="row">
				&nbsp;
				</div>
				<div class="row">
					<div class="span8 offset2 linkify">
						<dt>Ответ</dt>
						<dd>
							<?php echo nl2br($second_stage['Result']['answer']); ?>
						</dd>
					</div>
				</div>
				<div class="row">
				&nbsp;
				</div>				
				<div class="row">
					<?php if (!empty($second_stage['Result']['note'])):?>
						<div class="span8 offset2">
								<dt>Примечания</dt>
								<dd>
									<?php echo $second_stage['Result']['note']; ?>
								</dd>
						</div>
					<?php endif; ?>
					<div class="span2 offset2">
						<?php if ($second_stage['Result']['cis'] == 1):?>
						<dt>Есть шаблон в КИС</dt>
						<?php elseif ($second_stage['Result']['cis'] == 2):?>
						<dt>Шаблон в КИС не нужен</dt>
						<?php endif;?>
					</div>
				</div>
			</dl>
		<?php endif;?>
 		<?php if (!empty($second_stage['Result']) && $i < $count_second_stages):?>
			</div>
		<?php elseif (empty($second_stage['Result']) && $i == $count_second_stages):?>
				<div class="row">
					<?php echo $this->Html->link('Добавить предварительный ответ', array('controller' => 'preliminary_responses', 'action' => 'add', 'second_stage_id' => $second_stage['id']), array('class' => 'btn btn-primary btn-medium span3 offset2'));
					echo $this->Html->link('Добавить результат', array('controller' => 'results', 'action' => 'add', 'second_stage_id' => $second_stage['id']), array('class' => 'btn btn-primary btn-medium span2')); ?>
				</div>
			</div>
		<?php elseif (!empty($second_stage['Result']) && $i == $count_second_stages):?>
			</div>
			<div class="row">
				<?php echo $this->Html->link('Отправить повторный запрос', array('controller' => 'second_stages', 'action' => 'add', 'call_id' => $call['Call']['id']), array('class' => 'btn btn-primary btn-medium offset2'));?>
			</div>
		<?php endif;?>
	<?php $i++;?>
	<?php endforeach; ?>
<?php endif; ?>
<script>
$(document).ready(function(){
	function replaceURLWithHTMLLinks(text) {
		var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
		return text.replace(exp,"<a href='$1' target='_blank'>$1</a>"); 
	}
	$(".linkify").each(function(i){
		var text = $(this).html();
		$(this).html(replaceURLWithHTMLLinks(text));
	});
});
</script>