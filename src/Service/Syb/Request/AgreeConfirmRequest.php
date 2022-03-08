<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午4:29
 */

namespace Lmh\AllinPay\Service\Syb\Request;

/**
 * 快捷支付签约申请确认
 * Class AgreeApplyRequest
 * @package Lmh\AllinPay\Service\Syb\Request
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 */
class AgreeConfirmRequest extends BaseRequest
{
    /**
     * @var string
     */
    protected $uri = '/apiweb/qpay/agreeconfirm';

    protected $merUserId;
    /**
     * @var string 卡类型 00:借记卡 02:准贷记卡/贷记卡
     */
    protected $acctType = '00';
    /**
     * @var string 银行卡号
     */
    protected $acctNo;
    /**
     * @var int 证件类型
     * 0:身份证
     * 2:护照
     * 5:港澳通行证
     * 6:台湾通行证
     */
    protected $idType = 0;
    /**
     * @var string 证件号
     */
    protected $idNo;
    /**
     * @var string 户名
     */
    protected $acctName;
    /**
     * @var string 手机号码
     */
    protected $mobile;
    /**
     * @var string 信用卡有效期 MMyy
     */
    protected $validDate;
    /**
     * @var string 信用卡cvv2
     */
    protected $cvv2;
    /**
     * @var string 短信验证码
     */
    protected $smsCode;
    /**
     * @var string 签约申请时返回,如果不为空,则原样带上
     */
    protected $thpinfo;

    /**
     * @return mixed
     */
    public function getMerUserId()
    {
        return $this->merUserId;
    }

    /**
     * @param mixed $merUserId
     */
    public function setMerUserId($merUserId): void
    {
        $this->merUserId = $merUserId;
    }

    /**
     * @return string
     */
    public function getAcctType(): string
    {
        return $this->acctType;
    }

    /**
     * @param string $acctType
     */
    public function setAcctType(string $acctType): void
    {
        $this->acctType = $acctType;
    }

    /**
     * @return string
     */
    public function getAcctNo(): string
    {
        return $this->acctNo;
    }

    /**
     * @param string $acctNo
     */
    public function setAcctNo(string $acctNo): void
    {
        $this->acctNo = $acctNo;
    }

    /**
     * @return int
     */
    public function getIdType(): int
    {
        return $this->idType;
    }

    /**
     * @param int $idType
     */
    public function setIdType(int $idType): void
    {
        $this->idType = $idType;
    }

    /**
     * @return string
     */
    public function getIdNo(): string
    {
        return $this->idNo ?: '';
    }

    /**
     * @param string $idNo
     */
    public function setIdNo(string $idNo): void
    {
        $this->idNo = $idNo;
    }

    /**
     * @return string
     */
    public function getAcctName(): string
    {
        return $this->acctName ?: '';
    }

    /**
     * @param string $acctName
     */
    public function setAcctName(string $acctName): void
    {
        $this->acctName = $acctName;
    }

    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile ?: '';
    }

    /**
     * @param string $mobile
     */
    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    /**
     * @return string
     */
    public function getValidDate(): string
    {
        return $this->validDate ?: '';
    }

    /**
     * @param string $validDate
     */
    public function setValidDate(string $validDate): void
    {
        $this->validDate = $validDate;
    }

    /**
     * @return string
     */
    public function getCvv2(): string
    {
        return $this->cvv2 ?: '';
    }

    /**
     * @param string $cvv2
     */
    public function setCvv2(string $cvv2): void
    {
        $this->cvv2 = $cvv2;
    }

    /**
     * @return string
     */
    public function getSmsCode(): string
    {
        return $this->smsCode ?: '';
    }

    /**
     * @param string $smsCode
     */
    public function setSmsCode(string $smsCode): void
    {
        $this->smsCode = $smsCode;
    }

    /**
     * @return string
     */
    public function getThpinfo(): string
    {
        return $this->thpinfo ?: '';
    }

    /**
     * @param string $thpinfo
     */
    public function setThpinfo(string $thpinfo): void
    {
        $this->thpinfo = $thpinfo;
    }


    public function getApiParams(): array
    {
        $data = [
            'meruserid' => $this->getMerUserId(),
            'accttype' => $this->getAcctType(),
            'acctno' => $this->getAcctNo(),
            'idtype' => $this->getIdType(),
            'idno' => $this->getIdNo(),
            'acctname' => $this->getAcctName(),
            'mobile' => $this->getMobile(),
            'smscode' => $this->getSmsCode(),
        ];
        if ($this->getThpinfo()) {
            $data['thpinfo'] = $this->getThpinfo();
        }
        if ($this->getAcctType() != '00') {
            $data['validdate'] = $this->getValidDate();
            $data['cvv2'] = $this->getCvv2();
        }
        return $data;
    }
}