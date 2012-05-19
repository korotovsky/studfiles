<?php

class archive extends CActiveRecord {
    public $file;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'archive';
    }

    public function rules() {
        return array(
            array('semestr', 'required'),
            array('type', 'required'),
            array('filename', 'required'),
            array('sid', 'required'),
            array('id, sid, semestr, type, filename, description, uri', 'safe', 'on'=>'search'),

            array('description', 'safe'),
            array('semestr', 'safe'),
            array('type', 'safe'),
        );
    }


    public function relations() {
        return array(
            'types' => array(self::HAS_ONE, 'types', '', 'on' => '`t`.`type` = `types`.`id`'),
            'sems' => array(self::HAS_ONE, 'semestrs', '', 'on' => '`t`.`semestr` = `sems`.`id`'),

            'filterSems' => array(self::HAS_MANY, 'semestrs', '', 'on' => '`t`.`semestr` = `filterSems`.`id`'),
            'filterTypes' => array(self::HAS_MANY, 'types', '', 'on' => '`t`.`type` = `filterTypes`.`id`'),
            'filterSubj' => array(self::HAS_ONE, 'subjects', '', 'on' => '`t`.`sid` = `filterSubj`.`sid`'),
        );
    }

    public function attributeLabels() {
        return array(
            'sid' => 'Предмет',
            'semestr' => 'Семестр',
            'type' => 'Тип файла',
            'filename' => 'Название файла',
            'description' => 'Описание',
            'file' => 'Ваш файл'
        );
    }

    static public function getIconUrl($name) {
        $url = Yii::app()->baseUrl . '/images/file-icons/';
        $info = pathinfo(Yii::app()->basePath . '/../storage/' . $name);
        if(!isset($info['extension'])) {
            $url = $url . '_blank.png';
        } else {
            if(!in_array($info['extension'], Yii::app()->params['allowedExtensions'])) {
                $url = $url . '_blank.png';
            } else {
                $url = $url . $info['extension'] . '.png';
            }
        }
        return $url;
    }

    public function search() {
        $criteria=new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('sid', $this->sid);
        $criteria->compare('semestr', $this->semestr);
        $criteria->compare('type', $this->type);
        $criteria->compare('filename', $this->filename, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('uri', $this->uri, true);
        return new CActiveDataProvider('archive', array(
            'criteria' => $criteria,
        ));
    }
}
