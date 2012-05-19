<?php
$this->pageTitle=Yii::app()->name . ' - Добавить файл';
$this->breadcrumbs = array(
    'Добавить файл',
);

?>
<?php
$this->pageTitle=Yii::app()->name . ' - Добавить новый файл';
?>

<div>
    <h2>Добавить файл</h2>
    <hr />
    <div class="clear" style="margin-top: 25px"></div>
    <?php echo $this->renderPartial('_add', array(
        'model' => $model,
        'sids' => $sids,
        'semestrs' => $semestrs,
        'types' => $types
    )); ?>
</div>



