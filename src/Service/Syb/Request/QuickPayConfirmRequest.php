<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午5:16
 */

namespace Lmh\AllinPay\Service\Syb\Request;


class QuickPayConfirmRequest extends BaseRequest
{
    /**
     * @var string
     */
    protected $uri = '/apiweb/qpay/payagreeconfirm';
    /**
     * @var string
     */
    protected $agreeId;
    /**
     * @var string 商户的交易订单号
     */
    protected $reqSn;
    /**
     * @var string 短信验证码
     */
    protected $smsCode;
    /**
     * @var string
     */
    protected $thpinfo;

    /**
     * @return string
     */
    public function getAgreeId(): string
    {
        return $this->agreeId;
    }

    /**
     * @param string $agreeId
     */
    public function setAgreeId(string $agreeId): void
    {
        $this->agreeId = $agreeId;
    }

    /**
     * @return string
     */
    public function getReqSn(): string
    {
        return $this->reqSn;
    }

    /**
     * @param string $reqSn
     */
    public function setReqSn(string $reqSn): void
    {
        $this->reqSn = $reqSn;
    }

    /**
     * @return string
     */
    public function getSmsCode(): string
    {
        return $this->smsCode;
    }

    /**
     * @param string $smsCode
     */
    public function setSmsCode(string $smsCode): void
    {
        $this->smsCode = $smsCode;
    }

    /**
     * @return string
     */
    public function getThpinfo(): string
    {
        return $this->thpinfo ?: '';
    }

    /**
     * @param string $thpinfo
     */
    public function setThpinfo(string $thpinfo): void
    {
        $this->thpinfo = $thpinfo;
    }

    public function getApiParams(): array
    {
        $data = [
            'agreeid' => $this->getAgreeId(),
            'reqsn' => $this->getReqSn(),
            'smscode' => $this->getSmsCode(),
        ];
        if ($this->getThpinfo()) {
            $data['thpinfo'] = $this->getThpinfo();
        }
        return $data;
    }
}