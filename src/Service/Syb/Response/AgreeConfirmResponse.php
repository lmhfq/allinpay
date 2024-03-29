<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午5:02
 */

namespace Lmh\AllinPay\Service\Syb\Response;


use Illuminate\Support\Arr;

class AgreeConfirmResponse extends BaseResponse
{
    protected $agreeId;
    protected $bankCode;
    protected $bankName;

    /**
     * @return mixed
     */
    public function getAgreeId()
    {
        return $this->agreeId;
    }

    /**
     * @return mixed
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }

    /**
     * @return mixed
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @param string $message
     * @author lmh
     */
    public function handle(string $message)
    {
        parent::handle($message);
        $this->agreeId = Arr::get($this->responseData, 'agreeid', '');
        $this->bankCode = Arr::get($this->responseData, 'bankcode', '');
        $this->bankName = Arr::get($this->responseData, 'bankname', '');
    }
}