<div class="container">
	<div class="row">
		<div class="span6 offset2 well">
			<legend><?php echo 'Пожалуйста введите свои логин и пароль'; ?></legend>
					<?php echo $this->Session->flash('auth'); ?>
					<?php echo $this->Form->create('User', array('class' => 'form-inline'));?>
					<?php echo $this->Form->input('username', array('class' => 'span5', 'placeholder' => 'Логин', 'label' => '')); ?>
					<?php echo $this->Form->input('password', array('class' => 'span5', 'placeholder' => 'Пароль', 'label' => '')); ?>
					<?php echo $this->Form->end(array('class' => 'btn btn-info', 'label' => 'Войти'));?>
		</div>
	</div>
</div>