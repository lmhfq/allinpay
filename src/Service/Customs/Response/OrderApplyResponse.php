<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/11
 * Time: 下午2:19
 */

namespace Lmh\AllinPay\Service\Customs\Response;


use Illuminate\Support\Arr;
use Lmh\AllinPay\Constant\ReturnCode;

class OrderApplyResponse extends BaseResponse
{

    protected $verDept;

    /**
     * @return mixed
     */
    public function getVerDept()
    {
        return $this->verDept;
    }


    /**
     * @param string $message
     * @author lmh
     */
    public function handle(string $message)
    {
        parent::handle($message);
        if ($this->returnCode == ReturnCode::SUCCESS) {
            $this->verDept = intval(Arr::get($this->responseBody, 'VER_DEPT', 0));
        }
    }
}