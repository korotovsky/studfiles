<?php $form = $this->beginWidget('CActiveForm', array(
              'id' => 'archive-form',
              'action' => Yii::app()->createUrl('archive/view', array(
                   'id' => (int) Yii::app()->request->getParam('id')
               )),
              'enableAjaxValidation' => false,
    )); ?>

        <div class="row">
            <?php echo $form->hiddenField($modelComment, 'parent'); ?>
            <?php echo $form->TextArea($modelComment, 'text'); ?>
            <?php echo $form->error($modelComment, 'text'); ?>
        </div>

        <?php echo CHtml::SubmitButton(Yii::t('main', 'Добавить'), array('class' => 'btn primary', 'style' => 'margin-left: -20px')); ?>
<?php $this->endWidget(); ?>
