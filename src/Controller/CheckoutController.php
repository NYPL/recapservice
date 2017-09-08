<?php
namespace NYPL\Services\Controller;

use NYPL\Starter\Controller;
use NYPL\Starter\Filter;
use NYPL\Services\Model\DataModel\BaseCheckout\Checkout;
use NYPL\Services\Model\Response\SuccessResponse\CheckoutResponse;
use NYPL\Services\Model\Response\SuccessResponse\CheckoutsResponse;
use NYPL\Starter\ModelSet;

final class CheckoutController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/v0.1/checkouts",
     *     summary="Create a new Checkout",
     *     tags={"checkouts"},
     *     operationId="createCheckout",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="NewCheckout",
     *         in="body",
     *         description="",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/NewCheckout"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckoutResponse")
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
    public function createCheckout()
    {
        $checkout = new Checkout($this->getRequest()->getParsedBody());

        $checkout->create(true);

        return $this->getResponse()->withJson(
            new CheckoutResponse($checkout)
        );
    }

    /**
     * @SWG\Get(
     *     path="/v0.1/checkouts",
     *     summary="Get a list of Checkouts",
     *     tags={"checkouts"},
     *     operationId="getCheckouts",
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
     *         @SWG\Schema(ref="#/definitions/CheckoutsResponse")
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
    public function getCheckouts()
    {
        return $this->getDefaultReadResponse(
            new ModelSet(new Checkout(), true),
            new CheckoutsResponse()
        );
    }

    /**
     * @SWG\Get(
     *     path="/v0.1/checkouts/{id}",
     *     summary="Get a Checkout",
     *     tags={"checkouts"},
     *     operationId="getCheckout",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of Checkout",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="string",
     *         format="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/CheckoutResponse")
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
    public function getCheckout($id)
    {
        return $this->getDefaultReadResponse(
            new Checkout(),
            new CheckoutResponse(),
            new Filter(null, null, false, $id)
        );
    }
}
