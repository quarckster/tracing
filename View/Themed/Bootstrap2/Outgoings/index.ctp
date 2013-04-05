<h2>Исходящие</h2>
<?php echo $this->element('pagination'); ?>
<table class="table table-striped table-bordered table-condensed">
		<col width="70" />
		<col width="auto" />
		<col width="auto" />
		<col width="90" />
		<col width="180" />
		<col width="40" />
		<col width="40" />
		<col width="120" />
	<tr>
		<thead>
			<th>Номер</th>
			<th>Организация</th>
			<th>Содержание</th>
			<th>Дата</th>
			<th>Исполнитель</th>
			<th>Папка</th>
			<th>КИС</th>
			<th class="actions"></th>
		</thead>	
	</tr>
	<?php foreach ($outgoings as $outgoing):?>
	<tr>
		<td><?php echo $outgoing['Outgoing']['outgoing_num']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['organization']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['content']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['date']; ?>&nbsp;</td>
		<td><?php echo $outgoing['Outgoing']['executer']; ?>&nbsp;</td>
		<td><?php if ($outgoing['Outgoing']['folder'] == 1){ echo '<i class="icon-ok aligncenter"> </i>'; } ?>&nbsp;</td>
		<td><?php if ($outgoing['Outgoing']['cis'] == 1){ echo '<i class="icon-ok aligncenter"> </i>'; } ?>&nbsp;</td>
		<td><div class="btn-group"><?php
			echo $this->Html->link('<i class="icon-file"> </i>', array('action' => 'view', $outgoing['Outgoing']['id']), array('class' => 'btn', 'escape' => false)); 
			echo $this->Html->link('<i class="icon-edit"> </i>', array('action' => 'edit', $outgoing['Outgoing']['id']), array('class' => 'btn', 'escape' => false));
			echo $this->Html->link('<i class="icon-remove"> </i>', array('action' => 'delete', $outgoing['Outgoing']['id']), array('class' => 'btn', 'escape' => false, 'Вы уверены, что хотите удалить это письмо?'));?>
		</div></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php echo $this->element('pagination'); ?>