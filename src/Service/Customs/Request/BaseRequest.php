<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2021/10/18
 * Time: 下午3:12
 */

namespace Lmh\AllinPay\Service\Customs\Request;


use Exception;
use Lmh\AllinPay\Support\SignatureFactory;
use Lmh\AllinPay\Support\Xml;

abstract class BaseRequest
{
    /**
     * @var string
     */
    protected $version = 'v5.6';
    /**
     * @var string 默认值1，UTF-8
     */
    protected $charset = '1';
    /**
     * @var string  签名方式 默认值1，MD5签名
     */
    protected $signType = '1';
    /**
     * @var string
     */
    protected $uri = '';
    /**
     * @var string 请求报文明文
     */
    protected $requestPlainText;
    /**
     * @var string
     */
    protected $visitorId = 'MCT';
    /**
     * @var string
     */
    protected $mchtId;
    /**
     * @var string 流水号，无业务含义
     */
    protected $orderNo;
    /**
     * @var string 时间格式 yyyyMMddHH24mmss
     */
    protected $transDatetime;

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getVisitorId(): string
    {
        return $this->visitorId;
    }

    /**
     * @param string $visitorId
     */
    public function setVisitorId(string $visitorId): void
    {
        $this->visitorId = $visitorId;
    }

    /**
     * @return string
     */
    public function getMchtId(): string
    {
        return $this->mchtId ?: '';
    }

    /**
     * @param string $mchtId
     */
    public function setMchtId(string $mchtId): void
    {
        $this->mchtId = $mchtId;
    }

    /**
     * @return string
     */
    public function getOrderNo(): string
    {
        return $this->orderNo ?: '';
    }

    /**
     * @param string $orderNo
     */
    public function setOrderNo(string $orderNo): void
    {
        $this->orderNo = $orderNo;
    }

    /**
     * @return string
     */
    public function getCharset(): string
    {
        return $this->charset;
    }

    /**
     * @param string $charset
     */
    public function setCharset(string $charset): void
    {
        $this->charset = $charset;
    }

    /**
     * @return string
     */
    public function getSignType(): string
    {
        return $this->signType;
    }

    /**
     * @param string $signType
     */
    public function setSignType(string $signType): void
    {
        $this->signType = $signType;
    }

    /**
     * @return string
     */
    public function getRequestPlainText(): string
    {
        return $this->requestPlainText;
    }

    /**
     * @param string $requestPlainText
     */
    public function setRequestPlainText(string $requestPlainText): void
    {
        $this->requestPlainText = $requestPlainText;
    }

    /**
     * @return string
     */
    public function getTransDatetime(): string
    {
        return $this->transDatetime ?: '';
    }

    /**
     * @param string $transDatetime
     */
    public function setTransDatetime(string $transDatetime): void
    {
        $this->transDatetime = $transDatetime;
    }


    /**
     * @return array[]
     */
    protected function getHead(): array
    {
        if (empty($this->getTransDatetime())) {
            $this->setTransDatetime(date('YmdHis'));
        }
        return [
            'HEAD' => [
                'VERSION' => $this->getVersion(),
                'VISITOR_ID' => $this->getVisitorId(),
                'MCHT_ID' => $this->getMchtId(),
                'ORDER_NO' => $this->getOrderNo(),
                'TRANS_DATETIME' => $this->getTransDatetime(),
                'CHARSET' => $this->getCharset(),
                'SIGN_TYPE' => $this->getSignType(),
            ],
        ];
    }

    /**
     * @param array $data
     * @throws Exception
     * @author lmh
     */
    public function process(array $data)
    {
        $bodyPlainText = Xml::build($data['BODY'],'BODY');
        $signature = SignatureFactory::getSigner()->sign(trim($bodyPlainText));
        $data['HEAD']['SIGN_MSG'] = $signature;
        $this->requestPlainText = Xml::build($data);
    }
}