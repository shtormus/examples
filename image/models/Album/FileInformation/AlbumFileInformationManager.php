<?php

namespace ImageMS\models\Album\FileInformation;

use app\models\System\SystemManager;
use ImageMS\models\Album\FileInformation\AlbumFileInformation;

/**
 * @author Emil Vililyaev
 */
class AlbumFileInformationManager extends SystemManager
{

    /**
     * @param integer $albumId
     * @param integer $fileInformationId
     * @return \ImageMS\models\Album\FileInformation\AlbumFileInformation
     */
    public function add($albumId, $fileInformationId) : AlbumFileInformation
    {
        $row = new AlbumFileInformation();

        $row
            ->setAlbumId($albumId)
            ->setFileInformationId($fileInformationId)
            ->save()
        ;

        return $row;
    }

}