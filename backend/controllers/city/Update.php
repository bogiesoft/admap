<?php

namespace backend\controllers\city;

use Yii;
use yii\base\Action;

class Update extends Action {

    public function run($id) {
        $id = (int) $id;
        $model = $this->controller->findModel($id);
                        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()){
                Yii::$app->session->setFlash('success', Yii::t('app', 'City successfully saved.'));
            }
            else{
                Yii::$app->session->setFlash('error', Yii::t('app', 'Error on saving city.'));
            }
        }
        
        return $this->controller->render('manage', [
            'model' => $model,
        ]);   
    }
}