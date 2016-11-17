<?php

namespace ImageMS\models\Album;

use app\models\System\SystemManager;
use ImageMS\models\Album\Enum\Status;
use ImageMS\models\Album\Album;

/**
 * @author Emil Vililyaev
 */
class AlbumManager extends SystemManager
{

    /**
     * @param AlbumData $data
     * @return \ImageMS\models\Album\Album
     */
    public function add(AlbumData $data) : Album
    {
        $row = new Album();

        $row
            ->setName($data->name)
            ->setDescription($data->description)
            ->setFileInformationId($data->file_information_id)
            ->setCreatorModelName($data->creator_model_name)
            ->setCreatorObjectId($data->creator_object_id)
            ->setStatus(Status::NORMAL)
            ->save()
        ;

        return $row;
    }

    /**
     * @param integer $id
     * @return Album
     */
    public function get($id)
    {
        return Album::find()->where(['id' => $id])->one();
    }

    /**
     * @param integer $albumId
     * @param integer $fileInformationId
     * @return \ImageMS\models\Album\Album
     */
    public function addFileInformationId($albumId, $fileInformationId) : Album
    {
        $row = $this->get($albumId);

        $row
            ->setFileInformationId($fileInformationId)
            ->save()
        ;

        return $row;
    }

    /**
     * @param integer $id
     * @return boolean
     */
    public function isExist($id)
    {
        $row = $this->get($id);

        return !is_null($row);
    }

}