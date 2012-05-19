<?php

class semestrs extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'semestrs';
	}

	public function rules() {
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),

			array('id, name', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
            'archive' => array(self::HAS_MANY, 'archive', '', 'on' => '`archive`.`semestr` = `t`.`id`'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'Id',
			'name' => 'Name',
		);
	}

    public function getList($subject) {
        $criteria = new CDbCriteria;
        $criteria->with = array('archive');

        if($subject) {
            $criteria->condition = '`archive`.`sid` = :sid';
            $criteria->params = array(':sid' => $subject);
        }

        $criteria->group = '`t`.`name`';

        $model = semestrs::model()->findAll($criteria);

        $semestrs[""] = 'Любой семестр';
        foreach($model as $s) {
            $semestrs[$s->id] = $s->name;
        }
        return $semestrs;
    }

	public function search() {
		$criteria = new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		return new CActiveDataProvider('semestrs', array(
			'criteria' => $criteria,
		));
	}
}
