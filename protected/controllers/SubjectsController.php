<?php

class SubjectsController extends Controller {

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
                'actions' => array('admin'),
                'roles' => array('admin'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionAdmin() {
        $model = teachers::model()->findByPK(1);
        if(isset($_POST['tree']) && $_POST['tree'] == 'manage') {
            $node = teachers::model()->findByPK($_POST['node']);
            $nodeTo = teachers::model()->findByPK($_POST['nodeto']);
            if(isset($_POST['add']) && $_POST['add']) {
                $newNode = new teachers;
                $newNode->name = $_POST['name'];
                $node->appendChild($newNode);
            }
            if(isset($_POST['newname']) && $_POST['newname']) {
                $node->renameNode($node, strip_tags((string) $_POST['newname']));
            }
            if(isset($_POST['delete']) && $_POST['delete']) {
                $node->deleteNode(true);
            }
            if(isset($_POST['up']) && $_POST['up']) {
                $node->moveLeft();
            }
            if(isset($_POST['down']) && $_POST['down']) {
                $node->moveRight();
            }
            if(isset($_POST['before']) && $_POST['before']) {
                $node->moveBefore($nodeTo);
            }
            if(isset($_POST['below']) && $_POST['below']) {
                $node->moveBelow($nodeTo);
            }
            $this->refresh();
        }
        $categories = $model->findAll(array('order' => 'lft'));
        $data = CHtml::listData($categories, 'id', 'nameExt');
        $this->render('admin', array(
            'data' => $data,
        ));
    }

    protected function performAjaxValidation($model) {
        if(isset($_POST['ajax']) && $_POST['ajax'] === 'subjects-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
