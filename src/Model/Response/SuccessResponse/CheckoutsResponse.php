<?php
namespace NYPL\Services\Model\Response\SuccessResponse;

use NYPL\Services\Model\DataModel\BaseCheckout\Checkout;
use NYPL\Starter\Model\Response\SuccessResponse;

/**
 * @SWG\Definition(title="CheckoutsResponse", type="object")
 */
class CheckoutsResponse extends SuccessResponse
{
    /**
     * @SWG\Property
     * @var Checkout[]
     */
    public $data;
}
