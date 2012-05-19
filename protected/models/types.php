<?php

class types extends CActiveRecord {
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'types';
    }

    public function rules() {
        return array(
            array('type', 'required'),
            array('type', 'length', 'max'=>255),

            array('id, type', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'archive' => array(self::HAS_MANY, 'archive', '', 'on' => '`archive`.`type` = `t`.`id`'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'Id',
            'type' => 'Type',
        );
    }

    public function getList($subject, $semestr) {
        $criteria = new CDbCriteria;
        $criteria->with = array('archive');
        $criteria->group = '`t`.`type`';

        if($semestr) {
            $criteria->condition = '`archive`.`sid` = :sid AND `archive`.`semestr` = :semestr';
            $criteria->params = array(
                ':sid' => $subject,
                ':semestr' => $semestr,
            );
        } else {
            $criteria->condition = '`archive`.`sid` = :sid';
            $criteria->params = array(
                ':sid' => $subject,
            );
        }

        $model = types::model()->findAll($criteria);

        $types[""] = 'Любой тип';
        foreach($model as $s) {
            $types[$s->id] = $s->type;
        }

        return $types;
    }

    public function search() {
        $criteria=new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('type', $this->type, true);
        return new CActiveDataProvider('types', array(
            'criteria' => $criteria,
        ));
    }
}
