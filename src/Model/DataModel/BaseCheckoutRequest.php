<?php
namespace NYPL\Services\Model\DataModel;

use NYPL\Services\Model\DataModel;
use NYPL\Starter\Model\ModelTrait\TranslateTrait;

/**
 * @SWG\Definition(type="object")
 */
class BaseCheckoutRequest extends DataModel
{
    use TranslateTrait;

    /**
     * @SWG\Property(example="33433001888415")
     * @var string
     */
    public $patronBarcode;

    /**
     * @SWG\Property(example="33433001888415")
     * @var string
     */
    public $itemBarcode;

    /**
     * @SWG\Property(example="NYPL")
     * @var string
     */
    public $owningInstitutionId = '';

    /**
     * @SWG\Property(example="2016-04-12T04:00:00.000-08:00")
     * @var string
     */
    public $desiredDateDue;

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
    public function getDesiredDateDue()
    {
        return $this->desiredDateDue;
    }

    /**
     * @param string $desiredDateDue
     */
    public function setDesiredDateDue($desiredDateDue)
    {
        $this->desiredDateDue = $desiredDateDue;
    }

    /**
     * @return string
     */
    public function getOwningInstitutionId(): string
    {
        return $this->owningInstitutionId;
    }

    /**
     * @param string $owningInstitutionId
     */
    public function setOwningInstitutionId(string $owningInstitutionId)
    {
        $this->owningInstitutionId = $owningInstitutionId;
    }
}
