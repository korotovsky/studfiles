<?php
$this->pageTitle=Yii::app()->name . ' - Поиск по архиву';
$this->breadcrumbs = array(
    'Архив' => Yii::app()->createUrl('archive/index'),
    $archive->filterSubj->subjname,
);

?>

<?php
Yii::app()->clientScript->registerScript('ga-track', "
$('li.page a').click(function(){
    _gaq.push(['_trackPageview', '" . Yii::app()->request->getUrl() . "']);
});
");
?>

<div>
    <h2>Доступные файлы в категории <b><?php echo $archive->filterSubj->subjname ?></b></h2>
    <hr />
    <div>
        <form method="GET">
            <?php echo CHtml::hiddenField('subject', $subject); ?>
            <?php echo CHtml::dropDownList('semestr', $semestr, $semestrs); ?>
            <?php echo CHtml::dropDownList('type', $type, $types); ?>
            <?php echo CHtml::submitButton('Поиск', array('id' => 'search-btn', 'class' => 'btn primary')); ?>
        </form>
    </div>
    <div class="clear" style="margin-top: 15px"></div>
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView'=>'_view',
    )); ?>

</div>



