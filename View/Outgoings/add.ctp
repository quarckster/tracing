<div class="outgoings form">
<?php echo $this->Form->create('Outgoing');?>
	<fieldset>
		<legend><?php echo __('Добавить исходящее'); ?></legend>
	<?php
		echo 'Номера последних исходящих: ';
		echo $number['IP']['Outgoing']['outgoing_num'], ', ', $number['API']['Outgoing']['outgoing_num'], ', ', $number['KS']['Outgoing']['outgoing_num'], ', ', $number['RKS']['Outgoing']['outgoing_num'];
		echo $this->Form->input('Outgoing.outgoing_num', array( 'label' => 'Исходящий номер' ));
		echo $this->Form->input('Outgoing.organization', array( 'label' => 'Организация' ));
		echo $this->Form->input('Outgoing.executer', array( 'label' => 'Исполнитель' ));
		//echo $this->Form->input('Outgoing.date', array( 'label' => 'Дата исполнения', 'type' => 'text' ));
		echo $this->Form->input('Outgoing.content', array('rows' => '3', 'label' => 'Содержание'));
		echo $this->Form->input('Outgoing.folder', array('label' => 'Наличие в папке', 'type' => 'checkbox'));
		echo $this->Form->input('Outgoing.cis', array('label' => 'Наличие в КИС', 'type' => 'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Сохранить'));?>
</div>
<div class="actions">
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Исходящие', true), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Входящие', true), array('controller' => 'Outgoings', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
	</ul>
</div>
<script language="javascript" type="text/javascript">
	// Автозаполнение
	$("input#OutgoingExecuter").autocomplete({
		source: "/adnames.php",
		minLength: 2
	});
</script>
