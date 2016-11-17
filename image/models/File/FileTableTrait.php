<?php

namespace ImageMS\models\File;

use ImageMS\models\File\Information\FileInformation;

/**
 * @author Emil Vililyaev
 */
trait FileTableTrait
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_file';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'width'         => 'Width',
            'heigth'        => 'Heigth',
            'file_path'     => 'File Path',
            'type'          => 'Type',
            'data_insert'   => 'Data Insert',
            'server_name'   => 'Server Name',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageFileInformations()
    {
        return $this->hasMany(FileInformation::className(), ['file_id' => 'id']);
    }

}