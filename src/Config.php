<?php

namespace Yooer\Payment;

class Config
{
    /**
     * @var string API 基础 URL
     */
    private $baseUri = "https://payment.ringbeta.com";
    
    /**
     * @var int 商户 ID
     */
    private $merchantId;
    
    /**
     * @var string 密钥
     */
    private $secretKey;
    
    /**
     * @var int 超时时间(秒)
     */
    private $timeout = 5;
    
    /**
     * @var int 连接超时(秒)
     */
    private $connectTimeout = 3;
    
    /**
     * 创建配置实例
     * 
     * @param string $baseUri 支付API基础URL
     * @param int $merchantId 商户ID
     * @param string $secretKey 商户密钥
     */
    public function __construct(int $merchantId, string $secretKey)
    {
        $this->merchantId = $merchantId;
        $this->secretKey = $secretKey;
    }
    
    /**
     * 设置超时时间
     * 
     * @param int $timeout 请求超时(秒)
     * @param int $connectTimeout 连接超时(秒)
     * @return $this
     */
    public function setTimeout(int $timeout, int $connectTimeout = 3)
    {
        $this->timeout = $timeout;
        $this->connectTimeout = $connectTimeout;
        return $this;
    }
    
    /**
     * 获取API基础URL
     * 
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }
    
    /**
     * 获取商户ID
     * 
     * @return int
     */
    public function getMerchantId(): int
    {
        return $this->merchantId;
    }
    
    /**
     * 获取密钥
     * 
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }
    
    /**
     * 获取请求超时时间
     * 
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }
    
    /**
     * 获取连接超时时间
     * 
     * @return int
     */
    public function getConnectTimeout(): int
    {
        return $this->connectTimeout;
    }
}