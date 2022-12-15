<?php
/**
 * @copyright   Copyright 2022 © jegan, Inc. All rights reserved.
 * @license     See COPYING.txt for license details.
 * @package     Loop_TrackingService
 * @author      jegan jeyaraman <jeganjeyaraman.yt@gmail.com>
 * @link        https://jegan.com/
 */

namespace Loop\TrackingService\Model;

use Magento\Framework\Encryption\Encryptor;
use Magento\Framework\HTTP\Client\Curl;
use Psr\Log\LoggerInterface;

class ProductTracker{
    /**
     * @var Curl
     */
    protected $curlClient;

    /**
     * @var string
     */
    protected $urlPrefix = 'https://';

    /**
     * @var string
     */
   // protected $accessTokenUrl = 'supertracking.view.agentur-loop.com/v1/oauth2/token';

    /**
     * @var string
     */
    protected $apiUrl = 'supertracking.view.agentur-loop.com/trackme';

    /**
     * @var Encryptor
     */
    private Encryptor $encryptor;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ConfigInterface
     */
    private ConfigInterface $connectConfig;

    /**
     * ProductTracker constructor.
     * @param Curl $curl
     * @param Encryptor $encryptor
     * @param ConfigInterface $connectConfig
     * @param LoggerInterface $logger
     */
    public function __construct(
        Curl $curl,
        Encryptor $encryptor,
        ConfigInterface $connectConfig,
        LoggerInterface $logger
    ) {
        $this->curlClient = $curl;
        $this->encryptor = $encryptor;
        $this->connectConfig = $connectConfig;
        $this->logger = $logger;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->urlPrefix . $this->apiUrl;
    }

    /**
     * @param $trackDetails
     * @return mixed
     */
    public function addLoopTrackingInfo($trackDetails)
    {
        $apiUrl = $this->getApiUrl();

        // The trackers array, the API can handle multiple transactions at a time.
        $trackers = $trackDetails;
        try {
            $this->getCurlClient()->post($apiUrl, json_encode($trackers));
            $response = json_decode($this->getCurlClient()->getBody(), true);
        } catch (Exception $e) {
            throw new Exception("Tracking Item not added");
        }

        return $response;
    }

    /**
     * @return Curl
     */
    public function getCurlClient()
    {
        return $this->curlClient;
    }
}
