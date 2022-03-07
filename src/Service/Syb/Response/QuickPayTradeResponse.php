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
    protected $thpinfo;

    /**
     * @param string $message
     * @author lmh
     */
    public function handle(string $message)
    {
        parent::handle($message);
        $this->thpinfo = $this->responseData['thpinfo'] ?? '';
    }
}