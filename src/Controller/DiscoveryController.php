<?php
namespace NYPL\Services\Controller;

use NYPL\Services\Model\DataModel\BaseMessage\SierraBibRetrievalRequest;
use NYPL\Services\Model\DataModel\BaseMessage\SierraItemRetrievalRequest;
use NYPL\Services\Model\DataModel\BaseTest\RetrievalRequestTest;
use NYPL\Services\Model\DataModel\SierraItem;
use NYPL\Services\Model\DataModel\SierraItemSet;
use NYPL\Starter\APIException;
use NYPL\Starter\Controller;
use NYPL\Starter\Filter\QueryFilter;

final class DiscoveryController extends Controller
{
    /**
     * @throws APIException
     * @SWG\Post(
     *     path="/v0.1/discovery/tests/requests",
     *     summary="Create a test Bib or Item retrieval request",
     *     tags={"discovery"},
     *     operationId="createRequestTest",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="RetrievalRequestTest",
     *         in="body",
     *         description="",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/RetrievalRequestTest"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="Generic server error",
     *         @SWG\Schema(ref="#/definitions/ErrorResponse")
     *     ),
     *     security={
     *         {
     *             "api_auth": {"openid offline_access api"}
     *         }
     *     }
     * )
     */
    public function createRequestTest()
    {
        $this->setContentType('text/html');

        $requestTest = new RetrievalRequestTest($this->getRequest()->getParsedBody());

        if ($requestTest->getRecordType() === 'bib') {
            $message = new SierraBibRetrievalRequest();
        }

        if ($requestTest->getRecordType() === 'item') {
            $message = new SierraItemRetrievalRequest();
        }

        if (!isset($message)) {
            throw new APIException(
                'Invalid record type specified (' . $requestTest->getRecordType() . ')',
                null,
                0,
                null,
                400
            );
        }

        foreach ($requestTest->getIds() as $id) {
            if ($requestTest->getRecordType() === 'bib') {
                $sierraItems = new SierraItemSet(new SierraItem());
                $sierraItems->addFilter(
                    new QueryFilter('bibIds', $id)
                );
                $sierraItems->read();

                /**
                 * @var SierraItem $sierraItem
                 */
                foreach ($sierraItems->getData() as $sierraItem) {
                    $item = new SierraItemRetrievalRequest();
                    $item->setId($sierraItem->getId());
                    $item->publish();
                }
            }

            $message->setId($id);
            $message->publish();
        }

        return $this->getResponse();
    }
}
