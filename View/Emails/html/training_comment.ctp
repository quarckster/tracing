<div>
	<h1><a href="http://tracing2/trainings/view/<?php echo $training['Training']['id'];?>">Новый комментарий к заявке на обучение №<?php echo $training['Training']['id']?></a></h1>
<div>
<div>
Организация: <?php echo $training['Training']['organization'];?>
</div>	
<div><strong><?php echo $data['TrainingsComment']['user_sid'];?></strong></div>
<div>
<?php echo $data['TrainingsComment']['comment'];?>
</div>