<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var User $user
 */

$this->title = Yii::t('user', 'Loo kasutaja');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Kasutajad'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('/_alert', [
    'module' => Yii::$app->getModule('user'),
]) ?>

<?= $this->render('_menu') ?>

<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= Nav::widget([
                    'options' => [
                        'class' => 'nav-pills nav-stacked'
                    ],
                    'items' => [
                        ['label' => Yii::t('user', 'Kasutaja'), 'url' => ['/user/admin/create']],
                        ['label' => Yii::t('user', 'Profiil'), 'options' => [
                            'class' => 'disabled',
                            'onclick' => 'return false;'
                        ]],
                        ['label' => Yii::t('user', 'Informatsioon'), 'options' => [
                            'class' => 'disabled',
                            'onclick' => 'return false;'
                        ]],
                    ]
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="alert alert-info">
                    <?= Yii::t('user', 'Kasutaja informatsioon saadetakse emailile') ?>.
                    <?= Yii::t('user', 'Salasõna mitte määramisel, genereeritakse see automaatselt') ?>.
                </div>
                <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-sm-9',
                        ]
                    ],
                ]); ?>

                <?= $this->render('_user', ['form' => $form, 'user' => $user]) ?>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <?= Html::submitButton(Yii::t('user', 'Salvesta'), ['class' => 'btn btn-block btn-success']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>