<?php
namespace NYPL\Services\Controller;

use NYPL\Services\ItemClient;
use NYPL\Services\Model\DataModel\BaseRecapRecallRequest\RecapRecallRequest;
use NYPL\Services\Model\DataModel\BaseRecapRefileRequest\RecapRefileRequest;
use NYPL\Services\Model\Response\SuccessResponse\RecapRecallRequestResponse;
use NYPL\Services\Model\Response\SuccessResponse\RecapRefileRequestResponse;
use NYPL\Starter\APIException;
use NYPL\Starter\APILogger;
use NYPL\Starter\CacheModel\BaseJob\Job;
use NYPL\Starter\CacheModel\JobNotice\JobNoticeCreated;
use NYPL\Starter\CacheModel\JobStatus;
use NYPL\Starter\Config;
use NYPL\Starter\Controller;
use NYPL\Starter\JobClient;
use NYPL\Starter\JobStatus\JobStatusSuccess;

final class RecapController extends Controller
{
    /**
     * @var \sip2
     */
    protected $sip2Client;

    /**
     * @throws APIException
     * @return \sip2
     */
    public function getSip2Client()
    {
        if (!$this->sip2Client) {
            $this->setSip2Client(
                $this->initializeSip2Client()
            );
        }

        return $this->sip2Client;
    }

    /**
     * @param \sip2 $sip2Client
     */
    public function setSip2Client(\sip2 $sip2Client)
    {
        $this->sip2Client = $sip2Client;
    }

    /**
     * @throws APIException
     * @return \sip2
     */
    protected function initializeSip2Client()
    {
        $sipClient = new \sip2();

        $sipClient->hostname = Config::get('SIP2_HOSTNAME');
        $sipClient->port = Config::get('SIP2_PORT');

        $sipClient->connect();

        $sipClient->AC = Config::get('SIP2_TERMINAL_PASSWORD', null, true);

        return $sipClient;
    }

    /**
     * @throws APIException
     * @return Job
     */
    protected function createFakeJob($jobName = '')
    {
        $job = new Job();

        $jobStatus = new JobStatus();
        $jobStatus->setNotice(new JobNoticeCreated([
            'text' => $jobName . ' job has started.'
        ]));

        $jobClient = new JobClient();
        $jobClient->createJob($job);

        $jobClient->startJob(
            $job,
            $jobStatus
        );

        $jobStatus = new JobStatusSuccess();
        $jobStatus->setNotice(new JobNoticeCreated([
            'text' => $jobName . ' job has finished.'
        ]));

        $jobClient->success(
            $job,
            $jobStatus
        );

        return $job;
    }

    /**
     * @SWG\Post(
     *     path="/v0.1/recap/recall-requests",
     *     summary="Create a ReCAP Recall Request",
     *     tags={"recap"},
     *     operationId="createRecallRequest",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="NewRecapRecallRequest",
     *         in="body",
     *         description="",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/NewRecapRecallRequest"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/RecapRecallRequestResponse")
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
     * @throws \Exception
     */
    public function createRecallRequest()
    {
        $data = $this->getRequest()->getParsedBody();

        $data['jobId'] = $this->createFakeJob('Recall')->getId();

        $recapRecallRequest = new RecapRecallRequest($data);

        $recapRecallRequest->create();

        return $this->getResponse()->withJson(
            new RecapRecallRequestResponse($recapRecallRequest)
        );
    }

    /**
     * @SWG\Post(
     *     path="/v0.1/recap/refile-requests",
     *     summary="Create a ReCAP Refile Request",
     *     tags={"recap"},
     *     operationId="createRefileRequest",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="NewRecapRefileRequest",
     *         in="body",
     *         description="",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/NewRecapRefileRequest"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(ref="#/definitions/RecapRefileRequestResponse")
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
     * @throws \Exception
     */
    public function createRefileRequest()
    {
        $data = $this->getRequest()->getParsedBody();

        $data['jobId'] = $this->createFakeJob('Refile')->getId();

        $recapRefileRequest = new RecapRefileRequest($data);

        $recapRefileRequest->create();

        try {
            APILogger::addNotice('Beginning refile of item barcode ' . $data['itemBarcode']);

            APILogger::addNotice('Getting item record');

            $itemClient = new ItemClient();

            $response = $itemClient->get('items?barcode=' . $data['itemBarcode']);

            $item = json_decode($response->getBody(), true)['data'][0];

            APILogger::addNotice('Received item record', $item);

            APILogger::addNotice('Sending SIP2 call', [
                'barcode' => $item['barcode'],
                'locationCode' => $item['location']['code']
            ]);

            $checkinResponse = $this->getSip2Client()->msgCheckin(
                $item['barcode'],
                time(),
                $item['location']['code']
            );

            $result = $this->getSip2Client()->parseCheckinResponse(
                $this->getSip2Client()->get_message($checkinResponse)
            );

            APILogger::addNotice('Received SIP2 message', $result);
        } catch (\Exception $exception) {
            APILogger::addError('Refile SIP2 request failed: ' . $exception->getMessage());
        }

        return $this->getResponse()->withJson(
            new RecapRefileRequestResponse($recapRefileRequest)
        );
    }
}
