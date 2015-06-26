<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use frontend\models\ApplicationData;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Application */

?>

<!-- Initializing Foo Tables -->
<? $this->registerJS(
    "$(function () {
        $('.footable').footable({
            breakpoints: {
                /* Somehow Footable misses the screen wdtdh by 31 Pixels */
                mediaXXsmall: 480,
                mediaXsmall: 736,
                mediaSmall: 960

            }
        });
    });");

?>

<div class="application-create">
	<div class="row">
		<div class="col-sm-12">
			<h1>Bewerbung auf Stellenanzeige: <?= Html::a($job->title,"/job/view?id=".$job->id); ?></h1>
			<?php $form = ActiveForm::begin(['id' => 'form-createCover']); ?>
			<div class="row">
				<div class="col-sm-7">
					<h2>Anschreiben</h2>
					<?= $form->field($model, 'text')->textarea() ?>
				</div>
				<div class="col-sm-5">
					<h2>Anlagen</h2>
					<?= GridView::widget([
						'dataProvider' => $sentProvider,
						'tableOptions' => ['class' => 'hireMeTable footable toggle-arrow', 'id' => 'attachTable'],
						'id' => "uploadedGrid",
						'columns'      => [
							[
								'label'  => 'Titel',
								'format' => 'raw',
								'value'  => function ($data) {
									ApplicationData::getFileTitle($data->id);
								},
								'headerOptions'  => ['class' => 'first-col'],
								'contentOptions' => ['class' => 'first-col'],
							],
							[
								'label'  => 'Titel',
								'format' => 'raw',
								'value'  => function ($data) {
									return  Html::a("<span class='glyphicon glyphicon-eye-open'>,'/application/show-file?id=".$data['id'],['target' => '_blank']);
								},
								'headerOptions'  => ['class' => 'first-col','data-hide' => 'xsmall, phone'],
								'contentOptions' => ['class' => 'first-col'],
							], 
							[
								'label'  => '',
								'format' => 'raw',
								'value'  => function ($data) use ($appId) {                 ;
									return  Html::a("<span class='glyphicon glyphicon-floppy-save'></span>&nbsp;&nbsp;Entfernen","/application/data-handler?id=".$data['id']."&appID=".$appId."&direction=0",["class" => "btn btn-default ripple"]);
								},
								'headerOptions'  => ['class' => 'second-col','data-hide' => 'xsmall, phone'],
								'contentOptions' => ['class' => 'second-col'],
							],
							[
								'class'          => 'yii\grid\Column',
								'headerOptions'  => ['data-toggle' => 'true'],
								'contentOptions' => ['data-title' => 'data-toggle'],
							],
						],
					]);
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-3 saveBtn">
					<?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Bewerbung speichern', ['class' => 'btn btn-success', 'name' => 'create-button']) ?>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12">
					<h2>Anlagen hinzufügen</h2>
					<?= GridView::widget([
						'dataProvider' => $provider,
						'tableOptions' => ['class' => 'hireMeTable footable toggle-arrow', 'id' => 'attachTable'],
						'id' => "uploadedGrid",
						'columns'      => [
							[
								'label'  => 'Titel',
								'format' => 'raw',
								'value'  => function ($data) {
									return  Html::a("<span class='glyphicon glyphicon-eye-open'></span>&nbsp;&nbsp;".$data['title'],"/application/show-file?id=".$data['id'],['target' => '_blank']);
								},
								'headerOptions'  => ['class' => 'first-col'],
								'contentOptions' => ['class' => 'first-col'],
							],
							[
								'label'  => '',
								'format' => 'raw',
								'value'  => function ($data) use ($appId){   
											$tmpApp = ApplicationData::find()
											->where(['file_id' => $data['id'],'application_id'=>$appId])->one();

											if(count($tmpApp) == 0) {
											return  Html::a("<span class='glyphicon glyphicon-floppy-open'></span>&nbsp;&nbsp;Anhängen","/application/data-handler?id=".$data['id']."&appID=".$appId."&direction=1",["class" => "btn btn-success ripple"]);
											}    
											else {
											return  "<span class='attached'><span class='glyphicon glyphicon-ok'></span>&nbsp;Angehängt</span>";
											}
										},
								'headerOptions'  => ['class' => 'second-col','data-hide' => 'xsmall,phone'],
								'contentOptions' => ['class' => 'second-col'],
							],
							[
								'label'  => '',
								'format' => 'raw',
								'value'  => function ($data) {
									return Html::a("<span class='glyphicon glyphicon-pencil'></span>&nbsp;Anlagen bearbeiten", '/attachement');
								},
								'headerOptions'  => ['class' => 'third-col','data-hide' => 'xsmall,phone'],
								'contentOptions' => ['class' => 'third-col'],
							],
							[
								'class'          => 'yii\grid\Column',
								'headerOptions'  => ['data-toggle' => 'true'],
								'contentOptions' => ['data-title' => 'data-toggle'],
							],
						],
					]); ?> 
				</div>
			</div>
		</div>
		<div class="col-sm-9"></div>
		<div class="col-sm-3 saveBtn">
			<?= Html::a('<span class="glyphicon glyphicon-share"></span>&nbsp;&nbsp;Bewerbung verschicken','/application/send?id='.$appId,['class' => 'btn btn-success ripple']) ?>
		</div>
	</div>

</div>
