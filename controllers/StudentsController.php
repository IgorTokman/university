<?php

namespace app\controllers;

use app\models\Courses;
use app\models\Students;
use yii\data\Pagination;

class StudentsController extends \yii\web\Controller
{
    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionIndex($idcourse=null)
    {
        $students = array();
        $pagination = null;

        if (!is_null($idcourse)) {
            $course = Courses::findOne($idcourse);
            $query = $course->getStudentsIdstudents();

            $pagination = new Pagination([
                'defaultPageSize' => 20,
                'totalCount' => $query->count()
            ]);

            $students = $query->all();
        }
        else{
            $query = Students::find();

            $pagination = new Pagination([
                'defaultPageSize' => 20,
                'totalCount' => $query->count()
            ]);

            $students = $query
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }


        return $this->render('index', [
            'pagination' => $pagination,
            'students' => $students
        ]);
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

}
