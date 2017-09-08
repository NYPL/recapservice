<?php
namespace NYPL\Services\Model\DataModel\BaseCheckout\BaseNewCheckout;

use NYPL\Services\Model\DataModel\BaseCheckout\BaseNewCheckout;

/**
 * @SWG\Definition(type="object")
 */
class NewCheckout extends BaseNewCheckout
{
    /**
     * @SWG\Property(example="10004854")
     * @var string
     */
    public $patron;

    /**
     * @return string
     */
    public function getPatron()
    {
        return $this->patron;
    }

    /**
     * @param string $patron
     */
    public function setPatron($patron)
    {
        $this->patron = $patron;
    }
}
