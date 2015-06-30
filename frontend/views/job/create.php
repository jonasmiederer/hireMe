<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\CreateJobAsset;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\typeahead\Typeahead;

CreateJobAsset::register($this);

include Yii::getAlias('@helper/companySignup.php');

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model frontend\models\JobCreateForm */


$this->title = 'Stellenanzeige erstellen';

?>
<div class="job-create">
    <div class="row">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'form-createJob']); ?>

        <div class="col-sm-6">


            <?= $form->field($model, 'title')->label('Titel') ?>

            <?= $form->field($model, 'description', ['inputOptions' => ['class' => 'form-control', 'placeholder' => 'Beschreibung...']], ['options' => ['class' => 'form-control']])->textarea(['rows' => 15])->label(false) ?>

        </div>

        <div class="col-sm-6 col-2nd">


            <?=
            DatePicker::widget([
                'model' => $model,
                'attribute' => 'job_begin',
                'attribute2' => 'job_end',
                'options' => ['placeholder' => 'Von'],
                'options2' => ['placeholder' => 'Bis'],
                'type' => DatePicker::TYPE_RANGE,
                'form' => $form,
                'language' => 'de',
                'separator' => 'bis',
                'pluginOptions' => [
                    'format' => 'dd.mm.yyyy',
                    'autoclose' => true,
                    'todayHighlight' => true,
                ]
            ]);
            ?>


            <?= $form->field($model, 'checkLocationBased')->checkbox(array('id' => 'checkLocationBased')) ?>


            <div class="locationDiv" style="display: none">    <? //STYLE: display in css?>
                <?= $form->field($model, 'zip')->label('Postleitzahl') ?>
                <?= $form->field($model, 'city')->label('Stadt') ?>
            </div>

            <?= $form->field($model, 'sector')->widget(\kartik\select2\Select2::className(), [
                'data' => $sectors,
            ])->label('Branche') ?>

            <div class="form-group field-submit">
                <br>
                <br>
                <br>
                <?= Html::submitButton('Erstellen', ['class' => 'btn btn-success', 'name' => 'create-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

            <!-- <div id="aboutdiv">
 <?php Pjax::begin() ?>
        <?= Html::a(
                'Button generieren',
                Url::to(['job/generation?id=' . $assumedJobId]),
                ['data-pjax' => '#aboutdiv']
            ) ?>
    <?php Pjax::end(); ?>
             </div> -->
        </div>
    </div>
</div>
