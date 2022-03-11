<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午5:41
 */

namespace Lmh\AllinPay\Service\Syb\Response;


use Illuminate\Support\Arr;

class QuickPayConfirmResponse extends BaseResponse
{
    /**
     * @var string 平台的交易流水号
     */
    protected $trxId;

    /**
     * @return string
     */
    public function getTrxId(): string
    {
        return $this->trxId;
    }

    /**
     * @param string $message
     * @author lmh
     */
    public function handle(string $message)
    {
        parent::handle($message);
        $this->trxId = Arr::get($this->responseData, 'trxid', '');
    }
}