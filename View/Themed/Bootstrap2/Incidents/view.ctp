<div>
	<div class="row">
		<div class="span4 offset2">
			<h2>Входящее <?php echo $incident['Incident']['incoming_num']; ?></h2>
		</div>
		<div class="span4">
			<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-edit"> </i> Редактировать', array('action' => 'edit', $incident['Incident']['id']), array('class' => 'btn', 'escape' => false));
			 	  echo $this->Html->link('<i class="icon-list-alt"> </i> Ревизии', array('action' => 'history', $incident['Incident']['id']), array('class' => 'btn', 'escape' => false));?>
			</div>
		</div>
	</div>
	<dl>
		<div class="row">
			<div class="span2 offset2">
				<dt>Дата регистрации</dt>
				<dd>
					<?php echo $incident['Incident']['start_date']; ?>
				</dd>
			</div>
			<div class="span2">
				<dt>Дата выполнения</dt>
				<dd>
					<?php echo $incident['Incident']['exp_date']; ?>
				</dd>
			</div>
			<?php if (!empty($incident['Incident']['number_to'])):?>
			<div class="span1">
				<dt>Номер ТО</dt>
				<dd>
					<?php echo $incident['Incident']['number_to']; ?>
				</dd>
			</div>
			<?php endif;?>
			<div class="span3">
				<dt>Содержание</dt>
				<dd>
					<?php echo $incident['Incident']['content']; ?>
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
					<?php echo $incident['Incident']['organization']; ?>
				</dd>
			</div>
		</div>
		<div class="row">
			&nbsp;
		</div>
		<div class="row">
			<?php
			$notified = array();
			$i = 0;
			foreach ($incident['Detail'] as $detail0):
				if ($detail0['notify_only'] == 1) {
					$notified[] = $detail0['user_sid'];
				} else {
					$i++;
				}
			endforeach;
			if (!empty($notified)):?>
			<div class="span8 offset2">
				<dt>Уведомлены</dt>
				<dd>
					<?php echo implode(", ", $notified); ?>
				</dd>
			</div>
			<?php endif; ?>
		</div>
	</dl>
</div>
<?php if ($i != 0):?>
<div class="row">
	<div class="span8 offset2">
		<h3>Комментарии</h3>
		<table class="table table-striped table-bordered table-condensed">
			<thead>
				<tr>
					<th class="span1">№ п/п</th>
					<th class="span3">Имя</th>
					<th class="span6">Комментарий</th>
					<th class="span2">Дата</th>
				</tr>
			</thead>
		<?php
			foreach ($incident['Detail'] as $detail):
				if (!empty($detail['comment'])) {
					echo"
					<tr>
						<td>{$detail['comment_id']}</td>
						<td>{$detail['user_sid']}</td>
						<td>{$detail['comment']}</td>
						<td>{$detail['comment_date']}</td>
					</tr>";
				}
				if ($detail['comment_id'] == $min_comment_id && $detail['notify_only'] != 1) {
					echo"
					<tr>
						<td>{$detail['comment_id']}</td>
						<td>{$detail['user_sid']}</td>
						<td>{$this->Html->link('Оставить комментарий', array('controller' => 'incidents', 'action' => 'edit_comment', 'incident_id' => $detail['incident_id'], 'detail_id' => $detail['id']), array('class' => 'btn btn-mini'))}</td>
						<td>{$detail['comment_date']}</td>

					</tr>";
				}
				if (empty($detail['comment']) && $detail['comment_id'] != $min_comment_id && $detail['notify_only'] != 1) {
					echo"
					<tr>
						<td>{$detail['comment_id']}</td>
						<td>{$detail['user_sid']}</td>
						<td>{$detail['comment']}</td>
						<td>{$detail['comment_date']}</td>
					</tr>";
				}
				endforeach; ?>
			</tr>
		</table>
	</div>
</div>
<?php endif; ?>