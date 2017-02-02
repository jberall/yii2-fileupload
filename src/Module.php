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

//        print_R($this);
//        echo $this->runAction('file-upload');
        
    }
    
    
}
