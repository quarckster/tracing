<div class="row">
	<div class="span5 offset1">
		<h2>Заявка на обучение №<?php echo $training['Training']['id']; ?></h2>
	</div>
	<div class="span2 offset3">
		<div class="pull-right">
		<?php echo $this->Html->link('<i class="icon-edit"> </i> Редактировать', array('action' => 'edit', $training['Training']['id']), array('class' => 'btn', 'escape' => false));?>
		</div>
	</div>
</div>
<?php if(!empty($training['Training']['date_control'])):?>
<div class="row">
	<h3 class="offset1">На контроле до <?php echo $training['Training']['date_control']; ?></h3>
</div>
<?php endif;?>
<div class="row">
	<table class="table table-hover table-bordered table-condensed offset1 span10">
		<col width="240px" />
		<col width="auto" />
		<tbody>
			<tr>
				<td><b>Специалист</b></td>
				<td><?php echo $training['Training']['user_sid']; ?></td>
			</tr>
			<tr>
				<td><b>Цели обучения</b></td>
				<td><?php echo $training['Training']['purpose']; ?></td>
			</tr>
			<tr>
				<td><b>Вид обучения</b></td>
				<td><?php echo $training['Training']['kind_training']; ?></td>
			</tr>
			<tr>
				<td><b>Дополнительная информация</b></td>
				<td><?php echo $training['Training']['additional_info']; ?></td>
			</tr>
			<tr>
				<td><b>Номер ТО</b></td>
				<td><?php echo $training['Training']['number_to']; ?></td>
			</tr>
			<tr>
				<td><b>Организация</b></td>
				<td><?php echo $training['Training']['organization']; ?></td>
			</tr>
			<tr>
				<td><b>Город</b></td>
				<td><?php echo $training['Training']['town']; ?></td>
			</tr>
			<tr>
				<td><b>Адрес</b></td>
				<td><?php echo $training['Training']['address_fact']; ?></td>
			</tr>
			<tr>
				<td><b>Комплект систем</b></td>
				<td><?php echo $training['Training']['systems_set']; ?></td>
			</tr>
			<tr>
				<td><b>Сумма обслуживания</b></td>
				<td><?php echo $training['Training']['amount']; ?></td>
			</tr>
			<tr>
				<td><b>Конкуренты</b></td>
				<td><?php echo $training['Training']['competitors']; ?></td>
			</tr>
			<tr>
				<td><b>Оборудование</b></td>
				<td><?php echo $training['Training']['tso']; ?></td>
			</tr>
			<tr>
				<td><b>Дата поступления</b></td>
				<td><?php echo $training['Training']['date_receipt']; ?></td>
			</tr>
			<tr>
				<td><b>Преподаватель</b></td>
				<td><?php echo $training['Training']['mentor_sid']; ?></td>
			</tr>
			<tr>
				<td><b>Обучение проведено</b></td>
				<td><?php echo $training['Training']['date_training']; ?></td>
			</tr>
			<tr>
				<td><b>Дата завершения</b></td>
				<td><?php echo $training['Training']['date_end']; ?></td>
			</tr>
		</tbody>
	</table>
</div>
<!-- <dl>
	<div class="row">
		<div class="span2 offset1">
			<dt>Специалист</dt>
			<dd>
				<?php echo $training['Training']['user_sid']; ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Цели обучения</dt>
			<dd>
				<?php echo $training['Training']['purpose']; ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Вид обучения</dt>
			<dd>
				<?php echo $training['Training']['kind_training']; ?>
			</dd>
		</div>
		<div class="span4">
			<dt>Дополнительная информация</dt>
			<dd>
				<?php echo $training['Training']['additional_info']; ?>
			</dd>
		</div>
	</div>
	<div class="row">
	&nbsp;
	</div>
	<div class="row">
		<div class="span1 offset1">
			<dt>Номер ТО</dt>
			<dd>
				<?php echo $training['Training']['number_to']; ?>
			</dd>
		</div>
		<div class="span3">
			<dt>Организация</dt>
			<dd>
				<?php echo $training['Training']['organization']; ?>
			</dd>
		</div>
		<?php if(!empty($training['Training']['town'])):?>
 		<div class="span2">
			<dt>Город</dt>
			<dd>
				<?php echo $training['Training']['town']; ?>
			</dd>
		</div>
		<?php endif;?>
		<div class="span3">
			<dt>Адрес</dt>
			<dd>
				<?php echo $training['Training']['address_fact']; ?>
			</dd>
		</div>
	</div>
	<div class="row">
		&nbsp;
	</div>
	<div class="row">
		<div class="span3 offset1">
			<dt>Комплект систем</dt>
			<dd>
				<?php echo $training['Training']['systems_set']; ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Сумма обслуживания</dt>
			<dd>
				<?php echo $training['Training']['amount']; ?>
			</dd>
		</div>
		<div class="span2">
			<dt>Конкуренты</dt>
			<dd>
				<?php echo $training['Training']['competitors']; ?>
			</dd>
		</div>
		<div class="span1">
			<dt>Оборудование</dt>
			<dd>
				<?php echo $training['Training']['tso']; ?>
			</dd>
		</div>
	</div>
	<div class="row">
		&nbsp;
	</div>
	<div class="row">
		<div class="span2 offset1">
			<dt>Дата поступления</dt>
			<dd>
				<?php echo $training['Training']['date_receipt']; ?>
			</dd>
		</div>
		<?php if(!empty($training['Training']['mentor_sid'])):?>
		<div class="span2">
			<dt>Преподаватель</dt>
			<dd>
				<?php echo $training['Training']['mentor_sid']; ?>
			</dd>
		</div>
		<?php endif;?>
		<?php if(!empty($training['Training']['date_training'])):?>
		<div class="span2">
			<dt>Обучение проведено</dt>
			<dd>
				<?php echo $training['Training']['date_training']; ?>
			</dd>
		</div>
		<?php endif;?>
		<?php if(!empty($training['Training']['date_end'])):?>
		<div class="span2">
			<dt>Дата завершения</dt>
			<dd>
				<?php echo $training['Training']['date_end']; ?>
			</dd>
		</div>
		<?php endif;?>
	</div>		
</dl> -->
<?php if(!empty($training['TrainingsContact'])):?>
<div class="row">
	<h3 class="offset1">Список контактных лиц клиента</h3>
	<table class="table table-striped table-bordered table-condensed offset1 span10">
		<col width="auto" />
		<col width="auto" />
		<col width="200" />
		<col width="200" />
		<thead>
			<tr>
				<th>Имя</th>
				<th>Должность</th>
				<th>Телефон</th>
				<th>Примечание</th>
			</tr>
		</thead>
		<?php foreach ($training['TrainingsContact'] as $trainingscontact): ?>
			<tr>
				<td><?php echo $trainingscontact['name'];?></td>
				<td><?php echo $trainingscontact['occupation'];?></td>
				<td><?php echo $trainingscontact['phone'];?></td>
				<td><?php echo $trainingscontact['misc'];?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<?php endif;?>
<div class="row">
	<div class="span12">
		<div class="row">
			<div class="span3 offset1">
				<h3>Добавить комментарий</h3>
				<?php echo $this->Form->create('TrainingsComment', array('url' => array('controller' => 'TrainingsComments', 'action' => 'add')));
				echo $this->Form->input('TrainingsComment.trainings_id', array('type' => 'hidden', 'value' => $training['Training']['id']));
				echo $this->Form->input('TrainingsComment.user_sid', array('label' => 'Ваше имя', 'class' => 'span3'));
				echo $this->Form->input('TrainingsComment.comment', array('label' => 'Комментарий', 'class' => 'span3', 'type' => 'textarea'));
				echo $this->Form->end(array('class' => 'btn btn-primary btn-medium', 'label' => 'Отправить'));?>
			</div>
			<?php if(!empty($training['TrainingsComment'])):?>
			<div class="span6 offset1">
				<h3>Комментарии</h3>
				<?php foreach ($training['TrainingsComment'] as $trainingscomments):?>
				<div class="row">
					<div class="span2">
						<p style="margin-bottom:0;"><b><?php echo $trainingscomments['user_sid'];?></b></p>
						<small class="muted"><?php echo $trainingscomments['date'];?></small>
					</div>
					<div class="span4">
						<?php echo $trainingscomments['comment'];?>
					</div>
				</div>
				<br>
				<?php endforeach;?>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>
<script>
	$("input#TrainingsCommentUserSid").autocomplete({
		source: "/adnames.php",
		minLength: 2
			});
</script>