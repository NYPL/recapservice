<?php
namespace NYPL\Services\Model\DataModel\BaseRecapRecallRequest;

use NYPL\Services\Model\DataModel\BaseRecapRecallRequest;
use NYPL\Starter\Config;
use NYPL\Starter\Model\LocalDateTime;
use NYPL\Starter\Model\ModelInterface\MessageInterface;
use NYPL\Starter\Model\ModelInterface\ReadInterface;
use NYPL\Starter\Model\ModelTrait\DBCreateTrait;
use NYPL\Starter\Model\ModelTrait\DBReadTrait;

/**
 * @SWG\Definition(type="object")
 */
class RecapRecallRequest extends BaseRecapRecallRequest implements MessageInterface, ReadInterface
{
    use DBCreateTrait, DBReadTrait;

    /**
     * @SWG\Property(example=483)
     * @var string
     */
    public $id = 0;

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

    /**
     * @SWG\Property(example="5aaa1212cd")
     * @var string
     */
    public $jobId;

    public function getStreamName()
    {
        return Config::get('RECAP_RECALL_REQUEST_STREAM_NAME');
    }

    public function getSchema()
    {
        return
            [
                "name" => "RecapRecallRequest",
                "type" => "record",
                "fields" => [
                    ["name" => "id", "type" => "int"],
                    ["name" => "jobId", "type" => ["string", "null"]],
                    ["name" => "owningInstitutionId", "type" => ["string", "null"]],
                    ["name" => "itemBarcode", "type" => ["string", "null"]],
                    ["name" => "updatedDate", "type" => ["string", "null"]],
                    ["name" => "createdDate", "type" => ["string", "null"]]
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
        return ['id'];
    }

    public function getSequenceId()
    {
        return 'recap_recall_request_id_seq';
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
    public function setJobId($jobId = '')
    {
        $this->jobId = $jobId;
    }
}
