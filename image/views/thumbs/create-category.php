<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<?php $activeForm = ActiveForm::begin([
    'id' => 'create-category',
    'options' => [
        'class'     => 'form-horizontal',
        'method'    => 'post',
    ],

]) ?>

<?= $activeForm->field($form, 'category_name') ?>
<?= $activeForm->field($form, 'category_description') ?>

    <button>Submit</button>

<?php ActiveForm::end()?>