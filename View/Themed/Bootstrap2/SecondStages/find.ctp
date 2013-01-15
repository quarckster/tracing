<h2>Поиск заказов</h2>
<div>
<?php echo $this->Form->create('SecondStage', array('url' => array_merge(array('action' => 'find'), $this->params['pass'])));?>
<div class="row">
	<?php echo $this->Form->input('order_number', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Номер заказа'));?>
</div>
<!-- <div class="row">
	<?php echo $this->Form->input('range_from', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Начальная дата'));
	echo $this->Form->input('range_to', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Конечная дата'));  ?>
</div> -->
<div class="row">
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Найти', 'div' => array('class' => 'span2')));
?>
</div>
<?php echo $this->element('pagination'); ?>
<table class="table table-striped table-bordered table-condensed">
	<col width="auto" />
	<col width="auto" />
	<col width="auto" />
	<col width="auto" />
	<col width="120" />
	<thead>
		<tr>
				<th>Номер заказа</th>
				<th>Дата</th>
				<th>Заказ в</th>
				<th>Способ заказа</th>
				<th></th>
		</tr>
	</thead>
	<?php foreach ($secondStages as $secondStage): ?>
	<tr>
		<td><?php echo h($secondStage['SecondStage']['order_number']); ?>&nbsp;</td>
		<td><?php echo h($secondStage['SecondStage']['date']); ?>&nbsp;</td>
		<td><?php echo h($secondStage['SecondStage']['order_in']); ?>&nbsp;</td>
		<td><?php echo h($secondStage['SecondStage']['order_way']); ?>&nbsp;</td>
		<td><div class="btn-group"><?php
			echo $this->Html->link('<i class="icon-file"> </i>', array('action' => 'view', $secondStage['SecondStage']['id']), array('class' => 'btn', 'escape' => false)); 
			echo $this->Html->link('<i class="icon-edit"> </i>', array('action' => 'edit', $secondStage['SecondStage']['id']), array('class' => 'btn', 'escape' => false));
			echo $this->Html->link('<i class="icon-remove"> </i>', array('action' => 'delete', $secondStage['SecondStage']['id']), array('class' => 'btn', 'escape' => false, 'Вы уверены, что хотите удалить это входящее?'));?>
		</div></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php echo $this->element('pagination'); ?>