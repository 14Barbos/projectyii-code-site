<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\ArticleSearch;

class ArticleController extends Controller
{
    public function actionView($id)
    {
        $article = Article::findOne($id);

        if ($article === null) {
            throw new \yii\web\NotFoundHttpException("Статья с айди $id не найдена");
        }

        return $this->render('view', [
            'article' => $article,
        ]);
    }
    public function actionSearch()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
}
