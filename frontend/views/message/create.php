<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $userModel common\models\User */
/* @var $rec */

$this->title = Yii::t('app', 'Nachricht verfassen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Messages'), 'url' => ['']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'receiver' => $rec
    ]) ?>

</div>
