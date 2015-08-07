<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var $this yii\web\View
 */

use yii\bootstrap\Nav;

?>

<?= Nav::widget([
    'options' => [
        'class' => 'nav-tabs'
    ],
    'items' => [
        [
            'label'   => Yii::t('rbac', 'Kasutajad'),
            'url'     => ['/user/admin/index'],
            'visible' => isset(Yii::$app->extensions['dektrium/yii2-user']),
        ],
        [
            'label' => Yii::t('rbac', 'Rollid'),
            'url'   => ['/rbac/role/index'],
        ],
        [
            'label' => Yii::t('rbac', 'Õigused'),
            'url'   => ['/rbac/permission/index'],
        ],
        [
            'label' => Yii::t('rbac', 'Loo'),
            'items' => [
                [
                    'label'   => Yii::t('rbac', 'Uus kasutaja'),
                    'url'     => ['/user/admin/create'],
                    'visible' => isset(Yii::$app->extensions['dektrium/yii2-user']),
                ],
                [
                    'label' => Yii::t('rbac', 'Uus roll'),
                    'url'   => ['/rbac/role/create']
                ],
                [
                    'label' => Yii::t('rbac', 'Uus õigus'),
                    'url'   => ['/rbac/permission/create']
                ]
            ]
        ]
    ]
]) ?>
