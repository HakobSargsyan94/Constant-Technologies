<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_hy',
            'name_ru',
            'name_en',
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status == '1'){
                        return 'Active';
                    } else {
                        return 'In active';
                    }
                }
            ],
            [
                'attribute' => 'parent_id',
                'value' => function($model){
                    if ($model->parent_id > 0) {
                        return '#' . $model->parent_id . ' ' . $model->find()->where(['id' => $model->parent_id])->one()->name_hy ?? '';
                    } else {
                        return 'Havn\'t parent';
                    }
                }
            ],
            //'parent_id',
            //'created_date',
            //'updated_date',
            [
                'class' => ActionColumn::className(),
            ],
        ],
    ]); ?>


</div>
