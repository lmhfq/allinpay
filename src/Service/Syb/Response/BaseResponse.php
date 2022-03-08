<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午1:36
 */

namespace Lmh\AllinPay\Service\Syb\Response;

class BaseResponse
{
    /**
     * @var string 此字段是通信标识，非交易结果，交易是否成功需要查看trxstatus来判断
     * SUCCESS/FAIL
     */
    protected $retCode;
    /**
     * @var string
     */
    protected $retMsg;
    /**
     * @var string
     */
    protected $responsePlainText;
    /**
     * @var array
     */
    protected $responseData;
    /**
     * @var string 交易的状态
     */
    protected $trxStatus;
    /**
     * @var string 错误信息
     */
    protected $errMsg;

    /**
     * @return string
     */
    public function getResponsePlainText(): string
    {
        return $this->responsePlainText;
    }

    /**
     * @return mixed
     */
    public function getTrxStatus(): string
    {
        return $this->trxStatus;
    }

    /**
     * @return string
     */
    public function getRetCode(): string
    {
        return $this->retCode;
    }

    /**
     * @return string
     */
    public function getRetMsg(): string
    {
        return $this->retMsg;
    }

    /**
     * @return array
     */
    public function getResponseData(): array
    {
        return $this->responseData;
    }

    /**
     * @return string
     */
    public function getErrMsg(): string
    {
        return $this->errMsg;
    }

    /**
     * @param string $message
     * @author lmh
     */
    public function handle(string $message)
    {
        $this->responsePlainText = $message;
        $result = json_decode($message, true);
        $this->retCode = $result['retcode'] ?? '';
        $this->retMsg = $result['retmsg'] ?? '';
        $this->responseData = $result;
        $this->trxStatus = $this->responseData['trxstatus'] ?? '';
        $this->errMsg = $this->responseData['errmsg'] ?? '';
    }
}