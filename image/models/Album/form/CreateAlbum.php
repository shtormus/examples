<?php

namespace ImageMS\models\Album\form;

use yii\base\Model;
use app\models\System\SystemFormAbstract;
use ImageMS\models\Album\AlbumManager;
use ImageMS\models\Album\Album;

/**
 * @author Emil Vililyaev
 */
class CreateAlbum extends SystemFormAbstract
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $file_information_id;

    //------------------------------------------------------------------------------------------------------------------------------------

    /* (non-PHPdoc)
     * @see \yii\base\Model::rules()
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'nameIsExist'],
            [['description'], 'string'],
            [['file_information_id'], 'integer'],
        ];
    }

    public function nameIsExist($attribute)
    {
        /* @var $request \app\modules\services\components\GiraffeRequest */
        $request = \Yii::$app->request;
        $member = $request->getMember();

        $row = Album::findAll([
            'name'                  => $this->name,
            'creator_model_name'    => $member->className(),
            'creator_object_id'     => $member->getId()
        ]);

        if (!is_null($row))
        {
            $this->addError('name', 'Album by name "' . $this->name . '" already exist');
        }
    }

}