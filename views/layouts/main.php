<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

 <!-- ***** Хедер ***** -->
 <header class="header-area header-sticky header" id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <?php
                        NavBar::begin([
                            'brandLabel' => 'Barbos',
                            'brandUrl' => Yii::$app->homeUrl,
                            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
                        ]);
                        echo Nav::widget([
                            'options' => ['class' => 'navbar-nav'],
                            'items' => [
                                ['label' => 'Главная', 'url' => ['/site/index']],
                                ['label' => 'Контакты', 'url' => ['/site/contact']],
                                ['label' => 'О нас', 'url' => ['/site/about']],
                            ]
                        ]);
                        NavBar::end();
                    ?>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Меню ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Хедер ***** -->

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer-distributed">
    <div class="footer-left">
	 <p class="footer-links">
	  <a class="link-1" href="/php/projectyii/web/">Главная</a>
      <a href="/php/projectyii/web/site/contact">Контакты</a>
	  <a href="/php/projectyii/web/site/about">О нас</a>
	 </p>
	 <p>Barbos &copy; 2023</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
