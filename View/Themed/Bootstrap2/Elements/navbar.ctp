<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">Tracing2</a>
			<div class="btn-group pull-right">
						<?php if (AuthComponent::user()){?>
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-user"> </i> <?php echo AuthComponent::user('displayname'); ?>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link('Выйти', '/logout')?></li>
						</ul>
						<?php } else {
											echo $this->Html->link('<i class="icon-user"> </i> Войти', '/login', array('class' => 'btn', 'escape' => false));
									} ?>
			</div>
				<ul class="nav">
					<!--<li class="active"><a href="#">Главная</a></li>-->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" >Входящие<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li class="nav-header">Фильтры</li>
							<li><?php echo $this->Html->link(__('Все письма', true), array('controller' => 'incidents', 'action' => 'index')); ?></li>
							<li><?php echo $this->Html->link(__('Просроченные обработанные', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'delayed')); ?></li>
							<li><?php echo $this->Html->link(__('Просроченные необработанные', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'delayed_in_progress')); ?></li>
							<li><?php echo $this->Html->link(__('В работе', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'in_progress')); ?></li>
							<li><?php echo $this->Html->link(__('Об отключении за долги', true), array('controller' => 'incidents', 'action' => 'find', 'filter' => 'debt')); ?></li>
							<li class="divider"></li>
							<li><?php echo $this->Html->link(__('Добавить входящее', true), array('controller' => 'incidents', 'action' => 'add')); ?></li>
							<li class="divider"></li>
							<li><?php echo $this->Html->link(__('Поиск', true), array('controller' => 'incidents', 'action' => 'find')); ?></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" >Исходящие<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li class="nav-header">Фильтры</li>
							<li><?php echo $this->Html->link(__('Все письма', true), array('controller' => 'outgoings', 'action' => 'index')); ?></li>
							<li><?php echo $this->Html->link(__('РКС', true), array('controller' => 'outgoings', 'action' => 'find', 'filter' => 'RKS')); ?></li>
							<li><?php echo $this->Html->link(__('ИП', true), array('controller' => 'outgoings', 'action' => 'find', 'filter' => 'IP')); ?></li>
							<li><?php echo $this->Html->link(__('АПИ', true), array('controller' => 'outgoings', 'action' => 'find', 'filter' => 'API')); ?></li>
							<li><?php echo $this->Html->link(__('КС', true), array('controller' => 'outgoings', 'action' => 'find', 'filter' => 'KS')); ?></li>
							<li><?php echo $this->Html->link(__('СП', true), array('controller' => 'outgoings', 'action' => 'find', 'filter' => 'SP')); ?></li>
							<li class="divider"></li>
							<li><?php echo $this->Html->link(__('Добавить исходящее', true), array('controller' => 'outgoings', 'action' => 'add')); ?></li>
							<li class="divider"></li>
							<li><?php echo $this->Html->link(__('Поиск', true), array('controller' => 'outgoings', 'action' => 'find')); ?></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" >Обращения<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li class="nav-header">Фильтры</li>
							<li><?php echo $this->Html->link(__('Все обращения', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
							<li><?php echo $this->Html->link(__('Заказ документов', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'ЗД')); ?></li>
							<li><?php echo $this->Html->link(__('Сбой', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'Сбой')); ?></li>
							<li><?php echo $this->Html->link(__('Информационные', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'Инф.')); ?></li>
							<li><?php echo $this->Html->link(__('Демоверсии', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'Демо')); ?></li>
							<li><?php echo $this->Html->link(__('Консультации по формализованным вопросам', true), array('controller' => 'calls', 'action' => 'find', 'category' => 'КФВ')); ?></li>
							<li><?php echo $this->Html->link(__('На контроле', true), array('controller' => 'calls', 'action' => 'find', 'control' => '1')); ?></li>
							<li><?php echo $this->Html->link(__('Незакрытые', true), array('controller' => 'calls', 'action' => 'find', 'close_date' => '1')); ?></li>
							<li><?php echo $this->Html->link(__('Просроченные', true), array('controller' => 'calls', 'action' => 'find', 'filter' => 'expired')); ?></li>
							<li class="divider"></li>
							<li><?php echo $this->Html->link(__('Добавить обращение', true), array('controller' => 'calls', 'action' => 'add')); ?></li>
							<li class="divider"></li>
							<li><?php echo $this->Html->link(__('Поиск', true), array('controller' => 'calls', 'action' => 'find')); ?></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Второй этап<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li class="nav-header">Фильтры</li>
							<li><?php echo $this->Html->link(__('Все', true), array('controller' => 'second_stages', 'action' => 'index')); ?></li>
							<li class="divider"></li>
							<li><?php echo $this->Html->link(__('Поиск', true), array('controller' => 'second_stages', 'action' => 'find')); ?></li>
							<li><?php echo $this->Html->link(__('Поиск в архиве', true), array('controller' => 'second_stage_archives', 'action' => 'find')); ?></li>
						</ul>
					</li>
					<li><a href="/stats">Статистика</a></li>
				</ul>
		</div>
	</div>
</div>