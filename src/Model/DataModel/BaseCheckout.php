<?php
namespace NYPL\Services\Model\DataModel;

use NYPL\Services\Model\DataModel;
use NYPL\Starter\Model\LocalDateTime;
use NYPL\Starter\Model\ModelTrait\TranslateTrait;

abstract class BaseCheckout extends DataModel
{
    use TranslateTrait;

    /**
     * @SWG\Property(example="13453452")
     * @var string
     */
    public $id;

    /**
     * @SWG\Property(example="17746307")
     * @var string
     */
    public $item;

    /**
     * @SWG\Property(example="33433001888415")
     * @var string
     */
    public $barcode;

    /**
     * @SWG\Property(example="2013-03-20", type="string")
     * @var LocalDateTime
     */
    public $dueDate;

    /**
     * @SWG\Property(example="|h*ONPA 84-446")
     * @var string
     */
    public $callNumber;

    /**
     * @SWG\Property(example=0)
     * @var int
     */
    public $numberOfRenewals;

    /**
     * @SWG\Property(example="2013-03-20", type="string")
     * @var LocalDateTime
     */
    public $outDate;

    /**
     * @SWG\Property(example="2013-03-20", type="string")
     * @var LocalDateTime
     */
    public $recallDate;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param string $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }

    /**
     * @return string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     * @return LocalDateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param LocalDateTime $dueDate
     */
    public function setDueDate(LocalDateTime $dueDate)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @param array|string $data
     *
     * @return LocalDateTime
     */
    public function translateDueDate($data)
    {
        return new LocalDateTime(LocalDateTime::FORMAT_DATE, $data);
    }

    /**
     * @return string
     */
    public function getCallNumber()
    {
        return $this->callNumber;
    }

    /**
     * @param string $callNumber
     */
    public function setCallNumber($callNumber)
    {
        $this->callNumber = $callNumber;
    }

    /**
     * @return int
     */
    public function getNumberOfRenewals()
    {
        return $this->numberOfRenewals;
    }

    /**
     * @param int $numberOfRenewals
     */
    public function setNumberOfRenewals($numberOfRenewals)
    {
        $this->numberOfRenewals = (int) $numberOfRenewals;
    }

    /**
     * @return LocalDateTime
     */
    public function getOutDate()
    {
        return $this->outDate;
    }

    /**
     * @param LocalDateTime $outDate
     */
    public function setOutDate(LocalDateTime $outDate = null)
    {
        $this->outDate = $outDate;
    }

    /**
     * @param array|string $data
     *
     * @return LocalDateTime
     */
    public function translateOutDate($data)
    {
        if ($data) {
            return new LocalDateTime(LocalDateTime::FORMAT_DATE, $data);
        }
    }

    /**
     * @return LocalDateTime
     */
    public function getRecallDate()
    {
        return $this->recallDate;
    }

    /**
     * @param LocalDateTime $recallDate
     */
    public function setRecallDate(LocalDateTime $recallDate = null)
    {
        $this->recallDate = $recallDate;
    }

    /**
     * @param array|string $data
     *
     * @return LocalDateTime
     */
    public function translateRecallDate($data)
    {
        if ($data) {
            return new LocalDateTime(LocalDateTime::FORMAT_DATE, $data);
        }
    }
}
