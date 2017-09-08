<?php
namespace NYPL\Services\Model\Response\SuccessResponse;

use NYPL\Services\Model\DataModel\BaseCheckin\Checkin;
use NYPL\Starter\Model\Response\SuccessResponse;

/**
 * @SWG\Definition(title="CheckoutsResponse", type="object")
 */
class CheckinsResponse extends SuccessResponse
{
    /**
     * @SWG\Property
     * @var Checkin[]
     */
    public $data;
}
