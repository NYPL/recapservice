<?php
namespace NYPL\Services\Model\DataModel;

use GuzzleHttp\Client;
use NYPL\Services\Model\DataModel;
use NYPL\Starter\Config;
use NYPL\Starter\Model\ModelInterface\MessageInterface;
use NYPL\Starter\Model\ModelTrait\MessageTrait;
use NYPL\Starter\Model\ModelTrait\TranslateTrait;

abstract class BaseMessage extends DataModel implements MessageInterface
{
    use TranslateTrait, MessageTrait;

    /**
     * @return string
     */
    protected function getStreamName()
    {
        $reflection = new \ReflectionClass($this);

        return $reflection->getShortName();
    }

    /**
     * @return string
     */
    protected function getSchemaName()
    {
        return $this->getStreamName();
    }

    /**
     * @param string $stream
     *
     * @return array
     */
    public function retrieveSchema($stream = '')
    {
        $client = new Client();

        $response = json_decode(
            $client->get(Config::get('API_BASE_URL') . 'current-schemas/' . $this->getSchemaName())->getBody(),
            true
        );

        return $response['data']['schemaObject'];
    }

    /**
     * @return array
     */
    public function getSchema()
    {
        return $this->retrieveSchema($this->getStreamName());
    }

    public function publish()
    {
        $this->publishMessage($this->getStreamName(), $this->createMessage());
    }
}
