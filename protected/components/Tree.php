<?php

class Tree extends CWidget {
    public function run() {
        $model = teachers::model()->findByPk(1);
        $tree = $model->getTreeViewData(false);
        $this->render('tree', 
            array('tree' => $tree)
        );
    }
}

?>
