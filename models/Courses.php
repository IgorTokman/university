<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property integer $idcourses
 * @property string $title
 * @property string $start_date
 * @property string $end_date
 *
 * @property StudentsHasCourses[] $studentsHasCourses
 * @property Students[] $studentsIdstudents
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['start_date', 'end_date'], 'safe'],
            [['title'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcourses' => 'Idcourses',
            'title' => 'Title',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentsHasCourses()
    {
        return $this->hasMany(StudentsHasCourses::className(), ['courses_idcourses' => 'idcourses']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentsIdstudents()
    {
        return $this->hasMany(Students::className(), ['idstudents' => 'students_idstudents'])->viaTable('students_has_courses', ['courses_idcourses' => 'idcourses']);
    }
}
