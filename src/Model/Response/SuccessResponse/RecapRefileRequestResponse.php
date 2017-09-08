<?php
namespace NYPL\Services\Model\Response\SuccessResponse;

use NYPL\Services\Model\DataModel\BaseRecapRecallRequest\RecapRecallRequest;
use NYPL\Starter\Model\Response\SuccessResponse;

/**
 * @SWG\Definition(title="RecapRefileRequestResponse", type="object")
 */
class RecapRefileRequestResponse extends SuccessResponse
{
    /**
     * @SWG\Property
     * @var RecapRecallRequest
     */
    public $data;
}
