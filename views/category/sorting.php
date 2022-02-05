<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories sorting';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <div class="alert sorting_alert alert-danger" role="alert">
        Something went wrong! Try again.
    </div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if ($data) : ?>
        <?php foreach ($data as $categories) : ?>
            <div data-id="<?=$categories['parent']['id']?>" class="category_parents_wrapper connectedSortable sortable"><?=$categories['parent']['name_hy']?>
                <?php if (count($categories['child']) > 0) : ?>
                    <?php foreach ($categories['child'] as $children) : ?>
                        <div data-id="<?=$children['id']?>" class="category_child"><?=$children['name_hy']?>
                            <span class="child_as_handle">
                                <i class="fa fa-arrows"></i>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <h2>No data</h2>
    <?php endif; ?>
</div>
