<?php
/**
 * Created by PhpStorm.
 * User: shark
 * Date: 14.05.2018
 * Time: 23:41
 */

namespace app\models;


class MetaTagManager
{
    /**
     * Constants for robots meta tag
     * @link http://www.robotstxt.org/meta.html
     */
    const ROBOTS_INDEX_FOLLOW = 0;
    const ROBOTS_NOINDEX_FOLLOW = 1;
    const ROBOTS_INDEX_NOFOLLOW = 2;
    const ROBOTS_NOINDEX_NOFOLLOW = 3;

    /**
     * @var null|MetaInfo
     */
    private $_model;
    private $data;
    private $defaultData = [
        'title' => 'фотограф Дмитрий Акулов',
        'description' => 'Фотограф в Киеве Дмитрий Акулов, работает в таких направлениях: фотосессия love-story, 
        свадебная фотосессия',
        'keywords' => 'фотограф, Дмитрий Акулов, киев, свадьба, фотосессия беременных, свадебная фотосессия, 
        фотосессия love-story, фотосессия беременности',
        'robots' => self::ROBOTS_INDEX_FOLLOW,
    ];

    private function createMetaTitle()
    {
        $title = $this->getData('title');
        if (!$title && $this->_model) {
            $title = $this->_model->title;
        }
        if (!$title) {
            $title = $this->defaultData['title'];
        }

        return $title;
    }

    private function createMetaDescription()
    {
        //description
        $description = $this->getData('description');
        if (!$description && $this->_model) {
            $description = $this->_model->description;
        }
        if (!$description) {
            $description = $this->defaultData['description'];
        }

        return $description;
    }

    private function creteMetaKeywords()
    {
        //keywords
        $keywords = $this->getData('keywords');
        if (!$keywords && $this->_model) {
            $keywords = $this->_model->keywords;
        }
        if (!$keywords) {
            $keywords = $this->defaultData['keywords'];
        }

        return $keywords;
    }

    private function createCanonical()
    {
        //canonical
        $canonical = $this->getData('canonical');
        if ($canonical === null) {
            $controller = \Yii::$app->controller;
            $queryParams = \Yii::$app->request->queryParams;
            if (empty($queryParams['slug'])) {
                $canonical = \Yii::$app->urlManager->createAbsoluteUrl(
                    [
                        '/' . $controller->id . '/' . $controller->action->id,
                    ]);
            } else {
                $canonical = \Yii::$app->urlManager->createAbsoluteUrl(
                    [
                        '/' . $controller->id . '/' . $controller->action->id,
                        'slug' => $queryParams['slug']
                    ]);
            }
        }

        return $canonical;
    }

    public function creteMetaRobots()
    {
        $robots = $this->getData('robots');
        if (!is_int($robots) && $this->_model) {
            $robots = $this->_model->robots;
        }
        if (!is_int($robots)) {
            $robots = $this->defaultData['robots'];
        }

        return $robots;
    }

    function __construct($pageName, $data)
    {
        $this->_model = MetaInfo::find()->where(['page_name' => $pageName])->one();
        $this->data = $data;
    }

    public function getData($name)
    {
        if (empty($this->data) || !is_string($name)) return null;

        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    /**
     * @param null $model
     * @param array $data
     * @param array $options
     */
    public static function registerMetaTags($pageName = null, $data = [])
    {
        $manager = new self($pageName, $data);
        \Yii::$app->view->title = $manager->createMetaTitle();
        $description = $manager->createMetaDescription();
        $keywords = $manager->creteMetaKeywords();
        $canonical = $manager->createCanonical();
        $robots = $manager->creteMetaRobots();
        $type = 'website';

        if ($keywords) {
            \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $keywords],
                'keywords');
        }
        if ($description) {
            \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $description],
                'description');
            \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => $description],
                'og:description');
        }
        if ($canonical) {
            \Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => $canonical],
                'canonical');
            \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => $canonical],
                'og:url');
        }
        if ($type) {
            \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => $type],
                'og:type');
        }
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'akulov.kiev.ua'],
            'og:site_name');
        if (is_int($robots)) {
            self::registerMetaRobots($robots);
        }
    }

    public static function registerMetaRobots($robots, $skipDefault = false, $name = 'robots')
    {
        $content = isset(self::getRobotsList()[$robots])
            ? self::getRobotsList()[$robots]
            : self::getRobotsList()[self::ROBOTS_INDEX_FOLLOW];

        if (!$skipDefault or ($robots != self::ROBOTS_INDEX_FOLLOW)) {
            \Yii::$app->view->registerMetaTag(['name' => $name, 'content' => $content],
                'robots');
        }
    }

    /**
     * @return array
     */
    public static function getRobotsList()
    {
        return [
            self::ROBOTS_INDEX_FOLLOW => 'index, follow',
            self::ROBOTS_NOINDEX_FOLLOW => 'noindex, follow',
            self::ROBOTS_INDEX_NOFOLLOW => 'index, nofollow',
            self::ROBOTS_NOINDEX_NOFOLLOW => 'noindex, nofollow',
        ];
    }
}