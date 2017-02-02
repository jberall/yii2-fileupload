<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model jberall\fileupload\models\FileUpload */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'File Uploads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-upload-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Upload Files'), ['upload'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            '_id',
            'notes:ntext',
//            'file_blob',
            'name',
            'web_file_name',
            'mime_type',
            'size',
            'save_type',
            [
                'attribute' => 'save_type',
                'value' => $model->getSafeTypeDescription(),
            ],
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
<table border="1">
    <tr>
        <th>From Database</th>
        <th>From Folder</th>
    </tr>
    <tr>
        <th><img src="/file-upload/image?id=<?=$model->id?>" /></th>
        <th><img src="/uploads/<?=$model->web_file_name?>"></th></th>
    </tr>    
</table>

