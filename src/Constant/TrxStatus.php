<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午4:22
 */

namespace Lmh\AllinPay\Constant;


class TrxStatus
{
    /**
     * 交易成功
     */
    public const SUCCESS = '0000';
    /**
     * 交易不存在
     */
    public const S1001 = '1001';
    /**
     * 短信验证码已发送,请调用申请确认完成签约
     */
    public const S1999 = '1999';
    /**
     * 流水号重复
     */
    public const S3888 = '3888';
    /**
     * 校验实名信息失败
     */
    public const S3031 = '3031';
}