<div class="view well" style="padding: 10px; margin: 10px">
    <div style="float: right">
        <a class="btn primary" href="<?php echo Yii::app()->createUrl('archive/get', array('id' => $data->id, 'hash' => md5($data->filename . $data->id))); ?>">
            Скачать
        </a>
    </div>
    <div class="icon" style="float: left; padding-top: 5px; padding-right: 5px">
        <a href="<?php echo Yii::app()->createUrl('archive/view', array('id' => $data->id)) ?>">
            <img src="<?php echo archive::getIconUrl($data->uri) ?>" title="<?php echo CHtml::encode($data->filename) ?>" alt="<?php echo CHtml::encode($data->filename) ?>"/>
        </a>
    </div>
    <div class="info">
        <b><a style="font-size: 1.2em" href="<?php echo Yii::app()->createUrl('archive/view', array('id' => $data->id)) ?>"><?php echo CHtml::encode(mb_substr($data->filename, 0, 100, 'UTF-8')) ?></a></b>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('semestr')); ?>:</b>
        <?php echo CHtml::encode($data->sems->name); ?>

        <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
        <?php echo CHtml::encode($data->types->type); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
        <?php echo CHtml::encode(mb_substr($data->description, 0, 100, 'UTF-8')); ?>
        <br />
    </div>
</div>
<div style="clear: both"></div>
