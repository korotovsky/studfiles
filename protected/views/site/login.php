<?php
$this->pageTitle=Yii::app()->name . ' - Вход';
$this->breadcrumbs=array(
	'Вход',
);
?>

    <h1>Вход</h1>
    <div class="row show-grid" style="margin-top: 20px; margin-left: 0px">
        <div class="span14 columns well">


            <div class="form">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
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

                <div class="row">
                    <button style="margin-left: 140px; width: 220px" type="submit" class="btn primary">Авторизоваться</button>
                </div>
            <?php $this->endWidget(); ?>
            </div><!-- form -->
        </div>
    </div>
