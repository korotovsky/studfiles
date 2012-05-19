<?php
$this->breadcrumbs = array(
    'Преподователи' => array('admin/index'),
    'Админко',
);?>

<?php
    $css = Yii::app()->basePath . '/../css';
    $as = Yii::app()->getAssetManager()->publish($css);
    $cs = Yii::app()->clientScript;
    $cs->registerCssFile($as . '/treeview.css');
?>

<?php $this->widget('Tree'); ?>
