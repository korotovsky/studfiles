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

    'components' => array(
        'user' => array(
            'allowAutoLogin' => true,
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
