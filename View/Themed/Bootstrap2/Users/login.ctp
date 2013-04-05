<div class="container">
	<div class="row">
			<h3 class="form-signin-heading offset4">Пожалуйста введите свои логин и пароль</h3>
				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $this->Form->create('User', array('class' => 'form-signin well span4 offset4'));?>
				<?php echo $this->Form->input('username', array('div' => false, 'class' => 'span4 offset4 input-block-level', 'placeholder' => 'Логин', 'label' => '')); ?>
				<?php echo $this->Form->input('password', array('div' => false, 'class' => 'span4 offset4 input-block-level', 'placeholder' => 'Пароль', 'label' => '')); ?>
				<?php echo $this->Form->end(array('class' => 'btn btn-large btn-primary', 'label' => 'Войти'));?>
	</div>
</div>