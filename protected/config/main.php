<?php


return array(
    'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => 'Студенческие файлы СПбГЭТУ',

    'language' => 'ru',

    'preload' => array('log'),

    'import' => array(
        'application.models.*',
        'application.components.*',
    ),

    'modules' => array(

    ),

    'components' => array(
        'user' => array(
            'class' => 'WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => '/site/login',
        ),
        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),

        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=studfiles',
            'emulatePrepare' => true,
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
            'enableProfiling' => false,
            'enableParamLogging' => false,
        ),

        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                    'enabled' => false,
                ),
                array(
                    'class' => 'CProfileLogRoute',
                    'levels' => 'error, warning',
                    'enabled' => false,
                ),                
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'error, warning',
                    'enabled' => false,
                ),
            ),
        ),
    ),

    'params' => array(
        'adminEmail' => 'webmaster@example.com',
        'allowedExtensions' => array(
            'bmp', 'doc', 'exe', 'gif',
            'gz', 'tgz', 'jpg', 'jpeg',
            'pdf', 'png', 'ppt', 'psd',
            'rar', 'rtf', 'tiff', 'txt',
            'xls', 'xlst', 'zip', 'docx',
        ),
    ),
);
