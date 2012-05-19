<?php
$this->pageTitle=Yii::app()->name . ' - Обновить';
$this->breadcrumbs=array(
	'Archives'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обновить',
);

?>

<h1>Update archive <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_add', array('model' => $model, 'sids' => $sids, 'semestrs' => $semestrs, 'types' => $types)); ?>
