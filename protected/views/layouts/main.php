<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-1.1.1.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.png" />
    <?php Yii::app()->clientScript->registerCoreScript('jquery') ?>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-25797829-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
</head>

<body>

    <div class="topbar">
       <div class="fill">
           <div class="container">
            <h3><a title="... с блэкджеком и шлюхами!" href="<?php echo Yii::app()->createUrl('/site/index') ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a></h3>
            <?php if(!Yii::app()->user->isGuest) { ?>
                <?php $this->widget('zii.widgets.CMenu',array(
                    'items' => array(
                        array('label'=>'Главная', 'url' => array('/site/index')),
                        array('label'=>'Архив', 'url' => array('/archive/index')),
                        # array('label'=>'Преподаватели', 'url' => array('/teachers/index')),
                        array('label'=>'Добавить файл', 'url' => array('/archive/add'), 'visible'=>!Yii::app()->user->isGuest),
                    ),
                )); ?>
            <?php } else { ?>
                <?php $this->widget('zii.widgets.CMenu',array(
                    'items' => array(
                        array('label'=>'Главная', 'url' => array('/site/index')),
                        array('label'=>'Архив', 'url' => array('/archive/index')),
                        # array('label'=>'Преподаватели', 'url' => array('/teachers/index')),
                    ),
                )); ?>
            <?php } ?>
                <ul class="nav secondary-nav">
                <li class="menu">
                  <?php if(!Yii::app()->user->isGuest) { ?>
                  <a href="#" class="menu">Аккаунт</a>
                  <ul class="menu-dropdown">
                    <!--<li><a href="#">Настройки</a></li>
                    <li class="divider"></li>-->
                    <li><a href="<?php echo Yii::app()->createUrl('/site/logout') ?>">Выход</a></li>
                  </ul>
                  <?php } else { ?>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('/site/login') ?>">Авторизация</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('/site/register') ?>">Регистрация</a>
                    </li>
                  <?php } ?>
                </li>
              </ul>
        </div>
        </div>
    </div>

    <?php echo $content ?>

    <footer>
    <div class="inner">
        <div class="container">
            <p class="right"><a href="#">Наверх</a></p>
            Copyleft &copy; <?php echo date('Y'); ?> by СПбГЭТУ.<br/>
            <?php echo Yii::powered(); ?>
        </div>
    </div>
    </footer>
    <br />

    <script type="text/javascript">
    /*<![CDATA[*/
    $(function($) {
        $("body").live("click", function (e) {
            $('a.menu').parent("li").removeClass("open");
        });
        $("a.menu").live("click", function (e) {
            $(this).parent("li").toggleClass('open');
            return false;
        });
        $("a.close").live("click", function (e) {
            $(this).parent("div").slideUp("fast", function() { $(this).hide(); } );
            return false;
        });
    });
    /*]]>*/
    </script>
</body>
</html>
