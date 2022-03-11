<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/11
 * Time: 下午4:15
 */

namespace Lmh\AllinPay\Service\Customs\Response;


use Illuminate\Support\Arr;
use Lmh\AllinPay\Constant\ReturnCode;

class ApplyQueryResponse extends BaseResponse
{
    /**
     * @var int 发送状态 0-待发送 1-发送成功 2-发送失败
     */
    protected $sendStatus;
    /**
     * @var string
     */
    protected $sendDatetime;
    /**
     * @var string 平台入库回执状态 0-入库失败 1-入库成功
     */
    protected $insReceiptStatus;
    /**
     * @var string 平台入库回执时间
     */
    protected $insReceiptTime;
    /**
     * @var string 海关入库回执状态 0-申报失败 1-三单对碰成功 2-申报成功
     */
    protected $customsReceiptStatus;
    /**
     * @var string 海关入库回执时间
     */
    protected $customsReceiptTime;

    /**
     * @return int
     */
    public function getSendStatus(): int
    {
        return $this->sendStatus;
    }

    /**
     * @return string
     */
    public function getSendDatetime(): string
    {
        return $this->sendDatetime;
    }

    /**
     * @return string
     */
    public function getInsReceiptStatus(): string
    {
        return $this->insReceiptStatus;
    }

    /**
     * @return string
     */
    public function getInsReceiptTime(): string
    {
        return $this->insReceiptTime;
    }

    /**
     * @return string
     */
    public function getCustomsReceiptStatus(): string
    {
        return $this->customsReceiptStatus;
    }

    /**
     * @param string $message
     * @author lmh
     */
    public function handle(string $message)
    {
        parent::handle($message);
        if ($this->returnCode == ReturnCode::SUCCESS) {
            $this->sendStatus = intval(Arr::get($this->responseBody, 'SEND_STATUS', 0));
            $this->sendDatetime = Arr::get($this->responseBody, 'SEND_DATETIME', '');
            $this->insReceiptStatus = Arr::get($this->responseBody, 'INS_RECEIPT_STATUS', '');
            $this->insReceiptTime = Arr::get($this->responseBody, 'INS_RECEIPT_TIME', '');
            $this->insReceiptTime = Arr::get($this->responseBody, 'INS_RECEIPT_TIME', '');
            $this->customsReceiptStatus = Arr::get($this->responseBody, 'CUSTOMS_RECEIPT_STATUS', '');
            $this->customsReceiptTime = Arr::get($this->responseBody, 'CUSTOMS_RECEIPT_TIME', '');
        }
    }
}