<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<?php $activeForm = ActiveForm::begin([
    'id' => 'upload-image',
    'options' => [
        'class' => 'form-horizontal',
            'method'    => 'post',
    'enctype' => 'multipart/form-data',
    ],

]) ?>

<?=\yii\helpers\Html::fileInput('file')?>
<input name="thumbsCategoryId">
<?= $activeForm->field($form, 'name') ?>
<?= $activeForm->field($form, 'url') ?>
<?= $activeForm->field($form, 'title') ?>
<?= $activeForm->field($form, 'description') ?>

    <button>Submit</button>

<?php ActiveForm::end()?>



<?=\yii\helpers\Html::beginForm(
    ['/services/image/image/url'],
    'post'
)?>

<?=\yii\helpers\Html::input('text', 'url')?>

    <button>Submit</button>

<?=\yii\helpers\Html::endForm()?>