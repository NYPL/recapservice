<?php
namespace NYPL\Services\Model\Response\SuccessResponse;

use NYPL\Services\Model\DataModel\BaseRecapRecallRequest\RecapRecallRequest;
use NYPL\Starter\Model\Response\SuccessResponse;

/**
 * @SWG\Definition(title="RecapRecallRequestResponse", type="object")
 */
class RecapRecallRequestResponse extends SuccessResponse
{
    /**
     * @SWG\Property
     * @var RecapRecallRequest
     */
    public $data;
}
