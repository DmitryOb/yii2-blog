<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
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
		$data = Article::getAll(1);
		$popular = Article::getPopular();
		$recent = Article::getRecent();
		$categories = Category::getAll();

        return $this->render('index', [
        	'articles' => $data['articles'],
			'pagination' => $data['pagination'],
			'popular' => $popular,
			'recent' => $recent,
			'categories' => $categories,
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

    public function actionView($id)
	{
		$article = Article::findOne($id);
		$popular = Article::getPopular();
		$recent = Article::getRecent();
		$categories = Category::getAll();
		return $this->render('single', [
			'article' => $article,
			'popular' => $popular,
			'recent' => $recent,
			'categories' => $categories,
		]);
	}

	public function actionCategory($id)
	{

		$data = Category::getArticlesByCategory($id);

		$popular = Article::getPopular();
		$recent = Article::getRecent();
		$categories = Category::getAll();

		return $this->render('category', [
			'articles' => $data['articles'],
			'pagination' => $data['pagination'],
			'popular' => $popular,
			'recent' => $recent,
			'categories' => $categories
		]);
	}

}
