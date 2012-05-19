<?php
$this->pageTitle=Yii::app()->name . ' - Регистрация';
$this->breadcrumbs=array(
    'Регистрация',
);
?>
    <h1>Регистрация</h1>
    <div class="row show-grid" style="margin-top: 20px; margin-left: 0px">
        <div class="span14 columns well" style="padding-left: 30px">
            <div class="form">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id' => 'users-form',
                'enableAjaxValidation' => true,
            )); ?>

                <div class="row <?php if($model->getError('username') != '') echo ' error' ?>">
                    <?php echo $form->textField($model, 'username'); ?>
                    <?php echo $form->label($model, 'username'); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>

                <div class="row <?php if($model->getError('password') != '') echo ' error' ?>">
                    <?php echo $form->passwordField($model, 'password'); ?>
                    <?php echo $form->label($model, 'password'); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>

                <?php if(CCaptcha::checkRequirements()): ?>
                <div class="row <?php if($model->getError('verifyCode') != '') echo ' error' ?>">
                    <?php $this->widget('CCaptcha', array('clickableImage' => true, 'buttonLabel' => '')); ?>
                    <?php echo $form->textField($model, 'verifyCode', array('style' => 'width: 225px; height: 50px; line-height: 50px; font-size: 3em')); ?>
                    <?php echo $form->error($model, 'verifyCode'); ?>
                </div>
                <?php endif; ?>

                <div class="row">
                    <button style="margin-left: 125px; width: 230px" type="submit" class="btn primary">Регистрация</button>
                </div>
            <?php $this->endWidget(); ?>
            </div><!-- form -->
        </div>
    </div>
