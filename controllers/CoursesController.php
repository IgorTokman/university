<?php

namespace app\controllers;

use app\models\Courses;
use Yii;
use yii\data\Pagination;

class CoursesController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $model = new Courses();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->save();

                //Sends message
                Yii::$app->getSession()->setFlash('success', 'Course Added');

                return $this->redirect('/index.php?r=courses/index');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($idcourse)
    {
        if(!is_null($idcourse)) {
            $course = Courses::findOne($idcourse);
            $course->delete();

            Yii::$app->getSession()->setFlash('success', 'Course Deleted');

            return $this->redirect('/index.php?r=courses/index');

        }
    }

    public function actionIndex()
    {
        //Creates query
        $query = Courses::find();

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count()
        ]);

        $courses = $query->orderBy('idcourses')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'pagination' => $pagination,
            'courses' => $courses
        ]);
    }

    public function actionUpdate($idcourse)
    {

        $course = Courses::findOne($idcourse);

        if ($course->load(Yii::$app->request->post())) {
            if ($course->validate()) {
                // form inputs are valid, do something here
                $course->save();

                //Sends message
                Yii::$app->getSession()->setFlash('success', 'Course Updated');

                return $this->redirect('/index.php?r=courses/index');
            }
        }

        return $this->render('update', [
            'model' => $course,
        ]);
    }

}
