<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2021/10/18
 * Time: 下午3:14
 */

namespace Lmh\AllinPay\Service\Customs\Response;


use Illuminate\Support\Arr;
use Lmh\AllinPay\Support\Xml;

class BaseResponse
{
    /**
     * @var string 成功应答’0000’，其他为失败应答.报关信息见下方字段
     */
    protected $returnCode;
    /**
     * @var string 对失败应答的简单描述，应答码为’0000’时留空
     */
    protected $returnMsg;
    /**
     * @var string 响应报文
     */
    protected $responsePlainText;
    /**
     * @var array
     */
    protected $responseData = [];
    /**
     * @var array
     */
    protected $responseBody = [];

    /**
     * @return string
     */
    public function getReturnCode(): string
    {
        return $this->returnCode;
    }

    /**
     * @return string
     */
    public function getReturnMsg(): string
    {
        return $this->returnMsg;
    }

    /**
     * @return string
     */
    public function getResponsePlainText(): string
    {
        return $this->responsePlainText;
    }

    /**
     * @return array
     */
    public function getResponseData(): array
    {
        return $this->responseData;
    }

    /**
     * @return array
     */
    public function getResponseBody(): array
    {
        return $this->responseBody;
    }

    /**
     * @param string $message
     * @author lmh
     */
    public function handle(string $message)
    {
        $this->responsePlainText = trim(base64_decode($message));
        if (strpos($this->responsePlainText, '<') === false) {
            parse_str($this->responsePlainText, $params);
            $this->returnCode = Arr::get($params, 'RETURN_CODE', '');
            $this->returnMsg = Arr::get($params, 'RETURN_MSG', '');
        } else {
            $this->responseData = Xml::parse($this->responsePlainText);
            $this->responseBody = Arr::get($this->responseData, 'BODY', []);
            $this->returnCode = Arr::get($this->responseBody, 'RETURN_CODE', '');
            $this->returnMsg = Arr::get($this->responseBody, 'RETURN_MSG', '');
        }
    }
}