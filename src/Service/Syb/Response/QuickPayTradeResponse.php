<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午5:35
 */

namespace Lmh\AllinPay\Service\Syb\Response;


class QuickPayTradeResponse extends BaseResponse
{
    /**
     * @var string 交易透传信息
     */
    protected $thpinfo;
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
     * @author lmh
     */
    public function getThpinfo(): string
    {
        return $this->thpinfo;
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
        $this->thpinfo = $this->responseData['thpinfo'] ?? '';
        $this->trxId = $this->responseData['trxid'] ?? '';
        $this->reqSn = $this->responseData['reqsn'] ?? '';
    }
}