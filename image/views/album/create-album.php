<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<?php $activeForm = ActiveForm::begin([
    'id' => 'create-album-form',
    'options' => [
        'class'     => 'form-horizontal',
        'method'    => 'post',
    ],

]) ?>

<?= $activeForm->field($form, 'name') ?>
<?= $activeForm->field($form, 'description') ?>
<?= $activeForm->field($form, 'file_information_id') ?>

    <button>Submit</button>

<?php ActiveForm::end()?>