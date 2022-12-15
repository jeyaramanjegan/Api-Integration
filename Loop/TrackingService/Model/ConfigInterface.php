<?php
/**
 * @copyright   Copyright 2022 © jegan, Inc. All rights reserved.
 * @license     See COPYING.txt for license details.
 * @package     Loop_TrackingService
 * @author      jegan jeyaraman <jeganjeyaraman.yt@gmail.com>
 * @link        https://jegan.com/
 */
namespace Loop\TrackingService\Model;

/**
 * Interface ConfigInterface
 */
interface ConfigInterface
{
    /**
     * Enabled config path
     */
    const XML_PATH_ENABLED = 'trackingservice/general/active';

    /**
     * client id config path
     */
    const XML_PATH_LOOP_CLINT_ID = 'trackingservice/general/loop_client_id';

    /**
     * secret key config path
     */
    const XML_PATH_LOOP_SECRET_KEY = 'trackingservice/general/loop_secret_key';


    /**
     * Check if module is enabled
     *
     * @return mixed
     */
    public function isEnabled();

    /**
     * Return client id
     *
     * @return mixed
     */
    public function getLoopClientId();

    /**
     * Return secret key
     *
     * @return mixed
     */
    public function getLoopSecretKey();

}
