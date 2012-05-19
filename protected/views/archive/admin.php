<?php
$this->pageTitle=Yii::app()->name . ' - Админко';
$this->breadcrumbs = array(
    'Архив' => array('index'),
    'Админко',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('archive-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Manage Archives</h1>

<?php echo CHtml::link('Охуенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->
<style type="text/css">
    input[name="archive[id]"] {
        width: 50px;
    }
    input[name="archive[filename]"], input[name="archive[description]"] {
        width: 300px;
    }
    input[name="archive[description]"] {
        width: 380px;
    }
</style>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'archive-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'cssFile' => false,
    'columns' => array(
        'id',
        'filename',
        'description',
        array(
            'class'=>'CButtonColumn',
            'htmlOptions' => array('style' => 'width: 100px'),
        ),
    ),
)); ?>
