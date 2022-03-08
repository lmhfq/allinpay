<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午4:42
 */

namespace Lmh\AllinPay\Service\Syb\Response;


class AgreeApplyResponse extends BaseResponse
{
    protected $thpinfo;

    /**
     * @return mixed
     */
    public function getThpinfo()
    {
        return $this->thpinfo ?: '';
    }


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