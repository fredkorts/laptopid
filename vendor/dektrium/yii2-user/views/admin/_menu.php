<?php

/* 
 * This file is part of the Dektrium project
 * 
 * (c) Dektrium project <http://github.com/dektrium>
 * 
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\Nav;

?>

<?= Nav::widget([
    'options' => [
        'class' => 'nav-tabs',
        'style' => 'margin-bottom: 15px'
    ],
    'items' => [
        [
            'label'   => Yii::t('user', 'Kasutajad'),
            'url'     => ['/user/admin/index'],
        ],
        [
            'label' => Yii::t('user', 'Rollid'),
            'url'   => ['/rbac/role/index'],
            'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
        ],
        [
            'label' => Yii::t('user', 'Õigused'),
            'url'   => ['/rbac/permission/index'],
            'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
        ],
        [
            'label' => Yii::t('user', 'Loo'),
            'items' => [
                [
                    'label'   => Yii::t('user', 'Uus kasutaja'),
                    'url'     => ['/user/admin/create'],
                ],
                [
                    'label' => Yii::t('user', 'Uus roll'),
                    'url'   => ['/rbac/role/create'],
                    'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
                ],
                [
                    'label' => Yii::t('user', 'Uus õigus'),
                    'url'   => ['/rbac/permission/create'],
                    'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
                ]
            ]
        ]
    ]
]) ?>
