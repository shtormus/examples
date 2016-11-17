<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<?php $activeForm = ActiveForm::begin([
    'id' => 'create-thumbs',
    'options' => [
        'class' => 'form-horizontal',
        'method'    => 'post',
    ],

]) ?>

<?= $activeForm->field($form, 'name') ?>
<?= $activeForm->field($form, 'width') ?>
<?= $activeForm->field($form, 'heigth') ?>
<?= $activeForm->field($form, 'description') ?>

    <button>Submit</button>

<?php ActiveForm::end()?>