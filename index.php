<?php
require __DIR__ . '/vendor/autoload.php';

use Slim\Http\Request;
use Slim\Http\Response;
use NYPL\Starter\Service;
use NYPL\Services\Controller;
use NYPL\Starter\SwaggerGenerator;
use NYPL\Starter\ErrorHandler;
use NYPL\Starter\Config;

try {
    Config::initialize(__DIR__);

    $service = new Service();

    $service->get("/docs/recap", function (Request $request, Response $response) {
        return SwaggerGenerator::generate(
            [__DIR__ . "/src", __DIR__ . "/vendor/nypl/microservice-starter/src"],
            $response
        );
    });

    $service->get("/api/v0.1/checkouts", function (Request $request, Response $response) {
        $controller = new Controller\CheckoutController($request, $response);
        return $controller->getCheckouts();
    });

    $service->post("/api/v0.1/checkouts", function (Request $request, Response $response) {
        $controller = new Controller\CheckoutController($request, $response);
        return $controller->createCheckout();
    });

    $service->get("/api/v0.1/checkouts/{id}", function (Request $request, Response $response, $parameters) {
        $controller = new Controller\CheckoutController($request, $response);
        return $controller->getCheckout($parameters["id"]);
    });

    $service->post("/api/v0.1/checkout-requests", function (Request $request, Response $response) {
        $controller = new Controller\CheckoutRequestController($request, $response);
        return $controller->createCheckoutRequest();
    });

    $service->get("/api/v0.1/checkout-requests", function (Request $request, Response $response) {
        $controller = new Controller\CheckoutRequestController($request, $response);
        return $controller->getCheckoutRequests();
    });

    $service->get("/api/v0.1/checkout-requests/{id}", function (Request $request, Response $response, $parameters) {
        $controller = new Controller\CheckoutRequestController($request, $response);
        return $controller->getCheckoutRequest($parameters['id']);
    });

    $service->patch("/api/v0.1/checkout-requests/{id}", function (Request $request, Response $response, $parameters) {
        $controller = new Controller\CheckoutRequestController($request, $response);
        return $controller->updateCheckoutRequest($parameters['id']);
    });

    $service->post("/api/v0.1/recap/hold-requests", function (Request $request, Response $response) {
        $controller = new Controller\RecapController($request, $response);
        return $controller->createRecapHoldRequest();
    });

    $service->post("/api/v0.1/recap/cancel-hold-requests", function (Request $request, Response $response) {
        $controller = new Controller\RecapController($request, $response);
        return $controller->cancelRecapHoldRequest();
    });

    $service->post("/api/v0.1/recap/recall-requests", function (Request $request, Response $response) {
        $controller = new Controller\RecapController($request, $response);
        return $controller->createRecallRequest();
    });

    $service->post("/api/v0.1/recap/refile-requests", function (Request $request, Response $response) {
        $controller = new Controller\RecapController($request, $response);
        return $controller->createRefileRequest();
    });

    $service->get("/api/v0.1/checkins", function (Request $request, Response $response) {
        $controller = new Controller\CheckinController($request, $response);
        return $controller->getCheckins();
    });

    $service->post("/api/v0.1/checkins", function (Request $request, Response $response) {
        $controller = new Controller\CheckinController($request, $response);
        return $controller->createCheckin();
    });

    $service->get("/api/v0.1/checkins/{id}", function (Request $request, Response $response, $parameters) {
        $controller = new Controller\CheckinController($request, $response);
        return $controller->getCheckin($parameters["id"]);
    });

    $service->post("/api/v0.1/checkin-requests", function (Request $request, Response $response) {
        $controller = new Controller\CheckinRequestController($request, $response);
        return $controller->createCheckinRequest();
    });

    $service->get("/api/v0.1/checkin-requests", function (Request $request, Response $response) {
        $controller = new Controller\CheckinRequestController($request, $response);
        return $controller->getCheckinRequests();
    });

    $service->get("/api/v0.1/checkin-requests/{id}", function (Request $request, Response $response, $parameters) {
        $controller = new Controller\CheckinRequestController($request, $response);
        return $controller->getCheckinRequest($parameters['id']);
    });

    $service->patch("/api/v0.1/checkin-requests/{id}", function (Request $request, Response $response, $parameters) {
        $controller = new Controller\CheckinRequestController($request, $response);
        return $controller->updateCheckinRequest($parameters['id']);
    });

    $service->post("/api/v0.1/discovery/tests/requests", function (Request $request, Response $response) {
        $controller = new Controller\DiscoveryController($request, $response);
        return $controller->createRequestTest();
    });

    $service->run();
} catch (Exception $exception) {
    ErrorHandler::processShutdownError($exception->getMessage(), $exception);
}
