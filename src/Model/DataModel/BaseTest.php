<?php
namespace NYPL\Services\Model\DataModel;

use GuzzleHttp\Client;
use NYPL\Services\Model\DataModel;
use NYPL\Starter\Config;

abstract class BaseTest extends DataModel
{
    /**
     * @param string $stream
     *
     * @return array
     */
    public function retrieveSchema($stream = '')
    {
        $client = new Client();

        $response = json_decode(
            $client->get(Config::get('API_BASE_URL') . 'current-schemas/' . $stream)->getBody(),
            true
        );

        return $response['data']['schemaObject'];
    }
}
