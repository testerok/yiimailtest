<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SPEditUser */
/* @var $form ActiveForm */
?>
<div class="site-edituser">
	<?= Yii::$app->session->getFlash('access'); ?>
	<?= Yii::$app->session->getFlash('warning'); ?>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-edituser -->
