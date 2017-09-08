<?php
namespace NYPL\Services\Model\DataModel\BaseMessage;

use NYPL\Services\Model\DataModel\BaseMessage;
use NYPL\Starter\Config;

class SierraItemRetrievalRequest extends BaseMessage
{
    /**
     * @var string
     */
    public $id = '';

    protected function getStreamName()
    {
        return Config::get('ITEM_RETRIEVAL_REQUEST_STREAM_NAME');
    }

    protected function getSchemaName()
    {
        return Config::get('ITEM_RETRIEVAL_REQUEST_SCHEMA_NAME');
    }

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
    public function setId($id = '')
    {
        $this->id = $id;
    }
}
