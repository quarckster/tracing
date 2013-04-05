<div class="row">
	<div class="span4 offset2">
		<h2>Второй этап</h2>
	</div>
	<div class="span4">
		<div class="btn-group pull-right"><?php 
					echo $this->Html->link('<i class="icon-edit"> </i> Редактировать', array('action' => 'edit', $secondStage['SecondStage']['id']), array('class' => 'btn', 'escape' => false));
					echo $this->Html->link('<i class="icon-list-alt"> </i> Перейти к обращению', array('controller' => 'calls', 'action' => 'view', $secondStage['SecondStage']['call_id']), array('class' => 'btn', 'escape' => false));?>
		</div>
	</div>
</div>
<dl>
	<div class="row">
		<div class="span2 offset2">
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
	</div>
	<div class="row">
	&nbsp;
	</div>
	<div class="row">
		<div class="span2 offset2">
			<dt>Способ заказа</dt>
			<dd>
				<?php echo $secondStage['SecondStage']['order_way']; ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Категория</dt>
			<dd>
				<?php echo $secondStage['SecondStage']['category']; ?>
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
				<?php echo nl2br($secondStage['SecondStage']['additional_info']); ?>
			</dd>
		</div>
	</div>
	<div class="row">
	&nbsp;
	</div>
	<div class="row">
	<div class="span6 offset2">
		<dt>Примечания</dt>
			<dd>
				<?php echo nl2br($secondStage['SecondStage']['note']); ?>
			</dd>
		</div>
	</div>
</dl>
<?php if (!empty($secondStage['PreliminaryResponse'])):?>
<div class="row">
	<h3 class="span4 offset2">Предварительные ответы</h3>
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
	<?php foreach ($secondStage['PreliminaryResponse'] as $preliminary_responses): ?>
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
<?php if (!empty($secondStage['Result']['id'])):?>
<div class="row">
	<h3 class="span2 offset2">Результат</h3>
</div>
<dl>
	<div class="row">
		<div class="span2 offset2">
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
		<div class="span8 offset2 linkify">
			<dt>Ответ</dt>
			<dd>
				<?php echo nl2br($secondStage['Result']['answer']); ?>
			</dd>
		</div>
	</div>
	<div class="row">
	&nbsp;
	</div>
	<div class="row">
		<?php if (!empty($secondStage['Result']['note'])):?>
		<div class="span8 offset2">
			<dt>Примечания</dt>
			<dd>
				<?php echo $secondStage['Result']['note']; ?>
			</dd>
		</div>
		<?php endif;?>
	</div>
	<div class="row">
	&nbsp;
	</div>
	<div class="row">
		<div class="span2 offset2">
			<?php if ($secondStage['Result']['cis'] == 1):?>
				<dt>Есть шаблон в КИС</dt>
			<?php elseif ($secondStage['Result']['cis'] == 2):?>
				<dt>Шаблон не нужен</dt>
			<?php elseif ($secondStage['Result']['cis'] == 0):?>
				<dt>Без шаблона</dt>
			<?php endif;?>
		</div>
	</div>	
</dl>
<?php endif; ?>
<?php if (empty($secondStage['Result']['id'])):?>
<div class="row">
	<?php echo $this->Html->link('Добавить предварительный ответ', array('controller' => 'preliminary_responses', 'action' => 'add', 'second_stage_id' => $secondStage['SecondStage']['id']), array('class' => 'btn btn-primary btn-medium span3 offset2'));
	echo $this->Html->link('Добавить результат', array('controller' => 'results', 'action' => 'add', 'second_stage_id' => $secondStage['SecondStage']['id']), array('class' => 'btn btn-primary btn-medium span2')); ?>
</div>
<?php else: ?>
<div class="row">
<?php echo $this->Html->link('Отправить повторный запрос', array('controller' => 'second_stages', 'action' => 'add', 'call_id' => $secondStage['SecondStage']['call_id']), array('class' => 'btn btn-primary btn-medium offset2'));?>
</div>
<?php endif; ?>
<script>
$(document).ready(function(){
	function replaceURLWithHTMLLinks(text) {
		var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
		return text.replace(exp,"<a href='$1'>$1</a>"); 
	}
	$(".linkify").each(function(i){
		var text = $(this).html();
		$(this).html(replaceURLWithHTMLLinks(text));
	});
});
</script>