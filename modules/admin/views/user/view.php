<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <div style = "float:left;">
        <div>
        <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div style="margin-top: 65%">
        <p>
            <?= Html::a('Novo', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Deletar'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        </div>
    </div>
    <div style = "float:right;">
        <div>
            <style>
                .profile{
                    width: 160px;
                    height: 160px;
                    border-radius: 50%;
                    overflow: hidden;
                }

                .profile img{
                    width: 100%;
                }</style>
            <div class="profile">
                <img src="../../img/<?= $model->id; ?>.jpg">
                <img src="../../img/padrao/user.jpg">

        </div>
        <div style="margin: 2% 0 2% 0;"><button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">
                Mudar foto
            </button>
        </div>

    </div>
</div>
    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th{captionOptions} class="col-sm-2">{label}</th><td{contentOptions}>{value}</td></tr>',
        'attributes' => [
            'id',
            'username',
            'email:email',
            'status:status',
            'nome',
            'data_nascimento',
            'cpf',
            'telefone',
            'cep',
            'logradouro',
            'bairro',
            'cidade',
            'estado',
            'complemento',
            'criado_em:date',
            'alterado_em:date',
            'cadastrador',

        ],
    ])
    ?>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Escolha o arquivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/teste_inovall-master/web/assets/up.php" method="post" enctype="multipart/form-data">
                    <p>
                        <input type="text" hidden value="<?=  $model->id; ?>" name="nome" />
                        <input type="file" accept="image/png,image/jpeg,image/gif" name="userfile" />
                    </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

