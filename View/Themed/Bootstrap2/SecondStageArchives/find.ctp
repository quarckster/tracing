<h2>Поиск заказов</h2>
<div>
<?php echo $this->Form->create('SecondStageArchive', array('url' => array_merge(array('action' => 'find'), $this->params['pass'])));?>
<div class="row">
	<?php echo $this->Form->input('order_number', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Номер заказа'));
	echo $this->Form->input('contact_data', array('div' => array('class' => 'span4'), 'class' => 'span4', 'label' => 'Контактные данные'));
	echo $this->Form->input('requisites', array('div' => array('class' => 'span4'), 'type' => 'text', 'class' => 'span4', 'label' => 'Реквизиты'));?>
</div>
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
				<th>Дата получения</th>
				<th>Дата отправки клиенту</th>
				<th>Доставка</th>
				<th>Контактные данные</th>
				<th>Реквизиты</th>
		</tr>
	</thead>
	<?php foreach ($secondStageArchives as $SecondStageArchive): ?>
	<tr>
		<td><?php echo h($SecondStageArchive['SecondStageArchive']['order_number']); ?>&nbsp;</td>
		<td><?php echo h($SecondStageArchive['SecondStageArchive']['receive_date']); ?>&nbsp;</td>
		<td><?php echo h($SecondStageArchive['SecondStageArchive']['send_date']); ?>&nbsp;</td>
		<td><?php echo h($SecondStageArchive['SecondStageArchive']['delivery']); ?>&nbsp;</td>
		<td><?php echo h($SecondStageArchive['SecondStageArchive']['contact_data']); ?>&nbsp;</td>
		<td><?php echo h($SecondStageArchive['SecondStageArchive']['requisites']); ?>&nbsp;</td>
	</tr>
	<?php endforeach; ?>
</table>
<?php echo $this->element('pagination'); ?>