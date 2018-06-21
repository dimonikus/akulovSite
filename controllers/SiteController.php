<?php

namespace app\controllers;

use app\models\Image;
use app\models\MetaTagManager;
use app\models\TextPage;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\admin\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $items = Image::getSliderImages();
        $text = TextPage::findOne(['page_name' => 'main']);
        MetaTagManager::registerMetaTags('main', ['canonical' => false]);

        return $this->render('index', compact('items', 'text'));
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        if (!$model = TextPage::findOne(['page_name' => 'contact'])) {
            $model = new TextPage();
            $model->ru = '<p>Страница находится в стадии разработки!</p>';
        }
        MetaTagManager::registerMetaTags('contact');

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        if (!$model = TextPage::findOne(['page_name' => 'about'])) {
            $model = new TextPage();
            $model->ru = '<p>Страница находится в стадии разработки!</p>';
        }
        MetaTagManager::registerMetaTags('about');

        return $this->render('about', compact('model'));
    }

    public function actionSitemap()
    {
        $map = $serviceMap = [];
        $portfolioMap[] = [
            'label' => 'Свадьба',
            'url' => \Yii::$app->urlManager->createUrl(['/gallery/wedding'])
        ];
        $map[] = [
            'label' => 'Галерея',
            'url' => '',
            'level' => $portfolioMap,
        ];
        $map[] = [
            'label' => 'О нас',
            'url' => \Yii::$app->urlManager->createUrl(['/site/about']),
        ];
        $map[] = [
            'label' => 'Контакты',
            'url' => \Yii::$app->urlManager->createUrl(['/site/contact']),
        ];

        return $this->render('sitemap', ['map' => $map]);
    }

    public function actionSitemapXml()
    {
        $map[] = [
            'loc' => \Yii::$app->urlManager->createAbsoluteUrl(['/gallery/wedding']),
            'changefreq' => 'daily',
            'priority' => '0.5'
        ];
        $map[] = [
            'loc' => \Yii::$app->urlManager->createAbsoluteUrl(['/site/about']),
            'changefreq' => 'daily',
            'priority' => '0.5'
        ];
        $map[] = [
            'loc' => \Yii::$app->urlManager->createAbsoluteUrl(['/site/contact']),
            'changefreq' => 'daily',
            'priority' => '0.5'
        ];

        $dom = new \DOMDocument('1.0', 'utf-8');
        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        foreach ($map as $item) {
            $url = $dom->createElement('url');
            foreach ($item as $key => $value) {
                $elem = $dom->createElement($key);
                $elem->appendChild($dom->createTextNode($value));
                $url->appendChild($elem);
            }
            $urlset->appendChild($url);
        }
        $dom->appendChild($urlset);
        $xml = $dom->saveXML();
        file_put_contents('sitemap.xml', $xml);

        header("Content-type: text/xml");
        echo $xml;
    }
}
