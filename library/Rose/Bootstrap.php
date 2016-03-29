<?php

class Rose_Bootstrap
{
    public static $frontController;
    public static $registry;
    public static $configPath;
    public static $config;
    public static $route;
    public static $log_queries;

    public static function start($configPath)
    {
        self::$configPath = $configPath;

        self::$config = new Zend_Config_Xml(self::$configPath, APPSTAGE);

        Zend_Registry::set('config', self::$config);

        self::setupEnvironment();
        self::prepare();

        self::setupNavigation();
        $response = self::$frontController->dispatch();
        self::sendResponse($response);
    }

    public static function setupEnvironment()
    {
        $environment = self::$config->environment;

        date_default_timezone_set($environment->default_timezone);
        self::$log_queries = (self::$config->environment->log_queries)
            ? true
            : false;
    }

    public static function prepare()
    {
        self::$registry = Zend_Registry::getInstance();
        self::$registry->set('siteInfo', self::$config->site);
        self::$registry->set('path', self::$config->path);
        self::$registry->set('perpage', '12');
        self::$registry->set('config', self::$config);

        self::setupFrontController();
        self::setupView();
        self::setRoutes();
    }

    public static function setupFrontController()
    {
        self::$frontController = Zend_Controller_Front::getInstance();
        self::$frontController->returnResponse(true);
        self::$frontController->addModuleDirectory(
            ROOT_DIR.'/rose/modules/'
        );

        self::$frontController->setBaseUrl(self::$config->site->baseurl);
    }

    public static function setupView()
    {
        $view = new Zend_View();
        $view->setEncoding('UTF-8');

        $view->addHelperPath(
            ROOT_DIR.self::$config->path->library.'/Rose/View/Helper',
            'Rose_View_Helper'
        );

        $view->addScriptPath('../rose/modules/default/views/partials');

        $view->assign('appstage', APPSTAGE);

        Zend_Layout::startMvc(
            array('layoutPath' => '../rose/modules/default/views/layouts')
        );

        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
    }


    public static function setRoutes()
    {
        $router = self::$frontController->getRouter();
        $routes = array();
        $routes['apply'] = new Zend_Controller_Router_Route(
            'apply',
            array(
                'module'=>'default',
                'controller' => 'index',
                'action' => 'apply'
            )
        );

        if(count($routes) > 0)
        {
            foreach($routes as $key => $value)
            {
                $router->addRoute($key,$value);
            }
        }
    }

    public static function setupNavigation()
    {
        $container = new Zend_Navigation();
        $container->addPage(
            array(
                'label'      => 'Rose',
                'module'     => 'default',
                'controller' => 'index',
                'action'     => 'index',
                'order'      => -100, // make sure home is the first page
                'pages'      => array(
                      array(
                        'label'      => 'Apply',
                        'module'     => 'default',
                        'controller' => 'index',
                        'action'     => 'apply',
                        'route'      => 'apply'
                    )
                )
            )
        );

        Zend_Registry::set('Zend_Navigation', $container);
    }

    public static function sendResponse(Zend_Controller_Response_Http $response)
    {
            $response->sendResponse();
    }
}
