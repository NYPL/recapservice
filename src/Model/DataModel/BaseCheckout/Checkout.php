<?php
namespace NYPL\Services\Model\DataModel\BaseCheckout;

use NYPL\Services\Model\DataModel\BaseCheckout;
use NYPL\Starter\Model\ModelInterface\DeleteInterface;
use NYPL\Starter\Model\ModelInterface\MessageInterface;
use NYPL\Starter\Model\ModelInterface\ReadInterface;
use NYPL\Starter\Model\ModelTrait\DBCreateTrait;
use NYPL\Starter\Model\ModelTrait\DBDeleteTrait;
use NYPL\Starter\Model\ModelTrait\DBReadTrait;
use NYPL\Starter\Model\ModelTrait\DBUpdateTrait;

/**
 * @SWG\Definition(title="Item", type="object", required={"id"})
 */
class Checkout extends BaseCheckout implements MessageInterface, ReadInterface, DeleteInterface
{
    use DBCreateTrait, DBReadTrait, DBDeleteTrait, DBUpdateTrait;

    /**
     * @SWG\Property(example="10004854")
     * @var string
     */
    public $patron;

    public function getSchema()
    {
        return
            [
                "name" => "Checkout",
                "type" => "record",
                "fields" => [
                    ["name" => "id", "type" => "string"],
                    ["name" => "patron", "type" => "string"],
                    ["name" => "item", "type" => "string"],
                    ["name" => "barcode", "type" => "string"],
                    ["name" => "dueDate", "type" => ["string", "null"]],
                    ["name" => "callNumber", "type" => ["string", "null"]],
                    ["name" => "numberOfRenewals", "type" => ["int", "null"]],
                    ["name" => "outDate", "type" => ["string", "null"]],
                    ["name" => "recallDate", "type" => ["string", "null"]]
                ]
            ];
    }

    public function getIdFields()
    {
        return ["id"];
    }

    public function getSequenceId()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getPatron()
    {
        return $this->patron;
    }

    /**
     * @param string $patron
     */
    public function setPatron($patron)
    {
        $this->patron = $patron;
    }
}
