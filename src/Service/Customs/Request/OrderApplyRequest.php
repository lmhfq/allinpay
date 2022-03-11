<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/11
 * Time: 上午11:10
 */

namespace Lmh\AllinPay\Service\Customs\Request;


use Exception;

class OrderApplyRequest extends BaseRequest
{
    protected $uri = '/customs/pvcapply';
    /**
     * @var string 海关类别
     */
    protected $customsCode;
    /**
     * @var string 支付渠道 1-综合支付二代支付网关支付(快捷支付) 2-收银宝支付
     */
    protected $paymentChannel;
    /**
     * @var string 支付用的商户号
     */
    protected $cusId;
    /**
     * @var string 支付时间
     */
    protected $paymentDatetime;
    /**
     * @var string 商户订单号
     */
    protected $mchtOrderNo;
    /**
     * @var string 支付流水号
     */
    protected $paymentOrderNo;
    /**
     * @var int 支付总额 单位为分
     */
    protected $paymentAmount;
    /**
     * @var string 支付币制 人民币156
     */
    protected $currency = '156';
    /**
     * @var string 支付人姓名
     */
    protected $payerName;
    /**
     * @var string 支付人证件类型 01：身份证
     */
    protected $paperType = '01';
    /**
     * @var string 支付人证件号码
     */
    protected $paperNumber;
    /**
     * @var string 支付人手机号
     */
    protected $paperPhone;

    /**
     * @return string
     */
    public function getCustomsCode(): string
    {
        return $this->customsCode;
    }

    /**
     * @param string $customsCode
     */
    public function setCustomsCode(string $customsCode): void
    {
        $this->customsCode = $customsCode;
    }

    /**
     * @return string
     */
    public function getPaymentChannel(): string
    {
        return $this->paymentChannel;
    }

    /**
     * @param string $paymentChannel
     */
    public function setPaymentChannel(string $paymentChannel): void
    {
        $this->paymentChannel = $paymentChannel;
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
    public function getPaymentDatetime(): string
    {
        return $this->paymentDatetime;
    }

    /**
     * @param string $paymentDatetime
     */
    public function setPaymentDatetime(string $paymentDatetime): void
    {
        $this->paymentDatetime = $paymentDatetime;
    }

    /**
     * @return string
     */
    public function getMchtOrderNo(): string
    {
        return $this->mchtOrderNo;
    }

    /**
     * @param string $mchtOrderNo
     */
    public function setMchtOrderNo(string $mchtOrderNo): void
    {
        $this->mchtOrderNo = $mchtOrderNo;
    }

    /**
     * @return string
     */
    public function getPaymentOrderNo(): string
    {
        return $this->paymentOrderNo;
    }

    /**
     * @param string $paymentOrderNo
     */
    public function setPaymentOrderNo(string $paymentOrderNo): void
    {
        $this->paymentOrderNo = $paymentOrderNo;
    }

    /**
     * @return int
     */
    public function getPaymentAmount(): int
    {
        return $this->paymentAmount;
    }

    /**
     * @param int $paymentAmount
     */
    public function setPaymentAmount(int $paymentAmount): void
    {
        $this->paymentAmount = $paymentAmount;
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
    public function getPayerName(): string
    {
        return $this->payerName;
    }

    /**
     * @param string $payerName
     */
    public function setPayerName(string $payerName): void
    {
        $this->payerName = $payerName;
    }

    /**
     * @return string
     */
    public function getPaperType(): string
    {
        return $this->paperType;
    }

    /**
     * @param string $paperType
     */
    public function setPaperType(string $paperType): void
    {
        $this->paperType = $paperType;
    }

    /**
     * @return string
     */
    public function getPaperNumber(): string
    {
        return $this->paperNumber;
    }

    /**
     * @param string $paperNumber
     */
    public function setPaperNumber(string $paperNumber): void
    {
        $this->paperNumber = $paperNumber;
    }

    /**
     * @return string
     */
    public function getPaperPhone(): string
    {
        return $this->paperPhone;
    }

    /**
     * @param string $paperPhone
     */
    public function setPaperPhone(string $paperPhone): void
    {
        $this->paperPhone = $paperPhone;
    }

    /**
     * @throws Exception
     * @author lmh
     */
    public function handle()
    {
        $data = [];
        $head = parent::getHead();
        $data = array_merge($data, $head);
        $body = [
            'CUSTOMS_CODE' => $this->getCustomsCode(),
            'PAYMENT_CHANNEL' => $this->getPaymentChannel(),
            'CUS_ID' => $this->getCusId(),
            'PAYMENT_DATETIME' => $this->getPaymentDatetime(),
            'MCHT_ORDER_NO' => $this->getMchtOrderNo(),
            'PAYMENT_ORDER_NO' => $this->getPaymentOrderNo(),
            'PAYMENT_AMOUNT' => $this->getPaymentAmount(),
            'CURRENCY' => $this->getCurrency(),
            'PAYER_NAME' => $this->getPayerName(),
            'PAPER_TYPE' => $this->getPaperType(),
            'PAPER_NUMBER' => $this->getPaperNumber(),
            'PAPER_PHONE' => $this->getPaperPhone()
        ];
        $data = array_merge($data, [
            'BODY' => $body
        ]);
        parent::process($data);
    }
}