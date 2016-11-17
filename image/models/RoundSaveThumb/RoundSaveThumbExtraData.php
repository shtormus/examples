<?php

namespace ImageMS\models\RoundSaveThumb;

/**
 * @author Emil Vililyaev
 */
class RoundSaveThumbExtraData extends AbstractRoundSaveThumbExtraData
{

    /**
     * @var array
     * $rect = [$width, $height, $x, $y]
     */
    public $rect;

    /**
     * @var array
     * $round = [ mixed $background , float $degrees]
     */
    public $rotate;

    //-----------------------------------------------------------------------------------------------------------

    /**
     * @return \ImageMS\models\RoundSaveThumb\RoundSaveThumbExtraData
     */
    private function _crop()
    {
        if (!is_null($this->rect))
        {
            list($width, $height, $x, $y) = $this->rect;

            $this->_objImage->cropImage($width, $height, $x, $y);
        }

        return $this;
    }

    /**
     * @return \ImageMS\models\RoundSaveThumb\RoundSaveThumbExtraData
     */
    private function _rotate()
    {
        //need implements
        return $this;
    }

    //-----------------------------------------------------------------------------------------------------------

    /* (non-PHPdoc)
     * @see \ImageMS\models\RoundSaveThumb\AbstractRoundSaveThumbExtraData::process()
     */
    public function process()
    {
        return $this
                ->_crop()
                ->_rotate()
       ;

    }

}