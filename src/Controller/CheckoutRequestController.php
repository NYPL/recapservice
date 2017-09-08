<?php
namespace NYPL\Services\Controller;

use NYPL\Services\Model\DataModel\BaseCheckoutRequest\CheckoutRequest;
use NYPL\Services\Model\Response\SuccessResponse\CheckoutRequestResponse;
use NYPL\Services\Model\Response\SuccessResponse\CheckoutRequestsResponse;
use NYPL\Starter\Controller;
use NYPL\Starter\Filter;
use NYPL\Starter\JobManager;
use NYPL\Starter\ModelSet;

final class CheckoutRequestController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/v0.1/checkout-requests",
     *     summary="Create a new Checkout Request",
     *     tags={"checkouts"},
     *     operationId="createCheckoutRequest",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="NewCheckoutRequest",
     *         in="body",
     *         description="",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/NewCheckoutRequest"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckoutRequestResponse")
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
    public function createCheckoutRequest()
    {
        $data = $this->getRequest()->getParsedBody();

        $data['jobId'] = JobManager::createJob();

        $checkoutRequest = new CheckoutRequest($data);

        $checkoutRequest->create();

        return $this->getResponse()->withJson(
            new CheckoutRequestResponse($checkoutRequest)
        );
    }

    /**
     * @SWG\Get(
     *     path="/v0.1/checkout-requests",
     *     summary="Get a list of Checkout Requests",
     *     tags={"checkouts"},
     *     operationId="getCheckoutRequests",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="patronBarcode",
     *         in="query",
     *         required=false,
     *         type="string"
     *     ),
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
     *         @SWG\Schema(ref="#/definitions/CheckoutRequestsResponse")
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
    public function getCheckoutRequests()
    {
        return $this->getDefaultReadResponse(
            new ModelSet(new CheckoutRequest()),
            new CheckoutRequestsResponse(),
            null,
            ['patronBarcode', 'processed', 'itemBarcode']
        );
    }

    /**
     * @SWG\Get(
     *     path="/v0.1/checkout-requests/{id}",
     *     summary="Get a Checkout Request",
     *     tags={"checkouts"},
     *     operationId="getCheckoutRequest",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of Checkout Request",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="string",
     *         format="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckoutRequestResponse")
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
    public function getCheckoutRequest($id)
    {
        return $this->getDefaultReadResponse(
            new CheckoutRequest(),
            new CheckoutRequestResponse(),
            new Filter(null, null, false, $id)
        );
    }

    /**
     * @SWG\Patch(
     *     path="/v0.1/checkout-requests/{id}",
     *     summary="Update a Checkout Request",
     *     tags={"checkouts"},
     *     operationId="updateCheckoutRequest",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of Checkout Request",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="string",
     *         format="string"
     *     ),
     *     @SWG\Parameter(
     *         name="CheckoutRequest",
     *         in="body",
     *         description="",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/CheckoutRequest"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckoutRequestResponse")
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
    public function updateCheckoutRequest($id)
    {
        $checkoutRequest = new CheckoutRequest();

        $checkoutRequest->addFilter(new Filter('id', $id));

        $checkoutRequest->update(
            $this->getRequest()->getParsedBody()
        );

        return $this->getResponse()->withJson(
            new CheckoutRequestResponse($checkoutRequest)
        );
    }
}
