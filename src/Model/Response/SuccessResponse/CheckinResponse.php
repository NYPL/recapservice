<?php
namespace NYPL\Services\Model\Response\SuccessResponse;

use NYPL\Services\Model\DataModel\BaseCheckin\Checkin;
use NYPL\Starter\Model\Response\SuccessResponse;

/**
 * @SWG\Definition(title="CheckoutResponse", type="object")
 */
class CheckinResponse extends SuccessResponse
{
    /**
     * @SWG\Property
     * @var Checkin
     */
    public $data;
}
