<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午1:36
 */

namespace Lmh\AllinPay\Service\Syb\Request;


abstract class BaseRequest
{
    /**
     * @var string 通讯协议版本号
     */
    protected $version = '11';
    /**
     * @var string  签名方式
     */
    protected $signType = 'RSA';
    /**
     * @var string
     */
    protected $uri = '';
    /**
     * @var string
     */
    protected $appId;
    /**
     * @var string
     */
    protected $cusId;

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getSignType(): string
    {
        return $this->signType;
    }

    /**
     * @param string $signType
     */
    public function setSignType(string $signType): void
    {
        $this->signType = $signType;
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @param string $appId
     */
    public function setAppId(string $appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @return string
     */
    public function getCusId(): string
    {
        return $this->cusId;
    }

    /**
     * @param string $cusId
     */
    public function setCusId(string $cusId): void
    {
        $this->cusId = $cusId;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    public abstract function getApiParams(): array;
}