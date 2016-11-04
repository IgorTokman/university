<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="students-has-courses-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'full_name') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- students-has-courses-create -->