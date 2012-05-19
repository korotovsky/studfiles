<?php

class subjects extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'subjects';
    }

    public function rules() {
        return array(
            array('sid, subjname', 'required'),
            array('sid', 'numerical', 'integerOnly'=>true),
            array('subjname', 'length', 'max'=>255),

            array('id, sid, subjname', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'Id',
            'sid' => 'Sid',
            'subjname' => 'Subjname',
        );
    }

    public function search() {
        $criteria=new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('sid', $this->sid);
        $criteria->compare('subjname', $this->subjname, true);
        return new CActiveDataProvider('subjects', array(
            'criteria' => $criteria,
        ));
    }
}
