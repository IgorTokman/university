<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
?>
<div class="users-register">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'full_name') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'auth_key') ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'created_date') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- users-register -->
