<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'notes')->textarea(['size' => 3]) ?>
    <?= $form->field($model,'save_type')->dropDownList(['1'=> 'BINARY ONLY','2'=> 'FILE ONLY','3'=>'BOTH BINARY/FILE'],['prompt'=>'Please select a Save Type'])?>
    <?= $form->field($model, 'uploadedFiles[]')->fileInput(['multiple' => true]) ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>