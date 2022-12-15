<?php
/**
 * @copyright   Copyright 2022 © jegan, Inc. All rights reserved.
 * @license     See COPYING.txt for license details.
 * @package     Loop_TrackingService
 * @author      jegan jeyaraman <jeganjeyaraman.yt@gmail.com>
 * @link        https://jegan.com/
 */
namespace Loop\TrackingService\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 * @package Loop\TrackingService\Model
 */
class Config implements ConfigInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getLoopClientId()
    {
        return $this->scopeConfig->getValue(
            ConfigInterface::XML_PATH_LOOP_CLINT_ID,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getLoopSecretKey()
    {
        return $this->scopeConfig->getValue(
            ConfigInterface::XML_PATH_LOOP_SECRET_KEY,
            ScopeInterface::SCOPE_STORE
        );
    }
}
