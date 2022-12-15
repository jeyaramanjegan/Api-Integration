<?php
/**
 * @copyright   Copyright 2022 © jegan, Inc. All rights reserved.
 * @license     See COPYING.txt for license details.
 * @package     Loop_TrackingService
 * @author      jegan jeyaraman <jeganjeyaraman.yt@gmail.com>
 * @link        https://jegan.com/
 */



namespace Loop\TrackingService\Api;

interface TrackRepositoryInterface{

    /**
     * Return a filtered item.
     *
     * @return \Loop\TrackingService\Api\ResponseItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */

    public function getTrackItem();

}
