<?php

use yii\helpers\Html;

$this->title = 'Результаты поиска';

?>

<div class="container">
    <?php if ($dataProvider->getTotalCount() > 0): ?>
        <?php if ($dataProvider->getTotalCount() === 1): ?>
            <br>
            <div class="alert alert-success" style="border: 2px solid #A52A2A; background-color: #A52A2A; box-shadow: 0 0 12px #A52A2A" role="alert">
                <a style="color: white">По вашему запросу найдена статья.</a>
            </div>
        <?php else: ?>
            <br>
            <div class="alert alert-success" style="border: 2px solid #A52A2A; background-color: #A52A2A; box-shadow: 0 0 12px #A52A2A" role="alert">
                <a style="color: white">По вашему запросу найдено несколько статей.</a>
            </div>
        <?php endif; ?>
        <div class="row mb-3">
            <?php foreach ($dataProvider->getModels() as $article): ?>
                <div class="col-md-3 mb-2">
                    <div class="card custom-card" style="width: 18rem; background-color: #2e2e2e; margin-top: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; border: 2px solid #CD5C5C; box-shadow: 0 0 12px #CD5C5C">
                        <a href="<?= yii\helpers\Url::to(['article/view', 'id' => $article->id]) ?>" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; display: block;"></a>
                        <img src="<?= $article->image ?>" style="height: 200px;">
                        <div class="back">
                            <div class="card-body text-center" style="height: 120px; overflow: hidden; background-color: #2e2e2e">
                                <h5 style="color: white" class="card-title"><?= $article->title ?></h5>
                            </div>
                        </div>   
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            Статья не найдена.
        </div>
    <?php endif; ?>
    <?= Html::a('Назад', yii\helpers\Url::to(['site/index']), ['class' => 'btn btn-primary mt-3', 'style' => 'background-color: #007BFF; border-color: #007BFF;']) ?>
</div>