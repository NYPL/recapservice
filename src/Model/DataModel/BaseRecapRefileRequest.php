<?php
namespace NYPL\Services\Model\DataModel;

use NYPL\Services\Model\DataModel;
use NYPL\Starter\Model\ModelTrait\TranslateTrait;

abstract class BaseRecapRefileRequest extends DataModel
{
    use TranslateTrait;

    /**
     * @SWG\Property(example="33333259898217")
     * @var string
     */
    public $itemBarcode = '';


    /**
     * @return string
     */
    public function getItemBarcode()
    {
        return $this->itemBarcode;
    }

    /**
     * @param string $itemBarcode
     */
    public function setItemBarcode($itemBarcode)
    {
        $this->itemBarcode = $itemBarcode;
    }
}
