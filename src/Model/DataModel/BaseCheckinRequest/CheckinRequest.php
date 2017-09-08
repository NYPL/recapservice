<?php
namespace NYPL\Services\Model\DataModel\BaseCheckinRequest;

use NYPL\Services\Model\DataModel\BaseCheckinRequest;
use NYPL\Starter\Model\LocalDateTime;
use NYPL\Starter\Model\ModelInterface\DeleteInterface;
use NYPL\Starter\Model\ModelInterface\MessageInterface;
use NYPL\Starter\Model\ModelInterface\ReadInterface;
use NYPL\Starter\Model\ModelTrait\DBCreateTrait;
use NYPL\Starter\Model\ModelTrait\DBDeleteTrait;
use NYPL\Starter\Model\ModelTrait\DBReadTrait;
use NYPL\Starter\Model\ModelTrait\DBUpdateTrait;

/**
 * @SWG\Definition(type="object")
 */
class CheckinRequest extends BaseCheckinRequest implements MessageInterface, ReadInterface, DeleteInterface
{
    use DBCreateTrait, DBReadTrait, DBDeleteTrait, DBUpdateTrait;

    /**
     * @SWG\Property(example=124)
     * @var int
     */
    public $id;

    /**
     * @SWG\Property(example="5aaa1212cd")
     * @var string
     */
    public $jobId;

    /**
     * @SWG\Property(example=false)
     * @var bool
     */
    public $processed = false;

    /**
     * @SWG\Property(example=false)
     * @var bool
     */
    public $success = false;

    /**
     * @SWG\Property(example="2016-01-07T02:32:51Z", type="string")
     * @var LocalDateTime
     */
    public $updatedDate;

    /**
     * @SWG\Property(example="2008-12-24T03:16:00Z", type="string")
     * @var LocalDateTime
     */
    public $createdDate;

    public function getSchema()
    {
        return
            [
                "name" => "CheckinRequest",
                "type" => "record",
                "fields" => [
                    ["name" => "id", "type" => "int"],
                    ["name" => "itemBarcode", "type" => "string"],
                    ["name" => "owningInstitutionId", "type" => ["string", "null"]],
                    ["name" => "jobId", "type" => ["string", "null"]],
                    ["name" => "processed", "type" => "boolean"],
                    ["name" => "success", "type" => "boolean"],
                    ["name" => "updatedDate", "type" => ["string", "null"]],
                    ["name" => "createdDate", "type" => ["string", "null"]],
                ]
            ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function getIdFields()
    {
        return ["id"];
    }

    public function getSequenceId()
    {
        return "checkin_request_id_seq";
    }

    /**
     * @return string
     */
    public function getJobId()
    {
        return $this->jobId;
    }

    /**
     * @param string $jobId
     */
    public function setJobId($jobId)
    {
        $this->jobId = $jobId;
    }

    /**
     * @return boolean
     */
    public function isProcessed()
    {
        return $this->processed;
    }

    /**
     * @param boolean $processed
     */
    public function setProcessed($processed)
    {
        $this->processed = (bool) $processed;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = (bool) $success;
    }

    /**
     * @return LocalDateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * @param LocalDateTime $updatedDate
     */
    public function setUpdatedDate(LocalDateTime $updatedDate)
    {
        $this->updatedDate = $updatedDate;
    }

    /**
     * @param string $updatedDate
     *
     * @return LocalDateTime
     */
    public function translateUpdatedDate($updatedDate = '')
    {
        return new LocalDateTime(LocalDateTime::FORMAT_DATE_TIME_RFC, $updatedDate);
    }

    /**
     * @return LocalDateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param LocalDateTime $createdDate
     */
    public function setCreatedDate(LocalDateTime $createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @param string $createdDate
     *
     * @return LocalDateTime
     */
    public function translateCreatedDate($createdDate = '')
    {
        return new LocalDateTime(LocalDateTime::FORMAT_DATE_TIME_RFC, $createdDate);
    }
}
