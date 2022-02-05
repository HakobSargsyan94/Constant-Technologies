<?php

use app\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
$check_can_child = true;
$droplist_data[0] = '';
if (isset($_GET['id']) && !empty(isset($_GET['id']))) {
    $res = Category::find()->where(['id' => $_GET['id']])->one()->parent_id;
    if ($res) {
        $check_can_child = false;
    }
}
$categories = Category::find()->all();
if ($categories) {
    foreach ($categories as $key => $category ) {
        if (isset($_GET['id']) && !empty(isset($_GET['id'])) && $_GET['id'] == $category['id']) {
            continue;
        }
        $droplist_data[$category['id']] = $category['name_hy'];
    }
}
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_hy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([0 => 'Inactive' , 1 => 'Active']); ?>
    <?php if ($model->isNewRecord && $check_can_child) : ?>
    <?= $form->field($model, 'parent_id')->dropDownList($droplist_data) ?>
    <?php endif; ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
