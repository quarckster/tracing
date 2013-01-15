<div>
<h2>Входящее <?php echo $incident['Incident']['incoming_num']; ?></h2>
	<dl>
		<div class="row">
			<div class="span2">
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
			<div class="span2">
				<dt>Номер ТО</dt>
				<dd>
					<?php echo $incident['Incident']['number_to']; ?>
				</dd>
			</div>
			<div class="span4">
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
			<div class="span12">
				<dt>Организация</dt>
				<dd>
					<?php echo $incident['Incident']['organization']; ?>
				</dd>
			</div>
		</div>
		<div class="row">
			&nbsp;
		</div>
		<?php
		if (isset($incident['Detail'])):
			$notified = array();
			foreach ($incident['Detail'] as $detail0):
				if ($detail0['notify_only'] == 1) {
					$notified[] = $detail0['user_sid'];
				}
			endforeach;?>
			<div class="row">
				<div class="span12">
					<dt>Уведомлены</dt>
					<dd>
						<?php echo implode(", ", $notified); ?>
					</dd>
				</div>
			</div>
		<?php endif; ?>
	</dl>
</div>
<?php if(isset($incident['Detail'])):?>
<div class="row">
	<div class="span12">
		<h3>Оставьте свой комментарий</h3>
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
			echo $this->Form->create('Incident');
			foreach ($incident['Detail'] as $detail):
				if ($detail['notify_only'] != 1):
		?>
			<tr>
				<td><?php echo $detail['comment_id'];?></td>
				<td><?php echo $detail['user_sid'];?></td>
				<td><?php if ($detail['id'] == $detail_id) {
						echo $this->Form->input('Detail.comment', array('value' => $detail['comment'], 'div' => false, 'rows' => 3, 'class' => 'input-block-level', 'label' => false));
						echo $this->Form->input('Detail.id', array('type' => 'hidden', 'value' => $detail_id, 'label' => false));
						echo $this->Form->input('Detail.incident_id', array('type' => 'hidden', 'value' => $incident['Incident']['id'], 'label' => false));
						echo $this->Form->input('Detail.comment_id', array('type' => 'hidden', 'value' => $detail['comment_id'], 'label' => false));
						echo $this->Form->input('Detail.user_sid', array('type' => 'hidden', 'value' => $detail['user_sid'], 'label' => false));
						echo $this->Form->end(array('class' => 'btn btn-primary', 'label' => 'Сохранить'));
					  } else {
						echo $detail['comment'];
					  }?></td>
				<td><?php echo $detail['comment_date'];?></td>
			</tr>
		<?php 	endif;
			endforeach; ?>
		</table>
	<!--	<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Доработать входящее', true), array('controller' => 'details', 'action' => 'add'));?> </li>
			</ul>
		</div>
	-->
	</div>
</div>
<?php endif;?>
<script language="javascript" type="text/javascript">
	$("#DetailComment").focus();
</script>