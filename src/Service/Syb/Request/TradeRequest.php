<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午2:27
 */

namespace Lmh\AllinPay\Service\Syb\Request;


class TradeRequest extends BaseRequest
{
    /**
     * @var string
     */
    protected $uri = '/apiweb/unitorder/pay';
    /**
     * @var int 商户订单金额 单位为分
     */
    protected $trxAmt;
    /**
     * @var string 商户的交易订单号
     */
    protected $reqSn;
    /**
     * @var string JS支付时使用
     * 微信支付-用户的微信openid
     * 支付宝支付-用户user_id
     * 微信小程序-用户小程序的openid
     * 云闪付JS-用户userId
     */
    protected $acct;
    /**
     * @var string 订单标题 最大50个中文字符
     */
    protected $body;
    /**
     * @var string 交易方式
     */
    protected $payType;
    /**
     * @var string
     */
    protected $cusIp;
    /**
     * @var string
     */
    protected $frontUrl;
    /**
     * @var string
     */
    protected $notifyUrl;
    /**
     * @var string 备注信息 最大160个字节
     */
    protected $remark;
    /**
     * @var int 订单有效时间，以分为单位，不填默认为5分钟
     */
    protected $validTime;
    /**
     * @var string 分账信息
     * 格式:cusid:type:amount;cusid:type:amount…
     * 其中cusid:接收分账的通联商户号type分账类型（01：按金额  02：按比率）如果分账类型为02，则分账比率为0.5表示50%。如果分账类型为01，则分账金额以元为单位表示
     */
    protected $asinfo = '';
    /**
     * @var string
     */
    protected $subAppid;


    /**
     * @return int
     */
    public function getTrxAmt(): int
    {
        return intval($this->trxAmt);
    }

    /**
     * @param int $trxAmt
     */
    public function setTrxAmt(int $trxAmt): void
    {
        $this->trxAmt = $trxAmt;
    }

    /**
     * @return string
     */
    public function getReqSn(): string
    {
        return $this->reqSn ?: '';
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
    public function getAcct(): string
    {
        return $this->acct ?: '';
    }

    /**
     * @param string $acct
     */
    public function setAcct(string $acct): void
    {
        $this->acct = $acct;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body ?: '';
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getPayType(): string
    {
        return $this->payType ?: '';
    }

    /**
     * @param string $payType
     */
    public function setPayType(string $payType): void
    {
        $this->payType = $payType;
    }

    /**
     * @return string
     */
    public function getNotifyUrl(): string
    {
        return $this->notifyUrl ?: '';
    }

    /**
     * @param string $notifyUrl
     */
    public function setNotifyUrl(string $notifyUrl): void
    {
        $this->notifyUrl = $notifyUrl;
    }

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->remark;
    }

    /**
     * @param string $remark
     */
    public function setRemark(string $remark): void
    {
        $this->remark = $remark;
    }

    /**
     * @return int
     */
    public function getValidTime(): int
    {
        return $this->validTime;
    }

    /**
     * @param int $validTime
     */
    public function setValidTime(int $validTime): void
    {
        $this->validTime = $validTime;
    }

    /**
     * @return string
     */
    public function getAsinfo(): string
    {
        return $this->asinfo;
    }

    /**
     * @param string $asinfo
     */
    public function setAsinfo(string $asinfo): void
    {
        $this->asinfo = $asinfo;
    }

    /**
     * @return string
     */
    public function getSubAppid(): string
    {
        return $this->subAppid;
    }

    /**
     * @param string $subAppid
     */
    public function setSubAppid(string $subAppid): void
    {
        $this->subAppid = $subAppid;
    }

    /**
     * @return string
     */
    public function getCusIp(): string
    {
        return $this->cusIp;
    }

    /**
     * @param string $cusIp
     */
    public function setCusIp(string $cusIp): void
    {
        $this->cusIp = $cusIp;
    }


    /**
     * @return string
     */
    public function getFrontUrl(): string
    {
        return $this->frontUrl ?: '';
    }

    /**
     * @param string $frontUrl
     */
    public function setFrontUrl(string $frontUrl): void
    {
        $this->frontUrl = $frontUrl;
    }

    /**
     * @return array
     * @author lmh
     */
    public function getApiParams(): array
    {
        $data = [
            'trxamt' => $this->getTrxAmt(),
            'body' => $this->getBody(),
            'reqsn' => $this->getReqSn(),
            'paytype' => $this->getPayType(),
            'front_url' => $this->getFrontUrl(),
            'notify_url' => $this->getNotifyUrl(),
        ];
        if ($this->getAcct()){
            $data['acct'] = $this->getAcct();
        }
        if ($this->getAsinfo()) {
            $data['asinfo'] = $this->getAsinfo();
        }
        return $data;
    }
}