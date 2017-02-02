<?php

namespace jberall\fileupload;

/**
 * Module module definition class
 * for now use controller map
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'jberall\fileupload\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {

        parent::init();

        $this->controllerNamespace = $this->controllerNamespace;
//        $this->controllerMap = ['fu' => 'jberall\fileupload\controllers\FileUploadController'];
        
    }
    
    
}
