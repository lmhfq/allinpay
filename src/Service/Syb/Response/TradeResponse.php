<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午3:52
 */

namespace Lmh\AllinPay\Service\Syb\Response;


use Illuminate\Support\Arr;

class TradeResponse extends BaseResponse
{
    protected $trxId;
    protected $reqSn;
    protected $chnlTrxId;
    /**
     * @var string
     */
    protected $payInfo = '';
    /**
     * @var string 交易完成时间
     */
    protected $finTime;

    /**
     * @return mixed
     */
    public function getTrxId()
    {
        return $this->trxId;
    }

    /**
     * @return mixed
     */
    public function getReqSn()
    {
        return $this->reqSn;
    }

    /**
     * @return mixed
     */
    public function getChnlTrxId()
    {
        return $this->chnlTrxId;
    }

    /**
     * @return string
     */
    public function getPayInfo(): string
    {
        return $this->payInfo;
    }

    /**
     * @return string
     */
    public function getFinTime(): string
    {
        return $this->finTime;
    }

    /**
     * @param string $message
     * @author lmh
     */
    public function handle(string $message)
    {
        parent::handle($message);
        $this->trxId = Arr::get($this->responseData, 'trxid', '');
        $this->reqSn = Arr::get($this->responseData, 'reqsn', '');
        $this->chnlTrxId = Arr::get($this->responseData, 'chnltrxid', '');
        $this->payInfo = Arr::get($this->responseData, 'payinfo', '');
    }
}