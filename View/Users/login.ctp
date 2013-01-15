<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Пожалуйста введите свой логин и пароль'); ?></legend>
    <?php
        echo $this->Form->input('username', array('label' => 'Логин'));
        echo $this->Form->input('password', array('label' => 'Пароль'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Войти'));?>
</div>
<div class="actions">
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Письма', true), array('controller' => 'incidents', 'action' => 'index')); ?></li>
	</ul>
	<h3>Действия</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Зарегистрироваться', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>

