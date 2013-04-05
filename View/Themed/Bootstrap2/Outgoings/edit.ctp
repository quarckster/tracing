<?php echo $this->Form->create('Outgoing');?>
<fieldset>
	<legend>Редактировать исходящее</legend>
<div class="row">
	<?php echo $this->Form->input('Outgoing.outgoing_num', array('div' => 'span2', 'class' => 'span2', 'label' => 'Исходящий номер'));
	echo $this->Form->input('Outgoing.executer', array('div' => 'span2', 'class' => 'span2', 'label' => 'Исполнитель'));
	echo $this->Form->input('Outgoing.folder', array('div' => 'span3', 'type' => 'checkbox', 'label' => array('class' => 'inline checkbox', 'text' => 'Наличие в папке')));
	echo $this->Form->input('Outgoing.cis', array('type' => 'checkbox', 'label' => array('class' => 'inline checkbox', 'text' => 'Наличие в КИС')));?>
</div>
<div class="row">
	<?php echo $this->Form->input('Outgoing.organization', array('div' => 'span10', 'class' => 'span10', 'label' => 'Организация'));?>
</div>
<div class="row">
	<?php echo $this->Form->input('Outgoing.content', array('div' => 'span10', 'class' => 'span10', 'label' => 'Содержание'));?>
</div>
</fieldset>
<div class="row">
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Сохранить', 'div' => array('class' => 'span2')));?>
</div>