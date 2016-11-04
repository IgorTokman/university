<?php

namespace app\models;

use app\behaviors\ManyToManyBehavior;
use Yii;
use yii\helpers\ArrayHelper;

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
//    public $students = [];
//
//    public function behaviors() {
//        return [
//            [
//                'class' => ManyToManyBehavior::className(),
//                'relations' => [
//                    [
//                        'editableAttribute' => 'students', // Editable attribute name
//                        'table' => 'students_has_courses', // Name of the junction table
//                        'ownAttribute' => 'courses_idcourses', // Name of the column in junction table that represents current model
//                        'relatedModel' => Students::className(), // Related model class
//                        'relatedAttribute' => 'students_idstudents', // Name of the column in junction table that represents related model
//                    ],
//                ],
//            ],
//        ];
//    }
    
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
//            [['students'], 'required'],
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
//            'students' => 'Students',
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

    public static function getList()
    {
        $models = static::find()->orderBy('title')->all();

        return ArrayHelper::map($models, 'idcourses', 'title');
    }
}
