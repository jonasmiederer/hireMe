<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap\Modal;
use frontend\assets\SignupAsset;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $loginModel \common\models\LoginForm */
/* @var $signupModel frontend\models\SignupForm */


// Include JS //
$this->registerJsFile("https://apis.google.com/js/platform.js", array('async'=>'', 'defer'=>''));//, 'position'=>'POS_BEGIN'));
// Include Meta-Tags //
$this->registerMetaTag(array('name' =>'google-signin-client_id', 'content'=>'58721707988-v5app0rim8mk4pqan11dq8hh95nvph2o.apps.googleusercontent.com'));
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

// SignUp //
include Yii::getAlias('@helper/companySignup.php');
SignupAsset::register($this);

?>
<div class="site-login">
	
	<!-- Login Full-Page -->

    <div class="row">
        <div class="col-sm-4 col-sm-offset-1 login-field">
			<h1><?= Html::encode($this->title) ?></h1>
		
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($loginModel, 'email', ['template' => '{label} <div>{input}{error}{hint}</div>','inputOptions' => ['placeholder' => $model->getAttributeLabel('E-Mail')]])->label(false); ?>
                <?= $form->field($loginModel, 'password', ['template' => '{label} <div>{input}{error}{hint}</div>','inputOptions' => ['placeholder' => $model->getAttributeLabel('Passwort')]])->passwordInput()->label(false); ?>
                <?= $form->field($loginModel, 'rememberMe')->checkbox() ?>

				
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-success login-button', 'name' => 'login-button']) ?>
					<?= Html::a('Passwort vergessen?', ['site/request-password-reset']) ?>
                </div>
            <?php ActiveForm::end(); ?>
		
			<?= yii\authclient\widgets\AuthChoice::widget([
				'baseAuthUrl' => ['site/auth'],
				'popupMode' => false
			]) ?>
			
        </div>
		
		<div class="col-sm-4 col-sm-offset-2 login-field">
		
			<h2>SignUp Formular</h2>

            <?// Signup Form //?>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($signupModel, 'firstName')->label('Vorname')?>
            <?= $form->field($signupModel, 'lastName')->label('Nachname') ?>
            <?= $form->field($signupModel, 'email') ?>
            <?= $form->field($signupModel, 'password')->passwordInput() ?>

            <br>
            <?= $form->field($signupModel, 'checkCompanySignup')->checkbox(array('id'=>'checkCompanySignup'))->label('Als Recruiter registrieren') ?>


            <!-- Additional Information for recruiter signups -->


            <div class="companySetup" style="display: none">    <? //STYLE: display in css?>
                <?= $form->field($signupModel, 'companyName')->label('Name des Unternehmens')?>
                <?= $form->field($signupModel, 'companyAddress')->label('Anschrift des Unternehmens') ?>
                <div class="row">
                    <div class="col-lg-9">
                        <?= $form->field($signupModel, 'companyAddressStreet', array('inputOptions'=>['placeholder'=>'Straße']))->label(false) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($signupModel, 'companyAddressNumber', array('inputOptions'=>['placeholder'=>'Nr.']))->label(false)?>
                    </div>
                </div>
                <?= $form->field($signupModel, 'companyAddressZIP', array('inputOptions'=>['placeholder'=>'PLZ']))->label(false) ?>
                <?= $form->field($signupModel, 'companyAddressCity', array('inputOptions'=>['placeholder'=>'Ort']))->label(false) ?>

                <?= $form->field($signupModel, 'companySector')->dropDownList($sectors, ['prompt'=>'Branche wählen' /*, "0"=>['disabled' => true]*/ ])->label('Branche') ?>  <? //TODO: Make Prompt disabled?>
                <?= $form->field($signupModel, 'companyEmployees')->dropDownList($employeeAmount, ['prompt'=>'Anzahl der Beschäftigten' ])->label('Anzahl der Mitarbeiter') ?>
            </div>


            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

		</div>
		
    </div>
	
	
	<!-- Peter Login Modal Test -->
	<?php
	
	Modal::begin([
		'header' => '<h2>Hello world</h2>',
		'toggleButton' => ['label' => 'click me'],
	]);

	?>

	<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

		<?= $form->field($loginModel, 'email') ?>
		<?= $form->field($loginModel, 'password')->passwordInput() ?>
		<?= $form->field($loginModel, 'rememberMe')->checkbox() ?>

		<div style="color:#999;margin:1em 0">
			If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
		</div>
		<div class="form-group">
			<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
		</div>
	<?php ActiveForm::end(); ?>
	
	<hr>
    <p><?= Yii::t('app', "Or login using another service:") ?></p>

    <?= yii\authclient\widgets\AuthChoice::widget([
        'baseAuthUrl' => ['site/auth'],
        'popupMode' => false,
    ]) ?>
	
	<?php
	Modal::end();
	
	?>
</div>
