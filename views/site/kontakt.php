<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Kontakt';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-kontakt">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

    <div class="alert alert-success">
        Thank you for contacting us. We will respond to you as soon as possible.
    </div>

    <p>
        Note that if you turn on the Yii debugger, you should be able
        to view the mail message on the mail panel of the debugger.
        <?php if (Yii::$app->mailer->useFileTransport): ?>
        Because the application is in development mode, the email is not sent but saved as
        a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
        Please configure the <code>useFileTransport</code> property of the <code>mail</code>
        application component to be false to enable email sending.
        <?php endif; ?>
    </p>

    <?php else: ?>

    <p>
		Sülearvutid OÜ<br>
		E-mail: <a href="mailto:laptopid@laptopid.ee">laptopid@laptopid.ee</a><br>
		Telefon: 6 835 543<br>
		GSM: 56 665 943<br>
		Avatud: Tööpäeviti 10.00-18.00<br>
		<br>
		Aadress: Kivimurru 34, 11411, Tallinn (Sikupilli keskuse taga) <a href="http://www.laptopid.ee/images/kaart.jpg">KAART</a><br>
		Sissepääs maja tagant, parkimine tasuta.<br>
		<br>
		Laptopid.ee on tegutsenud üle 10 aasta, oleme Eesti suurim kvaliteetsete äriklassi sülearvutite müüja.<br>
		Meie valikust leiad ainult vastupidavad sülearvutid ning neid on võimalik kohapeal, hubases sülearvutite salongis, vaadata-katsuda ja muidugi ka osta.<br>
		Ekspertidena oleme kokku puutunud kõigi meil müügis olevate sülearvutitega, mistõttu oskame nende omadustest rääkida väga põhjalikult ning leiame kiirelt just Teie vajadustele sobiva mudeli. Laoseisu kontrolliks palume helistada.<br>
		
		<a target="_new" href="http://www.dell.com"><img src="http://www.laptopid.ee/images/dellpartner.jpg"></a>
		<a target="_new" href="http://www.lenovo.com"><img src="http://www.laptopid.ee/images/lenovopartner.jpg"></a>
		<a target="_new" href="http://www.hp.com"><img src="http://www.laptopid.ee/images/hppartner.jpg"></a>
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
