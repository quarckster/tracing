<div>
	<div class="row">
		<div class="span8">
			<h2>История изменений обращения</h2>
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
						<th class="span1">Номер ТО</th>
						<th class="span1">Организация</th>
						<th class="span1">Контактные данные</th>
						<th class="span2">Содержание</th>
						<th class="span2">Предпринятые действия</th>
						<th class="span2">Уведомлены</th>
					</tr>
				</thead>
				<?php foreach (array_reverse($histories) as $history): ?>
					<tr>
						<td><?php echo $history['Call']['changed_by'];?></td>
						<td><?php echo $history['Call']['version_created'];?></td>
						<td><?php echo $history['Call']['number_to'];?></td>
						<td><?php echo $history['Call']['organization'];?></td>
						<td><?php echo $history['Call']['contact_data'];?></td>
						<td><?php echo $history['Call']['content'];?></td>
						<td><?php echo $history['Call']['actions'];?></td>
						<td><?php echo $history['Call']['notified'];?></td>
					</tr>
				<?php endforeach; ?>	
			</table>
		</div>
	</div>
	<?php endif;?>