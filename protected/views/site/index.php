<?php $this->pageTitle = Yii::app()->name; ?>

<hr />
<h3>Этот сайт сочетает в себе все самое лучшее что только может быть.</h3>
<ul>
    <li>Бесплатная регистрация</li>
    <li>Скачивание файлов без регистрации</li>
    <li>Абсолютно бесплатное скачивание файлов</li>
    <li>Никаких ограниченией на скачивание</li>
    <li>Никаких рейтингов на аккаунтах пользователей</li>
</ul>

<p>Чтобы начать пользоваться сайтом, перейдите в <a href="<?php echo Yii::app()->createUrl('archive/index') ?>">Архив</a> файлов для выбора интересующего вас предмета.</p>
<p>Также, вы можете пройти <a href="<?php echo Yii::app()->createUrl('site/register') ?>">регистрацию</a> для того чтобы загружать файлы, помогите своим товарищам!</p>

<hr />
<p><h2>Помоги своему товарищу!</h2> Воспользуйся разделом для загрузки файлов на хранилище файлов. <a href="<?php echo Yii::app()->createUrl('archive/add') ?>">Загрузи</a> их прямо сейчас!</p>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-1820435160715571";
/* Center index */
google_ad_slot = "8367098407";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<hr />
<?php $this->widget('recentFiles'); ?>
