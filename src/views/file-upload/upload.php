<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model jberall\fileupload\models\FileUpload */

$this->title = Yii::t('app', 'Upload');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'File Uploads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-upload-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_upload', [
        'model' => $model,
    ]) ?>

</div>
