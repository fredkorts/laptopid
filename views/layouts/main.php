<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\db;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<img src="http://laptopid.ee/img/logo.png">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
			$connection = Yii::$app->db;
			$command = $connection->createCommand("SELECT * FROM page WHERE main_menu = 1");
			$pages = $command->queryAll();
			
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
			foreach($pages as $p)
			{
				//$items[] = ];			
				echo Nav::widget([
					'options' => ['class' => 'navbar-nav navbar-right'],
					'items' => [
						['label' => $p['label'], 'url' => ['/site/'.$p['route']]
					],
				]]);
			}			
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'items' => [
					['label' => 'Soodus', 'url' => ['/site/index']],
					['label' => 'Tooted', 'url' => ['/site/tooted']],
				],
			]);
			
			//var_dump($items);die;
			
            /*echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
					$items,*/
                    /*
					['label' => 'Soodus', 'url' => ['/site/index']],
                    ['label' => 'Tooted', 'url' => ['/site/tooted']],
                    ['label' => 'Kasulikku', 'url' => ['/site/kasulikku']],
                    ['label' => 'Järelmaks', 'url' => ['/site/jarelmaks']],
                    ['label' => 'Rent', 'url' => ['/site/rent']],
                    ['label' => 'Teenused', 'url' => ['/site/teenused']],
                    ['label' => 'Remont', 'url' => ['/site/remont']],
                    ['label' => 'Ekraani vahetus', 'url' => ['/site/ekraanivahetus']],
                    ['label' => 'Boonused', 'url' => ['/site/boonused']],
                    ['label' => 'Kontakt', 'url' => ['/site/kontakt']],*/
                    /*Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);*/
			//var_dump(Nav::widget);
			
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
