<?php

namespace app\controllers;

use app\models\Users;
use Yii;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegister()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->save();

                return $this->redirect('/index.php');
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

}
