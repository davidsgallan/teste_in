<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = Yii::t('app', 'Editar {modelClass}: ', [
    'modelClass' => 'User',
]) . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <script type="text/javascript">
        function fMasc(objeto,mascara) {
            obj=objeto
            masc=mascara
            setTimeout("fMascEx()",1)
        }
        function fMascEx() {
            obj.value=masc(obj.value)
        }

        function mCPF(cpf){
            cpf=cpf.replace(/\D/g,"")
            cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
            cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
            cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
            return cpf
        }
    </script>
    <div class="user-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'logradouro')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cpf')->textInput(['onkeydown' => 'javascript: fMasc( this, mCPF );','maxlength' => '14']) ?>

        <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cep')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'logradouro')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'bairro')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cidade')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'complemento')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->radioList($model->getStatusUser()) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
