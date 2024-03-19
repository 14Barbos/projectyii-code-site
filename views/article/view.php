<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $article->title;
?>

<div class="container">
    <h1 style="color: white" class="mt-2"><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card" style="background-color: #121212; width: 18rem; border-radius: 10px; padding-top: 10px;">
                <div style="padding-top: 10px; border-radius: 10px; text-align: center;  border: 2px solid #800000; box-shadow: 0 0 12px #800000">
                    <img src="<?= Html::encode($article->image) ?>" class="img-fluid" alt="Image" style="border-radius: 10px; height: 250px; width: 250px; display: block; margin-left: auto; margin-right: auto;">
                    <div style="padding-top: 25px"></div>
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var clipboard = new ClipboardJS('#shareButton', {
                            text: function () {
                                return window.location.href;
                            }
                        });

                        clipboard.on('success', function (e) {
                            alert('Ссылка скопирована!');
                            e.clearSelection();
                        });

                        clipboard.on('error', function (e) {
                            alert('Не удалось скопировать ссылку. Используйте Ctrl+C (Cmd+C на Mac) для копирования.');
                        });
                    });
                </script>

                <div class="col-md-6 mt-3">
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <button id="shareButton" class="btn btn-secondary" style="background-color: #28a745; border-color: #28a745; width: 142px;">Поделиться</button>
                            </div>

                        <div style="margin-left: 4px;">
                            <?= Html::a('Назад', Url::to(['site/index']), ['class' => 'btn btn-primary', 'style' => 'background-color: #007BFF; border-color: #007BFF; width: 142px;']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" style="padding-top: 10px;">
            <div class="row" style="box-shadow: 0 2px 8px rgba(0, 0, 0, 0.7); border-radius: 10px;">
                <div class="col-md-12" style="background-color: #121212; border: 2px solid #800000; box-shadow: 0 0 12px #800000; border-radius: 10px;">
                    <p style="color: white; text-align: justify; font-family: " class="lead"><?= Html::encode($article->description) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
