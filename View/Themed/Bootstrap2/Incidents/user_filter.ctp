<h2>Входящие</h2>
<?php //echo $this->element('pagination'); ?>
<table class="table table-striped table-bordered table-condensed">
	<col width="90" />
	<col width="auto" />
	<col width="90" />
	<col width="90" />
	<col width="60" />
	<col width="120" />
	<thead>
		<tr>
				<th>Номер входящего</th>
				<th>Организация</th>
				<th>Зарегистр.</th>
				<th>Дата исполнения</th>
				<th>Номер ТО</th>
				<th></th>
		</tr>
	</thead>
	<?php foreach ($incidents as $incident):?>
	<tr>
		<td><?php echo $incident['Incident']['incoming_num']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['organization']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['start_date']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['exp_date']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['number_to']; ?>&nbsp;</td>
		<td><div class="btn-group"><?php
			echo $this->Html->link('<i class="icon-file"> </i>', array('action' => 'view', $incident['Incident']['id']), array('class' => 'btn', 'escape' => false)); 
			echo $this->Html->link('<i class="icon-edit"> </i>', array('action' => 'edit', $incident['Incident']['id']), array('class' => 'btn', 'escape' => false));
			echo $this->Html->link('<i class="icon-remove"> </i>', array('action' => 'delete', $incident['Incident']['id']), array('class' => 'btn', 'escape' => false, 'Вы уверены, что хотите удалить это входящее?'));?>
		</div></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php //echo $this->element('pagination'); ?>