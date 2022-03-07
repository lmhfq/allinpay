<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午1:36
 */

namespace Lmh\AllinPay\Service\Syb;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Lmh\AllinPay\Service\Syb\Request\BaseRequest;
use Lmh\AllinPay\Service\Syb\Response\BaseResponse;
use Lmh\AllinPay\Support\RSASigner;
use Lmh\AllinPay\Support\ServiceContainer;
use Lmh\AllinPay\Support\SignatureFactory;
use Lmh\AllinPay\Support\StrUtil;
use Psr\Log\LoggerInterface;

class Application extends ServiceContainer
{
    /**
     * @param BaseRequest $request
     * @param BaseResponse $response
     * @return BaseResponse
     * @throws GuzzleException
     * @author lmh
     */
    public function execute(BaseRequest $request, BaseResponse $response): BaseResponse
    {
        $sysParams["cusid"] = $this->offsetGet("config")['cusid'];
        if (isset($this->offsetGet("config")['orgid']) && $this->offsetGet("config")['orgid']) {
            $sysParams['orgid'] = $this->offsetGet("config")['orgid'] ?? '';
        }
        $sysParams["appid"] = $this->offsetGet("config")['appid'];
        $sysParams["version"] = $request->getVersion();
        $sysParams["signtype"] = $request->getSignType();
        $sysParams["randomstr"] = self::random();
        $apiParams = $request->getApiParams();
        $params = array_merge($sysParams, $apiParams);
        SignatureFactory::setSigner(new RSASigner(
            $this->offsetGet("config")['keystoreFilename'],
            $this->offsetGet("config")['keystorePassword'],
            $this->offsetGet("config")['keyContent'],
            $this->offsetGet("config")['certificateFilename'],
            $this->offsetGet("config")['certContent']
        ));
        $requestPlainText = StrUtil::getSignText($params);
        $params['sign'] = SignatureFactory::getSigner()->sign($requestPlainText);
        $result = $this->request($request, $params);

        $logger = $this->offsetGet("config")['logger'] ?? null;
        if ($logger instanceof LoggerInterface && $this->offsetGet("config")['debug']) {
            $logger->debug("请求原文：", $params);
        }
        $response->handle($result);
        if ($logger instanceof LoggerInterface && $this->offsetGet("config")['debug']) {
            $logger->debug("响应原文：" . $response->getResponsePlainText());
        }
        return $response;
    }

    /**
     * @param BaseRequest $request
     * @param array $params
     * @return string
     * @throws GuzzleException
     * @author lmh
     */
    private function request(BaseRequest $request, array $params): string
    {
        $client = new Client($this->offsetGet("config")['http']);
        $options = [
            'headers' => [
                'Accept' => 'text/xml; charset=UTF8',
            ],
            'form_params' => $params,
            'verify' => false
        ];
        $response = $client->request('POST', $request->getUri(), $options);
        return $response->getBody()->getContents();
    }


    /**
     * Generates a random string of given length from characters specified in second argument.
     * Supports intervals, such as `0-9` or `A-Z`.
     * @param int $length
     * @param string $charList
     * @return string
     */
    public static function random(int $length = 16, string $charList = '0-9a-z'): string
    {
        $charList = count_chars(preg_replace_callback('#.-.#', function (array $m): string {
            return implode('', range($m[0][0], $m[0][2]));
        }, $charList), 3);
        $chLen = strlen($charList);
        $res = '';
        for ($i = 0; $i < $length; $i++) {
            $res .= $charList[random_int(0, $chLen - 1)];
        }
        return $res;
    }
}