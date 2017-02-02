<?php

namespace frontend\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%file_upload}}".
 *
 * @property string $id
 * @property string $_id
 * @property string $notes
 * @property resource $file_blob file stored as a bytea
 * @property string $name name of uploaded file
 * @property string $mime_type
 * @property string $size
 * @property string $web_file_name the name of the file stored on our web server by using Yii::$app->security->generateRandomString() + file.extension
 * @property integer $save_type 1 = Binary Only, 2 = File Only, 3 = Both Binary and File
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class FileUpload extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFiles
    */
    public $uploadedFiles;    
    
    /**
     * @var UploadedPath defaults to '/web/uploads/';
     */
    public $uploadedPath;
    
    /**
     * @var basePath defaults to Yii::$app->basePath
     */
    public $basePath;
    
    const BINARY_ONLY = 1;
    const FILE_ONLY = 2;
    const BINARY_AND_FILE = 3;
    
    public function init() {
        parent::init();
        if (!$this->basePath) $this->basePath =  Yii::$app->basePath;
        if (!$this->uploadedPath) $this->uploadedPath = '/web/uploads/';
    }
public function behaviors()
{
    return [
        [
            'class' => BlameableBehavior::className(),
        ],
        'timestamp' => [
            'class' => 'yii\behaviors\TimestampBehavior',
        ],
    ];
}
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file_upload}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'notes', 'file_blob'], 'string'],
            [['size'], 'number'],
            [['web_file_name'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 512],
            [['mime_type'], 'string', 'max' => 255],
            [['uploadedFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,gif,jpg', 'maxFiles' => 4],
            [['notes',],'trim'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'save_type',], 'integer'],
            [['save_type'],'required'],
            [['save_type'],'in','range'=>[$this::BINARY_ONLY,$this::FILE_ONLY,$this::BINARY_AND_FILE]],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            '_id' => Yii::t('app', 'Id'),
            'notes' => Yii::t('app', 'Notes'),
            'file_blob' => Yii::t('app', 'File Blob'),
            'name' => Yii::t('app', 'Name'),
            'mime_type' => Yii::t('app', 'Mime Type'),
            'size' => Yii::t('app', 'Size'),
            'web_file_name' => Yii::t('app', 'Web File Name'),
            'save_type' => Yii::t('app', 'Save Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
    
    public function upload()
    {

        if ($this->validate()) { 
//            print_R($this->uploadedFiles);
            foreach ($this->uploadedFiles as $file) {
                
                //create web_file_name
                $this->web_file_name = Yii::$app->security->generateRandomString().'.'.$file->extension;

//                $this->_id = //need to get uuid
                $this->name = $file->name;
                $this->mime_type = $file->type;
                $this->size = $file->size;
                
                switch($this->save_type){
                    case $this::BINARY_ONLY:
                        $this->file_blob = bin2hex(file_get_contents($file->tempName)); 
                        $this->web_file_name = NULL;
                        break;
                    case $this::FILE_ONLY:
                        $file->saveAs($this->basePath . $this->uploadedPath . $this->web_file_name);
                        break;
                    case $this::FILE_ONLY:
                    default:
                        $this->file_blob = bin2hex(file_get_contents($file->tempName)); 
                        $file->saveAs($this->basePath . $this->uploadedPath . $this->web_file_name);  
                        break;
                }
 
          
                //need to set validation to false or get error.
                $this->save(FALSE);
            }
            
            return true;
        } else {
            return false;
        }
    }    
    
    public function getSafeTypeDescription() {
        switch($this->save_type) {
            case $this::BINARY_ONLY:
                return 'BINARY ONLY';
            case $this::FILE_ONLY:
                return 'FILE ONLY';
            case $this::BINARY_AND_FILE:
                return 'BINARY AND FILE';
            default:
                return 'Not Set';
                
        }
        
    }
}
