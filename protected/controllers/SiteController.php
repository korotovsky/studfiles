<?php

class SiteController extends Controller {
    public $layout='//layouts/archive';

    public function actions() {
        return array(
            'captcha'=>array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xF5F5F5,
                'testLimit' => 10,
            ),
        );
    }

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
                'actions' => array('index', 'login', 'logout', 'register', 'captcha', 'error', 'browser'),
                'users' => array('*'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
            $this->render('browser', array());
            Yii::app()->end();
        }    
    
        $this->render('index');
    }

    public function actionError() {
        if($error=Yii::app()->errorHandler->error) {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionLogin() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
            $this->render('browser', array());
            Yii::app()->end();
        }    
    
        $model = new LoginForm;

        if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        $this->render('login', array('model'=>$model));
    }

    public function actionRegister() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
            $this->render('browser', array());
            Yii::app()->end();
        }    
    
        if(Yii::app()->user->isGuest) {
            $model = new users;
            $this->performAjaxValidation($model);
            if(isset($_POST['users'])) {
                $model->attributes = $_POST['users'];
                $model->role = 'user';
                if($model->validate()) {
                    if($model->save()) {
                        $model->password = md5($_POST['users']['password']);
                        if($model->save()) {
                            $_POST['LoginForm']['username'] = $_POST['users']['username'];
                            $_POST['LoginForm']['password'] = $_POST['users']['password'];
                            $this->actionLogin();
                        }
                    }
                }
            }
            $this->render('register', array(
                'model' => $model,
            ));
        } else {
            $this->redirect(array('/site/index'));
        }
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    protected function performAjaxValidation($model) {
        if(isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
