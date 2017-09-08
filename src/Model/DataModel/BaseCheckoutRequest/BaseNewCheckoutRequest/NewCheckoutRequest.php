<?php
namespace NYPL\Services\Model\DataModel\BaseHoldRequest\BaseNewCheckoutRequest;

use NYPL\Services\Model\DataModel\BaseCheckoutRequest\BaseNewCheckoutRequest;

/**
 * @SWG\Definition(type="object", required={"patronBarcode", "itemBarcode"})
 */
class NewCheckoutRequest extends BaseNewCheckoutRequest
{
}
