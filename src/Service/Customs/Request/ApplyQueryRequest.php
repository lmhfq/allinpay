<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/11
 * Time: 下午3:54
 */

namespace Lmh\AllinPay\Service\Customs\Request;


class ApplyQueryRequest extends BaseRequest
{
    protected $uri = '/customs/access';
    /**
     * @var string 海关类别
     */
    protected $customsCode;
    /**
     * @var string 支付流水号
     */
    protected $paymentOrderNo;
    /**
     * @var string 商户订单号
     */
    protected $mchtOrderNo;

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

    public function handle()
    {
        $data = [];
        $head = parent::getHead();
        $data = array_merge($data, $head);
        $body = [
            'VISITOR_ID' => $this->getVisitorId(),
            'CUSTOMS_CODE' => $this->getCustomsCode(),
            'PAYMENT_MCHT_ID' => $this->getMchtId(),
            'PAYMENT_ORDER_NO' => $this->getPaymentOrderNo(),
            'MCHT_ORDER_NO' => $this->getMchtOrderNo(),
        ];
        $data = array_merge($data, [
            'BODY' => $body
        ]);
        parent::process($data);
    }
}