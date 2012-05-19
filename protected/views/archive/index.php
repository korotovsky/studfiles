<?php

$this->pageTitle=Yii::app()->name . ' - Архив';
$this->breadcrumbs = array(
	'Архив',
);

$this->menu = array(
	array('label' => 'Create archive', 'url' => array('create')),
	array('label' => 'Manage archive', 'url' => array('admin')),
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
    <h2>Предметы</h2>
    <hr />
    <?php $letter = null; ?>
    <?php foreach($subjects as $subject) { ?>
        <?php
            $current = mb_substr($subject->subjname, 0, 2);
            if($letter != $current) {
                $letter = $current;
        ?>
        <h2><?php echo $current ?></h2>
        <?php } ?>
        <span class="subject" style="padding-right: 5px">
            <a href="<?php echo Yii::app()->createUrl('archive/search', array('subject' => $subject->sid)) ?>">
                <?php echo CHtml::encode($subject->subjname) ?>
            </a>
        </span>
    <?php } ?>

    <div class="clear" style="margin-top: 25px"></div>
    <h2>Последние файлы</h2>
    <hr />
    <?php $this->widget('zii.widgets.CListView', array(
	    'dataProvider' => $dataProvider,
	    'itemView'=>'_view',
    )); ?>

</div>



