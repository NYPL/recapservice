<?php
namespace NYPL\Services\Model\DataModel;

use NYPL\Services\Model\DataModel;
use NYPL\Starter\Model\ModelTrait\TranslateTrait;

abstract class BaseCheckin extends DataModel
{
    use TranslateTrait;

    /**
     * @SWG\Property(example="33433001888415")
     * @var string
     */
    public $itemBarcode = '';

    /**
     * @SWG\Property(example="33433001888415")
     * @var string
     */
    public $patronBarcode = '';

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

    /**
     * @return string
     */
    public function getPatronBarcode()
    {
        return $this->patronBarcode;
    }

    /**
     * @param string $patronBarcode
     */
    public function setPatronBarcode($patronBarcode)
    {
        $this->patronBarcode = $patronBarcode;
    }
}
