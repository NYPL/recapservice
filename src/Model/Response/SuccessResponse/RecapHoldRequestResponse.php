<?php
namespace NYPL\Services\Model\Response\SuccessResponse;

use NYPL\Services\Model\DataModel\BaseRecapHoldRequest\RecapHoldRequest;
use NYPL\Starter\Model\Response\SuccessResponse;

/**
 * @SWG\Definition(title="RecapHoldRequestResponse", type="object")
 */
class RecapHoldRequestResponse extends SuccessResponse
{
    /**
     * @SWG\Property
     * @var RecapHoldRequest
     */
    public $data;
}
