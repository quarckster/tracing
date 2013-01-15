<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset();
	echo $this->Html->script('jquery'); // Include jQuery library
	echo $this->Html->script('jquery-ui'); // Include jQuery-UI library
	echo $this->Html->css('ui-lightness/ui-lightness.css');
	?>
	<title>
		<?php __('Система обработки входящих'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->css('style');

		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1 class="left">Система обработки входящих</h1>
			<?php if (AuthComponent::user()):?>
				<h1 class="right">Вы вошли как <?php echo AuthComponent::user('displayname'); ?>. <?php echo $this->Html->link('Выйти', '/logout')?></h1>
			<?php endif; ?>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>

		</div>
		<div id="footer">
			<?php echo $this->Html->link(__('Статистика', true), '/stats', array('id' => array('stats'))); ?>
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
