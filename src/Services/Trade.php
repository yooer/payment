<?php

namespace Yooer\Payment\Services;

use Yooer\Payment\Client;
use Yooer\Payment\Exceptions\PaymentException;

class Trade
{
    /**
     * @var Client 支付客户端
     */
    private $client;
    
    /**
     * 创建交易服务
     * 
     * @param Client $client 支付客户端
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    /**
     * 创建订单
     * 
     * @param array $params 订单参数
     * @return array 订单结果
     * @throws PaymentException
     */
    public function create(array $params): array
    {
        return $this->client->post('/api/trade/create', $params);
    }
    
    /**
     * 查询订单
     * 
     * @param array $params 查询参数
     * @return array 查询结果
     * @throws PaymentException
     */
    public function query(array $params): array
    {
        return $this->client->post('/api/trade/query', $params);
    }
    
    /**
     * 申请退款
     * 
     * @param array $params 退款参数
     * @return array 退款结果
     * @throws PaymentException
     */
    public function refund(array $params): array
    {
        return $this->client->post('/api/trade/refund', $params);
    }
}