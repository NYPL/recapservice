<?php
namespace NYPL\Services\Model\DataModel\BaseTest;

use NYPL\Services\Model\DataModel\BaseTest;

/**
 * @SWG\Definition(type="object")
 */
class RetrievalRequestTest extends BaseTest
{
    /**
     * @SWG\Property(example="bib")
     * @var string
     */
    public $recordType = '';

    /**
     * @SWG\Property(type="array", @SWG\Items(type="string"))
     * @var array
     */
    public $ids = [];

    /**
     * @return string
     */
    public function getRecordType()
    {
        return $this->recordType;
    }

    /**
     * @param string $recordType
     */
    public function setRecordType($recordType = '')
    {
        $this->recordType = $recordType;
    }

    /**
     * @return array
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param array $ids
     */
    public function setIds($ids = [])
    {
        $this->ids = $ids;
    }
}
