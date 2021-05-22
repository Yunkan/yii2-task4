<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($model->getItems(), 'id', 'name')) ?>

    <? if(isset($model->status)): ?>
    	<?= $form->field($model, 'status')->dropDownList($model->statuses) ?>
	<? endIf; ?>

    <?= $form->field($model, 'reject_reason', ['options' => ['class' => 'hideReasonInput']])->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
	const status = document.getElementById('request-status');
	const reason = document.querySelector('.field-request-reject_reason');

	status.addEventListener('change', e => {
		if(status.value === 'Отклонена') {			
			reason.classList.remove('hideReasonInput');
			reason.classList.add('showReasonInput');
		} else {
			reason.classList.remove('showReasonInput');
			reason.classList.add('hideReasonInput');
		}
	});
</script>
