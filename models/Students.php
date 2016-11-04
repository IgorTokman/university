<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property integer $idstudents
 * @property string $name
 * @property string $address
 * @property string $phone
 *
 * @property StudentsHasCourses[] $studentsHasCourses
 * @property Courses[] $coursesIdcourses
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone'], 'required'],
            [['name', 'address'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idstudents' => 'Idstudents',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentsHasCourses()
    {
        return $this->hasMany(StudentsHasCourses::className(), ['students_idstudents' => 'idstudents']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesIdcourses()
    {
        return $this->hasMany(Courses::className(), ['idcourses' => 'courses_idcourses'])->viaTable('students_has_courses', ['students_idstudents' => 'idstudents']);
    }
}
