<?php
/**
 *
 * Twitter Bootstrap CakePHP Default Layout
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012 Trey Reynolds
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>
			Tracing2 - система обработки писем и обращений
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

<?php
	echo $this->fetch('meta');
	echo $this->Html->meta('icon');

	//echo $this->Html->css('cake.generic');
	echo $this->Html->css('bootstrap');
	echo $this->Html->css('style');
	//echo $this->Html->css('bootstrap-responsive');
	echo $this->Html->css('token-input-facebook');
	echo $this->Html->css('jquery-ui-custom-theme/jquery-ui-custom');
	echo $this->Html->script('jquery.js');
	echo $this->Html->script('jquery-ui.custom.js');
	echo $this->Html->script('jquery.tokeninput.js');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>

		<!-- Le styles -->
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>

	<body>
	<div id="wrap">
		<?php echo $this->element('navbar'); ?>
	
			<div class="container">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			</div> <!-- /container -->
			<div id="push"></div>
	</div>
		<footer>
			<p class="credit">Разработка - <a href="mailto:misharovdn@aric188.khakassia.ru" target="_blank">Дмитрий Мишаров</a></p>
		</footer>


		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<?php echo $this->Html->script('bootstrap.js');?>
	<?php echo $this->element('sql_dump'); ?>
	</body>
</html>