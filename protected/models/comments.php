<?php

/**
 * Comments model
 * @copyright 2011
 * @author Dmitry Korotovsky <rmpic30@gmail.com> 
 * @license BSD
 */
class comments extends CActiveRecord {
    public $parent;
    public $type;
    public $votes;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'comments';
    }

    /**
     * Подключаем NestedSet поведение для древовидных структур.  
     */
    public function behaviors(){
        return array(
            'tree' => array(
                'class' => 'application.behaviors.ENestedSetBehavior',
                'hasManyRoots' => true,
                'root' => 'root',
                'left' => 'lft',
                'right' => 'rgt',
                'level' => 'level',
            ),
        );
    }

    public function rules() {
        return array(
            array('text', 'required'),
            array('parent', 'safe'),
        );
    }

    public function relations() {
        return array(
            'users' => array(self::BELONGS_TO, 'users', 'user_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'text' => 'Комментарий'
        );
    }

    function onAfterValidate($event) {
        if(!Yii::app()->request->isAjaxRequest) {
            $this->text = preg_replace('(\r\n|\n|\r)', '<br />', $this->text);
        }
        return parent::onAfterValidate($event);
    }

    /**
     *  Метод создает новый корень для NestedSet.
     *  Потом к нему добавляются комментарии. 
     */
    public function newRoot() {
        $comment = new comments;
        $comment->text = 'root';
        $comment->user_id = Yii::app()->user->id;
        $comment->created = new CDbExpression('NOW()');
        $comment->saveNode();
        return $comment->id;
    }

    /**
     *  Метод загружает комментарии для видео со связью логов комментирования
     *  этой ветки. Чтобы правильно расставить классы для голосования.
     */
    public function loadComments($id) {
        $root = comments::model()->roots()->findByPk($id);
        return $root->descendants()->with('users')->findAll();
    }

    /**
     *  Метод для предупреждения полома верстки. Не дает делать отступ
     *  у комментария с уровнем 18 больше 18*20 пикселей.
     *  TODO: 20 надо бы в константу в конфиг вынести.
     */
    public function getMargin($level) {
        if($level > 18) {
            return (18 * 20) - 20;
        } else {
            return ($level * 20) - 20;
        }
    }
}
