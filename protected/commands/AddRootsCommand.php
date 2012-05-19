<?php

class AddRootsCommand extends CConsoleCommand {

    public function run($args) {
        $models = archive::model()->findAll();
        foreach($models as $model) {
            if($model->root_id == 0) {
                $model->root_id = comments::model()->newRoot();
                $model->save();
            }
        }
    }

}

?>
