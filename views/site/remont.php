<?php
//test
use yii\helpers\Html;
$connection = Yii::$app->db;
$command = $connection->createCommand("SELECT title, content FROM page WHERE main_menu = 1 AND route = 'remont'");
$page = $command->queryOne();
$this->title = $page['title'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
	<?php echo $page['content']; ?>
    <code><?= __FILE__ ?></code>
</div>