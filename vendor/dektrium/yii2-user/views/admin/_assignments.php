<?php

/* 
 * This file is part of the Dektrium project
 * 
 * (c) Dektrium project <http://github.com/dektrium>
 * 
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\rbac\widgets\Assignments;
use dektrium\user\models\User;
use yii\web\View;

/**
 * @var View $this
 * @var User $user
 */

?>

<?php $this->beginContent('@dektrium/user/views/admin/update.php', ['user' => $user]) ?>

    <?= yii\bootstrap\Alert::widget([
        'options' => [
            'class' => 'alert-info'
        ],
        'body' => Yii::t('user', 'Siin on võimalik määrata kasutajale mitmeid rolle ja õigusi.'),
    ]) ?>

    <?= Assignments::widget(['userId' => $user->id]) ?>

<?php $this->endContent() ?>
