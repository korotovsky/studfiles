<?php

class recentFiles extends CWidget {

    public function init() {
        $criteria = new CDbCriteria;
        $criteria->limit = 4;
        $criteria->order = '`t`.`id` DESC';
        $criteria->with = array('sems', 'types', 'filterSubj');

        $files = archive::model()->findAll($criteria);

        $this->render('recentFiles', array('recentFiles' => $files));
    }
}

?>
