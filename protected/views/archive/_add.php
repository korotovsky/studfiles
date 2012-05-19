<div class="form well show-grid" style="padding-left: 30px">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'archive-form',
    'enableAjaxValidation' => true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

    <div class="row <?php if($model->getError('filename') != '') echo ' error' ?>">
        <?php echo $form->textField($model, 'filename', array('style' => 'width: 70%')); ?>
        <?php echo $form->label($model, 'filename'); ?>
        <?php echo $form->error($model, 'filename'); ?>
    </div>

    <div class="row <?php if($model->getError('file') != '') echo ' error' ?>">
        <?php echo $form->fileField($model, 'file'); ?>
        <?php echo $form->label($model, 'file'); ?>
        <?php echo $form->error($model, 'file'); ?>
    </div>

    <div class="row <?php if($model->getError('description') != '') echo ' error' ?>">
        <?php echo $form->textArea($model, 'description', array('style' => 'width: 70%; height: 100px')); ?>
        <?php echo $form->label($model, 'description'); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row" style="margin-left: 0px">
        <div class="row <?php if($model->getError('sid') != '') echo ' error' ?>">
            <?php echo $form->dropDownList($model, 'sid', $sids); ?>
            <?php echo $form->label($model, 'sid'); ?>
            <?php echo $form->error($model, 'sid'); ?>
        </div>

        <div class="row <?php if($model->getError('semestr') != '') echo ' error' ?>">
            <?php echo $form->dropDownList($model, 'semestr', $semestrs); ?>
            <?php echo $form->label($model, 'semestr'); ?>
            <?php echo $form->error($model, 'semestr'); ?>
        </div>

        <div class="row <?php if($model->getError('type') != '') echo ' error' ?>">
            <?php echo $form->dropDownList($model, 'type', $types); ?>
            <?php echo $form->label($model, 'type'); ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>
        
        <div style="clear: both"></div>        
        
        <br />
        <button style="margin-left: 10px; width: 320px" type="submit" class="btn large primary"><?php echo $model->isNewRecord ? 'Добавить' : 'Сохранить' ?></button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
