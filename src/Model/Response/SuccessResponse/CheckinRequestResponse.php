<?php
namespace NYPL\Services\Model\Response\SuccessResponse;

use NYPL\Services\Model\DataModel\BaseCheckinRequest\CheckinRequest;
use NYPL\Starter\Model\Response\SuccessResponse;

/**
 * @SWG\Definition(title="CheckoutRequestResponse", type="object")
 */
class CheckinRequestResponse extends SuccessResponse
{
    /**
     * @SWG\Property
     * @var CheckinRequest
     */
    public $data;
}
