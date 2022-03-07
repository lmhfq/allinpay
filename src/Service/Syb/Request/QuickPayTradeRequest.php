<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午5:16
 */

namespace Lmh\AllinPay\Service\Syb\Request;


class QuickPayTradeRequest extends BaseRequest
{
    /**
     * @var string
     */
    protected $uri = '/apiweb/qpay/payapplyagree';
    /**
     * @var string
     */
    protected $agreeId;
    /**
     * @var int 商户订单金额 单位为分
     */
    protected $amount;
    /**
     * @var string 商户的交易订单号
     */
    protected $reqSn;
    /**
     * @var string 商户的交易订单号
     */
    protected $currency = "CNY";
    /**
     * @var string 订单的展示标题
     */
    protected $subject;
    /**
     * @var string 用于用户订单个性化信息,交易完成通知会带上本字段。
     */
    protected $trxReserve;
    /**
     * @var string
     */
    protected $notifyUrl;
    /**
     * @var string 分账信息
     * 格式:cusid:type:amount;cusid:type:amount…
     * 其中cusid:接收分账的通联商户号type分账类型（01：按金额  02：按比率）如果分账类型为02，则分账比率为0.5表示50%。如果分账类型为01，则分账金额以元为单位表示
     */
    protected $asinfo = '';

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
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject ?: '';
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getNotifyUrl(): string
    {
        return $this->notifyUrl;
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
    public function getTrxReserve(): string
    {
        return $this->trxReserve ?: '';
    }

    /**
     * @param string $trxReserve
     */
    public function setTrxReserve(string $trxReserve): void
    {
        $this->trxReserve = $trxReserve;
    }

    public function getApiParams(): array
    {
        $data = [
            'agreeid' => $this->getAgreeId(),
            'reqsn' => $this->getReqSn(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'notifyurl' => $this->getNotifyUrl(),
            'subject' => $this->getSubject(),
        ];
        if ($this->getTrxReserve()) {
            $data['trxreserve'] = $this->getTrxReserve();
        }
        if ($this->getAsinfo()) {
            $data['asinfo'] = $this->getAsinfo();
        }
        return $data;
    }
}