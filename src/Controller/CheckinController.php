<?php
namespace NYPL\Services\Controller;

use NYPL\Services\Model\DataModel\BaseCheckin\Checkin;
use NYPL\Services\Model\Response\SuccessResponse\CheckinResponse;
use NYPL\Services\Model\Response\SuccessResponse\CheckinsResponse;
use NYPL\Starter\Controller;
use NYPL\Starter\Filter;
use NYPL\Starter\ModelSet;

final class CheckinController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/v0.1/checkins",
     *     summary="Create a new Checkin",
     *     tags={"checkins"},
     *     operationId="createCheckin",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="NewCheckin",
     *         in="body",
     *         description="",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/NewCheckin"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckinResponse")
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
    public function createCheckin()
    {
        $checkout = new Checkin($this->getRequest()->getParsedBody());

        $checkout->create();

        return $this->getResponse()->withJson(
            new CheckinResponse($checkout)
        );
    }

    /**
     * @SWG\Get(
     *     path="/v0.1/checkins",
     *     summary="Get a list of Checkins",
     *     tags={"checkins"},
     *     operationId="getCheckins",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="offset",
     *         in="query",
     *         required=false,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="limit",
     *         in="query",
     *         required=false,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckinsResponse")
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
    public function getCheckins()
    {
        return $this->getDefaultReadResponse(
            new ModelSet(new Checkin(), true),
            new CheckinsResponse()
        );
    }

    /**
     * @SWG\Get(
     *     path="/v0.1/checkins/{id}",
     *     summary="Get a Checkin",
     *     tags={"checkins"},
     *     operationId="getCheckin",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of Checkin",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="string",
     *         format="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckinResponse")
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
    public function getCheckin($id)
    {
        return $this->getDefaultReadResponse(
            new Checkin(),
            new CheckinResponse(),
            new Filter(null, null, false, $id)
        );
    }
}
