<?php

namespace Yooer\Payment\Exceptions;

class PaymentException extends \Exception
{
    /**
     * @var array 响应数据
     */
    private $responseData;
    
    /**
     * 创建支付异常
     * 
     * @param string $message 异常消息
     * @param array $responseData 响应数据
     * @param int $code 错误代码
     */
    public function __construct(string $message, array $responseData = [], int $code = 0)
    {
        parent::__construct($message, $code);
        $this->responseData = $responseData;
    }
    
    /**
     * 获取响应数据
     * 
     * @return array
     */
    public function getResponseData(): array
    {
        return $this->responseData;
    }
}