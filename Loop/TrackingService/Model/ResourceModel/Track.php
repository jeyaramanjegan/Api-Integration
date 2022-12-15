<?php
/**
 * @copyright   Copyright 2022 © jegan, Inc. All rights reserved.
 * @license     See COPYING.txt for license details.
 * @package     Loop_TrackingService
 * @author      jegan jeyaraman <jeganjeyaraman.yt@gmail.com>
 * @link        https://jegan.com/
 */

namespace Loop\TrackingService\Model\ResourceModel;


use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Model\AbstractModel;

class Track extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManagerInterface;

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        StoreManagerInterface $storeManager,
        $connectionName = null
    )
    {
        $this->storeManagerInterface = $storeManager;
        parent::__construct($context, $connectionName);
    }

    protected function _construct()
    {
        $this->_init('tracking_information', 'item_id');
    }
}
