<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午4:17
 */

namespace Lmh\AllinPay\Constant;


class TrxCode
{
    /**
     * 微信支付
     */
    public const VSP501 = 'VSP501';
    /**
     * 微信支付退款
     */
    public const VSP503 = 'VSP503';
    /**
     * 支付宝支付
     */
    public const VSP511 = 'VSP511';
    /**
     * 支付宝支付退款
     */
    public const VSP513 = 'VSP513';
    /**
     * 扫码支付
     */
    public const VSP541 = 'VSP541';
    /**
     * 快捷支付
     */
    public const VSP301 = 'VSP301';
    /**
     * 快捷支付退货
     */
    public const VSP303 = 'VSP303';
}