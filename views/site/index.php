<?php

/** @var yii\web\View $this */
use app\models\Article;

$this->title = 'Barbos \ Статьи о программировании';

$randomArticles = Article::find()->orderBy('RAND()')->limit(6)->all();

$selectedGenre = Yii::$app->request->get('genre');

?>


<div class="site-index">


    <!-- Надпись и поиск -->
    <div class="pad">
        <div class="block" style="border: 2px solid #A52A2A; background-color: #A52A2A; box-shadow: 0 0 12px #A52A2A">
            <nav style="border-radius: 200px: background-color: green" class="navbar navbar-light">
                <div class="container-fluid">
                    <a style="color: white" class="navbar-brand">Случайные статьи</a>
                    <form class="d-flex" method="get" action="<?= yii\helpers\Url::to(['article/search']) ?>">
                       <input style="border: 2px solid #2e2e2e; box-shadow: 0 0 12px #2e2e2e; background-color: #2e2e2e; color: #FFF;" 
                       class="form-control me-2" type="search" placeholder="Поиск статей" aria-label="Поиск" name="ArticleSearch[title]">
                       <button style="color: white; border-radius: 8px; background-color: #2e2e2e; border: 2px solid #2e2e2e; box-shadow: 0 0 12px #2e2e2e" type="submit">Найти</button>
                    </form>
                </div>
            </nav>
        </div>
    </div>

    
    <!-- Случайные карточки -->
    <div class="body-content">
        <div class="top" style="display: flex; flex-wrap: wrap; justify-content: space-between;" id="randomArticlesBlock">
            <?php foreach ($randomArticles as $article): ?>
                <a href="<?= yii\helpers\Url::to(['article/view', 'id' => $article->id]) ?>" class="card p-2 mb-2" style="width: 25rem; border-radius: 10px; position: relative; background-color: #2e2e2e; border: 2px solid #FA8072; box-shadow: 0 0 12px #CD5C5C; text-decoration: none;">
                    <img src="<?= $article->image ?>" alt="<?= $article->title ?>" class="card-img-top" style="border-radius: 10px; height: 200px;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 style="color: white" class="card-title"><?= $article->title ?></h5>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- Категории -->
    <div style="background-color: #262626; border-radius: 10px; margin-top: 20px">
        <h3 style="padding-top: 20px; padding-left: 15px; text-align: center; color: white" class="logo">
            <?php echo isset($selectedGenre) ? '' . $selectedGenre . '' : 'Категории'; ?>
        </h3>
        <div style="padding-top: 20px" class="container">
            <div class="row mb-3">
                <?php $genresCount = count($genres); ?>
                <?php $genresPerColumn = ceil($genresCount / 3); ?>
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <div class="col-md-4 mb-3">
                        <div class="d-flex flex-column">
                            <?php for ($j = $i * $genresPerColumn; $j < min(($i + 1) * $genresPerColumn, $genresCount); $j++): ?>
                                <a href="<?= yii\helpers\Url::to(['site/index', 'genre' => $genres[$j]]) ?>"
                                    style="border: 2px solid #A52A2A; background-color: #A52A2A; box-shadow: 0 0 12px #A52A2A" class="btn btn-sm btn-success mb-2 <?= $selectedGenre == $genres[$j] ? 'active' : '' ?>">
                                    <?= $genres[$j] ?>
                                </a>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>


    <!-- Карточки в категории -->
    <div class="container">
    <div class="row mb-2">
        <?php for ($i = 0; $i < count($contacts); $i++): ?>
            <div class="col-md-3 mb-2">
                <div class="card custom-card" style="width: 18rem; background-color: #2e2e2e; margin-top: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; border: 2px solid #CD5C5C; box-shadow: 0 0 12px #CD5C5C">
                    <a href="<?= yii\helpers\Url::to(['article/view', 'id' => $contacts[$i]['id']]) ?>" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; display: block;"></a>
                    <img src="<?= $contacts[$i]['image'] ?>" style="height: 200px;">
                    <div class="back">
                        <div class="card-body text-center" style="height: 120px; overflow: hidden; background-color: #2e2e2e">
                            <h5 style="color: white" class="card-title"><?= $contacts[$i]['title'] ?></h5>
                        </div>
                    </div>   
                </div>
            </div>
            <?php if (($i + 1) % 4 === 0): ?>
                </div>
                <div class="row mb-2">
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>


<!-- Навигация по страницам -->
<div class="d-flex justify-content-center" style="padding-top:50px;">
                        <?php
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pagination,
                            'prevPageLabel' => '«',
                            'nextPageLabel' => '»',
                            'firstPageLabel' => 'В начало',
                            'lastPageLabel' => 'Последняя (' . $pagination->getPageCount() . ')',
                            'maxButtonCount' => 10,
                            'options' => ['class' => 'pagination'],
                            'linkOptions' => ['class' => 'page-link'],
                            'disabledListItemSubTagOptions' => ['class' => 'page-link'],
                            'activePageCssClass' => 'active',
                            'nextPageCssClass' => 'page-item next',
                            'prevPageCssClass' => 'page-item prev',
                            'pageCssClass' => 'page-item',
                        ]);
                        ?>
                    </div>
                        
</div>
