<?php
$this->pageTitle=Yii::app()->name . ' - Просмотр файла - ' . CHtml::encode($archive->filename);
$this->breadcrumbs = array(
    'Архив' => Yii::app()->createUrl('archive/index'),
    $archive->filterSubj->subjname => Yii::app()->createUrl('archive/search', array('subject' => $archive->filterSubj->sid)),
    $archive->sems->name => Yii::app()->createUrl('archive/search', array('subject' => $archive->filterSubj->sid, 'semestr' => $archive->sems->id)),
    CHtml::encode($archive->filename),
);

?>

<?php

    $css = Yii::app()->basePath . '/../js';
    $as = Yii::app()->getAssetManager()->publish($css);
    $cs = Yii::app()->clientScript;
    $cs->registerScriptFile($as . '/jquery.comment.js');

?>

<div>
    <h2><b><?php echo CHtml::encode($archive->filename) ?></b></h2>
    <hr />
    <div class="well" style="margin-right: 10px">
        <div style="float: right">
            <a class="btn primary" href="<?php echo Yii::app()->createUrl('archive/get', array('id' => $archive->id, 'hash' => md5($archive->filename . $archive->id))); ?>">
                Скачать
            </a>
        </div>
        <div class="icon" style="float: left; padding: 5px">
            <img src="<?php echo archive::getIconUrl($archive->uri) ?>" title="<?php echo CHtml::encode($archive->filename) ?>" alt="<?php echo CHtml::encode($archive->filename) ?>"/>
        </div>
        <div style="float: left">
            <p><b><?php echo CHtml::encode($archive->filename) ?></b></p>
            Семестр: <b><?php echo $archive->sems->name ?></b><br />
            Тип: <b><?php echo $archive->types->type ?></b><br />
        </div>
        <div style="clear: both; padding-top: 15px"><b>Описание</b>: <?php echo CHtml::encode($archive->description) ?></div>
    </div>

    <p style="font-size: 1.2em"><?php echo Yii::t('main', 'Комментарии (' . count($modelComments) . '):') ?></p>
    <div class="comments">
        <div style="margin-left: -20px">
        <?php foreach($modelComments as $k => $comment) { ?>
            <?php echo $this->renderPartial('/comments/_comment', array(
                'comment' => $comment,
            )); ?>
        <?php } ?>
        </div>

        <div class="clear"></div>
        <a href="#" to="<?php echo $modelComment->parent ?>" level="0" class="reply-main-link"><?php echo Yii::t('main', 'Оставить комментарий') ?></a>
        <span id="form<?php echo $modelComment->parent ?>">
            <div class="form" id="formmain">
                <?php echo $this->renderPartial('/comments/_form', array(
                    'modelComment' => $modelComment
                )); ?>
            </div>
        </span>
    </div>

</div>



