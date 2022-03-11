<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午5:35
 */

namespace Lmh\AllinPay\Service\Syb\Response;


use Illuminate\Support\Arr;

class QuickPayTradeResponse extends BaseResponse
{
    /**
     * @var string 交易透传信息
     */
    protected $thpInfo;
    /**
     * @var string 平台的交易流水号
     */
    protected $trxId;
    /**
     * @var string 商户的交易订单号
     */
    protected $reqSn;

    /**
     * @return string
     * @author lmh
     */
    public function getTrxId(): string
    {
        return $this->trxId;
    }

    /**
     * @return string
     */
    public function getThpInfo(): string
    {
        return $this->thpInfo;
    }


    /**
     * @return string
     */
    public function getReqSn(): string
    {
        return $this->reqSn;
    }

    /**
     * @param string $message
     * @author lmh
     */
    public function handle(string $message)
    {
        parent::handle($message);
        $this->thpInfo = Arr::get($this->responseData, 'thpinfo', '');
        $this->trxId = Arr::get($this->responseData, 'trxid', '');
        $this->reqSn = Arr::get($this->responseData, 'reqsn', '');
    }
}