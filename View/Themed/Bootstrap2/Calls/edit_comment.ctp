<div class="row">
	<div class="span4">
		<h2>Обращение</h2>
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
				<?php echo $call['Call']['number_to']; ?>
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
<div class="related">
	<h3>Комментарии</h3>
	<?php if (!empty($call['CallsDetail'])):?>
	<table class="table table-striped table-bordered table-condensed">
		<col width="50" />
		<col width="200" />
		<col width="auto" />
		<col width="130" />
		<col width="100" />
	<tr>
		<thead>
			<th>№ п/п</th>
			<th>Имя</th>
			<th>Комментарий</th>
			<th>Дата</th>
			<th class="actions">&nbsp;</th>
		</thead>
	</tr>
	<?php
		echo $this->Form->create('Call');
		$i = 0;
		foreach ($call['CallsDetail'] as $calls_detail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $calls_detail['order'];?></td>
			<td><?php echo $calls_detail['user_sid'];?></td>
			<td><?php if ($calls_detail['id'] == $calls_detail_id) {
					echo $this->Form->input('CallsDetail.comment', array('value' => $calls_detail['comment'], 'class' => 'input-block-level', 'label' => false));
					echo $this->Form->input('CallsDetail.id', array('type' => 'hidden', 'value' => $calls_detail_id, 'label' => false));
					echo $this->Form->input('CallsDetail.call_id', array('type' => 'hidden', 'value' => $call['Call']['id'], 'label' => false));
					echo $this->Form->input('CallsDetail.order', array('type' => 'hidden', 'value' => $calls_detail['order'], 'label' => false));
					echo $this->Form->input('CallsDetail.user_sid', array('type' => 'hidden', 'value' => $calls_detail['user_sid'], 'label' => false));
					if (empty($calls_detail['comment'])) {
						echo $this->Form->input('CallsDetail.user_sid_next', array('label' => 'Передать звонок', 'class' => 'input-block-level'));
					}
				  } else {
					echo $calls_detail['comment'];
				  }?><td><?php if (!empty($calls_detail['comment_date'])) {
					echo $calls_detail['comment_date'];
				   }?></td>
			<td class="actions">
			<?php if ($calls_detail['id'] == $calls_detail_id) echo $this->Form->end(array('class' => 'btn btn-primary', 'label' => 'Сохранить')); ?>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>
<script language="javascript" type="text/javascript">
	$("#CallsDetailComment").focus();
	// Динамическое добавление input'ов и их автозаполнение
	$("input#CallsDetailUserSidNext").autocomplete({
		source: "/adnames.php",
		minLength: 2
	});
</script>
