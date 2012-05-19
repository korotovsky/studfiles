<?php

class TeachersController extends Controller {
    public $layout = '//layouts/teachers';

    public function filters() {
        return array(
            'accessControl',
            array('YXssFilter',
                'clean'   => '*',
                'tags'    => 'strict',
                'actions' => 'all'
            ),
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionView() {
        $this->render('view');
    }

    protected function performAjaxValidation($model) {
        if(isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
