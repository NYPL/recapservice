<?php
namespace NYPL\Services\Model\DataModel;

use NYPL\Services\Model\DataModel;
use NYPL\Starter\Model\ModelTrait\TranslateTrait;

class SierraItem extends DataModel
{
    use TranslateTrait;

    /**
     * @var string
     */
    public $id;

    /**
     * @var string[]
     */
    public $bibIds;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = (string) $id;
    }

    /**
     * @return string[]
     */
    public function getBibIds()
    {
        return $this->bibIds;
    }

    /**
     * @param string[] $bibIds
     */
    public function setBibIds($bibIds)
    {
        if (is_string($bibIds)) {
            $bibIds = json_decode($bibIds, true);
        }

        $this->bibIds = $bibIds;
    }
}
