<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <? if(!Yii::$app->user->isGuest): ?>
    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <? endif; ?>

    <h1 id="decidedRequests">Решённые: 0</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'description:ntext',
            ['attribute' => 'category_id', 'value' => 'category.name'],
            'status:ntext',
            'reject_reason:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
<script>
    const decidedRequests = document.getElementById('decidedRequests');

    function requestCount() {
        fetch('/web/index.php?r=request%2Fcount')
        .then(response => response.json())
        .then(res => {
            decidedRequests.innerHTML = `Решённые: ${res}`;
        });
    }

    requestCount();

    setInterval(requestCount, 5 * 1000);
</script>