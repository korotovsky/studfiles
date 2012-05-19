<?php

class users extends CActiveRecord {
    public $verifyCode;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'users';
    }

    public function rules() {
        return array(
            array('username, password, role', 'required'),
            array('username, password', 'length', 'max' => 255),
            array('role', 'length', 'max'=>5),
            array('username', 'unique', 'className' => 'users'),
            array('id, username, password, role', 'safe', 'on'=>'search'),

            array('verifyCode', 'safe'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'Id',
            'username' => 'Логин',
            'password' => 'Пароль',
            'role' => 'Роль',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('role', $this->role, true);
        return new CActiveDataProvider('users', array(
            'criteria' => $criteria,
        ));
    }
}
