<?php
$this->breadcrumbs = array(
    'Преподователи' => array('admin/index'),
);?>

<?php
    $css = Yii::app()->basePath . '/../css';
    $as = Yii::app()->getAssetManager()->publish($css);
    $cs = Yii::app()->clientScript;
    $cs->registerCssFile($as . '/treeview.css');
?>

<div class="well">
    <p>Раздел с обсуждениями преподавателей в разработке...</p>
</div>
