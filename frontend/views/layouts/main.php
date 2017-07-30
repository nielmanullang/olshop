<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
                'brandLabel' => 'Olshop',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Produk', 'url' => ['/produk/index']],
//                ['label' => 'Kategori', 'url' => ['/kategori/index']],
                [
                    'label' => 'Kategori',
                    'icon' => 'fa fa-share',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Handphone', 'icon' => 'fa fa-file-code-o', 'url' => ['/produk/handphone'],],
                        ['label' => 'Televisi', 'icon' => 'fa fa-file-code-o', 'url' => ['/produk/televisi'],],
                        ['label' => 'Kulkas', 'icon' => 'fa fa-file-code-o', 'url' => ['/produk/kulkas'],]
                    ],
                ],
                ['label' => 'Toko', 'url' => ['/toko/index']],
            ];

            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Register', 'url' => ['/site/register']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = ['label' => 'Pembelian', 'url' => ['/pembelian/view-pembeli']];
//                $menuItems[] = ['label' => 'Toko Saya', 'url' => ['/toko/index-saya']];
//                $menuItems[] = ['label' => 'Toko', 'url' => ['/toko/index']];
                $menuItems[] = [
                    'label' => Yii::$app->user->identity->username,
                    'icon' => 'fa fa-share',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Toko Saya', 'icon' => 'fa fa-file-code-o', 'url' => ['/toko/index-saya'],],
                        ['label' => 'Penjualan', 'icon' => 'fa fa-file-code-o', 'url' => ['/pembelian/view-penjual'],],
                        ['label' => 'Logout', 'icon' => 'fa fa-dashboard', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                    ],
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; TA D3TI-19 <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
