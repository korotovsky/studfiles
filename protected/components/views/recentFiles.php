<h2>Последние файлы</h2>

<?php foreach($recentFiles as $file): ?>

<div style="float: left; margin-right: 10px; width: 210px">
    <div style="padding: 5px; margin-left: 5px">
        <a style="font-weight: bold" href="<?php echo Yii::app()->createUrl('archive/view', array('id' => $file->id)) ?>"><?php echo mb_substr($file->filename, 0, 20, 'UTF-8') ?></a>
    </div>
    <div class="icon" style="float: left; padding: 5px">
        <a href="<?php echo Yii::app()->createUrl('archive/view', array('id' => $file->id)) ?>">
            <img src="<?php echo archive::getIconUrl($file->uri) ?>" title="<?php echo CHtml::encode($file->filename) ?>" alt="<?php echo CHtml::encode($file->filename) ?>"/>
        </a>
    </div>
    <div style="float: left">
        Семестр: <?php echo $file->sems->name ?><br />
        Тип: <?php echo $file->types->type ?><br />
        Предмет: <a href="<?php echo Yii::app()->createUrl('archive/search', array('subject' => $file->filterSubj->sid, 'semestr' => $file->sems->id)) ?>"><?php echo $file->filterSubj->subjname ?><br />
    </div>
</div>

<?php endforeach ?>
