<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'product_ids')->widget(\kartik\select2\Select2::class, [
    'data' => $model->getList(),
    'options' => [
        'placeholder' => 'products...',
        'multiple' => true
    ],
    'pluginOptions' => [
    'allowClear' => true
    ],

    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
