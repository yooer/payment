<?php

namespace Yooer\Payment;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Yooer\Payment\Exceptions\PaymentException;
use Yooer\Payment\Utils\Signature;

class Client
{
    /**
     * @var Config 配置
     */
    private $config;
    
    /**
     * @var HttpClient HTTP客户端
     */
    private $httpClient;
    
    /**
     * 创建支付客户端
     * 
     * @param Config $config 配置信息
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->httpClient = new HttpClient([
            'base_uri' => $config->getBaseUri(),
            'timeout' => $config->getTimeout(),
            'connect_timeout' => $config->getConnectTimeout(),
        ]);
    }
    
    /**
     * 发送POST请求
     * 
     * @param string $endpoint 接口地址
     * @param array $data 请求数据
     * @return array 响应结果
     * @throws PaymentException
     */
    public function post(string $endpoint, array $data): array
    {
        $data['merchantsId'] = $this->config->getMerchantId();
        $data['signature'] = Signature::create($data, $this->config->getSecretKey());
        
        try {
            $response = $this->httpClient->request('POST', $endpoint, ['json' => $data]);
            $body = $response->getBody()->getContents();
            $result = json_decode($body, true) ?? [];
            
            if (isset($result['status']) && $result['status'] && isset($result['signature'])) {
                if (Signature::verify($result, $this->config->getSecretKey())) {
                    unset($result['signature']);
                    return $result;
                } else {
                    throw new PaymentException('响应签名验证失败', $result);
                }
            }
            
            return $result;
        } catch (GuzzleException $e) {
            throw new PaymentException('HTTP请求异常: ' . $e->getMessage(), [], $e->getCode());
        }
    }
}