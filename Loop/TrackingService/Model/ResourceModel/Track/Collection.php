<?php
/**
 * @copyright   Copyright 2022 © jegan, Inc. All rights reserved.
 * @license     See COPYING.txt for license details.
 * @package     Loop_TrackingService
 * @author      jegan jeyaraman <jeganjeyaraman.yt@gmail.com>
 * @link        https://jegan.com/
 */

namespace Loop\TrackingService\Model\ResourceModel\Track;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'item_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init(\Loop\TrackingService\Model\Track::class, \Loop\TrackingService\Model\ResourceModel\Track::class);
    }

}
