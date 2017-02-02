File Upload with Binary
=======================
File upload with binary, file upload or both.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

After install 
Migrations are not done.
Open the file_upload_table.sql in your database and run it as a query.

In your config file put
    'controllerMap' => [
        'file-upload' => 'jberall\fileupload\controllers\FileUploadController',
    ],
then http://your-site.com/file-upload

Or

'modules' => [
        'fuext' => [
            'class' => 'jberall\fileupload\Module',
        ],   
], 

then http://your-site.com/fuext/file-upload

Either run

```
composer require jberall/yii2-fileupload:dev-master 
```

or add

```
"jberall/yii2-fileupload": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :



```php
