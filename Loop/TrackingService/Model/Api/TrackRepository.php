<?php
/**
 * @copyright   Copyright 2022 © jegan, Inc. All rights reserved.
 * @license     See COPYING.txt for license details.
 * @package     Loop_TrackingService
 * @author      jegan jeyaraman <jeganjeyaraman.yt@gmail.com>
 * @link        https://jegan.com/
 */

namespace Loop\TrackingService\Model\Api;

use Loop\TrackingService\Api\TrackRepositoryInterface;
use Loop\TrackingService\Model\ResourceModel\Track\CollectionFactory as TrackCollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

class TrackRepository implements TrackRepositoryInterface{

    /**
     * @var TrackCollectionFactory
     */
    private $trackCollectionFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * TrackRepository constructor.
     * @param TrackCollectionFactory $trackCollectionFactory
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        TrackCollectionFactory $trackCollectionFactory,
        StoreManagerInterface $storeManager
    ){
        $this->trackCollectionFactory = $trackCollectionFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * @return array
     * @throws NoSuchEntityException
     */
    public function getTrackItem()
    {
        /** @var TrackCollectionFactory $collection */
        $collection = $this->trackCollectionFactory->create();

        $arrResponse =[];
        $i = 0;
        foreach ($collection as $item){

            if (!$item->getItemId()) {
                throw new NoSuchEntityException(__('Track Item not found'));
            }
            $arrResponse['items'][$i++] = $item->getData();
        }
        $response['items'] = $arrResponse;
        return $response;
    }
}
