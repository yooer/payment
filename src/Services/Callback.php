<?php

namespace Yooer\Payment\Services;

use Yooer\Payment\Config;
use Yooer\Payment\Utils\Signature;

class Callback
{
    /**
     * @var Config 配置
     */
    private $config;
    
    /**
     * 创建回调服务
     * 
     * @param Config $config 配置
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }
    
    /**
     * 验证回调数据
     * 
     * @param array $data 回调数据
     * @return bool 验证结果
     */
    public function verifyCallback(array $data): bool
    {
        return Signature::verify($data, $this->config->getSecretKey());
    }
}