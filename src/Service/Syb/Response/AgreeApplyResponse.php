<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午4:42
 */

namespace Lmh\AllinPay\Service\Syb\Response;


use Illuminate\Support\Arr;

class AgreeApplyResponse extends BaseResponse
{
    protected $thpInfo;

    /**
     * @return mixed
     */
    public function getThpInfo()
    {
        return $this->thpInfo;
    }


    /**
     * @param string $message
     * @author lmh
     */
    public function handle(string $message)
    {
        parent::handle($message);
        $this->thpInfo = Arr::get($this->responseData, 'thpinfo', '');
    }
}