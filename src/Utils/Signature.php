<?php

namespace Yooer\Payment\Utils;

class Signature
{
    /**
     * 创建签名
     * 
     * @param array $params 需要签名的参数
     * @param string $secretKey 密钥
     * @return string
     */
    public static function create(array $params, string $secretKey): string
    {
        ksort($params);
        reset($params);
        $sign = '';
        
        foreach ($params as $key => $val) {
            if ($val === '') continue;
            if ($key != 'signature') {
                if (is_array($val)) {
                    $val = json_encode($val, JSON_UNESCAPED_UNICODE);
                }
                if ($sign != '') {
                    $sign .= "&";
                }
                $sign .= "$key=$val";
            }
        }
        
        return md5($sign . $secretKey);
    }
    
    /**
     * 验证签名
     * 
     * @param array $data 数据(含签名)
     * @param string $secretKey 密钥
     * @return bool
     */
    public static function verify(array $data, string $secretKey): bool
    {
        if (!isset($data['signature'])) {
            return false;
        }
        
        $signature = $data['signature'];
        $calculatedSignature = self::create($data, $secretKey);
        
        return $signature === $calculatedSignature;
    }
}