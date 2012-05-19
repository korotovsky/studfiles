<?php

class ArchiveController extends Controller {
    public $layout='//layouts/archive';
    public $description;
    public $keywords;
    private $_model;

    public function beforeRender() {
        if (!empty($this->description)) {
            Yii::app()->clientScript->registerMetaTag($this->description, 'description');
        }
        if (!empty($this->keywords)) {
            Yii::app()->clientScript->registerMetaTag($this->keywords, 'keywords');
        }
        return true;
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
                'actions' => array('index', 'view', 'search', 'get'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('add'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('admin', 'update', 'delete'),
                'roles' => array('admin'),
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
    
        $this->description = 'Архив файлов СПбГЭТУ. Курсовики, лабы, методы, шпоры, бомбы, лекции, файлы, программы, ИДЗ, конспекты. Все для учебы.';
        $this->keywords = $this->description;

        $criteria = new CDbCriteria;
        $criteria->order = '`t`.`id` DESC';
        $criteria->with = array('types', 'sems');

        $subjects = subjects::model()->findAll();
        $dataProvider = new CActiveDataProvider('archive', array(
            'criteria' => $criteria,
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'subjects' => $subjects,
        ));
    }

    public function actionView() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
            $this->render('browser', array());
            Yii::app()->end();
        }     
    
        $criteria = new CDbCriteria;
        $criteria->condition = '`t`.`id` = :id';
        $criteria->params = array(':id' => (string) Yii::app()->request->getParam('id', null));
        $criteria->with = array(
                'sems',
                'types',
                'filterSubj',
        );

        $archive = archive::model()->find($criteria);
        if(!$archive) {
            throw new CHttpException(404, 'Ой! Кажется этот файл пропал.');
        }

        $modelComment = new comments;
        $this->performAjaxValidation($modelComment);

        $modelComments = comments::model()->loadComments($archive->root_id);
        if(empty($modelComment->parent)) {
            $modelComment->parent = $archive->root_id;
        }

        $this->description = 'Архив файлов СПбГЭТУ. Все для учебы. ' . $archive->filterSubj->subjname . '. ' . $archive->sems->name . ', ' . $archive->filename;
        $this->keywords = $archive->filterSubj->subjname . ', ' . $archive->sems->name . ', ' . $archive->filename;

        if(isset($_POST['comments'])) {
            $modelComment->attributes = $_POST['comments'];
            $modelComment->user_id = Yii::app()->user->id;
            $modelComment->created = new CDbExpression('NOW()');
            /*
             * Сначала ищем запись в базе по id. Смотрим, root это или нет.
             * В зависимости от этого выбираем нужный метод сохранения.
             */
            $parentComment = comments::model()->roots()->findByPk($modelComment->parent);
            if($parentComment) {
                if($modelComment->validate() && $parentComment->append($modelComment)) {
                    $this->refresh();
                } else {
                    $this->render('view', array(
                        'archive' => $archive,
                        'modelComments' => $modelComments,
                        'modelComment' => $modelComment,
                    ));
                }
            } else {
                $parentComment = comments::model()->findByPk($modelComment->parent);
                if($modelComment->validate() && $parentComment->append($modelComment)) {
                    $this->refresh();
                } else {
                    $this->render('view', array(
                        'archive' => $archive,
                        'modelComments' => $modelComments,
                        'modelComment' => $modelComment,
                    ));
                }
            }
        } else {
            $this->render('view', array(
                'archive' => $archive,
                'modelComments' => $modelComments,
                'modelComment' => $modelComment,
            ));
        }
    }

    public function actionSearch() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
            $this->render('browser', array());
            Yii::app()->end();
        }     
    
        $subject = Yii::app()->request->getParam('subject', null);
        $semestr = Yii::app()->request->getParam('semestr', null);
        $type = Yii::app()->request->getParam('type', null);

        $criteria = new CDbCriteria;
        $criteria->order = '`t`.`id` DESC';
        $criteria->with = array(
                'sems',
                'types',
                'filterSubj',
        );

        if($subject) {
            $criteria->addCondition('`t`.`sid` = :sid');
            $criteria->params[':sid'] = $subject;
        } else {
            Yii::app()->request->redirect(Yii::app()->createUrl('archive/index'));
        }

        if($semestr) {
            $criteria->addCondition('`t`.`semestr` = :semestr');
            $criteria->params[':semestr'] = $semestr;
        }

        if($type) {
            $criteria->addCondition('`t`.`type` = :type');
            $criteria->params[':type'] = $type;
        }

        $semestrs = semestrs::model()->getList(
            $subject
        );
        $types = types::model()->getList(
            $subject,
            $semestr
        );

        $archive = archive::model()->find($criteria);
        if(!$archive) {
            Yii::app()->request->redirect(Yii::app()->createUrl('archive/index'));
        }

        $dataProvider = new CActiveDataProvider('archive', array(
            'criteria' => $criteria,
        ));

        $this->description = 'Архив файлов СПбГЭТУ. Все для учебы. ' . $archive->filterSubj->subjname . '. ' . $archive->sems->name;
        $this->keywords = $archive->filterSubj->subjname . ', ' . $archive->sems->name;

        $this->render('search', array(
            'dataProvider' => $dataProvider,
            'archive' => $archive,

            'semestrs' => $semestrs,
            'types' => $types,

            'subject' => $subject,
            'semestr' => $semestr,
            'type' => $type
        ));
    }

    public function actionGet() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
            $this->render('browser', array());
            Yii::app()->end();
        }     
    
        $model = archive::model()->findbyPk((int) $_GET['id']);
        if(!$model) {
            throw new CHttpException(404, 'Ой! Кажется этот файл пропал.');
        }
        $hash = Yii::app()->request->getParam('hash', null);
        if($hash != md5($model->filename . $model->id)) {
            throw new CHttpException(500, 'Ключ для скачивания не верен.');
        }

        if(preg_match('/http(.*)+/i', $model->uri, $matches)) {
            Yii::app()->request->redirect($model->uri);
        } else {
            Yii::app()->request->sendFile($model->uri, 
                @file_get_contents(Yii::app()->basePath . '/../storage/' . $model->uri
            ));
        }

    }

    public function actionAdd() {
        $model = new archive;
        $model->file = CUploadedFile::getInstance($model, "file");

        $this->performAjaxValidation($model);

        if(isset($_POST['archive'])) {
            $model->attributes = $_POST['archive'];
            if($model->file === null) {
                $model->addError('file', 'Необходимо выбрать файл для загрузки');
            } else {
                $extensions = Yii::app()->params['allowedExtensions'];
                if(!in_array($model->file->extensionName, $extensions)) {
                    $model->addError('file', 'Этот тип файла не разрешен для загрузки');
                }
                if($model->file->size > 100663296) {
                    $model->addError('file', 'Файл слишком велик, для загрузки доступны файлы не более 100Мб');
                }
                if($model->semestr == 0 or $model->type == 0) {
                    $model->addError('semestr', 'Ошибка при заполнении');
                    $model->addError('type', 'Ошибка при заполнении');
                }
                /**
                 * Важный момент, тут после валидации, мы создаем новый корень
                 * комментариев и только потом сохраняем.
                 */
                $model->root_id = comments::model()->newRoot();
                if(!$model->hasErrors() and !empty($model->root_id) and $model->validate()) {
                    $name = date('U') . rand(1000, 9999) . '.' . $model->file->extensionName;
                    $model->uri = $name;
                    $model->user_id = Yii::app()->user->id;
                    if($model->file->saveAs(Yii::app()->basePath . '/../storage/' . $name)) {
                        if($model->save()) {
                            Yii::app()->request->redirect(Yii::app()->createUrl('archive/index'));
                        }
                    }
                }
            }
        }
        $sems = semestrs::model()->findAll();
        $semestrs[""] = 'Выберете семестр';
        foreach($sems as $sem) {
            $semestrs[$sem->id] = $sem->name;
        }
        $types = types::model()->findAll();
        $type[""] = 'Выберете тип';
        foreach($types as $item) {
            $type[$item->id] = $item->type;
        }

        $subjects = subjects::model()->findAll();
        $sids[""] = 'Выберете предмет';
        foreach($subjects as $item) {
            $sids[$item->sid] = $item->subjname;
        }
        $this->render('add', array(
            'model' => $model,
            'sids' => $sids,
            'semestrs' => $semestrs,
            'types' => $type
        ));
    }

    public function actionAdmin() {
        $model = new archive('search');
        $model->unsetAttributes();
        if(isset($_GET['archive']))
            $model->attributes = $_GET['archive'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionUpdate() {
        $model = $this->loadModel();
        $this->performAjaxValidation($model);

        if(isset($_POST['archive'])) {
            $model->attributes = $_POST['archive'];
            if($model->save())
                $this->redirect(array('view','id' => $model->id));
        }

        $sems = semestrs::model()->findAll();
        $semestrs[""] = 'Выберете семестр';
        foreach($sems as $sem) {
            $semestrs[$sem->id] = $sem->name;
        }
        $types = types::model()->findAll();
        $type[""] = 'Выберете тип';
        foreach($types as $item) {
            $type[$item->id] = $item->type;
        }

        $subjects = subjects::model()->findAll();
        $sids[""] = 'Выберете предмет';
        foreach($subjects as $item) {
            $sids[$item->sid] = $item->subjname;
        }
        $this->render('update', array(
            'model' => $model,
            'sids' => $sids,
            'semestrs' => $semestrs,
            'types' => $type
        ));
    }

    public function actionDelete() {
        if(Yii::app()->request->isPostRequest) {
            $this->loadModel()->delete();
            if(!isset($_GET['ajax']))
                $this->redirect(array('index'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function loadModel() {
        if($this->_model === null) {
            if(isset($_GET['id']))
                $this->_model = archive::model()->findbyPk($_GET['id']);
            if($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

    protected function performAjaxValidation($model) {
        if(isset($_POST['ajax']) && $_POST['ajax'] === 'archive-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
