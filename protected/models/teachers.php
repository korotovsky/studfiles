<?php

/**
 * This is the model class for table "teachers".
 *
 * The followings are the available columns in table 'teachers':
 * @property integer $id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $name
 */
class teachers extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @return teachers the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'teachers';
    }

    public function behaviors() {
        return array(
            'TreeBehavior' => array(
                'class' => 'TreeBehavior',
                '_idCol' => 'id',
                '_lftCol' => 'lft',
                '_rgtCol' => 'rgt',
                '_lvlCol' => 'level',
            ),
            'TreeViewTreebehavior' => array(
                'class' => 'TreeViewTreebehavior',
            )
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('lft, rgt, level', 'required'),
            array('lft, rgt, level', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),

            array('id, lft, rgt, level, name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Id',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
            'name' => 'Name',
        );
    }

    public function getNameExt() {
        return str_repeat('---', $this->level) . ' ' . $this->name;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('lft', $this->lft);
        $criteria->compare('rgt', $this->rgt);
        $criteria->compare('level', $this->level);
        $criteria->compare('name', $this->name, true); 
        return new CActiveDataProvider('teachers', array(
            'criteria' => $criteria,
        ));
    }
}
