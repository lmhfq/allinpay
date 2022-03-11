<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午4:08
 */

namespace Lmh\AllinPay\Service\Syb\Response;


use Illuminate\Support\Arr;

class RefundResponse extends BaseResponse
{
    protected $trxId;

    /**
     * @return mixed
     */
    public function getTrxId()
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