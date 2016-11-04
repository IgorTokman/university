<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students_has_courses".
 *
 * @property integer $students_idstudents
 * @property integer $courses_idcourses
 *
 * @property Students $studentsIdstudents
 * @property Courses $coursesIdcourses
 */
class StudentsHasCourses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students_has_courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['students_idstudents', 'courses_idcourses'], 'required'],
            [['students_idstudents', 'courses_idcourses'], 'integer'],
            [['students_idstudents'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['students_idstudents' => 'idstudents']],
            [['courses_idcourses'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['courses_idcourses' => 'idcourses']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'students_idstudents' => 'Students Idstudents',
            'courses_idcourses' => 'Courses Idcourses',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentsIdstudents()
    {
        return $this->hasOne(Students::className(), ['idstudents' => 'students_idstudents']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesIdcourses()
    {
        return $this->hasOne(Courses::className(), ['idcourses' => 'courses_idcourses']);
    }
}
