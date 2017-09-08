<?php
namespace NYPL\Services\Model\DataModel;

use NYPL\Services\Model\DataModel;
use NYPL\Starter\Model\ModelTrait\TranslateTrait;

/**
 * @SWG\Definition(type="object")
 */
class BaseCheckinRequest extends DataModel
{
    use TranslateTrait;

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
