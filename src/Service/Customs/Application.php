<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/11
 * Time: 上午11:02
 */

namespace Lmh\AllinPay\Service\Customs;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Lmh\AllinPay\Service\Customs\Request\BaseRequest;
use Lmh\AllinPay\Service\Customs\Response\BaseResponse;
use Lmh\AllinPay\Support\Md5Signer;
use Lmh\AllinPay\Support\ServiceContainer;
use Lmh\AllinPay\Support\SignatureFactory;
use Psr\Log\LoggerInterface;

class Application extends ServiceContainer
{
    /**
     * 执行请求
     * @param BaseRequest $request
     * @param BaseResponse $response
     * @return BaseResponse
     * @throws GuzzleException
     * @author lmh
     */
    public function execute(BaseRequest $request, BaseResponse $response): BaseResponse
    {
        if (!$request->getMchtId()) {
            $request->setMchtId($this->offsetGet("config")['mchtId']);
        }
        SignatureFactory::setSigner(new Md5Signer(
            $this->offsetGet("config")['key']
        ));
        $request->handle();
        /**
         * @var LoggerInterface $logger
         */
        $logger = $this->offsetGet("config")['logger'] ?? null;
        if ($logger instanceof LoggerInterface && $this->offsetGet("config")['debug']) {
            $logger->debug("请求原文：" . $request->getUri() . '：' . $request->getRequestPlainText());
        }
        $result = $this->request($request);
        $response->handle($result);
        if ($logger instanceof LoggerInterface && $this->offsetGet("config")['debug']) {
            $logger->debug("响应原文：" . $response->getResponsePlainText());
        }
        return $response;
    }

    /**
     * @param BaseRequest $request
     * @return string
     * @throws GuzzleException
     * @author lmh
     */
    private function request(BaseRequest $request): string
    {
        $client = new Client($this->offsetGet("config")['http']);
        $options = [
            'headers' => [
                'Accept' => 'text/plain; charset=UTF8',
            ],
            'form_params' => [
                'data' => base64_encode(trim($request->getRequestPlainText()))
            ],
            'verify' => false
        ];
        $response = $client->request('POST', $request->getUri(), $options);
        return $response->getBody()->getContents();
    }
}