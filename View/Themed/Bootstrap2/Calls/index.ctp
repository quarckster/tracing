<h2>Обращения</h2>
<?php echo $this->element('pagination'); ?>
<table class="table table-striped table-bordered table-condensed">
	<col width="80" />		
	<col width="95" />
	<col width="50" />
	<col width="auto" />
	<col width="auto" />
	<col width="170" />
	<col width="40" />
	<col width="120" />
	<thead>
		<tr>
			<th>Имя</th>
			<th>Даты</th>
			<th>Кат.</th>
			<th>Организация</th>
			<th>Контактные данные</th>
			<th>Предпр. действия</th>
			<th>КИС</th>
			<th></th>
		</tr>
	</thead>
	<?php foreach ($calls as $call):?>
	<tr>
		<td><?php echo $call['Call']['user_sid']; ?>&nbsp;</td>
		<td>О:&nbsp;<?php echo $call['Call']['open_date']; ?><br>З:&nbsp;<?php echo $call['Call']['close_date']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['category']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['organization']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['contact_data']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['actions']; ?>&nbsp;</td>
		<td><?php if ($call['Call']['cis_template'] == 1){ echo '<i class="icon-ok aligncenter"> </i>'; } ?>&nbsp;</td>
		<td>
			<div class="btn-group pull-right"><?php
				echo $this->Html->link('<i class="icon-file"> </i>', array('action' => 'view', $call['Call']['id']), array('class' => 'btn', 'escape' => false)); 
				echo $this->Html->link('<i class="icon-edit"> </i>', array('action' => 'edit', $call['Call']['id']), array('class' => 'btn', 'escape' => false));
				echo $this->Html->link('<i class="icon-remove"> </i>', array('action' => 'delete', $call['Call']['id']), array('class' => 'btn', 'escape' => false, 'Вы уверены, что хотите удалить это обращение?'));?>
			</div>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<?php echo $this->element('pagination'); ?>