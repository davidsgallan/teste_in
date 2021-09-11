<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_nascimento')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'cpf')->textInput(['onkeydown' => 'javascript: fMasc( this, mCPF );','maxlength' => '14']) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cep')->textInput(['id' => 'cep']) ?>

    <?= $form->field($model, 'logradouro')->textInput(['id' => 'logradouro']) ?>

    <?= $form->field($model, 'bairro')->textInput(['id' => 'bairro']) ?>

    <?= $form->field($model, 'cidade')->textInput(['id' => 'localidade']) ?>

    <?= $form->field($model, 'estado')->textInput(['id' => 'uf']) ?>

    <?= $form->field($model, 'complemento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passwordHash')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->radioList($model->getStatusUser()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
