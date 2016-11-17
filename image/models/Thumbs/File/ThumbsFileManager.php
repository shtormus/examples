<?php

namespace ImageMS\models\Thumbs\File;

use app\models\System\SystemManager;
use yii\base\ErrorException;
use app\modules\services\modules\testProject\models\MemberAccount\Enum\Sex;
use app\models\System\Exception\SystemExceptionIsArray;
use yii\db\Expression;
use app\models\System\DevelopDebug;
use ImageMS\models\Thumbs\Thumbs;
use yii\helpers\Json;

/**
 * @author Emil Vililyaev
 */
class ThumbsFileManager extends SystemManager
{

    /**
     * @param ThumbsFileData $data
     * @return NULL|\ImageMS\models\Thumbs\File\ThumbsFile
     */
    public function add(ThumbsFileData $data)
    {
        $row = new ThumbsFile();

        $row
            ->setFileInformationId($data->file_information_id)
            ->setThumbsId($data->thumbs_id)
            ->setFilePath($data->file_path)
            ->setType($data->type)
            ->save()
        ;

        if (!$row->getId())
        {
            throw new ErrorException('ThumbsFile object not created');
        }

        return $row;
    }

    /**
     * @param integer $categoryId
     * @param array $thumbsName
     * @return Thumbs[]
     */
    public function get($categoryId, $fileInformationId, $thumbsName = NULL)
    {
        $listThumbs = Thumbs::find()
            ->where(['thumb_category_id' => $categoryId])
        ;

        if (!is_null($thumbsName))
        {
            SystemExceptionIsArray::getInstance()->validate($thumbsName);

            $listThumbs
                ->andWhere(['name' => $thumbsName])
            ;
        }

        $result = [];

        foreach ($listThumbs->all() as $thumb)
        {
            /**
             * @var ThumbsFile $thumbFileRow
             */
            $thumbFileRow = $thumb->getThumbsFile()->where(['file_information_id' => $fileInformationId])->one();
            $thumbFileRow->setFilePath(\Yii::$app->params['cdn'] . DIRECTORY_SEPARATOR . $thumbFileRow->getFilePath());
            $result[$thumb['name']]['file'] = $thumbFileRow;
        }

        return $result;
    }

}