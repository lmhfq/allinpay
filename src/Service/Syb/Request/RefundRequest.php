<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午4:03
 */

namespace Lmh\AllinPay\Service\Syb\Request;


class RefundRequest extends BaseRequest
{
    /**
     * @var string
     */
    protected $uri = '/apiweb/tranx/refund';
    /**
     * @var int 退款金额 单位为分
     */
    protected $trxAmt;
    /**
     * @var string 商户的交易订单号
     */
    protected $reqSn;
    /**
     * @var string 原交易的商户订单号
     */
    protected $oldReqSn;
    /**
     * @var string 原交易的收银宝平台流水
     * oldreqsn和oldtrxid必填其一
     * 建议:商户如果同时拥有oldtrxid和oldreqsn,优先使用oldtrxid
     */
    protected $oldTrxId;
    /**
     * @var string 备注信息
     */
    protected $remark;

    /**
     * @return int
     */
    public function getTrxAmt(): int
    {
        return $this->trxAmt;
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
    public function getOldReqSn(): string
    {
        return $this->oldReqSn ?: '';
    }

    /**
     * @param string $oldReqSn
     */
    public function setOldReqSn(string $oldReqSn): void
    {
        $this->oldReqSn = $oldReqSn;
    }

    /**
     * @return string
     */
    public function getOldTrxId(): string
    {
        return $this->oldTrxId ?: '';
    }

    /**
     * @param string $oldTrxId
     */
    public function setOldTrxId(string $oldTrxId): void
    {
        $this->oldTrxId = $oldTrxId;
    }

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->remark ?: '';
    }

    /**
     * @param string $remark
     */
    public function setRemark(string $remark): void
    {
        $this->remark = $remark;
    }


    public function getApiParams(): array
    {
        $data = [
            'trxamt' => $this->getTrxAmt(),
            'reqsn' => $this->getReqSn(),
            'remark' => $this->getRemark(),
        ];
        if ($this->getOldReqSn()) {
            $data['oldreqsn'] = $this->getOldReqSn();
        }
        if ($this->getOldTrxId()) {
            $data['oldtrxid'] = $this->getOldTrxId();
        }
        return $data;
    }
}