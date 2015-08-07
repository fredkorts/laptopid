<?php

/* 
 * This file is part of the Dektrium project
 * 
 * (c) Dektrium project <http://github.com/dektrium>
 * 
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $user
 */

?>

<?php $this->beginContent('@dektrium/user/views/admin/update.php', ['user' => $user]) ?>

    <table class="table">
        <tr>
            <td><strong><?= Yii::t('user', 'Registreerimise aeg') ?>:</strong></td>
            <td><?= Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$user->created_at]) ?></td>
        </tr>
        <?php if ($user->registration_ip !== null): ?>
        <tr>
            <td><strong><?= Yii::t('user', 'Registreerimise IP') ?>:</strong></td>
            <td><?= $user->registration_ip ?></td>
        </tr>
        <?php endif ?>
        <tr>
            <td><strong><?= Yii::t('user', 'Kinnitus') ?>:</strong></td>
            <?php if ($user->isConfirmed): ?>
            <td class="text-success"><?= Yii::t('user', 'KINNITATUD - {0, date, MMMM dd, YYYY HH:mm}', [$user->created_at]) ?></td>
            <?php else: ?>
            <td class="text-danger"><?= Yii::t('user', 'KINNITAMATA') ?></td>
            <?php endif ?>
        </tr>
        <tr>
            <td><strong><?= Yii::t('user', 'Blokk') ?>:</strong></td>
            <?php if ($user->isBlocked): ?>
            <td class="text-danger"><?= Yii::t('user', 'BLOKEERITUD - {0, date, MMMM dd, YYYY HH:mm}', [$user->blocked_at]) ?></td>
            <?php else: ?>
            <td class="text-success"><?= Yii::t('user', 'BLOKEERIMATA') ?></td>
            <?php endif ?>
        </tr>
    </table>

<?php $this->endContent() ?>
