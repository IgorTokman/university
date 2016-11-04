<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentsHasCourses */
/* @var $form ActiveForm */
?>
<div class="students-has-courses-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'students_idstudents')->dropDownList(\app\models\Students::getList()) ?>

        <?= $form->field($model, 'courses_idcourses')->dropDownList(\app\models\Courses::getList()) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- students-has-courses-create -->
