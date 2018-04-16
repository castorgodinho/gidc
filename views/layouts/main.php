<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Company;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        'brandLabel' => 'GIDC',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $link = [];
    if(Yii::$app->user->isGuest){
        $link[] = ['label' => 'Login', 'url' => ['/site/login']];
    }else{
        if(\Yii::$app->user->can('admin')){
            $link[] = ['label' => 'Area', 'url' => ['/area/index']];
            $link[] = ['label' => 'Company', 'url' => ['/company/index']];
            /* $link[] = ['label' => 'Plot', 'url' => ['/plot/index']]; */
            $link[] = ['label' => 'Interest', 'url' => ['/interest/index']];
            $link[] = ['label' => 'Orders', 'url' => ['/orders/index']];
            $link[] = ['label' => 'Tax', 'url' => ['/tax/index']];
            $link[] = ['label' => 'Rate', 'url' => ['/rate/index']];
            $link[] = ['label' => 'Invoice', 'url' => ['/invoice/index']];
            $link[] = ['label' => 'Payment', 'url' => ['/payment/index']];
            $link[] = ['label' => 'User', 'url' => ['/users/index']];
        }else if(\Yii::$app->user->can('company')){
            $link[] = ['label' => 'Profile', 'url' => ['/company/view', 'id' => Company::find()->where(['user_id' => Yii::$app->user->identity->user_id])->one()->company_id]];
            $link[] = ['label' => 'Change Password', 'url' => ['/users/change-password']];
        }else if(\Yii::$app->user->can('staff')){
            $link[] = ['label' => 'Add Company', 'url' => ['/company/create']];
            $link[] = ['label' => 'Change Password', 'url' => ['/users/change-password']];
        }else if(\Yii::$app->user->can('accounts')){
            $link[] = ['label' => 'Payment', 'url' => ['/payment/search']];
            $link[] = ['label' => 'Change Password', 'url' => ['/users/change-password']];
        }

        /* $link[] = ['label' => 'Invoice', 'url' => ['/invoice/print-invoice']]; */

        $link[] =['label' => 'Logout', 'url' => ['site/logout'],'linkOptions' => ['data-method' => 'post']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $link,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php if (Yii::$app->session->hasFlash('danger')): ?>
        <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?= Yii::$app->session->getFlash('danger') ?>
        </div>
        <?php endif; ?>
        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
