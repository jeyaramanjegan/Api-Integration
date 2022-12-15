<?php
/**
 * @copyright   Copyright 2022 © jegan, Inc. All rights reserved.
 * @license     See COPYING.txt for license details.
 * @package     Loop_TrackingService
 * @author      jegan jeyaraman <jeganjeyaraman.yt@gmail.com>
 * @link        https://jegan.com/
 */

namespace Loop\TrackingService\Observer\Quote;

use Magento\Catalog\Model\Product;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Loop\TrackingService\Model\ProductTracker;
use Loop\TrackingService\Model\ConfigInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\View\Result\PageFactory;
use Loop\TrackingService\Model\TrackFactory;

class Item implements ObserverInterface
{

    /**
     * @var ProductTracker
     */
    private $producttracker;

    /**
     * @var ConfigInterface
     */
    private $connectConfig;

    /**
     * @var ResourceConnection
     */
    private ResourceConnection $_resource;
    /**
     * @var PageFactory
     */
    private PageFactory $_pageFactory;
    /**
     * @var TrackFactory
     */
    private TrackFactory $_trackFactory;

    /**
     * Item constructor.
     * @param ProductTracker $producttracker
     * @param ConfigInterface $connectConfig
     */
    public function __construct(
        producttracker $producttracker,
        ConfigInterface $connectConfig,
        ResourceConnection $resource,
        PageFactory $pageFactory,
        TrackFactory $trackFactory
    )
    {
        $this->producttracker = $producttracker;
        $this->connectConfig = $connectConfig;
        $this->_resource     = $resource;
        $this->_pageFactory = $pageFactory;
        $this->_trackFactory = $trackFactory;
    }

    /**
     * @param Observer $observer
     * @throws \Exception
     */
    public function execute(Observer $observer)
    {
        if ($this->connectConfig->isEnabled()) {
            $event = $observer->getEvent();
            /** @var Product $product */
            $product = $event->getData('product');
            $productSku = $product->getSku();
            $productPrice = number_format($product->getPrice(), 1);
            $trackDetails = [
                'sku' => $productSku,
                'price' => $productPrice,
            ];
            $trackResponse = $this->producttracker->addLoopTrackingInfo($trackDetails);
            $trackResponse += ['sku' => $productSku];
            if ($trackResponse !== '') {
                $track = $this->_trackFactory->create();
                $track->setData($trackResponse);
                $track->save($track);
            }
        }
    }
}
