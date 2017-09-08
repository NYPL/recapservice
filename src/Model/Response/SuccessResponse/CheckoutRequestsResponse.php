<?php
namespace NYPL\Services\Model\Response\SuccessResponse;

use NYPL\Services\Model\DataModel\BaseCheckoutRequest\CheckoutRequest;
use NYPL\Starter\Model\Response\SuccessResponse;

/**
 * @SWG\Definition(title="CheckoutRequestResponse", type="object")
 */
class CheckoutRequestsResponse extends SuccessResponse
{
    /**
     * @SWG\Property
     * @var CheckoutRequest[]
     */
    public $data;
}
