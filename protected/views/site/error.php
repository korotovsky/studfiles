<?php
$this->pageTitle=Yii::app()->name . ' - Ошибка';
$this->breadcrumbs=array(
	'Ошибка',
);
?>

<h2>Ошибка <?php echo $code; ?></h2>
<hr />
<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
