<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<?php $activeForm = ActiveForm::begin([
    'id' => 'add-to-album',
    'options' => [
        'class'     => 'form-horizontal',
        'method'    => 'post',
    ],

]) ?>

<?= $activeForm->field($form, 'album_id') ?>
<?= $activeForm->field($form, 'file_information_id') ?>

    <button>Submit</button>

<?php ActiveForm::end()?>