<div>
	<div class="row">
		<div class="span8">
			<h2>История изменений входящего <?php echo $incoming_num; ?></h2>
		</div>
		<div class="offset2 span2">
			<?php echo $this->Html->link('<i class="icon-file"> </i> Вернуться', array('action' => 'view', $id), array('div' => array('class' => 'pull-right'), 'class' => 'btn', 'escape' => false));?>
		</div>
	</div>	
	<?php if (!empty($histories)):?>
	<br/>
	<h3>Ревизии</h3>
	<div class="row">
		<div class="span12">
			<table class="table">
				<thead>
					<tr>
						<th class="span1">Кто изменил</th>
						<th class="span2">Дата изменения</th>
						<th class="span1">Вх. номер</th>
						<th class="span1">Дата выполнения</th>
						<th class="span1">Номер ТО</th>
						<th class="span3">Содержание</th>
						<th class="span3">Организация</th>
					</tr>
				</thead>
				<?php foreach (array_reverse($histories) as $history): ?>
					<tr>
						<td><?php echo $history['Incident']['changed_by'];?></td>
						<td><?php echo $history['Incident']['version_created'];?></td>
						<td><?php echo $history['Incident']['incoming_num'];?></td>
						<td><?php echo $history['Incident']['exp_date'];?></td>
						<td><?php echo $history['Incident']['number_to'];?></td>
						<td><?php echo $history['Incident']['content'];?></td>
						<td><?php echo $history['Incident']['organization'];?></td>
					</tr>
				<?php //if (isset($history_prev)) $diff = Set::diff($history['Incident'], $history_prev['Incident']);
					  //$history_prev = $history;?>
					<!--<tr>
						<td><?php echo $history['Incident']['changed_by'];?></td>
						<td><?php echo $history['Incident']['version_created'];?></td>
						<td><?php
							if (isset($diff['incoming_num'])) echo 'Входящий номер:'.'&nbsp;'.$diff['incoming_num'].'&nbsp;'.'<br/>';
							if (isset($diff['start_date'])) echo 'Дата регистрации:'.'&nbsp;'.$diff['start_date'].'&nbsp;'.'<br/>';
							if (isset($diff['exp_date'])) echo 'Дата выполнения:'.'&nbsp;'.$diff['exp_date'].'&nbsp;'.'<br/>';
							if (isset($diff['number_to'])) echo 'Номер ТО:'.'&nbsp;'.$diff['number_to'].'&nbsp;'.'<br/>';
							if (isset($diff['content'])) echo 'Содержание:'.'&nbsp;'.$diff['content'].'&nbsp;'.'<br/>';
							if (isset($diff['organization'])) echo 'Организация:'.'&nbsp;'.$diff['organization'].'&nbsp;'.'<br/>';
						?></td>
					</tr>-->
				<?php endforeach; ?>	
			</table>
		</div>
	</div>
	<?php endif;?>
	<?php if (!empty($details_histories)):?>
	<h3>Участники, которые были удалены из маршрута</h3>
	<div class="row">
		<div class="span9">
			<table class="table">
				<thead>
					<tr>
						<th class="span2">Редактировал(а)</th>
						<th class="span2">Дата изменения</th>
						<th class="span2">Имя участника</th>
						<th class="span3">Очерёдность в маршруте</th>
					</tr>
				</thead>
				<?php foreach ($details_histories as $details_history): ?>
				<tr>
					<td><?php echo $details_history['DetailsRev']['changed_by']; ?>&nbsp;</td>
					<td><?php echo $details_history['DetailsRev']['modify_time']; ?>&nbsp;</td>
					<td><?php echo $details_history['DetailsRev']['user_sid']; ?>&nbsp;</td>
					<td><?php echo $details_history['DetailsRev']['comment_id']; ?>&nbsp;</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
	<?php endif;?>
</div>