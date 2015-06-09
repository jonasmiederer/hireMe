<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\CustomAppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
CustomAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- Hard Coded. Remove this in Application.php
    <link rel="stylesheet" href="/css/stylesheets/style.css">
    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script src="/js/footable.js"></script>
    <script src="/js/customScript.js"></script>
    -->


    <?php $this->head() ?>
</head>
<body class='<?= Yii::$app->controller->getBodyClasses() ?>'>
<?php $this->beginBody() ?>
<div class="wrap">
	
    <?php
    NavBar::begin([
        'brandLabel' => '<img id="navbar-logo" src="/images/hireMe-Web.png"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'id' => 'header'
        ],
    ]);
	
	/* Guest menu */
	
	if (Yii::$app->user->isGuest) {
        $menuItems = [
		['label' => 'Home', 'url' => ['/site/index']],
		['label' => 'About', 'url' => ['/site/about']],
		['label' => 'Login', 'url' => ['/site/login']],
		];
    }
	
	/* Recruiter menu */
	
	elseif (Yii::$app->user->identity->isRecruiter()){
		$menuItems = [
			['label' => 'Dashboard', 'url' => ['/dashboard']],
			['label' => 'Stellenanzeigen', 'url' => ['/job']],
			['label' => 'Bewerbungen', 'url' => ['#']],
			['label' => 'Nachrichten', 'url' => ['/message']],
			['label' => 'Analytics', 'url' => ['/analytics']],

			[
				'label' => Yii::$app->user->identity->firstName,
				'items' => [
					['label' => 'Als Bewerber nutzen', 'url' => '#'],
					['label' => 'Einstellungen', 'url' => '/user/settings'],
					[
						'label' => 'Logout',
						'url' => ['/site/logout'],
						'linkOptions' => ['data-method' => 'post']
					],
				],
			],
		];
	}
	
	/* Applicant menu */
	
    else {
        $menuItems = [
			['label' => 'Dashboard', 'url' => ['/dashboard']],
			['label' => 'Favoriten', 'url' => ['/favourites']],
			['label' => 'Bewerbungen', 'url' => ['/application']],
			['label' => 'Nachrichten', 'url' => ['/message']],
			['label' => 'Lebenslauf', 'url' => ['/resume']],
			['label' => 'Anlagen', 'url' => ['#']],

			[
				'label' => Yii::$app->user->identity->firstName,
				'items' => [
					['label' => 'Profil ansehen', 'url' => ['/user']],
					['label' => 'Einstellungen', 'url' => '/user/settings'],
					['label' => 'Als Recruiter nutzen', 'url' => '#'],
					[
						'label' => 'Logout',
						'url' => ['/site/logout'],
						'linkOptions' => ['data-method' => 'post']
					],
				],
			],
		];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; hireMe <?= date('Y') ?></p>
        <p class="pull-right">
            Made with <span class="glyphicon glyphicon-heart"></span> in Stuttgart


        </p>
        <!--<p class="pull-right"><?= Yii::powered() ?></p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
