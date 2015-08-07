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
	<script type="text/javascript" src="/js/jQuery-Autocomplete/scripts/jquery-2.1.1.js"></script>
	<script type="text/javascript" src="/js/jquery/jquery.form.js"></script>
	<script type="text/javascript" src="/js/jQuery-Autocomplete/src/jquery.autocomplete.js"></script>
    <?php $this->head() ?>
</head>
<body>

<?php 
$identity = Yii::$app->user->identity;
$is_admin = false;
if(isset($identity))
{
	$is_admin = $identity->isAdmin;	
}

$connection = Yii::$app->db;
$command = $connection->createCommand("SELECT * FROM page WHERE main_menu = 1 ORDER BY id DESC");
$pages = $command->queryAll();

$menuItems[] = ['label' => 'Soodus', 'url' => ['/']];
$menuItems[] = ['label' => 'Tooted', 'url' => ['/product']];
$menuItems[] = ['label' => 'Ostukorv('.count(Yii::$app->cart->getItems()).')', 'url' => ['/cart/index']];

if($is_admin)
{
	$menuItems[] = ['label' => 'Komponendid', 'url' => ['/field']];
	$menuItems[] = ['label' => 'Kasutajad', 'url' => ['/user/admin']];	
}

// Staatilised lehed
// foreach($pages as $p)
// {
	// $menuItems[] = ['label' => $p['label'], 'url' => ['/page/'.$p['id'].'/'.$p['route']]];
// }

// Set nav item active when urls match
foreach($menuItems as $key=>$item) {
	if($item['url'][0] == "/".Yii::$app->request->pathInfo)
		$menuItems[$key]['active'] = true;
}
?>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Laptopid.ee',
                //'brandLabel' => '<img src="http://laptopid.ee/img/logo.png">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
			
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    Yii::$app->user->isGuest ?
                        ['label' => 'Logi sisse', 'url' => ['/user/security/login']] :
                        ['label' => 'Logi välja (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-left'],
				'items' => $menuItems,
			]);
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
            <p class="pull-left">&copy; Laptopid.ee <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
