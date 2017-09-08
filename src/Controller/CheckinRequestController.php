<?php
namespace NYPL\Services\Controller;

use NYPL\Services\Model\DataModel\BaseCheckinRequest\CheckinRequest;
use NYPL\Services\Model\Response\SuccessResponse\CheckinRequestResponse;
use NYPL\Services\Model\Response\SuccessResponse\CheckinRequestsResponse;
use NYPL\Starter\Controller;
use NYPL\Starter\Filter;
use NYPL\Starter\JobManager;
use NYPL\Starter\ModelSet;

final class CheckinRequestController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/v0.1/checkin-requests",
     *     summary="Create a new Checkin Request",
     *     tags={"checkins"},
     *     operationId="createCheckinRequest",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="NewCheckinRequest",
     *         in="body",
     *         description="",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/NewCheckinRequest"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckinRequestResponse")
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not found",
     *         @SWG\Schema(ref="#/definitions/ErrorResponse")
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
    public function createCheckinRequest()
    {
        $data = $this->getRequest()->getParsedBody();

        $data['jobId'] = JobManager::createJob();

        $checkinRequest = new CheckinRequest($data);

        $checkinRequest->create();

        return $this->getResponse()->withJson(
            new CheckinRequestResponse($checkinRequest)
        );
    }

    /**
     * @SWG\Get(
     *     path="/v0.1/checkin-requests",
     *     summary="Get a list of Checkin Requests",
     *     tags={"checkins"},
     *     operationId="getCheckinRequests",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="itemBarcode",
     *         in="query",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="processed",
     *         in="query",
     *         required=false,
     *         type="boolean"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckinRequestsResponse")
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not found",
     *         @SWG\Schema(ref="#/definitions/ErrorResponse")
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
    public function getCheckinRequests()
    {
        return $this->getDefaultReadResponse(
            new ModelSet(new CheckinRequest()),
            new CheckinRequestsResponse(),
            null,
            ['processed', 'itemBarcode']
        );
    }

    /**
     * @SWG\Get(
     *     path="/v0.1/checkin-requests/{id}",
     *     summary="Get a Checkin Request",
     *     tags={"checkins"},
     *     operationId="getCheckinRequest",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of Checkin Request",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="string",
     *         format="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckinRequestResponse")
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not found",
     *         @SWG\Schema(ref="#/definitions/ErrorResponse")
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
    public function getCheckinRequest($id)
    {
        return $this->getDefaultReadResponse(
            new CheckinRequest(),
            new CheckinRequestResponse(),
            new Filter(null, null, false, $id)
        );
    }

    /**
     * @SWG\Patch(
     *     path="/v0.1/checkin-requests/{id}",
     *     summary="Update a Checkin Request",
     *     tags={"checkins"},
     *     operationId="updateCheckinRequest",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of Checkin Request",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="string",
     *         format="string"
     *     ),
     *     @SWG\Parameter(
     *         name="CheckinRequest",
     *         in="body",
     *         description="",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/CheckinRequest"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckinRequestResponse")
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not found",
     *         @SWG\Schema(ref="#/definitions/ErrorResponse")
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
    public function updateCheckinRequest($id)
    {
        $checkinRequest = new CheckinRequest();

        $checkinRequest->addFilter(new Filter('id', $id));

        $checkinRequest->update(
            $this->getRequest()->getParsedBody()
        );

        return $this->getResponse()->withJson(
            new CheckinRequestResponse($checkinRequest)
        );
    }
}
