<?php

namespace app\controllers;

use yii\data\Pagination;

use app\models\Contacts;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\Article;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $genres = Yii::$app->db->createCommand("SELECT DISTINCT genre FROM article")->queryColumn();
        $selectedGenre = Yii::$app->request->get('genre');
        $query = "SELECT `id`, `title`, `genre`, `image`, `description` FROM article";
        if ($selectedGenre) {
            $query .= " WHERE genre = :genre";
        }
        $query .= " ORDER BY id ASC";
        $params = ($selectedGenre) ? [':genre' => $selectedGenre] : [];
        $totalCountQuery = "SELECT COUNT(*) FROM ({$query}) as subquery";
        $contacts = Contacts::findBySQL($query, $params)->asArray()->all();
        $pagination = new Pagination([
            'totalCount' => Yii::$app->db->createCommand($totalCountQuery, $params)->queryScalar(),
            'pageSize' => 8,
        ]);
        $contacts = array_slice($contacts, $pagination->offset, $pagination->limit);
        return $this->render('index', [
            'contacts' => $contacts,
            'pagination' => $pagination,
            'selectedGenre' => $selectedGenre,
            'genres' => $genres,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
