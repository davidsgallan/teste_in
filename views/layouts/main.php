<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Teste inovall',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);



    if (!Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<span class="glyphicon glyphicon-dashboard"></span> Dashboard', 'url' => ['/admin/default/dashboard']];
        $menuItems[] = [
            'label' => '<span class="glyphicon glyphicon-user"></span> Usuários',
            'url' => ['/#'],
            'options' => ['class' => 'dropdown'],
            'template' => '<a href="{url}" class="href_class">{label}</a>',
            'items' => [
                ['label' => '<span class="glyphicon glyphicon-user"></span> Usuários'],
                ['label' => '&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"></span> Adicionar Usuários', 'url' => ['/admin/user/create'],],
                ['label' => '&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-list"></span> Listar Usuários', 'url' => ['/admin/user/index'],],

            ]
        ];
        $menuItems[] = [
            'label' => '<span class="glyphicon glyphicon-log-out"></span> Sair (' . Yii::$app->user->identity->username . ')',
            'url' => ['/admin/default/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }else {
        $menuItems[] = ['label' => '<span class="glyphicon glyphicon-log-out"></span> Entrar', 'url' => ['admin/default/']];
    }


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Teste inovall
            <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
