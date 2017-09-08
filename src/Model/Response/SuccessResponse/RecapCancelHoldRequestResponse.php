<?php
namespace NYPL\Services\Model\Response\SuccessResponse;

use NYPL\Services\Model\DataModel\BaseCancelRecapHoldRequest\RecapCancelHoldRequest;
use NYPL\Starter\Model\Response\SuccessResponse;

/**
 * @SWG\Definition(title="RecapHoldRequestResponse", type="object")
 */
class RecapCancelHoldRequestResponse extends SuccessResponse
{
    /**
     * @SWG\Property
     * @var RecapCancelHoldRequest
     */
    public $data;
}
