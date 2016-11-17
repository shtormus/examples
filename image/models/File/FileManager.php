<?php

// namespace app\modules\services\modules\Image\models\File;
namespace ImageMS\models\File;

use app\models\System\SystemManager;
use ImageMS\Module;
use ImageMS\models\File\File;
use app\models\System\SystemFolder;
use yii\base\ErrorException;

/**
 * @author Emil Vililyaev
 */
class FileManager extends SystemManager
{

    /**
     * @param string $content
     * @return string
     */
    private function _getFilePath($content)
    {
        $config = (new Module('Image'))->params['file'];

        $fileLevel = $config['FILE_LEVEL'];
        $dirNameLength = $config['DIR_NAME_LENGTH'];

        $hash = sha1($content);
        $path = '';

        for ($i = 0; $i < $fileLevel; $i++)
        {
            $path .= substr($hash, $i * $dirNameLength, $dirNameLength) . DIRECTORY_SEPARATOR;
        }

        //@todo нужно бы использовать объект по хорошему
        return [$path . substr($hash, $fileLevel * $dirNameLength) . DIRECTORY_SEPARATOR, $config['FILE_ORIGINAL_NAME']];
    }

    //------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @param string $imageContent
     * @return \ImageMS\models\File\File
     */
    public function addIfNotExist($imageContent) : File
    {
        list($imageWidth, $imageHeigth, $imageType) = getimagesizefromstring($imageContent);
        list($dirPath, $fileName)                   = $this->_getFilePath($imageContent);

        $basePath = (new Module('Image'))->params['file']['BASE_DIR'];
        $filePath =  $dirPath . $fileName . image_type_to_extension($imageType);

        $row = File::find()->where(['file_path' => $filePath])->one();

        if (!is_null($row))
        {
            if (!is_file($basePath . $filePath))
            {
                throw new ErrorException('File not exist! ' . $filePath);
            }

            return $row;
        }

        SystemFolder::create($basePath . $dirPath, 0777);
        file_put_contents($basePath . $filePath, $imageContent);

        $row = new File();
        $row
            ->setWidth($imageWidth)
            ->setHeigth($imageHeigth)
            ->setFilePath($filePath)
            ->setType($imageType)
            ->save()
        ;

        return $row;
    }

}