<?php

return [
    'components' => [
        'filesystem' => function() {
            $adapter = new \Gaufrette\Adapter\Local(Yii::getAlias('@webroot/photo'), true);
            return new \Gaufrette\Filesystem($adapter);
        },
    ],
    'params' => [
        'MaxSizePhoto' => 1024 * 1024 * 8,
        'ImageTypes' => [
            IMG_JPEG,
            IMG_JPG,
            IMG_GIF,
            IMG_PNG,
        ],
        'mimeTypes' => [
            'image/jpg',
            'image/gif',
            'image/png',
        ],
        'file' => [
            'FILE_LEVEL'            => 2,
            'DIR_NAME_LENGTH'       => 2,
            'BASE_DIR'              => Yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR,
            'FILE_ORIGINAL_NAME'    => 'original',
        ],
    ],
];