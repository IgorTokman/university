<?php

namespace app\controllers;

use app\models\StudentsHasCourses;
use Yii;

class StudentsHasCoursesController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $model = new StudentsHasCourses();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->save();

                //Sends message
                Yii::$app->getSession()->setFlash('success', 'New Student-Course Relation Added');

                return $this->redirect('/index.php?r=courses/index');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
